@extends('layouts.master')

@section('title', 'Profil Saya')

@section('content')
<div class="min-h-screen pt-20">
    <div class="mx-auto max-w-2xl px-4 py-8 lg:px-8">
        @if (session('success'))
            <div class="mb-6 rounded-2xl border border-success/30 bg-success/10 p-4 text-sm font-medium text-success">
                {{ session('success') }}
            </div>
        @endif

        <h1 class="mb-8 text-3xl font-bold text-text-primary dark:text-white">Profil Saya</h1>

        <div class="rounded-2xl border border-border bg-surface-alt p-8 shadow-sm dark:border-gray-700 dark:bg-dark-surface">
            <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Avatar --}}
                <div class="mb-8 flex flex-col items-center gap-4 sm:flex-row">
                    <div class="flex h-20 w-20 shrink-0 items-center justify-center overflow-hidden rounded-full border border-border bg-gray-100 dark:border-gray-600 dark:bg-dark-bg">
                        @if ($user->avatar)
                            <img src="{{ asset('storage/' . $user->avatar) }}" alt="{{ $user->name }}" class="h-full w-full object-cover">
                        @else
                            <span class="text-2xl font-bold text-text-muted dark:text-gray-500">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                        @endif
                    </div>
                    <div class="text-center sm:text-left">
                        <p class="font-semibold text-text-primary dark:text-white">{{ $user->name }}</p>
                        <p class="text-sm text-text-secondary dark:text-gray-400">{{ $user->email }}</p>
                    </div>
                </div>

                <div class="mb-4">
                    <label for="avatar" class="mb-1 block text-sm font-medium text-text-primary dark:text-gray-200">Ganti Foto Profil</label>
                    <input type="file" name="avatar" id="avatar" accept="image/jpeg,image/png,image/webp"
                        class="w-full text-sm text-text-secondary file:mr-4 file:rounded-full file:border-0 file:bg-gradient-to-b file:from-[#2B7FFF] file:to-[#0065FF] file:px-4 file:py-2 file:text-sm file:font-medium file:text-white hover:file:opacity-90">
                    @error('avatar') <p class="mt-1 text-sm text-danger">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label for="name" class="mb-1 block text-sm font-medium text-text-primary dark:text-gray-200">Nama Lengkap</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required
                        class="w-full rounded-xl border border-border bg-white px-4 py-3 text-sm text-text-primary outline-none transition-colors focus:border-primary-start focus:ring-1 focus:ring-primary-start dark:border-gray-600 dark:bg-dark-bg dark:text-white">
                    @error('name') <p class="mt-1 text-sm text-danger">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label for="email" class="mb-1 block text-sm font-medium text-text-primary dark:text-gray-200">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required
                        class="w-full rounded-xl border border-border bg-white px-4 py-3 text-sm text-text-primary outline-none transition-colors focus:border-primary-start focus:ring-1 focus:ring-primary-start dark:border-gray-600 dark:bg-dark-bg dark:text-white">
                    @error('email') <p class="mt-1 text-sm text-danger">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label for="phone" class="mb-1 block text-sm font-medium text-text-primary dark:text-gray-200">Nomor Telepon</label>
                    <input type="text" name="phone" id="phone" value="{{ old('phone', $user->phone) }}" required
                        class="w-full rounded-xl border border-border bg-white px-4 py-3 text-sm text-text-primary outline-none transition-colors focus:border-primary-start focus:ring-1 focus:ring-primary-start dark:border-gray-600 dark:bg-dark-bg dark:text-white">
                    @error('phone') <p class="mt-1 text-sm text-danger">{{ $message }}</p> @enderror
                </div>

                <hr class="my-6 border-border dark:border-gray-700">

                <p class="mb-4 text-sm font-medium text-text-primary dark:text-gray-200">Ganti Kata Sandi (kosongkan jika tidak ingin mengubah)</p>

                <div class="mb-4">
                    <label for="password" class="mb-1 block text-sm font-medium text-text-primary dark:text-gray-200">Kata Sandi Baru</label>
                    <input type="password" name="password" id="password"
                        class="w-full rounded-xl border border-border bg-white px-4 py-3 text-sm text-text-primary outline-none transition-colors focus:border-primary-start focus:ring-1 focus:ring-primary-start dark:border-gray-600 dark:bg-dark-bg dark:text-white">
                    @error('password') <p class="mt-1 text-sm text-danger">{{ $message }}</p> @enderror
                </div>

                <div class="mb-6">
                    <label for="password_confirmation" class="mb-1 block text-sm font-medium text-text-primary dark:text-gray-200">Konfirmasi Kata Sandi Baru</label>
                    <input type="password" name="password_confirmation" id="password_confirmation"
                        class="w-full rounded-xl border border-border bg-white px-4 py-3 text-sm text-text-primary outline-none transition-colors focus:border-primary-start focus:ring-1 focus:ring-primary-start dark:border-gray-600 dark:bg-dark-bg dark:text-white">
                </div>

                <button type="submit"
                    class="w-full rounded-full bg-gradient-to-b from-[#2B7FFF] to-[#0065FF] px-6 py-3 text-sm font-medium text-white transition-all duration-150 hover:opacity-90">
                    Simpan Perubahan
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
