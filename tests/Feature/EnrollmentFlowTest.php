<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Course;
use App\Models\Instructor;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class EnrollmentFlowTest extends TestCase
{
    use RefreshDatabase;

    private User $user;
    private Course $course;

    protected function setUp(): void
    {
        parent::setUp();

        $category = Category::factory()->create();
        $instructor = Instructor::factory()->create();

        $this->course = Course::factory()->create([
            'category_id' => $category->id,
            'instructor_id' => $instructor->id,
            'type' => 'online',
            'price' => 150000,
        ]);

        $this->user = User::factory()->create([
            'role_id' => 2,
        ]);
    }

    public function test_user_can_register(): void
    {
        $response = $this->post('/register', [
            'name' => 'Budi Santoso',
            'email' => 'budi@example.com',
            'phone' => '08123456789',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $response->assertRedirect(route('dashboard'));
        $this->assertAuthenticated();
        $this->assertDatabaseHas('users', [
            'email' => 'budi@example.com',
            'role_id' => 2,
        ]);
    }

    public function test_user_can_login_and_redirect_to_dashboard(): void
    {
        $response = $this->post('/login', [
            'email' => $this->user->email,
            'password' => 'password',
        ]);

        $response->assertRedirect(route('dashboard'));
        $this->assertAuthenticatedAs($this->user);
    }

    public function test_user_can_browse_courses(): void
    {
        $response = $this->actingAs($this->user)->get(route('courses.index'));

        $response->assertStatus(200);
        $response->assertSee($this->course->title);
    }

    public function test_user_can_see_course_detail(): void
    {
        $response = $this->actingAs($this->user)->get(route('courses.show', $this->course->slug));

        $response->assertStatus(200);
        $response->assertSee($this->course->title);
        $response->assertSee($this->course->instructor->name);
    }

    public function test_user_can_enroll_in_course(): void
    {
        $response = $this->actingAs($this->user)->post(route('enrollments.store', $this->course));

        $response->assertRedirect();
        $this->assertDatabaseHas('enrollments', [
            'user_id' => $this->user->id,
            'course_id' => $this->course->id,
            'status' => 'pending',
        ]);
    }

    public function test_user_cannot_enroll_twice(): void
    {
        $this->actingAs($this->user)->post(route('enrollments.store', $this->course));

        $response = $this->actingAs($this->user)->post(route('enrollments.store', $this->course));

        $response->assertSessionHas('error');
    }

    public function test_user_can_upload_payment_proof(): void
    {
        Storage::fake('public');

        $this->actingAs($this->user)->post(route('enrollments.store', $this->course));
        $enrollment = $this->user->enrollments()->first();

        $file = UploadedFile::fake()->image('bukti.jpg', 300, 300);

        $response = $this->actingAs($this->user)->post(route('payments.store', $enrollment), [
            'transfer_bank_name' => 'BCA',
            'account_holder_name' => 'Budi Santoso',
            'proof_file' => $file,
        ]);

        $response->assertRedirect(route('dashboard'));
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('payments', [
            'enrollment_id' => $enrollment->id,
            'transfer_bank_name' => 'BCA',
            'account_holder_name' => 'Budi Santoso',
        ]);

        $enrollment->refresh();
        $this->assertEquals('pending', $enrollment->status);
    }
}
