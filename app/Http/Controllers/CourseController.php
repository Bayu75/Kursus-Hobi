<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Course;
use App\Services\CourseFilterService;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index(Request $request, CourseFilterService $filterService)
    {
        $courses = $filterService->filter($request);
        $categories = Category::all();

        return view('courses.index', compact('courses', 'categories'));
    }

    public function show(string $slug)
    {
        $course = Course::with(['category', 'instructor', 'schedules', 'materials'])
            ->withAvg('reviews', 'rating_value')
            ->where('slug', $slug)
            ->firstOrFail();

        return view('courses.show', compact('course'));
    }
}
