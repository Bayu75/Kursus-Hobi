<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Services\EnrollmentService;
use Carbon\Carbon;

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

        if ($course->type === 'offline') {
            // Ambil jadwal pertama berdasarkan tanggal dan jam
            $firstSchedule = $course->schedules()
                ->orderBy('date')
                ->orderBy('start_time')
                ->first();

            $approvedParticipants = $course->enrollments()
                ->whereIn('status', ['approved', 'completed'])
                ->count();

            if ($approvedParticipants >= $firstSchedule->quota) {
                return back()->with(
                    'error',
                    'Kuota peserta sudah penuh.'
                );
            }
            
            if (!$firstSchedule) {
                return back()->with(
                    'error',
                    'Kursus ini belum memiliki jadwal.'
                );
            }

            // Tutup pendaftaran jika kursus sudah dimulai
            $startCourse = Carbon::parse(
                $firstSchedule->date . ' ' . $firstSchedule->start_time
            );

            if (now()->greaterThanOrEqualTo($startCourse)) {
                return back()->with(
                    'error',
                    'Pendaftaran telah ditutup karena kursus sudah dimulai.'
                );
            }
        }

        $enrollment = $this->enrollmentService->enroll($course);

        return redirect()->route('payments.create', $enrollment)
            ->with('success', 'Pendaftaran berhasil. Silakan lakukan pembayaran.');
    }
}
