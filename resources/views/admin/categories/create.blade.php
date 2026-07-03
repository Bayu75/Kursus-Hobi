@extends('layouts.master')

@section('title', 'Tambah Kategori')

@section('content')
<div class="min-h-screen pt-20">
    <div class="mx-auto max-w-2xl px-4 py-8 lg:px-8">
        <div class="mb-6">
            <a href="{{ route('admin.categories.index') }}" class="text-sm font-medium text-primary-start hover:underline">&larr; Kembali</a>
        </div>

        <h1 class="mb-8 text-2xl font-bold text-text-primary dark:text-white">Tambah Kategori</h1>

        <div class="rounded-2xl border border-border bg-surface-alt p-8 shadow-sm dark:border-gray-700 dark:bg-dark-surface">
            <form method="POST" action="{{ route('admin.categories.store') }}">
                @csrf

                <div class="mb-4">
                    <label class="mb-1 block text-sm font-medium text-text-primary dark:text-gray-200">Nama</label>
                    <input type="text" name="name" value="{{ old('name') }}" required
                        class="w-full rounded-xl border border-border bg-white px-4 py-3 text-sm outline-none focus:border-primary-start focus:ring-1 focus:ring-primary-start dark:border-gray-600 dark:bg-dark-bg dark:text-white">
                    @error('name') <p class="mt-1 text-sm text-danger">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label class="mb-1 block text-sm font-medium text-text-primary dark:text-gray-200">Icon Class</label>
                    <input type="text" name="icon_class" value="{{ old('icon_class') }}"
                        class="w-full rounded-xl border border-border bg-white px-4 py-3 text-sm outline-none focus:border-primary-start focus:ring-1 focus:ring-primary-start dark:border-gray-600 dark:bg-dark-bg dark:text-white">
                    @error('icon_class') <p class="mt-1 text-sm text-danger">{{ $message }}</p> @enderror
                </div>

                <div class="mb-6">
                    <label class="mb-1 block text-sm font-medium text-text-primary dark:text-gray-200">Deskripsi</label>
                    <textarea name="description" rows="3"
                        class="w-full rounded-xl border border-border bg-white px-4 py-3 text-sm outline-none focus:border-primary-start focus:ring-1 focus:ring-primary-start dark:border-gray-600 dark:bg-dark-bg dark:text-white">{{ old('description') }}</textarea>
                    @error('description') <p class="mt-1 text-sm text-danger">{{ $message }}</p> @enderror
                </div>

                <button type="submit" class="w-full rounded-full bg-gradient-to-b from-[#2B7FFF] to-[#0065FF] px-6 py-3 text-sm font-medium text-white transition-all duration-150 hover:opacity-90">
                    Simpan
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
