@extends('layouts.master')

@section('title', 'Ulasan Kursus')

@section('content')
<div class="min-h-screen pt-20">
    <div class="mx-auto max-w-lg px-4 py-8 lg:px-8">
        <h1 class="mb-2 text-3xl font-bold text-text-primary dark:text-white">Ulasan Kursus</h1>
        <p class="mb-8 text-text-secondary dark:text-gray-400">{{ $enrollment->course->title }}</p>

        <div class="rounded-2xl border border-border bg-surface-alt p-8 shadow-sm dark:border-gray-700 dark:bg-dark-surface">
            <form method="POST" action="{{ route('reviews.store', $enrollment) }}">
                @csrf

                <div class="mb-6 text-center">
                    <p class="mb-3 text-sm font-medium text-text-primary dark:text-gray-200">Bagaimana kursus ini?</p>
                    <div class="star-rating flex justify-center gap-2" id="star-rating">
                        @for ($i = 1; $i <= 5; $i++)
                            <button type="button" data-value="{{ $i }}"
                                class="star-btn text-4xl text-gray-300 transition-colors hover:text-yellow-400 dark:text-gray-600"
                                aria-label="Rating {{ $i }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="star-icon"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                            </button>
                        @endfor
                    </div>
                    <p id="rating-label" class="mt-2 text-sm text-text-muted dark:text-gray-500">Klik bintang untuk memberi nilai</p>
                    <input type="hidden" name="rating_value" id="rating_value" value="">
                    @error('rating_value')
                        <p class="mt-1 text-sm text-danger">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="comment" class="mb-1 block text-sm font-medium text-text-primary dark:text-gray-200">Komentar (opsional)</label>
                    <textarea name="comment" id="comment" rows="4"
                        class="w-full rounded-xl border border-border bg-white px-4 py-3 text-sm text-text-primary outline-none transition-colors focus:border-primary-start focus:ring-1 focus:ring-primary-start dark:border-gray-600 dark:bg-dark-bg dark:text-white"
                        placeholder="Ceritakan pengalaman Anda...">{{ old('comment') }}</textarea>
                    @error('comment')
                        <p class="mt-1 text-sm text-danger">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit"
                    class="w-full rounded-full bg-gradient-to-b from-[#2B7FFF] to-[#0065FF] px-6 py-3 text-sm font-medium text-white transition-all duration-150 hover:opacity-90">
                    Kirim Ulasan
                </button>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    (function() {
        const stars = document.querySelectorAll('.star-btn');
        const ratingInput = document.getElementById('rating_value');
        const ratingLabel = document.getElementById('rating-label');
        let selected = 0;

        const labels = ['', 'Sangat Buruk', 'Buruk', 'Cukup', 'Baik', 'Sangat Baik'];

        function highlight(rating) {
            stars.forEach((star, index) => {
                const icon = star.querySelector('.star-icon');
                if (index < rating) {
                    icon.style.fill = '#facc15';
                    icon.style.stroke = '#facc15';
                } else {
                    icon.style.fill = 'none';
                    icon.style.stroke = '';
                    icon.classList.remove('text-yellow-400');
                }
            });
        }

        function reset() {
            highlight(selected);
        }

        stars.forEach((star, index) => {
            star.addEventListener('mouseenter', () => highlight(index + 1));
            star.addEventListener('mouseleave', reset);

            star.addEventListener('click', () => {
                selected = index + 1;
                ratingInput.value = selected;
                ratingLabel.textContent = labels[selected];
                highlight(selected);
            });
        });
    })();
</script>
@endpush
@endsection
