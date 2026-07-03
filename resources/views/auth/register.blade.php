@extends('layouts.master')

@section('title', 'Daftar')

@section('content')
<div class="flex min-h-screen items-center justify-center px-4 pt-20">
    <div class="w-full max-w-md rounded-2xl border border-border bg-surface-alt p-8 shadow-md dark:border-gray-700 dark:bg-dark-surface">
        <h1 class="mb-6 text-2xl font-bold text-text-primary dark:text-white">Daftar Akun</h1>

        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <label for="name" class="mb-1 block text-sm font-medium text-text-primary dark:text-gray-200">Nama Lengkap</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" required autofocus
                    class="w-full rounded-xl border border-border bg-white px-4 py-3 text-sm text-text-primary outline-none transition-colors focus:border-primary-start focus:ring-1 focus:ring-primary-start dark:border-gray-600 dark:bg-dark-bg dark:text-white dark:focus:border-primary-start">
                @error('name')
                    <p class="mt-1 text-sm text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="email" class="mb-1 block text-sm font-medium text-text-primary dark:text-gray-200">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required
                    class="w-full rounded-xl border border-border bg-white px-4 py-3 text-sm text-text-primary outline-none transition-colors focus:border-primary-start focus:ring-1 focus:ring-primary-start dark:border-gray-600 dark:bg-dark-bg dark:text-white dark:focus:border-primary-start">
                @error('email')
                    <p class="mt-1 text-sm text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="phone" class="mb-1 block text-sm font-medium text-text-primary dark:text-gray-200">Nomor Telepon</label>
                <input type="text" name="phone" id="phone" value="{{ old('phone') }}" required
                    class="w-full rounded-xl border border-border bg-white px-4 py-3 text-sm text-text-primary outline-none transition-colors focus:border-primary-start focus:ring-1 focus:ring-primary-start dark:border-gray-600 dark:bg-dark-bg dark:text-white dark:focus:border-primary-start">
                @error('phone')
                    <p class="mt-1 text-sm text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="avatar" class="mb-1 block text-sm font-medium text-text-primary dark:text-gray-200">Foto Profil (opsional)</label>
                <input type="file" name="avatar" id="avatar" accept="image/jpeg,image/png,image/webp"
                    class="w-full text-sm text-text-secondary file:mr-4 file:rounded-full file:border-0 file:bg-gradient-to-b file:from-[#2B7FFF] file:to-[#0065FF] file:px-4 file:py-2 file:text-sm file:font-medium file:text-white hover:file:opacity-90">
                @error('avatar')
                    <p class="mt-1 text-sm text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password" class="mb-1 block text-sm font-medium text-text-primary dark:text-gray-200">Kata Sandi</label>
                <input type="password" name="password" id="password" required
                    class="w-full rounded-xl border border-border bg-white px-4 py-3 text-sm text-text-primary outline-none transition-colors focus:border-primary-start focus:ring-1 focus:ring-primary-start dark:border-gray-600 dark:bg-dark-bg dark:text-white dark:focus:border-primary-start">
                @error('password')
                    <p class="mt-1 text-sm text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="password_confirmation" class="mb-1 block text-sm font-medium text-text-primary dark:text-gray-200">Konfirmasi Kata Sandi</label>
                <input type="password" name="password_confirmation" id="password_confirmation" required
                    class="w-full rounded-xl border border-border bg-white px-4 py-3 text-sm text-text-primary outline-none transition-colors focus:border-primary-start focus:ring-1 focus:ring-primary-start dark:border-gray-600 dark:bg-dark-bg dark:text-white dark:focus:border-primary-start">
            </div>

            <button type="submit"
                class="w-full rounded-full bg-gradient-to-b from-[#2B7FFF] to-[#0065FF] px-6 py-3 text-sm font-medium text-white transition-all duration-150 hover:opacity-90">
                Daftar
            </button>

            <p class="mt-4 text-center text-sm text-text-secondary dark:text-gray-400">
                Sudah punya akun?
                <a href="{{ route('login') }}" class="font-medium text-primary-start hover:underline">Masuk</a>
            </p>
        </form>
    </div>
</div>
@endsection
