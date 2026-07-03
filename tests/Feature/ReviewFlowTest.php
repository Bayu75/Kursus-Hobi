<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Instructor;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ReviewFlowTest extends TestCase
{
    use RefreshDatabase;

    private User $user;
    private Enrollment $completedEnrollment;

    protected function setUp(): void
    {
        parent::setUp();

        $category = Category::factory()->create();
        $instructor = Instructor::factory()->create();
        $course = Course::factory()->create([
            'category_id' => $category->id,
            'instructor_id' => $instructor->id,
        ]);

        $this->user = User::factory()->create(['role_id' => 2]);

        $this->completedEnrollment = Enrollment::factory()->create([
            'user_id' => $this->user->id,
            'course_id' => $course->id,
            'status' => 'completed',
        ]);
    }

    public function test_user_can_submit_review(): void
    {
        $response = $this->actingAs($this->user)->post(route('reviews.store', $this->completedEnrollment), [
            'rating_value' => 5,
            'comment' => 'Kursus yang sangat bagus!',
        ]);

        $response->assertRedirect(route('dashboard'));
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('reviews', [
            'user_id' => $this->user->id,
            'course_id' => $this->completedEnrollment->course_id,
            'rating_value' => 5,
            'comment' => 'Kursus yang sangat bagus!',
        ]);
    }

    public function test_user_cannot_review_without_rating(): void
    {
        $response = $this->actingAs($this->user)->post(route('reviews.store', $this->completedEnrollment), [
            'comment' => 'Kursus bagus',
        ]);

        $response->assertSessionHasErrors('rating_value');
    }

    public function test_rating_value_must_be_between_1_and_5(): void
    {
        $response = $this->actingAs($this->user)->post(route('reviews.store', $this->completedEnrollment), [
            'rating_value' => 6,
            'comment' => 'Bagus',
        ]);

        $response->assertSessionHasErrors('rating_value');
    }

    public function test_user_cannot_review_non_completed_enrollment(): void
    {
        $category = Category::factory()->create();
        $instructor = Instructor::factory()->create();
        $otherCourse = Course::factory()->create([
            'category_id' => $category->id,
            'instructor_id' => $instructor->id,
        ]);

        $pendingEnrollment = Enrollment::factory()->create([
            'user_id' => $this->user->id,
            'course_id' => $otherCourse->id,
            'status' => 'pending',
        ]);

        $response = $this->actingAs($this->user)->post(route('reviews.store', $pendingEnrollment), [
            'rating_value' => 4,
            'comment' => 'Bagus',
        ]);

        $response->assertStatus(403);
    }

    public function test_course_shows_average_rating(): void
    {
        $this->actingAs($this->user)->post(route('reviews.store', $this->completedEnrollment), [
            'rating_value' => 5,
            'comment' => 'Luar biasa!',
        ]);

        $course = Course::withAvg('reviews', 'rating_value')->find($this->completedEnrollment->course_id);

        $this->assertEquals(5.0, $course->reviews_avg_rating_value);
    }
}
