@extends('layouts.master')

@section('title', 'Kursus')

@section('content')
<div class="min-h-screen pt-20">
    <div class="mx-auto max-w-7xl px-4 py-8 lg:px-8">
        <h1 class="mb-8 text-3xl font-bold text-text-primary dark:text-white">Eksplorasi Kursus</h1>

        <div class="flex flex-col gap-8 lg:flex-row">
            {{-- Sidebar Filter --}}
            <aside class="w-full shrink-0 lg:w-72">
                <form method="GET" action="{{ route('courses.index') }}" class="sticky top-24 rounded-2xl border border-border bg-surface-alt p-6 shadow-sm dark:border-gray-700 dark:bg-dark-surface">
                    <div class="mb-5">
                        <label for="search" class="mb-1 block text-sm font-medium text-text-primary dark:text-gray-200">Cari</label>
                        <input type="text" name="search" id="search" value="{{ request('search') }}"
                            class="w-full rounded-xl border border-border bg-white px-4 py-2.5 text-sm text-text-primary outline-none transition-colors focus:border-primary-start focus:ring-1 focus:ring-primary-start dark:border-gray-600 dark:bg-dark-bg dark:text-white"
                            placeholder="Nama kursus...">
                    </div>

                    <div class="mb-5">
                        <p class="mb-2 text-sm font-medium text-text-primary dark:text-gray-200">Tipe Kelas</p>
                        <div class="space-y-2">
                            <label class="flex items-center gap-2 text-sm text-text-secondary dark:text-gray-400">
                                <input type="checkbox" name="type" value="online" {{ request('type') === 'online' ? 'checked' : '' }}>
                                Online
                            </label>
                            <label class="flex items-center gap-2 text-sm text-text-secondary dark:text-gray-400">
                                <input type="checkbox" name="type" value="offline" {{ request('type') === 'offline' ? 'checked' : '' }}>
                                Offline
                            </label>
                        </div>
                    </div>

                    <div class="mb-5">
                        <label for="category_id" class="mb-1 block text-sm font-medium text-text-primary dark:text-gray-200">Kategori</label>
                        <select name="category_id" id="category_id"
                            class="w-full rounded-xl border border-border bg-white px-4 py-2.5 text-sm text-text-primary outline-none transition-colors focus:border-primary-start focus:ring-1 focus:ring-primary-start dark:border-gray-600 dark:bg-dark-bg dark:text-white">
                            <option value="">Semua Kategori</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-5">
                        <p class="mb-2 text-sm font-medium text-text-primary dark:text-gray-200">Rentang Harga</p>
                        <div class="flex gap-2">
                            <input type="number" name="price_min" value="{{ request('price_min') }}" placeholder="Min"
                                class="w-full rounded-xl border border-border bg-white px-3 py-2 text-sm text-text-primary outline-none transition-colors focus:border-primary-start focus:ring-1 focus:ring-primary-start dark:border-gray-600 dark:bg-dark-bg dark:text-white">
                            <input type="number" name="price_max" value="{{ request('price_max') }}" placeholder="Max"
                                class="w-full rounded-xl border border-border bg-white px-3 py-2 text-sm text-text-primary outline-none transition-colors focus:border-primary-start focus:ring-1 focus:ring-primary-start dark:border-gray-600 dark:bg-dark-bg dark:text-white">
                        </div>
                    </div>

                    <button type="submit"
                        class="w-full rounded-full bg-gradient-to-b from-[#2B7FFF] to-[#0065FF] px-5 py-2.5 text-sm font-medium text-white transition-all duration-150 hover:opacity-90">
                        Filter
                    </button>

                    <a href="{{ route('courses.index') }}"
                        class="mt-2 block w-full rounded-full border border-border px-5 py-2.5 text-center text-sm font-medium text-text-secondary transition-colors hover:bg-gray-50 dark:border-gray-600 dark:text-gray-300 dark:hover:bg-dark-bg">
                        Reset
                    </a>
                </form>
            </aside>

            {{-- Course Grid --}}
            <div class="flex-1">
                @if ($courses->isEmpty())
                    <div class="rounded-2xl border border-border bg-surface-alt p-12 text-center dark:border-gray-700 dark:bg-dark-surface">
                        <p class="text-text-secondary dark:text-gray-400">Tidak ada kursus yang ditemukan.</p>
                    </div>
                @else
                    <div class="grid gap-6 sm:grid-cols-2 xl:grid-cols-3">
                        @foreach ($courses as $course)
                            <a href="{{ route('courses.show', $course->slug) }}" class="group block">
                                <div class="overflow-hidden rounded-2xl border border-border bg-surface-alt shadow-sm transition-all duration-200 group-hover:-translate-y-1 group-hover:shadow-md dark:border-gray-700 dark:bg-dark-surface">
                                    <div class="flex aspect-video items-center justify-center bg-gradient-to-br from-[#2B7FFF]/10 to-[#0065FF]/10">
                                        @if ($course->thumbnail)
                                            <img src="{{ asset('storage/' . $course->thumbnail) }}" alt="{{ $course->title }}" class="h-full w-full object-cover">
                                        @else
                                            <span class="text-sm font-medium text-text-muted dark:text-gray-500">{{ $course->category->name }}</span>
                                        @endif
                                    </div>
                                    <div class="p-5">
                                        <div class="mb-2 flex items-center gap-2">
                                            <span class="rounded-full bg-tertiary/10 px-3 py-1 text-xs font-medium text-tertiary">
                                                {{ $course->type === 'online' ? 'Online' : 'Offline' }}
                                            </span>
                                        </div>
                                        <h3 class="text-lg font-semibold text-text-primary group-hover:text-primary-start dark:text-white dark:group-hover:text-primary-start">
                                            {{ $course->title }}
                                        </h3>
                                        <p class="mt-1 text-sm text-text-secondary dark:text-gray-400">{{ $course->instructor->name }}</p>
                                        @if ($course->reviews_avg_rating_value)
                                            <div class="mt-1 flex items-center gap-1">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    <svg class="h-3.5 w-3.5 {{ $i <= round($course->reviews_avg_rating_value) ? 'text-yellow-400' : 'text-gray-300 dark:text-gray-600' }}" fill="currentColor" viewBox="0 0 20 20">
                                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                                    </svg>
                                                @endfor
                                                <span class="ml-0.5 text-xs text-text-muted dark:text-gray-500">{{ number_format($course->reviews_avg_rating_value, 1) }}</span>
                                            </div>
                                        @endif
                                        <p class="mt-2 text-xl font-bold text-primary-start">Rp {{ number_format($course->price, 0, ',', '.') }}</p>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>

                    <div class="mt-8">
                        {{ $courses->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
