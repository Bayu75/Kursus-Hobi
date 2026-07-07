<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Services\EnrollmentService;

class EnrollmentController extends Controller
{
    public function __construct(
        protected EnrollmentService $enrollmentService
    ) {}

    public function store(Course $course)
    {
        $exists = $course->enrollments()->where('user_id', auth()->id())->exists();

        if (auth()->user()->role_id === 1) {
            abort(403, 'Administrator tidak dapat mendaftar kursus.');
        }
        
        if ($exists) {
            return redirect()->route('courses.show', $course->slug)
                ->with('error', 'Anda sudah terdaftar di kursus ini.');
        }

        $enrollment = $this->enrollmentService->enroll($course);

        return redirect()->route('payments.create', $enrollment)
            ->with('success', 'Pendaftaran berhasil. Silakan lakukan pembayaran.');
    }
}
