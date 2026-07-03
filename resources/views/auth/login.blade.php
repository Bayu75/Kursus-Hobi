@extends('layouts.master')

@section('title', 'Masuk')

@section('content')
<div class="flex min-h-screen items-center justify-center px-4 pt-20">
    <div class="w-full max-w-md rounded-2xl border border-border bg-surface-alt p-8 shadow-md dark:border-gray-700 dark:bg-dark-surface">
        <h1 class="mb-6 text-2xl font-bold text-text-primary dark:text-white">Masuk</h1>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-4">
                <label for="email" class="mb-1 block text-sm font-medium text-text-primary dark:text-gray-200">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus
                    class="w-full rounded-xl border border-border bg-white px-4 py-3 text-sm text-text-primary outline-none transition-colors focus:border-primary-start focus:ring-1 focus:ring-primary-start dark:border-gray-600 dark:bg-dark-bg dark:text-white dark:focus:border-primary-start">
                @error('email')
                    <p class="mt-1 text-sm text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="password" class="mb-1 block text-sm font-medium text-text-primary dark:text-gray-200">Kata Sandi</label>
                <input type="password" name="password" id="password" required
                    class="w-full rounded-xl border border-border bg-white px-4 py-3 text-sm text-text-primary outline-none transition-colors focus:border-primary-start focus:ring-1 focus:ring-primary-start dark:border-gray-600 dark:bg-dark-bg dark:text-white dark:focus:border-primary-start">
                @error('password')
                    <p class="mt-1 text-sm text-danger">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit"
                class="w-full rounded-full bg-gradient-to-b from-[#2B7FFF] to-[#0065FF] px-6 py-3 text-sm font-medium text-white transition-all duration-150 hover:opacity-90">
                Masuk
            </button>

            <p class="mt-4 text-center text-sm text-text-secondary dark:text-gray-400">
                Belum punya akun?
                <a href="{{ route('register') }}" class="font-medium text-primary-start hover:underline">Daftar</a>
            </p>
        </form>
    </div>
</div>
@endsection
