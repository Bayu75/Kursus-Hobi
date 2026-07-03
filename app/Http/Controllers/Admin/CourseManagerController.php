<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CourseRequest;
use App\Http\Requests\MaterialRequest;
use App\Http\Requests\ScheduleRequest;
use App\Models\Category;
use App\Models\Course;
use App\Models\CourseMaterial;
use App\Models\CourseSchedule;
use App\Models\Instructor;
use Illuminate\Support\Str;

class CourseManagerController extends Controller
{
    public function index()
    {
        $courses = Course::with(['category', 'instructor'])->latest()->paginate(10);

        return view('admin.courses.index', compact('courses'));
    }

    public function create()
    {
        $categories = Category::all();
        $instructors = Instructor::all();

        return view('admin.courses.create', compact('categories', 'instructors'));
    }

    public function store(CourseRequest $request)
    {
        $validated = $request->validated();

        $validated['slug'] = Str::slug($validated['title']).'-'.Str::random(5);

        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail'] = $request->file('thumbnail')->store('courses', 'public');
        }

        $course = Course::create($validated);

        return redirect()->route('admin.courses.edit', $course)
            ->with('success', 'Kursus berhasil dibuat. Tambahkan jadwal/materi jika perlu.');
    }

    public function edit(Course $course)
    {
        $course->load(['schedules', 'materials']);
        $categories = Category::all();
        $instructors = Instructor::all();

        return view('admin.courses.edit', compact('course', 'categories', 'instructors'));
    }

    public function update(CourseRequest $request, Course $course)
    {
        $validated = $request->validated();

        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail'] = $request->file('thumbnail')->store('courses', 'public');
        }

        $course->update($validated);

        return redirect()->route('admin.courses.index')
            ->with('success', 'Kursus berhasil diperbarui.');
    }

    public function destroy(Course $course)
    {
        $course->delete();

        return redirect()->route('admin.courses.index')
            ->with('success', 'Kursus berhasil dihapus.');
    }

    public function storeSchedule(ScheduleRequest $request, Course $course)
    {
        $course->schedules()->create($request->validated());

        return redirect()->route('admin.courses.edit', $course)
            ->with('success', 'Jadwal berhasil ditambahkan.');
    }

    public function destroySchedule(CourseSchedule $schedule)
    {
        $courseId = $schedule->course_id;
        $schedule->delete();

        return redirect()->route('admin.courses.edit', $courseId)
            ->with('success', 'Jadwal berhasil dihapus.');
    }

    public function storeMaterial(MaterialRequest $request, Course $course)
    {
        $validated = $request->validated();

        $validated['file_path'] = $request->file('file')->store('materials', 'public');

        $course->materials()->create($validated);

        return redirect()->route('admin.courses.edit', $course)
            ->with('success', 'Materi berhasil ditambahkan.');
    }

    public function destroyMaterial(CourseMaterial $material)
    {
        $courseId = $material->course_id;
        $material->delete();

        return redirect()->route('admin.courses.edit', $courseId)
            ->with('success', 'Materi berhasil dihapus.');
    }
}
