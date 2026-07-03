<?php

namespace App\Services;

use App\Models\Course;
use App\Models\Enrollment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EnrollmentService
{
    public function enroll(Course $course): Enrollment
    {
        return DB::transaction(function () use ($course) {
            $enrollment = Enrollment::create([
                'user_id' => Auth::id(),
                'course_id' => $course->id,
                'status' => 'pending',
            ]);

            return $enrollment;
        });
    }
}
