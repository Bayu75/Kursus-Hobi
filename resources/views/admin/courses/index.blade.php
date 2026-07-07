@extends('layouts.master')

@section('title', 'Manajemen Kursus')

@section('content')
<div class="min-h-screen pt-20">
    <div class="mx-auto max-w-7xl px-4 py-8 lg:px-8">
        @if (session('success'))
            <div class="mb-6 rounded-2xl border border-success/30 bg-success/10 p-4 text-sm font-medium text-success">{{ session('success') }}</div>
        @endif

        <div class="flex flex-col gap-8 lg:flex-row">
            <x-admin-sidebar />

            <div class="flex-1">
                <div class="mb-6 flex items-center justify-between">
                    <h1 class="text-2xl font-bold text-text-primary dark:text-white">Kursus</h1>
                    <a href="{{ route('admin.courses.create') }}" class="rounded-full bg-gradient-to-b from-[#2B7FFF] to-[#0065FF] px-5 py-2 text-sm font-medium text-white transition-all duration-150 hover:opacity-90">
                        Tambah Kursus
                    </a>
                </div>

                <div class="overflow-x-auto rounded-2xl border border-border bg-surface-alt shadow-sm dark:border-gray-700 dark:bg-dark-surface">
                    <table class="w-full text-left text-sm">
                        <thead>
                            <tr class="border-b border-border text-text-muted dark:border-gray-700 dark:text-gray-500">
                                <th class="px-5 py-4 font-medium">Judul</th>
                                <th class="px-5 py-4 font-medium">Kategori</th>
                                <th class="px-5 py-4 font-medium">Instruktur</th>
                                <th class="px-5 py-4 font-medium">Tipe</th>
                                <th class="px-5 py-4 font-medium">Harga</th>
                                <th class="px-5 py-4 font-medium">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($courses as $course)
                                <tr class="border-b border-border last:border-0 dark:border-gray-700">
                                    <td class="px-5 py-4 font-medium text-text-primary dark:text-white">{{ $course->title }}</td>
                                    <td class="px-5 py-4 text-text-secondary dark:text-gray-400">{{ $course->category->name }}</td>
                                    <td class="px-5 py-4 text-text-secondary dark:text-gray-400">{{ $course->instructor->name }}</td>
                                    <td class="px-5 py-4 text-text-secondary dark:text-gray-400">{{ $course->type }}</td>
                                    <td class="px-5 py-4 text-text-secondary dark:text-gray-400">Rp {{ number_format($course->price, 0, ',', '.') }}</td>
                                    <td class="px-5 py-4">
                                        <a href="{{ route('admin.courses.edit', $course) }}" class="text-sm font-medium text-primary-start hover:underline">Edit</a>
                                        <form method="POST" action="{{ route('admin.courses.destroy', $course) }}" class="inline" onsubmit="return confirm('Hapus kursus ini?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="ml-3 text-sm font-medium text-danger hover:underline">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-6">{{ $courses->links() }}</div>
            </div>
        </div>
    </div>
</div>
@endsection
