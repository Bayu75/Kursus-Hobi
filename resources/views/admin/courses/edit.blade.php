@extends('layouts.master')

@section('title', 'Edit Kursus')

@section('content')
<div class="min-h-screen pt-20">
    <div class="mx-auto max-w-2xl px-4 py-8 lg:px-8">
        <div class="mb-6">
            <a href="{{ route('admin.courses.index') }}" class="text-sm font-medium text-primary-start hover:underline">&larr; Kembali</a>
        </div>

        <h1 class="mb-8 text-2xl font-bold text-text-primary dark:text-white">Edit Kursus</h1>

        {{-- Edit Form --}}
        <div class="mb-8 rounded-2xl border border-border bg-surface-alt p-8 shadow-sm dark:border-gray-700 dark:bg-dark-surface">
            <form method="POST" action="{{ route('admin.courses.update', $course) }}" enctype="multipart/form-data">
                @csrf @method('PUT')

                <div class="mb-4">
                    <label class="mb-1 block text-sm font-medium text-text-primary dark:text-gray-200">Judul</label>
                    <input type="text" name="title" value="{{ old('title', $course->title) }}" required
                        class="w-full rounded-xl border border-border bg-white px-4 py-3 text-sm outline-none focus:border-primary-start focus:ring-1 focus:ring-primary-start dark:border-gray-600 dark:bg-dark-bg dark:text-white">
                </div>

                <div class="mb-4">
                    <label class="mb-1 block text-sm font-medium text-text-primary dark:text-gray-200">Kategori</label>
                    <select name="category_id" required class="w-full rounded-xl border border-border bg-white px-4 py-3 text-sm outline-none focus:border-primary-start focus:ring-1 focus:ring-primary-start dark:border-gray-600 dark:bg-dark-bg dark:text-white">
                        @foreach ($categories as $cat)
                            <option value="{{ $cat->id }}" {{ $course->category_id == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label class="mb-1 block text-sm font-medium text-text-primary dark:text-gray-200">Instruktur</label>
                    <select name="instructor_id" required class="w-full rounded-xl border border-border bg-white px-4 py-3 text-sm outline-none focus:border-primary-start focus:ring-1 focus:ring-primary-start dark:border-gray-600 dark:bg-dark-bg dark:text-white">
                        @foreach ($instructors as $inst)
                            <option value="{{ $inst->id }}" {{ $course->instructor_id == $inst->id ? 'selected' : '' }}>{{ $inst->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label class="mb-1 block text-sm font-medium text-text-primary dark:text-gray-200">Deskripsi</label>
                    <textarea name="description" rows="4" class="w-full rounded-xl border border-border bg-white px-4 py-3 text-sm outline-none focus:border-primary-start focus:ring-1 focus:ring-primary-start dark:border-gray-600 dark:bg-dark-bg dark:text-white">{{ old('description', $course->description) }}</textarea>
                </div>

                <div class="mb-4">
                    <label class="mb-1 block text-sm font-medium text-text-primary dark:text-gray-200">Tipe</label>
                    <select name="type" required class="w-full rounded-xl border border-border bg-white px-4 py-3 text-sm outline-none focus:border-primary-start focus:ring-1 focus:ring-primary-start dark:border-gray-600 dark:bg-dark-bg dark:text-white">
                        <option value="online" {{ $course->type === 'online' ? 'selected' : '' }}>Online</option>
                        <option value="offline" {{ $course->type === 'offline' ? 'selected' : '' }}>Offline</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="mb-1 block text-sm font-medium text-text-primary dark:text-gray-200">Harga (Rp)</label>
                    <input type="number" name="price" value="{{ old('price', $course->price) }}" required min="0"
                        class="w-full rounded-xl border border-border bg-white px-4 py-3 text-sm outline-none focus:border-primary-start focus:ring-1 focus:ring-primary-start dark:border-gray-600 dark:bg-dark-bg dark:text-white">
                </div>

                <div class="mb-6">
                    <label class="mb-1 block text-sm font-medium text-text-primary dark:text-gray-200">Thumbnail</label>
                    <input type="file" name="thumbnail" accept="image/jpeg,image/png,image/webp"
                        class="w-full text-sm text-text-secondary file:mr-4 file:rounded-full file:border-0 file:bg-gradient-to-b file:from-[#2B7FFF] file:to-[#0065FF] file:px-4 file:py-2 file:text-sm file:font-medium file:text-white hover:file:opacity-90">
                </div>

                <button type="submit" class="w-full rounded-full bg-gradient-to-b from-[#2B7FFF] to-[#0065FF] px-6 py-3 text-sm font-medium text-white transition-all duration-150 hover:opacity-90">
                    Update Kursus
                </button>
            </form>
        </div>

        {{-- Schedule / Materials management --}}
        @if ($course->type === 'offline')
            <div class="rounded-2xl border border-border bg-surface-alt p-8 shadow-sm dark:border-gray-700 dark:bg-dark-surface">
                <h2 class="mb-4 text-lg font-semibold text-text-primary dark:text-white">Jadwal Offline</h2>

                @forelse ($course->schedules as $schedule)
                    <div class="mb-2 flex items-center justify-between rounded-xl border border-border bg-surface p-4 dark:border-gray-600 dark:bg-dark-bg">
                        <div>
                            <p class="text-sm text-text-primary dark:text-white">{{ \Carbon\Carbon::parse($schedule->date)->format('d M Y') }} — {{ $schedule->location_name }}</p>
                            <p class="text-xs text-text-muted dark:text-gray-500">{{ substr($schedule->start_time, 0, 5) }} - {{ substr($schedule->end_time, 0, 5) }} | Kuota: {{ $schedule->quota }}</p>
                        </div>
                        <form method="POST" action="{{ route('admin.courses.schedules.destroy', $schedule) }}" onsubmit="return confirm('Hapus jadwal ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-xs font-medium text-danger hover:underline">Hapus</button>
                        </form>
                    </div>
                @empty
                    <p class="mb-4 text-sm text-text-muted dark:text-gray-500">Belum ada jadwal.</p>
                @endforelse

                <hr class="my-4 border-border dark:border-gray-700">

                <h3 class="mb-3 text-sm font-medium text-text-primary dark:text-gray-200">Tambah Jadwal</h3>
                <form method="POST" action="{{ route('admin.courses.schedules.store', $course) }}">
                    @csrf
                    <div class="grid gap-3 sm:grid-cols-2">
                        <div>
                            <label class="mb-1 block text-xs text-text-secondary dark:text-gray-400">Tanggal</label>
                            <input type="date" name="date" required
                                class="w-full rounded-xl border border-border bg-white px-3 py-2 text-sm outline-none focus:border-primary-start dark:border-gray-600 dark:bg-dark-bg dark:text-white">
                        </div>
                        <div>
                            <label class="mb-1 block text-xs text-text-secondary dark:text-gray-400">Lokasi</label>
                            <input type="text" name="location_name" required placeholder="Nama tempat"
                                class="w-full rounded-xl border border-border bg-white px-3 py-2 text-sm outline-none focus:border-primary-start dark:border-gray-600 dark:bg-dark-bg dark:text-white">
                        </div>
                        <div>
                            <label class="mb-1 block text-xs text-text-secondary dark:text-gray-400">Jam Mulai</label>
                            <input type="time" name="start_time" required
                                class="w-full rounded-xl border border-border bg-white px-3 py-2 text-sm outline-none focus:border-primary-start dark:border-gray-600 dark:bg-dark-bg dark:text-white">
                        </div>
                        <div>
                            <label class="mb-1 block text-xs text-text-secondary dark:text-gray-400">Jam Selesai</label>
                            <input type="time" name="end_time" required
                                class="w-full rounded-xl border border-border bg-white px-3 py-2 text-sm outline-none focus:border-primary-start dark:border-gray-600 dark:bg-dark-bg dark:text-white">
                        </div>
                        <div>
                            <label class="mb-1 block text-xs text-text-secondary dark:text-gray-400">Kuota</label>
                            <input type="number" name="quota" required min="1" value="20"
                                class="w-full rounded-xl border border-border bg-white px-3 py-2 text-sm outline-none focus:border-primary-start dark:border-gray-600 dark:bg-dark-bg dark:text-white">
                        </div>
                        <div>
                            <label class="mb-1 block text-xs text-text-secondary dark:text-gray-400">Google Maps Link (opsional)</label>
                            <input type="url" name="google_maps_link" placeholder="https://maps.app.goo.gl/..."
                                class="w-full rounded-xl border border-border bg-white px-3 py-2 text-sm outline-none focus:border-primary-start dark:border-gray-600 dark:bg-dark-bg dark:text-white">
                        </div>
                    </div>
                    <button type="submit"
                        class="mt-4 rounded-full bg-gradient-to-b from-[#2B7FFF] to-[#0065FF] px-5 py-2 text-sm font-medium text-white transition-all duration-150 hover:opacity-90">
                        Tambah Jadwal
                    </button>
                </form>
            </div>
        @else
            <div class="rounded-2xl border border-border bg-surface-alt p-8 shadow-sm dark:border-gray-700 dark:bg-dark-surface">
                <h2 class="mb-4 text-lg font-semibold text-text-primary dark:text-white">Materi Online</h2>

                @forelse ($course->materials->sortBy('sequence_order') as $material)
                    <div class="mb-2 flex items-center justify-between rounded-xl border border-border bg-surface p-4 dark:border-gray-600 dark:bg-dark-bg">
                        <div>
                            <p class="text-sm text-text-primary dark:text-white">{{ $material->title }}</p>
                            <p class="text-xs text-text-muted dark:text-gray-500">Urutan {{ $material->sequence_order }}</p>
                        </div>
                        <form method="POST" action="{{ route('admin.courses.materials.destroy', $material) }}" onsubmit="return confirm('Hapus materi ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-xs font-medium text-danger hover:underline">Hapus</button>
                        </form>
                    </div>
                @empty
                    <p class="mb-4 text-sm text-text-muted dark:text-gray-500">Belum ada materi.</p>
                @endforelse

                <hr class="my-4 border-border dark:border-gray-700">

                <h3 class="mb-3 text-sm font-medium text-text-primary dark:text-gray-200">Tambah Materi</h3>
                <form method="POST" action="{{ route('admin.courses.materials.store', $course) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label class="mb-1 block text-xs text-text-secondary dark:text-gray-400">Judul Materi</label>
                        <input type="text" name="title" required placeholder="Judul video / dokumen"
                            class="w-full rounded-xl border border-border bg-white px-3 py-2 text-sm outline-none focus:border-primary-start dark:border-gray-600 dark:bg-dark-bg dark:text-white">
                    </div>
                    <div class="mb-3">
                        <label class="mb-1 block text-xs text-text-secondary dark:text-gray-400">File (video / PDF / dokumen)</label>
                        <input type="file" name="file" required
                            class="w-full text-sm text-text-secondary file:mr-4 file:rounded-full file:border-0 file:bg-gradient-to-b file:from-[#2B7FFF] file:to-[#0065FF] file:px-4 file:py-2 file:text-sm file:font-medium file:text-white hover:file:opacity-90">
                    </div>
                    <div class="mb-3">
                        <label class="mb-1 block text-xs text-text-secondary dark:text-gray-400">Urutan</label>
                        <input type="number" name="sequence_order" required min="1" value="{{ $course->materials->count() + 1 }}"
                            class="w-24 rounded-xl border border-border bg-white px-3 py-2 text-sm outline-none focus:border-primary-start dark:border-gray-600 dark:bg-dark-bg dark:text-white">
                    </div>
                    <button type="submit"
                        class="rounded-full bg-gradient-to-b from-[#2B7FFF] to-[#0065FF] px-5 py-2 text-sm font-medium text-white transition-all duration-150 hover:opacity-90">
                        Tambah Materi
                    </button>
                </form>
            </div>
        @endif
    </div>
</div>
@endsection
