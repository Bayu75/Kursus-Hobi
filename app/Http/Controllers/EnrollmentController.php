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

        if ($exists) {
            return redirect()->route('courses.show', $course->slug)
                ->with('error', 'Anda sudah terdaftar di kursus ini.');
        }

        $enrollment = $this->enrollmentService->enroll($course);

        return redirect()->route('payments.create', $enrollment)
            ->with('success', 'Pendaftaran berhasil. Silakan lakukan pembayaran.');
    }
}
