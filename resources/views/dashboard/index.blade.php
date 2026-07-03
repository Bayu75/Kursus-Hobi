@extends('layouts.master')

@section('title', 'Dashboard')

@section('content')
<div class="min-h-screen pt-20">
    <div class="mx-auto max-w-7xl px-4 py-8 lg:px-8">
        <div class="mb-8 flex items-center justify-between">
            <h1 class="text-3xl font-bold text-text-primary dark:text-white">Dashboard</h1>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="rounded-full border border-border px-6 py-2 text-sm font-medium text-text-secondary transition-colors hover:bg-gray-50 dark:border-gray-600 dark:text-gray-300 dark:hover:bg-dark-surface">
                    Logout
                </button>
            </form>
        </div>

        {{-- Stats Cards --}}
        <div class="mb-8 grid gap-6 md:grid-cols-3">
            <a href="{{ route('dashboard', ['tab' => 'active']) }}" class="rounded-2xl border border-border bg-surface-alt p-6 shadow-sm transition-colors hover:border-primary-start/30 dark:border-gray-700 dark:bg-dark-surface">
                <p class="text-sm text-text-secondary dark:text-gray-400">Kursus Aktif</p>
                <p class="text-3xl font-bold text-text-primary dark:text-white">{{ $stats['active'] }}</p>
            </a>
            <a href="{{ route('dashboard', ['tab' => 'pending']) }}" class="rounded-2xl border border-border bg-surface-alt p-6 shadow-sm transition-colors hover:border-warning/30 dark:border-gray-700 dark:bg-dark-surface">
                <p class="text-sm text-text-secondary dark:text-gray-400">Menunggu Verifikasi</p>
                <p class="text-3xl font-bold text-warning">{{ $stats['pending'] }}</p>
            </a>
            <a href="{{ route('dashboard', ['tab' => 'completed']) }}" class="rounded-2xl border border-border bg-surface-alt p-6 shadow-sm transition-colors hover:border-success/30 dark:border-gray-700 dark:bg-dark-surface">
                <p class="text-sm text-text-secondary dark:text-gray-400">Selesai</p>
                <p class="text-3xl font-bold text-success">{{ $stats['completed'] }}</p>
            </a>
        </div>

        {{-- Tabs --}}
        <div class="mb-6 flex border-b border-border dark:border-gray-700">
            @php $tabs = ['active' => 'Kursus Aktif', 'pending' => 'Menunggu Verifikasi', 'completed' => 'Riwayat']; @endphp
            @foreach ($tabs as $key => $label)
                <a href="{{ route('dashboard', ['tab' => $key]) }}"
                    class="border-b-2 px-6 py-3 text-sm font-medium transition-colors
                    {{ $tab === $key ? 'border-primary-start text-primary-start' : 'border-transparent text-text-secondary hover:text-text-primary dark:text-gray-400 dark:hover:text-white' }}">
                    {{ $label }}
                </a>
            @endforeach
        </div>

        {{-- Enrollments List --}}
        @if ($enrollments->isEmpty())
            <div class="rounded-2xl border border-border bg-surface-alt p-12 text-center dark:border-gray-700 dark:bg-dark-surface">
                <p class="text-text-secondary dark:text-gray-400">Belum ada kursus di tab ini.</p>
                <a href="{{ route('courses.index') }}" class="mt-3 inline-block text-sm font-medium text-primary-start hover:underline">Jelajahi Kursus</a>
            </div>
        @else
            <div class="space-y-4">
                @foreach ($enrollments as $enrollment)
                    <div class="rounded-2xl border border-border bg-surface-alt p-5 shadow-sm transition-colors hover:border-border/80 dark:border-gray-700 dark:bg-dark-surface">
                        <div class="flex items-center justify-between">
                            <div class="flex-1">
                                <h3 class="font-semibold text-text-primary dark:text-white">{{ $enrollment->course->title }}</h3>
                                <p class="text-sm text-text-secondary dark:text-gray-400">{{ $enrollment->course->instructor->name }}</p>
                            </div>
                            <div class="text-right">
                                <span class="inline-block rounded-full px-3 py-1 text-xs font-medium
                                    @if ($enrollment->status === 'active') bg-success/10 text-success
                                    @elseif ($enrollment->status === 'pending') bg-warning/10 text-warning
                                    @else bg-gray-100 text-text-secondary dark:bg-dark-surface dark:text-gray-400 @endif">
                                    {{ ucfirst($enrollment->status) }}
                                </span>
                                @if ($enrollment->status === 'active')
                                    <a href="{{ route('learning.show', $enrollment->course) }}" class="mt-2 block text-xs font-medium text-primary-start hover:underline">
                                        Mulai Belajar
                                    </a>
                                @elseif ($enrollment->status === 'pending' && !$enrollment->payment)
                                    <a href="{{ route('payments.create', $enrollment) }}" class="mt-2 block text-xs font-medium text-primary-start hover:underline">
                                        Upload Pembayaran
                                    </a>
                                @elseif ($enrollment->status === 'completed')
                                    @php
                                        $hasReviewed = $enrollment->course->reviews()->where('user_id', auth()->id())->exists();
                                    @endphp
                                    @if (!$hasReviewed)
                                        <button type="button"
                                            class="open-review-modal mt-2 block text-xs font-medium text-primary-start hover:underline"
                                            data-enrollment-id="{{ $enrollment->id }}"
                                            data-course-title="{{ $enrollment->course->title }}">
                                            Beri Ulasan
                                        </button>
                                    @else
                                        <span class="mt-2 block text-xs text-text-muted dark:text-gray-500">Sudah diulas</span>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>

{{-- Review Modal --}}
<div id="review-modal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 backdrop-blur-sm p-4">
    <div class="w-full max-w-lg rounded-2xl border border-border bg-surface-alt p-8 shadow-xl dark:border-gray-700 dark:bg-dark-surface">
        <div class="mb-2 flex items-center justify-between">
            <h2 class="text-xl font-bold text-text-primary dark:text-white">Ulasan Kursus</h2>
            <button type="button" id="close-review-modal" class="rounded-full p-1 text-text-muted transition-colors hover:bg-gray-100 dark:hover:bg-dark-bg">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
            </button>
        </div>
        <p id="modal-course-title" class="mb-6 text-sm text-text-secondary dark:text-gray-400"></p>

        <form id="review-form" method="POST" action="">
            @csrf

            <div class="mb-6 text-center">
                <p class="mb-3 text-sm font-medium text-text-primary dark:text-gray-200">Bagaimana kursus ini?</p>
                <div class="star-rating flex justify-center gap-2" id="modal-star-rating">
                    @for ($i = 1; $i <= 5; $i++)
                        <button type="button" data-value="{{ $i }}"
                            class="star-btn text-4xl text-gray-300 transition-colors hover:text-yellow-400 dark:text-gray-600"
                            aria-label="Rating {{ $i }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="star-icon"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                        </button>
                    @endfor
                </div>
                <p id="modal-rating-label" class="mt-2 text-sm text-text-muted dark:text-gray-500">Klik bintang untuk memberi nilai</p>
                <input type="hidden" name="rating_value" id="modal_rating_value" value="">
            </div>

            <div class="mb-6">
                <label for="modal_comment" class="mb-1 block text-sm font-medium text-text-primary dark:text-gray-200">Komentar (opsional)</label>
                <textarea name="comment" id="modal_comment" rows="4"
                    class="w-full rounded-xl border border-border bg-white px-4 py-3 text-sm text-text-primary outline-none transition-colors focus:border-primary-start focus:ring-1 focus:ring-primary-start dark:border-gray-600 dark:bg-dark-bg dark:text-white"
                    placeholder="Ceritakan pengalaman Anda..."></textarea>
            </div>

            <button type="submit"
                class="w-full rounded-full bg-gradient-to-b from-[#2B7FFF] to-[#0065FF] px-6 py-3 text-sm font-medium text-white transition-all duration-150 hover:opacity-90">
                Kirim Ulasan
            </button>
        </form>
    </div>
</div>

@push('scripts')
<script>
    (function() {
        const modal = document.getElementById('review-modal');
        const closeBtn = document.getElementById('close-review-modal');
        const courseTitle = document.getElementById('modal-course-title');
        const reviewForm = document.getElementById('review-form');
        const stars = document.querySelectorAll('#modal-star-rating .star-btn');
        const ratingInput = document.getElementById('modal_rating_value');
        const ratingLabel = document.getElementById('modal-rating-label');
        const labels = ['', 'Sangat Buruk', 'Buruk', 'Cukup', 'Baik', 'Sangat Baik'];
        let selected = 0;

        function highlight(rating) {
            stars.forEach((star, index) => {
                const icon = star.querySelector('.star-icon');
                if (index < rating) {
                    icon.style.fill = '#facc15';
                    icon.style.stroke = '#facc15';
                } else {
                    icon.style.fill = 'none';
                    icon.style.stroke = '';
                }
            });
        }

        function resetStars() {
            highlight(selected);
        }

        stars.forEach((star, index) => {
            star.addEventListener('mouseenter', () => highlight(index + 1));
            star.addEventListener('mouseleave', resetStars);
            star.addEventListener('click', () => {
                selected = index + 1;
                ratingInput.value = selected;
                ratingLabel.textContent = labels[selected];
                highlight(selected);
            });
        });

        function openModal(title, actionUrl) {
            courseTitle.textContent = title;
            reviewForm.action = actionUrl;
            selected = 0;
            ratingInput.value = '';
            ratingLabel.textContent = 'Klik bintang untuk memberi nilai';
            document.getElementById('modal_comment').value = '';
            highlight(0);
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            document.body.style.overflow = 'hidden';
        }

        function closeModal() {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            document.body.style.overflow = '';
        }

        document.querySelectorAll('.open-review-modal').forEach(btn => {
            btn.addEventListener('click', function() {
                const id = this.dataset.enrollmentId;
                const title = this.dataset.courseTitle;
                openModal(title, '{{ url('reviews') }}/' + id);
            });
        });

        if (closeBtn) {
            closeBtn.addEventListener('click', closeModal);
        }

        modal.addEventListener('click', function(e) {
            if (e.target === this) closeModal();
        });

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') closeModal();
        });
    })();
</script>
@endpush
@endsection
