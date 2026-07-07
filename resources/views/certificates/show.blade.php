@extends('layouts.master')

@section('title', 'Sertifikat')

@section('content')
<div class="min-h-screen pt-20 bg-gray-100">
    <div class="mx-auto max-w-5xl px-6 py-10">

        <div class="rounded-xl border-8 border-blue-600 bg-white p-12 shadow-xl">

            <h1 class="text-center text-5xl font-bold text-blue-700">
                SERTIFIKAT
            </h1>

            <p class="mt-10 text-center text-lg">
                Diberikan kepada
            </p>

            <h2 class="mt-3 text-center text-4xl font-bold">
                {{ $certificate->enrollment->user->name }}
            </h2>

            <p class="mt-8 text-center text-lg">
                Telah berhasil menyelesaikan kursus
            </p>

            <h3 class="mt-3 text-center text-3xl font-semibold">
                {{ $certificate->enrollment->course->title }}
            </h3>

            <div class="mt-12 flex justify-between text-sm">
                <div>
                    <p><strong>Tanggal Lulus</strong></p>
                    <p>{{ $certificate->created_at->format('d F Y') }}</p>
                </div>

                <div class="text-right">
                    <p><strong>No. Sertifikat</strong></p>
                    <p>{{ $certificate->certificate_number }}</p>
                </div>
            </div>

        </div>
        <div class="mt-8 text-center">

    <a href="{{ route('certificates.download', $certificate) }}"
       class="rounded-full bg-blue-600 px-6 py-3 text-white hover:bg-blue-700">

        Download Sertifikat

    </a>

</div>

    </div>
    
</div>
@endsection