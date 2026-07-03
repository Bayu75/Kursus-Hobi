<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $tab = $request->query('tab', 'active');

        $enrollments = Enrollment::with(['course.category', 'course.instructor', 'payment'])
            ->where('user_id', $user->id)
            ->when($tab === 'active', fn ($q) => $q->where('status', 'active'))
            ->when($tab === 'pending', fn ($q) => $q->where('status', 'pending'))
            ->when($tab === 'completed', fn ($q) => $q->where('status', 'completed'))
            ->latest()
            ->get();

        $stats = [
            'active' => Enrollment::where('user_id', $user->id)->where('status', 'active')->count(),
            'pending' => Enrollment::where('user_id', $user->id)->where('status', 'pending')->count(),
            'completed' => Enrollment::where('user_id', $user->id)->where('status', 'completed')->count(),
        ];

        return view('dashboard.index', compact('enrollments', 'stats', 'tab'));
    }
}
