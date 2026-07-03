<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Instructor;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AdminVerificationTest extends TestCase
{
    use RefreshDatabase;

    private User $admin;
    private User $peserta;
    private Enrollment $enrollment;

    protected function setUp(): void
    {
        parent::setUp();

        Storage::fake('public');

        $this->admin = User::factory()->create(['role_id' => 1]);

        $category = Category::factory()->create();
        $instructor = Instructor::factory()->create();
        $course = Course::factory()->create([
            'category_id' => $category->id,
            'instructor_id' => $instructor->id,
        ]);

        $this->peserta = User::factory()->create(['role_id' => 2]);

        $this->enrollment = Enrollment::factory()->create([
            'user_id' => $this->peserta->id,
            'course_id' => $course->id,
            'status' => 'pending',
        ]);

        Payment::factory()->create([
            'enrollment_id' => $this->enrollment->id,
            'proof_file_path' => UploadedFile::fake()->image('proof.jpg')->store('payments', 'public'),
        ]);
    }

    public function test_admin_can_view_dashboard(): void
    {
        $response = $this->actingAs($this->admin)->get(route('admin.dashboard'));

        $response->assertStatus(200);
        $response->assertSee($this->peserta->name);
        $response->assertSee($this->enrollment->course->title);
    }

    public function test_peserta_cannot_access_admin(): void
    {
        $response = $this->actingAs($this->peserta)->get(route('admin.dashboard'));

        $response->assertStatus(403);
    }

    public function test_guest_cannot_access_admin(): void
    {
        $response = $this->get(route('admin.dashboard'));

        $response->assertRedirect(route('login'));
    }

    public function test_admin_can_verify_payment(): void
    {
        $response = $this->actingAs($this->admin)->get(route('admin.verify', $this->enrollment));

        $response->assertStatus(200);
        $response->assertSee($this->peserta->name);
        $response->assertSee($this->enrollment->course->title);
        $response->assertSee($this->enrollment->payment->transfer_bank_name);
    }

    public function test_admin_can_approve_payment(): void
    {
        $response = $this->actingAs($this->admin)->post(route('admin.approve', $this->enrollment));

        $response->assertRedirect(route('admin.dashboard'));
        $response->assertSessionHas('success');

        $this->enrollment->refresh();
        $this->assertEquals('active', $this->enrollment->status);
        $this->assertNotNull($this->enrollment->payment->verified_at);
    }

    public function test_admin_can_reject_payment(): void
    {
        $response = $this->actingAs($this->admin)->post(route('admin.reject', $this->enrollment), [
            'rejected_reason' => 'Bukti transfer tidak jelas',
        ]);

        $response->assertRedirect(route('admin.dashboard'));
        $response->assertSessionHas('success');

        $this->enrollment->refresh();
        $this->assertEquals('rejected', $this->enrollment->status);
        $this->assertNotNull($this->enrollment->payment->verified_at);
        $this->assertEquals('Bukti transfer tidak jelas', $this->enrollment->payment->rejected_reason);
    }

    public function test_admin_can_mark_enrollment_completed(): void
    {
        $this->enrollment->update(['status' => 'active']);

        $response = $this->actingAs($this->admin)->post(route('admin.enrollments.complete', $this->enrollment));

        $response->assertRedirect(route('admin.dashboard'));
        $response->assertSessionHas('success');

        $this->enrollment->refresh();
        $this->assertEquals('completed', $this->enrollment->status);
    }

    public function test_cannot_complete_non_active_enrollment(): void
    {
        $response = $this->actingAs($this->admin)->post(route('admin.enrollments.complete', $this->enrollment));

        $response->assertSessionHas('error');
    }
}
