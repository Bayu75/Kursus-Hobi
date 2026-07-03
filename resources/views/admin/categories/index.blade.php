@extends('layouts.master')

@section('title', 'Manajemen Kategori')

@section('content')
<div class="min-h-screen pt-20">
    <div class="mx-auto max-w-7xl px-4 py-8 lg:px-8">
        @if (session('success'))
            <div class="mb-6 rounded-2xl border border-success/30 bg-success/10 p-4 text-sm font-medium text-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="mb-6 rounded-2xl border border-danger/30 bg-danger/10 p-4 text-sm font-medium text-danger">{{ session('error') }}</div>
        @endif

        <div class="flex flex-col gap-8 lg:flex-row">
            <x-admin-sidebar />

            <div class="flex-1">
                <div class="mb-6 flex items-center justify-between">
                    <h1 class="text-2xl font-bold text-text-primary dark:text-white">Kategori</h1>
                    <a href="{{ route('admin.categories.create') }}" class="rounded-full bg-gradient-to-b from-[#2B7FFF] to-[#0065FF] px-5 py-2 text-sm font-medium text-white transition-all duration-150 hover:opacity-90">
                        Tambah Kategori
                    </a>
                </div>

                <div class="overflow-x-auto rounded-2xl border border-border bg-surface-alt shadow-sm dark:border-gray-700 dark:bg-dark-surface">
                    <table class="w-full text-left text-sm">
                        <thead>
                            <tr class="border-b border-border text-text-muted dark:border-gray-700 dark:text-gray-500">
                                <th class="px-5 py-4 font-medium">Nama</th>
                                <th class="px-5 py-4 font-medium">Deskripsi</th>
                                <th class="px-5 py-4 font-medium">Kursus</th>
                                <th class="px-5 py-4 font-medium">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                                <tr class="border-b border-border last:border-0 dark:border-gray-700">
                                    <td class="px-5 py-4 font-medium text-text-primary dark:text-white">{{ $category->name }}</td>
                                    <td class="px-5 py-4 text-text-secondary dark:text-gray-400">{{ Str::limit($category->description, 50) }}</td>
                                    <td class="px-5 py-4 text-text-secondary dark:text-gray-400">{{ $category->courses_count ?? $category->courses()->count() }}</td>
                                    <td class="px-5 py-4">
                                        <a href="{{ route('admin.categories.edit', $category) }}" class="text-sm font-medium text-primary-start hover:underline">Edit</a>
                                        <form method="POST" action="{{ route('admin.categories.destroy', $category) }}" class="inline" onsubmit="return confirm('Hapus kategori ini?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="ml-3 text-sm font-medium text-danger hover:underline">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-6">{{ $categories->links() }}</div>
            </div>
        </div>
    </div>
</div>
@endsection
