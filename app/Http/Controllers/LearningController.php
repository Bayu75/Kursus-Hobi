<?php

namespace App\Http\Controllers;

use App\Models\Course;

class LearningController extends Controller
{
    public function show(Course $course)
    {
        $enrollment = $course->enrollments()
            ->where('user_id', auth()->id())
            ->where('status', 'active')
            ->firstOrFail();

        $course->load(['materials' => fn ($q) => $q->orderBy('sequence_order')]);

        return view('learning.show', compact('course', 'enrollment'));
    }
}
