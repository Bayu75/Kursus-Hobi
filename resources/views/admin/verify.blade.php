@extends('layouts.master')

@section('title', 'Verifikasi Pembayaran')

@section('content')
<div class="min-h-screen pt-20">
    <div class="mx-auto max-w-4xl px-4 py-8 lg:px-8">
        <div class="mb-6">
            <a href="{{ route('admin.dashboard') }}" class="text-sm font-medium text-primary-start hover:underline">&larr; Kembali</a>
        </div>

        <h1 class="mb-8 text-3xl font-bold text-text-primary dark:text-white">Verifikasi Pembayaran</h1>

        {{-- Enrollment Info --}}
        <div class="mb-6 grid gap-6 md:grid-cols-2">
            <div class="rounded-2xl border border-border bg-surface-alt p-5 dark:border-gray-700 dark:bg-dark-surface">
                <p class="text-xs text-text-muted dark:text-gray-500">Peserta</p>
                <p class="font-semibold text-text-primary dark:text-white">{{ $enrollment->user->name }}</p>
                <p class="text-sm text-text-secondary dark:text-gray-400">{{ $enrollment->user->email }}</p>
            </div>
            <div class="rounded-2xl border border-border bg-surface-alt p-5 dark:border-gray-700 dark:bg-dark-surface">
                <p class="text-xs text-text-muted dark:text-gray-500">Kursus</p>
                <p class="font-semibold text-text-primary dark:text-white">{{ $enrollment->course->title }}</p>
                <p class="text-sm text-text-secondary dark:text-gray-400">Rp {{ number_format($enrollment->course->price, 0, ',', '.') }}</p>
            </div>
        </div>

        {{-- Payment Detail --}}
        @if ($enrollment->payment)
            <div class="mb-8 rounded-2xl border border-border bg-surface-alt p-6 dark:border-gray-700 dark:bg-dark-surface">
                <h2 class="mb-4 text-xl font-semibold text-text-primary dark:text-white">Detail Pembayaran</h2>
                <div class="space-y-3 text-sm">
                    <div class="flex justify-between">
                        <span class="text-text-secondary dark:text-gray-400">Bank Tujuan</span>
                        <span class="font-medium text-text-primary dark:text-white">{{ $enrollment->payment->transfer_bank_name }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-text-secondary dark:text-gray-400">Nama Pemilik Rekening</span>
                        <span class="font-medium text-text-primary dark:text-white">{{ $enrollment->payment->account_holder_name }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-text-secondary dark:text-gray-400">Total Pembayaran</span>
                        <span class="font-bold text-primary-start">Rp {{ number_format($enrollment->course->price, 0, ',', '.') }}</span>
                    </div>
                </div>

                <div class="mt-6">
                    <p class="mb-2 text-sm font-medium text-text-primary dark:text-white">Bukti Transfer</p>
                    <img src="{{ asset('storage/' . $enrollment->payment->proof_file_path) }}"
                        class="max-h-96 w-full rounded-xl border border-border object-contain dark:border-gray-700"
                        alt="Bukti Transfer">
                </div>
            </div>

            <div class="flex flex-col gap-4 sm:flex-row">
                <form method="POST" action="{{ route('admin.approve', $enrollment) }}">
                    @csrf
                    <button type="submit"
                        class="rounded-full bg-gradient-to-b from-[#2B7FFF] to-[#0065FF] px-8 py-3 text-sm font-medium text-white transition-all duration-150 hover:opacity-90">
                        Setujui Pembayaran
                    </button>
                </form>

                <form method="POST" action="{{ route('admin.reject', $enrollment) }}" class="flex-1">
                    @csrf
                    <div class="flex gap-3">
                        <input type="text" name="rejected_reason" placeholder="Alasan penolakan..." required
                            class="flex-1 rounded-xl border border-border bg-white px-4 py-3 text-sm text-text-primary outline-none transition-colors focus:border-danger focus:ring-1 focus:ring-danger dark:border-gray-600 dark:bg-dark-bg dark:text-white">
                        <button type="submit"
                            class="rounded-full border border-danger px-6 py-3 text-sm font-medium text-danger transition-colors hover:bg-danger/5">
                            Tolak
                        </button>
                    </div>
                </form>
            </div>
        @else
            <div class="rounded-2xl border border-border bg-surface-alt p-12 text-center dark:border-gray-700 dark:bg-dark-surface">
                <p class="text-text-secondary dark:text-gray-400">Peserta belum mengunggah bukti pembayaran.</p>
            </div>
        @endif
    </div>
</div>
@endsection
