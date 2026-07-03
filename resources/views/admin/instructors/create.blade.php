@extends('layouts.master')

@section('title', 'Tambah Instruktur')

@section('content')
<div class="min-h-screen pt-20">
    <div class="mx-auto max-w-2xl px-4 py-8 lg:px-8">
        <div class="mb-6">
            <a href="{{ route('admin.instructors.index') }}" class="text-sm font-medium text-primary-start hover:underline">&larr; Kembali</a>
        </div>

        <h1 class="mb-8 text-2xl font-bold text-text-primary dark:text-white">Tambah Instruktur</h1>

        <div class="rounded-2xl border border-border bg-surface-alt p-8 shadow-sm dark:border-gray-700 dark:bg-dark-surface">
            <form method="POST" action="{{ route('admin.instructors.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="mb-4">
                    <label class="mb-1 block text-sm font-medium text-text-primary dark:text-gray-200">Nama</label>
                    <input type="text" name="name" value="{{ old('name') }}" required
                        class="w-full rounded-xl border border-border bg-white px-4 py-3 text-sm outline-none focus:border-primary-start focus:ring-1 focus:ring-primary-start dark:border-gray-600 dark:bg-dark-bg dark:text-white">
                    @error('name') <p class="mt-1 text-sm text-danger">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label class="mb-1 block text-sm font-medium text-text-primary dark:text-gray-200">Keahlian</label>
                    <input type="text" name="expertise" value="{{ old('expertise') }}"
                        class="w-full rounded-xl border border-border bg-white px-4 py-3 text-sm outline-none focus:border-primary-start focus:ring-1 focus:ring-primary-start dark:border-gray-600 dark:bg-dark-bg dark:text-white">
                    @error('expertise') <p class="mt-1 text-sm text-danger">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label class="mb-1 block text-sm font-medium text-text-primary dark:text-gray-200">Bio</label>
                    <textarea name="bio" rows="4"
                        class="w-full rounded-xl border border-border bg-white px-4 py-3 text-sm outline-none focus:border-primary-start focus:ring-1 focus:ring-primary-start dark:border-gray-600 dark:bg-dark-bg dark:text-white">{{ old('bio') }}</textarea>
                    @error('bio') <p class="mt-1 text-sm text-danger">{{ $message }}</p> @enderror
                </div>

                <div class="mb-6">
                    <label class="mb-1 block text-sm font-medium text-text-primary dark:text-gray-200">Foto Profil</label>
                    <input type="file" name="profile_picture" accept="image/jpeg,image/png,image/webp"
                        class="w-full text-sm text-text-secondary file:mr-4 file:rounded-full file:border-0 file:bg-gradient-to-b file:from-[#2B7FFF] file:to-[#0065FF] file:px-4 file:py-2 file:text-sm file:font-medium file:text-white hover:file:opacity-90">
                    @error('profile_picture') <p class="mt-1 text-sm text-danger">{{ $message }}</p> @enderror
                </div>

                <button type="submit" class="w-full rounded-full bg-gradient-to-b from-[#2B7FFF] to-[#0065FF] px-6 py-3 text-sm font-medium text-white transition-all duration-150 hover:opacity-90">
                    Simpan
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
