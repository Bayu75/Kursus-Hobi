@extends('layouts.master')

@section('title', 'Admin Dashboard')

@section('content')
<div class="min-h-screen pt-20">
    <div class="mx-auto max-w-7xl px-4 py-8 lg:px-8">
        @if (session('success'))
            <div class="mb-6 rounded-2xl border border-success/30 bg-success/10 p-4 text-sm font-medium text-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="flex flex-col gap-8 lg:flex-row">

            <x-admin-sidebar />

            <div class="flex-1">
                <div class="mb-8 flex items-center justify-between">
                    <h1 class="text-3xl font-bold text-text-primary dark:text-white">Admin Dashboard</h1>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="rounded-full border border-border px-6 py-2 text-sm font-medium text-text-secondary transition-colors hover:bg-gray-50 dark:border-gray-600 dark:text-gray-300 dark:hover:bg-dark-surface">
                            Logout
                        </button>
                    </form>
                </div>

                {{-- Stats --}}
                <div class="mb-8 grid gap-6 md:grid-cols-3">
                    <div class="rounded-2xl border border-border bg-surface-alt p-6 shadow-sm dark:border-gray-700 dark:bg-dark-surface">
                        <p class="text-sm text-text-secondary dark:text-gray-400">Total Peserta</p>
                        <p class="text-3xl font-bold text-text-primary dark:text-white">{{ $stats['total_users'] }}</p>
                    </div>
                    <div class="rounded-2xl border border-border bg-surface-alt p-6 shadow-sm dark:border-gray-700 dark:bg-dark-surface">
                        <p class="text-sm text-text-secondary dark:text-gray-400">Total Kursus</p>
                        <p class="text-3xl font-bold text-text-primary dark:text-white">{{ $stats['total_courses'] }}</p>
                    </div>
                    <div class="rounded-2xl border border-border bg-surface-alt p-6 shadow-sm dark:border-gray-700 dark:bg-dark-surface">
                        <p class="text-sm text-text-secondary dark:text-gray-400">Pembayaran Pending</p>
                        <p class="text-3xl font-bold text-warning">{{ $stats['pending_payments'] }}</p>
                    </div>
                </div>

                {{-- Pending Payments Table --}}
                <div class="rounded-2xl border border-border bg-surface-alt shadow-sm dark:border-gray-700 dark:bg-dark-surface">
                    <div class="border-b border-border p-5 dark:border-gray-700">
                        <h2 class="text-lg font-semibold text-text-primary dark:text-white">Validasi Pembayaran</h2>
                    </div>

                    @if ($pendingEnrollments->isEmpty())
                        <div class="p-12 text-center">
                            <p class="text-text-secondary dark:text-gray-400">Tidak ada pembayaran yang perlu divalidasi.</p>
                        </div>
                    @else
                        <div class="overflow-x-auto">
                            <table class="w-full text-left text-sm">
                                <thead>
                                    <tr class="border-b border-border text-text-muted dark:border-gray-700 dark:text-gray-500">
                                        <th class="px-5 py-4 font-medium">Peserta</th>
                                        <th class="px-5 py-4 font-medium">Kursus</th>
                                        <th class="px-5 py-4 font-medium">Bank</th>
                                        <th class="px-5 py-4 font-medium">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pendingEnrollments as $enrollment)
                                        <tr class="border-b border-border last:border-0 dark:border-gray-700">
                                            <td class="px-5 py-4">
                                                <p class="font-medium text-text-primary dark:text-white">{{ $enrollment->user->name }}</p>
                                                <p class="text-xs text-text-muted dark:text-gray-500">{{ $enrollment->user->email }}</p>
                                            </td>
                                            <td class="px-5 py-4 text-text-primary dark:text-white">{{ $enrollment->course->title }}</td>
                                            <td class="px-5 py-4">
                                                @if ($enrollment->payment)
                                                    <p class="text-text-primary dark:text-white">{{ $enrollment->payment->transfer_bank_name }}</p>
                                                    <p class="text-xs text-text-muted dark:text-gray-500">{{ $enrollment->payment->account_holder_name }}</p>
                                                @else
                                                    <span class="text-text-muted dark:text-gray-500">Belum upload</span>
                                                @endif
                                            </td>
                                            <td class="px-5 py-4">
                                                <a href="{{ route('admin.verify', $enrollment) }}"
                                                    class="rounded-full bg-gradient-to-b from-[#2B7FFF] to-[#0065FF] px-4 py-1.5 text-xs font-medium text-white transition-all duration-150 hover:opacity-90">
                                                    Lihat Detail
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>

                {{-- Active Enrollments Table --}}
                <div class="mt-8 rounded-2xl border border-border bg-surface-alt shadow-sm dark:border-gray-700 dark:bg-dark-surface">
                    <div class="border-b border-border p-5 dark:border-gray-700">
                        <h2 class="text-lg font-semibold text-text-primary dark:text-white">Kursus Aktif — Tandai Lulus</h2>
                    </div>

                    @if ($activeEnrollments->isEmpty())
                        <div class="p-12 text-center">
                            <p class="text-text-secondary dark:text-gray-400">Tidak ada kursus aktif saat ini.</p>
                        </div>
                    @else
                        <div class="overflow-x-auto">
                            <table class="w-full text-left text-sm">
                                <thead>
                                    <tr class="border-b border-border text-text-muted dark:border-gray-700 dark:text-gray-500">
                                        <th class="px-5 py-4 font-medium">Peserta</th>
                                        <th class="px-5 py-4 font-medium">Kursus</th>
                                        <th class="px-5 py-4 font-medium">Tanggal Daftar</th>
                                        <th class="px-5 py-4 font-medium">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($activeEnrollments as $enrollment)
                                        <tr class="border-b border-border last:border-0 dark:border-gray-700">
                                            <td class="px-5 py-4">
                                                <p class="font-medium text-text-primary dark:text-white">{{ $enrollment->user->name }}</p>
                                                <p class="text-xs text-text-muted dark:text-gray-500">{{ $enrollment->user->email }}</p>
                                            </td>
                                            <td class="px-5 py-4 text-text-primary dark:text-white">{{ $enrollment->course->title }}</td>
                                            <td class="px-5 py-4 text-text-secondary dark:text-gray-400">
                                                {{ $enrollment->created_at->format('d M Y') }}
                                            </td>
                                            <td class="px-5 py-4">
                                                <form method="POST" action="{{ route('admin.enrollments.complete', $enrollment) }}"
                                                    onsubmit="return confirm('Tandai peserta ini sebagai lulus?')">
                                                    @csrf
                                                    <button type="submit"
                                                        class="rounded-full border border-success px-4 py-1.5 text-xs font-medium text-success transition-colors hover:bg-success/5">
                                                        Tandai Selesai
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div> 
        
    </div>
</div>
@endsection
