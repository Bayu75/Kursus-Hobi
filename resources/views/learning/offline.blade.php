@extends('layouts.master')

@section('title', $course->title)

@section('content')

<div class="min-h-screen pt-20">
    <div class="mx-auto max-w-4xl px-4 py-8">

        <h1 class="text-3xl font-bold text-text-primary dark:text-white">
            {{ $course->title }}
        </h1>


        <div class="mt-6 rounded-2xl border border-border bg-surface-alt p-6 dark:border-gray-700 dark:bg-dark-surface">

            <h2 class="text-xl font-semibold text-text-primary dark:text-white">
                Informasi Kursus Offline
            </h2>

            <p class="mt-2 text-text-secondary dark:text-gray-400">
                Kursus ini dilakukan secara tatap muka.
            </p>


            <div class="mt-6">

                <h3 class="mb-4 font-semibold text-text-primary dark:text-white">
                    Jadwal Pelaksanaan
                </h3>


                @forelse($course->schedules as $schedule)

                    <div class="mb-4 rounded-xl border border-border p-5 dark:border-gray-700">

                        <div class="space-y-2 text-sm">

                            <p>
                                <span class="font-medium">
                                    Tanggal:
                                </span>

                                {{ \Carbon\Carbon::parse($schedule->date)->format('d M Y') }}
                            </p>


                            <p>
                                <span class="font-medium">
                                    Waktu:
                                </span>

                                {{ $schedule->start_time }}
                                -
                                {{ $schedule->end_time }}
                            </p>


                            <p>
                                <span class="font-medium">
                                    Lokasi:
                                </span>

                                {{ $schedule->location_name }}
                            </p>


                            <p>
                                <span class="font-medium">
                                    Kuota:
                                </span>

                                {{ $schedule->quota }} peserta
                            </p>


                            @if($schedule->google_maps_link)

                                <a href="{{ $schedule->google_maps_link }}"
                                   target="_blank"
                                   class="mt-3 inline-block text-sm text-primary-start hover:underline">

                                    Lihat Lokasi Google Maps

                                </a>

                            @endif

                        </div>

                    </div>


                @empty

                    <p class="text-gray-500">
                        Jadwal offline belum tersedia.
                    </p>

                @endforelse


            </div>

        </div>

    </div>
</div>

@endsection