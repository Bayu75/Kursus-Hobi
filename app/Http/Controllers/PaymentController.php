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

        $validated = $request->validated();

        $path = $request->file('proof_file')->store('payments', 'public');

        if ($enrollment->payment) {

            // Update pembayaran lama
            $enrollment->payment->update([
                'transfer_bank_name' => $validated['transfer_bank_name'],
                'account_holder_name' => $validated['account_holder_name'],
                'proof_file_path' => $path,
                'verified_at' => null,
                'rejected_reason' => null,
            ]);

        } else {

            // Pembayaran pertama
            $enrollment->payment()->create([
                'transfer_bank_name' => $validated['transfer_bank_name'],
                'account_holder_name' => $validated['account_holder_name'],
                'proof_file_path' => $path,
            ]);

        }

        // Kembalikan status menjadi pending
        $enrollment->update([
            'status' => 'pending',
        ]);

        return redirect()->route('dashboard')
            ->with('success', 'Pembayaran berhasil diajukan kembali dan menunggu verifikasi admin.');
    }
}
