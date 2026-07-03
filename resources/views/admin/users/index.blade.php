@extends('layouts.master')

@section('title', 'Manajemen Peserta')

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
                <h1 class="mb-6 text-2xl font-bold text-text-primary dark:text-white">Peserta</h1>

                <div class="overflow-x-auto rounded-2xl border border-border bg-surface-alt shadow-sm dark:border-gray-700 dark:bg-dark-surface">
                    <table class="w-full text-left text-sm">
                        <thead>
                            <tr class="border-b border-border text-text-muted dark:border-gray-700 dark:text-gray-500">
                                <th class="px-5 py-4 font-medium">Nama</th>
                                <th class="px-5 py-4 font-medium">Email</th>
                                <th class="px-5 py-4 font-medium">Telepon</th>
                                <th class="px-5 py-4 font-medium">Tanggal Daftar</th>
                                <th class="px-5 py-4 font-medium">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr class="border-b border-border last:border-0 dark:border-gray-700">
                                    <td class="px-5 py-4 font-medium text-text-primary dark:text-white">{{ $user->name }}</td>
                                    <td class="px-5 py-4 text-text-secondary dark:text-gray-400">{{ $user->email }}</td>
                                    <td class="px-5 py-4 text-text-secondary dark:text-gray-400">{{ $user->phone ?? '-' }}</td>
                                    <td class="px-5 py-4 text-text-secondary dark:text-gray-400">{{ $user->created_at->format('d M Y') }}</td>
                                    <td class="px-5 py-4">
                                        <form method="POST" action="{{ route('admin.users.destroy', $user) }}"
                                            onsubmit="return confirm('Hapus peserta {{ $user->name }}?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="text-sm font-medium text-danger hover:underline">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-6">{{ $users->links() }}</div>
            </div>
        </div>
    </div>
</div>
@endsection
