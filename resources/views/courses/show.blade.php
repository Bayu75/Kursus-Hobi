@extends('layouts.master')

@section('title', $course->title)

@section('content')
<div class="min-h-screen pt-20">
    <div class="mx-auto max-w-7xl px-4 py-8 lg:px-8">
        <div class="mb-6">
            <a href="{{ route('courses.index') }}" class="text-sm font-medium text-primary-start hover:underline">&larr; Kembali ke katalog</a>
        </div>

        <div class="grid gap-8 lg:grid-cols-3">
            {{-- Main Content --}}
            <div class="lg:col-span-2">
                <div class="flex aspect-video items-center justify-center overflow-hidden rounded-2xl bg-gradient-to-br from-[#2B7FFF]/20 to-[#0065FF]/20">
                    @if ($course->thumbnail)
                        <img src="{{ asset('storage/' . $course->thumbnail) }}" alt="{{ $course->title }}" class="h-full w-full object-cover">
                    @else
                        <span class="text-text-muted dark:text-gray-500">{{ $course->category->name }}</span>
                    @endif
                </div>

                <div class="mt-6">
                    <div class="mb-2 flex items-center gap-3">
                        <span class="rounded-full bg-tertiary/10 px-3 py-1 text-xs font-medium text-tertiary">
                            {{ $course->type === 'online' ? 'Online' : 'Offline' }}
                        </span>
                        <span class="rounded-full bg-gray-100 px-3 py-1 text-xs font-medium text-text-secondary dark:bg-dark-surface dark:text-gray-400">
                            {{ $course->category->name }}
                        </span>
                    </div>

                    <h1 class="text-3xl font-bold text-text-primary dark:text-white">{{ $course->title }}</h1>

                    <p class="mt-2 text-lg text-text-secondary dark:text-gray-400">
                        Oleh <span class="font-medium text-text-primary dark:text-white">{{ $course->instructor->name }}</span>
                    </p>
                    @if ($course->reviews_avg_rating_value)
                        <div class="mt-2 flex items-center gap-1">
                            @for ($i = 1; $i <= 5; $i++)
                                <svg class="h-4 w-4 {{ $i <= round($course->reviews_avg_rating_value) ? 'text-yellow-400' : 'text-gray-300 dark:text-gray-600' }}" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                            @endfor
                            <span class="ml-1 text-sm text-text-muted dark:text-gray-500">{{ number_format($course->reviews_avg_rating_value, 1) }}</span>
                        </div>
                    @endif

                    @if ($course->instructor->bio)
                        <div class="mt-4 rounded-2xl border border-border bg-surface-alt p-4 dark:border-gray-700 dark:bg-dark-surface">
                            <p class="text-sm text-text-secondary dark:text-gray-400">{{ $course->instructor->bio }}</p>
                            @if ($course->instructor->expertise)
                                <p class="mt-1 text-xs font-medium text-text-muted dark:text-gray-500">Ahli: {{ $course->instructor->expertise }}</p>
                            @endif
                        </div>
                    @endif

                    @if ($course->description)
                        <div class="mt-6">
                            <h2 class="mb-3 text-xl font-semibold text-text-primary dark:text-white">Deskripsi</h2>
                            <p class="text-text-secondary dark:text-gray-400">{{ $course->description }}</p>
                        </div>
                    @endif

                    {{-- Online: Materials --}}
                    @if ($course->type === 'online' && $course->materials->isNotEmpty())
                        <div class="mt-8">
                            <h2 class="mb-4 text-xl font-semibold text-text-primary dark:text-white">Materi Pembelajaran</h2>
                            <div class="space-y-3">
                                @foreach ($course->materials->sortBy('sequence_order') as $material)
                                    <div class="flex items-center gap-4 rounded-2xl border border-border bg-surface-alt p-4 dark:border-gray-700 dark:bg-dark-surface">
                                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-primary-start/10 text-primary-start">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="5 3 19 12 5 21 5 3"/></svg>
                                        </div>
                                        <div>
                                            <p class="font-medium text-text-primary dark:text-white">{{ $material->title }}</p>
                                            <p class="text-xs text-text-muted dark:text-gray-500">Pertemuan {{ $material->sequence_order }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    {{-- Offline: Schedule --}}
                    @if ($course->type === 'offline' && $course->schedules->isNotEmpty())
                        <div class="mt-8">
                            <h2 class="mb-4 text-xl font-semibold text-text-primary dark:text-white">Jadwal & Lokasi</h2>
                            <div class="space-y-3">
                                @foreach ($course->schedules as $schedule)
                                    <div class="rounded-2xl border border-border bg-surface-alt p-4 dark:border-gray-700 dark:bg-dark-surface">
                                        <div class="flex items-center gap-3">
                                            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-tertiary/10 text-tertiary">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
                                            </div>
                                            <div class="flex-1">
                                                <p class="font-medium text-text-primary dark:text-white">{{ $schedule->location_name }}</p>
                                                <p class="text-xs text-text-muted dark:text-gray-500">
                                                    {{ \Carbon\Carbon::parse($schedule->date)->format('d M Y') }}
                                                    {{ \Carbon\Carbon::parse($schedule->start_time)->format('H:i') }} -
                                                    {{ \Carbon\Carbon::parse($schedule->end_time)->format('H:i') }}
                                                </p>
                                                <p class="text-xs text-text-muted dark:text-gray-500">Kuota: {{ $schedule->quota }} peserta</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Sidebar --}}
            <aside>
                <div class="sticky top-24 rounded-2xl border border-border bg-surface-alt p-6 shadow-sm dark:border-gray-700 dark:bg-dark-surface">
                    <p class="text-3xl font-bold text-text-primary dark:text-white">
                        Rp {{ number_format($course->price, 0, ',', '.') }}
                    </p>

                    <ul class="mt-4 space-y-3 text-sm text-text-secondary dark:text-gray-400">
                        <li class="flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="shrink-0"><rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" x2="16" y1="2" y2="6"/><line x1="8" x2="8" y1="2" y2="6"/><line x1="3" x2="21" y1="10" y2="10"/></svg>
                            {{ $course->type === 'online' ? 'Belajar mandiri' : 'Tatap muka langsung' }}
                        </li>
                        <li class="flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="shrink-0"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                            {{ $course->instructor->name }}
                        </li>
                        @if ($course->type === 'offline')
                            <li class="flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="shrink-0"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
                                {{ optional($course->schedules->first())->location_name ?? 'Lokasi menyusul' }}
                            </li>
                        @endif
                    </ul>

                    @php
                        $registrationClosed = false;
                        $registrationMessage = '';

                        if ($course->type === 'offline' && $course->schedules->isNotEmpty()) {

                            $firstSchedule = $course->schedules
                                ->sortBy(fn($schedule) => $schedule->date . ' ' . $schedule->start_time)
                                ->first();

                            $approvedParticipants = $course->enrollments
                                ->whereIn('status', ['active', 'completed'])
                                ->count();

                            $startTime = \Carbon\Carbon::parse(
                                $firstSchedule->date . ' ' . $firstSchedule->start_time
                            );

                            if (now()->greaterThanOrEqualTo($startTime)) {
                                $registrationClosed = true;
                                $registrationMessage = 'Pendaftaran Ditutup';
                            } elseif ($approvedParticipants >= $firstSchedule->quota) {
                                $registrationClosed = true;
                                $registrationMessage = 'Kuota Penuh';
                            }
                        }
                    @endphp

                    @auth

                        @if(Auth::user()->role_id != 1)

                            @if($registrationClosed)

                                <button
                                    disabled
                                    class="mt-6 flex w-full cursor-not-allowed items-center justify-center rounded-full bg-gray-300 px-6 py-3 text-sm font-medium text-gray-600 dark:bg-gray-700 dark:text-gray-400">
                                    {{ $registrationMessage }}
                                </button>

                            @else

                                <form method="POST" action="{{ route('enrollments.store', $course) }}">
                                    @csrf

                                    <button
                                        type="submit"
                                        class="mt-6 flex w-full items-center justify-center rounded-full bg-gradient-to-b from-[#2B7FFF] to-[#0065FF] px-6 py-3 text-sm font-medium text-white hover:opacity-90">
                                        Daftar Sekarang
                                    </button>
                                </form>

                            @endif

                        @endif

                    @else

                        <a href="{{ route('login') }}"
                            class="mt-6 flex w-full items-center justify-center rounded-full bg-gradient-to-b from-[#2B7FFF] to-[#0065FF] px-6 py-3 text-sm font-medium text-white">
                            Masuk untuk Mendaftar
                        </a>

                    @endauth
                </div>
            </aside>
        </div>
    </div>
</div>
@endsection
