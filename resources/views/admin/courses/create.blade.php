@extends('layouts.master')

@section('title', 'Tambah Kursus')

@section('content')
<div class="min-h-screen pt-20">
    <div class="mx-auto max-w-2xl px-4 py-8 lg:px-8">
        <div class="mb-6">
            <a href="{{ route('admin.courses.index') }}" class="text-sm font-medium text-primary-start hover:underline">&larr; Kembali</a>
        </div>

        <h1 class="mb-8 text-2xl font-bold text-text-primary dark:text-white">Tambah Kursus</h1>

        <div class="rounded-2xl border border-border bg-surface-alt p-8 shadow-sm dark:border-gray-700 dark:bg-dark-surface">
            <form method="POST" action="{{ route('admin.courses.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="mb-4">
                    <label class="mb-1 block text-sm font-medium text-text-primary dark:text-gray-200">Judul</label>
                    <input type="text" name="title" value="{{ old('title') }}" required
                        class="w-full rounded-xl border border-border bg-white px-4 py-3 text-sm outline-none focus:border-primary-start focus:ring-1 focus:ring-primary-start dark:border-gray-600 dark:bg-dark-bg dark:text-white">
                    @error('title') <p class="mt-1 text-sm text-danger">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label class="mb-1 block text-sm font-medium text-text-primary dark:text-gray-200">Kategori</label>
                    <select name="category_id" required
                        class="w-full rounded-xl border border-border bg-white px-4 py-3 text-sm outline-none focus:border-primary-start focus:ring-1 focus:ring-primary-start dark:border-gray-600 dark:bg-dark-bg dark:text-white">
                        <option value="">Pilih Kategori</option>
                        @foreach ($categories as $cat)
                            <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id') <p class="mt-1 text-sm text-danger">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label class="mb-1 block text-sm font-medium text-text-primary dark:text-gray-200">Instruktur</label>
                    <select name="instructor_id" required
                        class="w-full rounded-xl border border-border bg-white px-4 py-3 text-sm outline-none focus:border-primary-start focus:ring-1 focus:ring-primary-start dark:border-gray-600 dark:bg-dark-bg dark:text-white">
                        <option value="">Pilih Instruktur</option>
                        @foreach ($instructors as $inst)
                            <option value="{{ $inst->id }}" {{ old('instructor_id') == $inst->id ? 'selected' : '' }}>{{ $inst->name }}</option>
                        @endforeach
                    </select>
                    @error('instructor_id') <p class="mt-1 text-sm text-danger">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label class="mb-1 block text-sm font-medium text-text-primary dark:text-gray-200">Deskripsi</label>
                    <textarea name="description" rows="4"
                        class="w-full rounded-xl border border-border bg-white px-4 py-3 text-sm outline-none focus:border-primary-start focus:ring-1 focus:ring-primary-start dark:border-gray-600 dark:bg-dark-bg dark:text-white">{{ old('description') }}</textarea>
                    @error('description') <p class="mt-1 text-sm text-danger">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label class="mb-1 block text-sm font-medium text-text-primary dark:text-gray-200">Tipe</label>
                    <select name="type" required
                        class="w-full rounded-xl border border-border bg-white px-4 py-3 text-sm outline-none focus:border-primary-start focus:ring-1 focus:ring-primary-start dark:border-gray-600 dark:bg-dark-bg dark:text-white">
                        <option value="online" {{ old('type') === 'online' ? 'selected' : '' }}>Online</option>
                        <option value="offline" {{ old('type') === 'offline' ? 'selected' : '' }}>Offline</option>
                    </select>
                    @error('type') <p class="mt-1 text-sm text-danger">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label class="mb-1 block text-sm font-medium text-text-primary dark:text-gray-200">Harga (Rp)</label>
                    <input type="number" name="price" value="{{ old('price', 0) }}" required min="0"
                        class="w-full rounded-xl border border-border bg-white px-4 py-3 text-sm outline-none focus:border-primary-start focus:ring-1 focus:ring-primary-start dark:border-gray-600 dark:bg-dark-bg dark:text-white">
                    @error('price') <p class="mt-1 text-sm text-danger">{{ $message }}</p> @enderror
                </div>

                <div class="mb-6">
                    <label class="mb-1 block text-sm font-medium text-text-primary dark:text-gray-200">Thumbnail</label>
                    <input type="file" name="thumbnail" accept="image/jpeg,image/png,image/webp"
                        class="w-full text-sm text-text-secondary file:mr-4 file:rounded-full file:border-0 file:bg-gradient-to-b file:from-[#2B7FFF] file:to-[#0065FF] file:px-4 file:py-2 file:text-sm file:font-medium file:text-white hover:file:opacity-90">
                    @error('thumbnail') <p class="mt-1 text-sm text-danger">{{ $message }}</p> @enderror
                </div>

                <button type="submit" class="w-full rounded-full bg-gradient-to-b from-[#2B7FFF] to-[#0065FF] px-6 py-3 text-sm font-medium text-white transition-all duration-150 hover:opacity-90">
                    Simpan
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
