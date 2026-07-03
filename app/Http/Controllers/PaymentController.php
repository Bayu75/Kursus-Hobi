<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentRequest;
use App\Models\Enrollment;

class PaymentController extends Controller
{
    public function create(Enrollment $enrollment)
    {
        if ($enrollment->user_id !== auth()->id()) {
            abort(403);
        }

        return view('payments.create', compact('enrollment'));
    }

    public function store(PaymentRequest $request, Enrollment $enrollment)
    {
        if ($enrollment->user_id !== auth()->id()) {
            abort(403);
        }

        if ($enrollment->payment) {
            return redirect()->route('dashboard')
                ->with('info', 'Bukti pembayaran sudah diunggah sebelumnya.');
        }

        $validated = $request->validated();

        $path = $request->file('proof_file')->store('payments', 'public');

        $enrollment->payment()->create([
            'transfer_bank_name' => $validated['transfer_bank_name'],
            'account_holder_name' => $validated['account_holder_name'],
            'proof_file_path' => $path,
        ]);

        return redirect()->route('dashboard')
            ->with('success', 'Bukti pembayaran berhasil diunggah. Menunggu verifikasi admin.');
    }
}
