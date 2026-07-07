@extends('layouts.master')

@section('title', 'Beranda')

@section('content')
<div class="min-h-screen">
    {{-- Hero Section --}}
    <section id="beranda" class="relative flex min-h-[650px] items-center justify-center overflow-hidden pt-20 lg:min-h-[750px]">
        <div class="pointer-events-none absolute inset-0" aria-hidden="true">
            <div class="absolute -left-40 -top-40 h-[500px] w-[500px] rounded-full bg-gradient-to-br from-blue-400/20 to-purple-400/20 blur-3xl"></div>
            <div class="absolute -bottom-40 -right-40 h-[500px] w-[500px] rounded-full bg-gradient-to-br from-purple-400/20 to-blue-400/20 blur-3xl"></div>
            <div class="absolute left-1/2 top-1/2 h-[600px] w-[600px] -translate-x-1/2 -translate-y-1/2 rounded-full bg-gradient-to-br from-blue-100/30 to-purple-100/30 blur-3xl dark:from-blue-500/10 dark:to-purple-500/10"></div>
        </div>

        <div class="relative mx-auto max-w-[1600px] px-6 text-center lg:px-8">
            <h1 class="text-5xl font-bold leading-tight tracking-tight text-text-primary dark:text-white sm:text-6xl lg:text-7xl">
                Kembangkan
                <span class="bg-gradient-to-r from-primary to-primary-dark bg-clip-text text-transparent">Bakat</span>
                &amp;
                <span class="bg-gradient-to-r from-primary to-primary-dark bg-clip-text text-transparent">Kreativitas</span>
                Anda
            </h1>
            <p class="mx-auto mt-6 max-w-3xl text-xl leading-relaxed text-text-secondary dark:text-gray-400 lg:text-2xl">
                Temukan kursus hobi terbaik dari instruktur profesional. Belajar secara online atau offline sesuai gaya dan jadwal Anda.
            </p>

            <form action="{{ route('courses.index') }}" method="GET" class="mx-auto mt-10 flex max-w-2xl items-center gap-4">
                <div class="relative flex-1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="pointer-events-none absolute left-4 top-1/2 -translate-y-1/2 text-text-muted dark:text-gray-500">
                        <circle cx="11" cy="11" r="8"/>
                        <path d="m21 21-4.3-4.3"/>
                    </svg>
                    <input type="text" name="search" placeholder="Cari kursus yang kamu minati..."
                        class="w-full rounded-2xl border border-border bg-white px-11 py-4 text-base text-text-primary placeholder-text-muted shadow-sm transition-all duration-200 focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20 dark:border-gray-600 dark:bg-dark-surface dark:text-white dark:placeholder-gray-500 dark:focus:border-primary lg:text-lg">
                </div>
                <button type="submit"
                    class="rounded-2xl bg-primary px-8 py-4 text-base font-medium text-white shadow-sm transition-all duration-150 hover:bg-primary-dark hover:shadow-md focus:outline-none focus:ring-2 focus:ring-primary/40 lg:text-lg">
                    Cari
                </button>
            </form>

            <div class="mt-12 flex flex-wrap items-center justify-center gap-4">
                @foreach ($categories as $category)
                    <a href="{{ route('courses.index', ['category_id' => $category->id]) }}"
                        class="rounded-full border border-border bg-white/70 px-5 py-2.5 text-sm font-medium text-text-secondary shadow-sm backdrop-blur-sm transition-all duration-200 hover:border-primary/30 hover:text-primary hover:shadow-md dark:border-gray-600 dark:bg-dark-surface/70 dark:text-gray-300 dark:hover:border-primary/50 dark:hover:text-primary lg:text-base">
                        {{ $category->name }}
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Statistics Section (#tentang) --}}
    <section id="tentang" class="py-24 lg:py-28 bg-surface dark:bg-dark-bg">
        <div class="mx-auto max-w-[1600px] px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-4xl font-bold tracking-tight text-text-primary dark:text-white lg:text-5xl">Tentang Kami</h2>
                <p class="mx-auto mt-4 max-w-3xl text-lg leading-relaxed text-text-secondary dark:text-gray-400">
                    Platform kursus hobi terpercaya dengan ribuan pilihan belajar dari mentor profesional. Kembangkan bakat dan minat Anda bersama komunitas pembelajar aktif di seluruh Indonesia.
                </p>
            </div>
            <div class="mt-14 grid gap-8 sm:grid-cols-2 lg:grid-cols-4">
                <div class="group rounded-2xl bg-gradient-to-br from-primary to-primary-dark p-10 text-center shadow-lg transition-all duration-300 hover:-translate-y-1.5 hover:shadow-xl">
                    <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-xl bg-white/20 backdrop-blur-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-white">
                            <path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H19a1 1 0 0 1 1 1v18a1 1 0 0 1-1 1H6.5a1 1 0 0 1 0-5H20"/>
                        </svg>
                    </div>
                    <p class="mt-5 text-5xl font-bold tracking-tight text-white lg:text-6xl">{{ $stats['courses'] }}+</p>
                    <p class="mt-2 text-base font-medium text-white/80">Kursus Tersedia</p>
                </div>

                <div class="group rounded-2xl bg-gradient-to-br from-emerald-500 to-emerald-600 p-10 text-center shadow-lg transition-all duration-300 hover:-translate-y-1.5 hover:shadow-xl">
                    <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-xl bg-white/20 backdrop-blur-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-white">
                            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                            <circle cx="9" cy="7" r="4"/>
                            <path d="M22 21v-2a4 4 0 0 0-3-3.87"/>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                        </svg>
                    </div>
                    <p class="mt-5 text-5xl font-bold tracking-tight text-white lg:text-6xl">{{ $stats['students'] }}+</p>
                    <p class="mt-2 text-base font-medium text-white/80">Siswa Aktif</p>
                </div>

                <div class="group rounded-2xl bg-gradient-to-br from-orange-400 to-orange-500 p-10 text-center shadow-lg transition-all duration-300 hover:-translate-y-1.5 hover:shadow-xl">
                    <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-xl bg-white/20 backdrop-blur-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-white">
                            <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
                        </svg>
                    </div>
                    <p class="mt-5 text-5xl font-bold tracking-tight text-white lg:text-6xl">{{ $stats['instructors'] }}+</p>
                    <p class="mt-2 text-base font-medium text-white/80">Mentor Profesional</p>
                </div>

                <div class="group rounded-2xl bg-gradient-to-br from-purple-500 to-purple-600 p-10 text-center shadow-lg transition-all duration-300 hover:-translate-y-1.5 hover:shadow-xl">
                    <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-xl bg-white/20 backdrop-blur-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-white">
                            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                        </svg>
                    </div>
                    <p class="mt-5 text-5xl font-bold tracking-tight text-white lg:text-6xl">{{ $stats['satisfaction'] }}%</p>
                    <p class="mt-2 text-base font-medium text-white/80">Tingkat Kepuasan</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Popular Courses Section --}}
    <section id="kursus" class="py-24 lg:py-28 bg-surface-alt dark:bg-dark-surface">
        <div class="mx-auto max-w-[1600px] px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-4xl font-bold tracking-tight text-text-primary dark:text-white lg:text-5xl">Kursus Populer</h2>
                <p class="mx-auto mt-4 max-w-2xl text-xl leading-relaxed text-text-secondary dark:text-gray-400">
                    Temukan kursus favorit pilihan peserta untuk mengembangkan potensi diri Anda.
                </p>
            </div>

            @php
                $gradients = [
                    'from-blue-400 to-blue-600',
                    'from-purple-400 to-purple-600',
                    'from-emerald-400 to-emerald-600',
                    'from-orange-400 to-orange-600',
                    'from-pink-400 to-pink-600',
                    'from-teal-400 to-teal-600',
                    'from-rose-400 to-rose-600',
                    'from-cyan-400 to-cyan-600',
                ];
                $icons = [
                    'palette', 'music', 'dumbbell', 'code', 'camera', 'book-open', 'pen-tool', 'headphones'
                ];
            @endphp

            <div class="mt-14 grid gap-10 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($courses as $i => $course)
                    @php
                        $gi = $course->category_id % count($gradients);
                    @endphp
                    <div class="group overflow-hidden rounded-[18px] border border-border bg-white shadow-sm transition-all duration-300 hover:-translate-y-1 hover:shadow-xl dark:border-gray-700 dark:bg-dark-surface">
                    <div class="relative aspect-video overflow-hidden bg-gradient-to-br {{ $gradients[$gi] }}">
                        @if ($course->thumbnail)
                            <img src="{{ asset('storage/' . $course->thumbnail) }}" alt="{{ $course->title }}" class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-110">
                        @else
                            <div class="flex h-full w-full items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="56" height="56" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="text-white/40">
                                    <circle cx="12" cy="12" r="10"/><path d="M12 16v-4"/><path d="M12 8h.01"/>
                                </svg>
                            </div>
                        @endif
                        <div class="absolute top-4 left-4 flex flex-wrap gap-2">
                            <span class="rounded-full bg-white/90 px-3.5 py-1.5 text-xs font-medium text-text-primary shadow-sm backdrop-blur-sm dark:bg-dark-surface/90 dark:text-white">
                                {{ $course->category->name }}
                            </span>
                            <span class="rounded-full px-3.5 py-1.5 text-xs font-medium text-white shadow-sm backdrop-blur-sm {{ $course->type === 'online' ? 'bg-tertiary/80' : 'bg-amber-500/80' }}">
                                {{ $course->type === 'online' ? 'Online' : 'Offline' }}
                            </span>
                        </div>
                    </div>
                    <div class="p-8">
                        <h3 class="text-xl font-semibold text-text-primary transition-colors group-hover:text-primary dark:text-white dark:group-hover:text-primary">{{ $course->title }}</h3>
                        <p class="mt-1.5 text-base text-text-secondary dark:text-gray-400">{{ $course->instructor->name }}</p>

                            <div class="mt-3 flex items-center gap-1.5">
                                @if ($course->reviews_avg_rating_value)
                                    @for ($s = 1; $s <= 5; $s++)
                                        <svg class="h-4 w-4 {{ $s <= round($course->reviews_avg_rating_value) ? 'text-yellow-400' : 'text-gray-300 dark:text-gray-600' }}" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                        </svg>
                                    @endfor
                                    <span class="ml-0.5 text-xs font-medium text-text-muted dark:text-gray-500">{{ number_format($course->reviews_avg_rating_value, 1) }}</span>
                                @endif
                            </div>

                            <div class="mt-3 flex flex-wrap items-center gap-x-4 gap-y-1.5 text-xs text-text-muted dark:text-gray-500">
                                @if ($course->duration)
                                    <span class="flex items-center gap-1.5">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                                        {{ $course->duration }}
                                    </span>
                                @endif
                                @if ($course->enrollments_count > 0)
                                    <span class="flex items-center gap-1.5">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                                        {{ $course->enrollments_count }} siswa
                                    </span>
                                @endif
                            </div>

                            <div class="mt-5 flex items-center justify-between">
                                <p class="text-2xl font-bold text-primary dark:text-primary">Rp {{ number_format($course->price, 0, ',', '.') }}</p>
                                <a href="{{ route('courses.show', $course->slug) }}"
                                    class="rounded-full border border-border px-6 py-2.5 text-sm font-medium text-text-secondary transition-all duration-200 hover:border-primary hover:bg-primary hover:text-white dark:border-gray-600 dark:text-gray-300 dark:hover:border-primary dark:hover:bg-primary dark:hover:text-white">
                                    Lihat Detail
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-14 text-center">
                <a href="{{ route('courses.index') }}"
                    class="inline-flex items-center gap-2 rounded-full border border-border px-10 py-3.5 text-base font-medium text-text-secondary transition-all duration-200 hover:border-primary hover:text-primary hover:shadow-md dark:border-gray-600 dark:text-gray-300 dark:hover:border-primary dark:hover:text-primary">
                    Lihat Semua Kursus
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                </a>
            </div>
        </div>
    </section>

    {{-- CTA Section --}}
    <section class="py-24 lg:py-28">
        <div class="bg-gradient-to-br from-primary to-primary-dark py-20 text-center shadow-xl lg:py-24">
            <div class="mx-auto max-w-[1600px] px-6 lg:px-8">
                <h3 class="text-4xl font-bold tracking-tight text-white lg:text-5xl">Siap Mengembangkan Bakat Anda?</h3>
                <p class="mx-auto mt-4 max-w-2xl text-xl leading-relaxed text-white/80 lg:text-2xl">
                    Bergabunglah dengan ribuan peserta lainnya dan mulailah perjalanan belajar Anda hari ini.
                </p>
                <div class="mt-12 flex flex-col items-center justify-center gap-5 sm:flex-row">
                    <a href="{{ route('register') }}"
                        class="rounded-2xl bg-white px-10 py-4 text-base font-semibold text-primary shadow-sm transition-all duration-200 hover:bg-gray-50 hover:shadow-md focus:outline-none focus:ring-2 focus:ring-white/40 lg:text-lg">
                        Daftar Sekarang
                    </a>
                    <a href="{{ route('courses.index') }}"
                        class="rounded-2xl border border-white/30 px-10 py-4 text-base font-medium text-white transition-all duration-200 hover:border-white/60 hover:bg-white/10 focus:outline-none focus:ring-2 focus:ring-white/40 lg:text-lg">
                        Jelajahi Kursus
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- Footer --}}
    <footer class="border-t border-border bg-surface-alt dark:border-gray-700 dark:bg-dark-surface">
        <div class="mx-auto max-w-[1600px] px-6 py-20 lg:px-8">
            <div class="grid gap-16 sm:grid-cols-2 lg:grid-cols-[2fr_2.5fr_1.5fr_1.5fr]">
                {{-- Column 1: Logo & Description --}}
                <div>
                    <a href="/" class="flex items-center gap-2.5">
                        <img src="{{ asset('images/logo-kursus-hobi.svg') }}" alt="Kursus Hobi" class="h-9 w-auto dark:brightness-0 dark:invert">
                        <span class="text-xl font-bold text-primary-start dark:text-primary-light">Kursus Hobi</span>
                    </a>
                    <p class="mt-4 text-base leading-relaxed text-text-secondary dark:text-gray-400">
                        Platform edukasi hobi terpercaya yang menghubungkan Anda dengan instruktur profesional untuk mengembangkan bakat dan kreativitas.
                    </p>
                    <div class="mt-6 flex items-center gap-3">
                        <a href="#" class="flex h-10 w-10 items-center justify-center rounded-xl border border-border text-text-muted transition-colors hover:border-primary hover:text-primary dark:border-gray-600 dark:text-gray-500 dark:hover:border-primary dark:hover:text-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="20" x="2" y="2" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg>
                        </a>
                        <a href="#" class="flex h-10 w-10 items-center justify-center rounded-xl border border-border text-text-muted transition-colors hover:border-primary hover:text-primary dark:border-gray-600 dark:text-gray-500 dark:hover:border-primary dark:hover:text-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 4s-.7 2.1-2 3.4c1.6 10-9.4 17.3-18 11.6 2.2.1 4.4-.6 6-2C3 15.5.5 9.6 3 5c2.2 2.6 5.6 4.1 9 4-.9-4.2 4-6.6 7-3.8 1.1 0 3-1.2 3-1.2z"/></svg>
                        </a>
                        <a href="#" class="flex h-10 w-10 items-center justify-center rounded-xl border border-border text-text-muted transition-colors hover:border-primary hover:text-primary dark:border-gray-600 dark:text-gray-500 dark:hover:border-primary dark:hover:text-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2.5 17a24.12 24.12 0 0 1 0-10 2 2 0 0 1 1.4-1.4 49.56 49.56 0 0 1 16.2 0A2 2 0 0 1 21.5 7a24.12 24.12 0 0 1 0 10 2 2 0 0 1-1.4 1.4 49.55 49.55 0 0 1-16.2 0A2 2 0 0 1 2.5 17"/><path d="m10 15 5-3-5-3z"/></svg>
                        </a>
                    </div>
                </div>

                {{-- Column 2: Categories --}}
                <div>
                    <h4 class="text-sm font-semibold uppercase tracking-wider text-text-primary dark:text-white">Kategori</h4>
                    <div class="mt-6 grid grid-cols-3 gap-x-2 gap-y-3">
                        @foreach ($categories->take(6) as $category)
                            <a href="{{ route('courses.index', ['category_id' => $category->id]) }}"
                                class="whitespace-nowrap text-sm text-text-secondary transition-colors hover:text-primary dark:text-gray-400 dark:hover:text-primary">
                                {{ $category->name }}
                            </a>
                        @endforeach
                        <a href="{{ route('courses.index') }}"
                            class="col-span-3 text-sm font-medium text-primary transition-colors hover:text-primary-dark dark:text-primary dark:hover:text-primary-light">
                            Lihat Semua
                        </a>
                    </div>
                </div>

                {{-- Column 3: About --}}
                <div>
                    <h4 class="text-sm font-semibold uppercase tracking-wider text-text-primary dark:text-white">Tentang</h4>
                    <ul class="mt-6 space-y-3">
                        <li><a href="#tentang" class="text-sm text-text-secondary transition-colors hover:text-primary dark:text-gray-400 dark:hover:text-primary">Tentang Kami</a></li>
                    </ul>
                </div>

                {{-- Column 4: Contact --}}
                <div>
                    <h4 class="text-sm font-semibold uppercase tracking-wider text-text-primary dark:text-white">Kontak</h4>
                    <ul class="mt-6 space-y-3">
                        <li><a href="mailto:hello@kursushobi.com" class="text-sm text-text-secondary transition-colors hover:text-primary dark:text-gray-400 dark:hover:text-primary">hello@kursushobi.com</a></li>
                        <li><a href="tel:+62221234567" class="text-sm text-text-secondary transition-colors hover:text-primary dark:text-gray-400 dark:hover:text-primary">(022) 123-4567</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="border-t border-border dark:border-gray-700">
            <div class="mx-auto max-w-[1600px] px-6 py-8 text-center text-sm text-text-secondary dark:text-gray-400 lg:px-8">
                &copy; {{ date('Y') }} Kursus Hobi. All rights reserved.
            </div>
        </div>
    </footer>
</div>

@push('scripts')
<script>
(function() {
    const sections = document.querySelectorAll('section[id]');
    const navLinks = document.querySelectorAll('nav a[href^="/#"], nav a[href="/"]');

    const updateActiveLink = () => {
        let currentId = 'beranda';
        sections.forEach(section => {
            const rect = section.getBoundingClientRect();
            if (rect.top <= 200) {
                currentId = section.id;
            }
        });

        navLinks.forEach(link => {
            link.classList.remove('text-primary', 'dark:text-primary-light');
            link.classList.add('text-text-secondary', 'dark:text-gray-300');

            const href = link.getAttribute('href');
            const targetId = href === '/' ? 'beranda' : href.replace('/#', '');
            if (targetId === currentId) {
                link.classList.remove('text-text-secondary', 'dark:text-gray-300');
                link.classList.add('text-primary', 'dark:text-primary-light');
            }
        });
    };

    updateActiveLink();

    sections.forEach(section => {
        const observer = new IntersectionObserver(() => {
            updateActiveLink();
        }, { threshold: 0.2 });
        observer.observe(section);
    });

    window.addEventListener('scroll', updateActiveLink, { passive: true });
})();
</script>
@endpush
@endsection