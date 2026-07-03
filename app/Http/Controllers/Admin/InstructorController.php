<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\InstructorRequest;
use App\Models\Instructor;

class InstructorController extends Controller
{
    public function index()
    {
        $instructors = Instructor::latest()->paginate(10);

        return view('admin.instructors.index', compact('instructors'));
    }

    public function create()
    {
        return view('admin.instructors.create');
    }

    public function store(InstructorRequest $request)
    {
        $validated = $request->validated();

        if ($request->hasFile('profile_picture')) {
            $validated['profile_picture'] = $request->file('profile_picture')->store('instructors', 'public');
        }

        Instructor::create($validated);

        return redirect()->route('admin.instructors.index')
            ->with('success', 'Instruktur berhasil ditambahkan.');
    }

    public function edit(Instructor $instructor)
    {
        return view('admin.instructors.edit', compact('instructor'));
    }

    public function update(InstructorRequest $request, Instructor $instructor)
    {
        $validated = $request->validated();

        if ($request->hasFile('profile_picture')) {
            $validated['profile_picture'] = $request->file('profile_picture')->store('instructors', 'public');
        }

        $instructor->update($validated);

        return redirect()->route('admin.instructors.index')
            ->with('success', 'Instruktur berhasil diperbarui.');
    }

    public function destroy(Instructor $instructor)
    {
        if ($instructor->courses()->exists()) {
            return back()->with('error', 'Instruktur tidak dapat dihapus karena masih mengajar kursus.');
        }

        $instructor->delete();

        return redirect()->route('admin.instructors.index')
            ->with('success', 'Instruktur berhasil dihapus.');
    }
}
