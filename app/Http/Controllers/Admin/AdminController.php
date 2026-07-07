<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RejectPaymentRequest;
use App\Models\Certificate;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\User;
use Illuminate\Support\Str;

class AdminController extends Controller
{
            public function index()
        {
            $stats = [
                'total_users' => User::count(),
                'total_courses' => Course::count(),
                'pending_payments' => Enrollment::where('status', 'pending')->count(),
            ];

            $pendingEnrollments = Enrollment::with(['user', 'course', 'payment'])
                ->where('status', 'pending')
                ->latest()
                ->get();

            $activeEnrollments = Enrollment::with(['user', 'course'])
                ->where('status', 'active')
                ->latest()
                ->get();

            // TAMBAHKAN INI
            $completedEnrollments = Enrollment::with([
                    'user',
                    'course',
                    'certificate'
                ])
                ->where('status', 'completed')
                ->latest()
                ->get();

            return view('admin.dashboard', compact(
                'stats',
                'pendingEnrollments',
                'activeEnrollments',
                'completedEnrollments'
            ));
        }

    public function verify(Enrollment $enrollment)
    {
        $enrollment->load(['user', 'course', 'payment']);

        return view('admin.verify', compact('enrollment'));
    }

    public function approve(Enrollment $enrollment)
    {
        $enrollment->update(['status' => 'active']);

        if ($enrollment->payment) {
            $enrollment->payment->update(['verified_at' => now()]);
        }

        return redirect()->route('admin.dashboard')
            ->with('success', 'Pembayaran disetujui. Kursus peserta kini aktif.');
    }

    public function reject(RejectPaymentRequest $request, Enrollment $enrollment)
    {
        $validated = $request->validated();

        $enrollment->update(['status' => 'rejected']);

        if ($enrollment->payment) {
            $enrollment->payment->update([
                'verified_at' => now(),
                'rejected_reason' => $validated['rejected_reason'],
            ]);
        }

        return redirect()->route('admin.dashboard')
            ->with('success', 'Pembayaran ditolak.');
    }

        public function complete(Enrollment $enrollment)
    {
        if ($enrollment->status !== 'active') {
            return back()->with('error', 'Hanya enrollment aktif yang bisa ditandai selesai.');
        }

        $enrollment->update([
            'status' => 'completed',
        ]);

        Certificate::firstOrCreate(
            [
                'enrollment_id' => $enrollment->id,
            ],
            [
                'certificate_number' => 'CERT-' . date('Y') . '-' . strtoupper(Str::random(8)),
            ]
        );

        return redirect()->route('admin.dashboard')
            ->with('success', 'Peserta telah ditandai lulus dan sertifikat berhasil dibuat.');
    }
}
