<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReviewRequest;
use App\Models\Enrollment;

class ReviewController extends Controller
{
    public function create(Enrollment $enrollment)
    {
        if ($enrollment->user_id !== auth()->id() || $enrollment->status !== 'completed') {
            abort(403);
        }

        if ($enrollment->course->reviews()->where('user_id', auth()->id())->exists()) {
            return redirect()->route('dashboard')->with('info', 'Anda sudah memberikan ulasan untuk kursus ini.');
        }

        return view('reviews.create', compact('enrollment'));
    }

    public function store(ReviewRequest $request, Enrollment $enrollment)
    {
        if ($enrollment->user_id !== auth()->id() || $enrollment->status !== 'completed') {
            abort(403);
        }

        $validated = $request->validated();

        $enrollment->course->reviews()->create([
            'user_id' => auth()->id(),
            'rating_value' => $validated['rating_value'],
            'comment' => $validated['comment'],
        ]);

        return redirect()->route('dashboard')->with('success', 'Terima kasih atas ulasan Anda!');
    }
}
