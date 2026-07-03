@extends('layouts.master')

@section('title', $course->title)

@section('content')
<div class="fixed inset-0 top-20 flex flex-col bg-black lg:flex-row">
    {{-- Video Player (70%) --}}
    <div class="flex flex-1 items-center justify-center bg-black lg:w-7/10">
        <div class="w-full px-4 lg:px-8">
            <video id="main-player" class="w-full rounded-xl shadow-2xl" controls autoplay>
                <source id="video-source" src="{{ $course->materials->first() ? asset('storage/' . $course->materials->first()->file_path) : '' }}" type="video/mp4">
                Browser tidak mendukung pemutar video.
            </video>
            <h2 id="video-title" class="mt-4 text-lg font-semibold text-white">
                {{ $course->materials->first()->title ?? 'Belum ada materi' }}
            </h2>
        </div>
    </div>

    {{-- Playlist Sidebar (30%) --}}
    <aside class="w-full border-t border-white/10 bg-black/80 backdrop-blur-xl lg:w-3/10 lg:border-t-0 lg:border-l">
        <div class="flex items-center border-b border-white/10 px-5 py-4">
            <h3 class="text-sm font-semibold text-white">Daftar Materi</h3>
            <span class="ml-2 rounded-full bg-white/10 px-2 py-0.5 text-xs text-gray-400">{{ $course->materials->count() }}</span>
        </div>

        <div class="overflow-y-auto" style="max-height: calc(100vh - 12rem);">
            @forelse ($course->materials as $index => $material)
                <button type="button"
                    class="playlist-item group flex w-full items-center gap-4 px-5 py-4 text-left transition-colors hover:bg-white/5 {{ $loop->first ? 'bg-white/10' : '' }}"
                    data-src="{{ asset('storage/' . $material->file_path) }}"
                    data-title="{{ $material->title }}">
                    <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-white/10 text-xs font-medium text-gray-400 group-hover:bg-primary-start/20 group-hover:text-primary-start {{ $loop->first ? 'bg-primary-start/20 text-primary-start' : '' }}">
                        {{ str_pad($material->sequence_order, 2, '0', STR_PAD_LEFT) }}
                    </span>
                    <div class="min-w-0 flex-1">
                        <p class="truncate text-sm font-medium text-white/80 group-hover:text-white {{ $loop->first ? 'text-white' : '' }}">
                            {{ $material->title }}
                        </p>
                        <p class="text-xs text-gray-500">Materi {{ $material->sequence_order }}</p>
                    </div>
                </button>
            @empty
                <div class="px-5 py-8 text-center text-sm text-gray-500">
                    Belum ada materi untuk kursus ini.
                </div>
            @endforelse
        </div>
    </aside>
</div>

@push('scripts')
<script>
    (function() {
        const player = document.getElementById('main-player');
        const videoSource = document.getElementById('video-source');
        const videoTitle = document.getElementById('video-title');
        const items = document.querySelectorAll('.playlist-item');

        items.forEach(item => {
            item.addEventListener('click', function() {
                const src = this.dataset.src;
                const title = this.dataset.title;

                if (videoSource.src === src) return;

                items.forEach(el => {
                    el.classList.remove('bg-white/10');
                    el.querySelector('span:first-child')?.classList.remove('bg-primary-start/20', 'text-primary-start');
                    el.querySelector('span:first-child')?.classList.add('bg-white/10', 'text-gray-400');
                    el.querySelector('p:first-of-type')?.classList.remove('text-white');
                    el.querySelector('p:first-of-type')?.classList.add('text-white/80');
                });

                this.classList.add('bg-white/10');
                const numSpan = this.querySelector('span:first-child');
                numSpan?.classList.remove('bg-white/10', 'text-gray-400');
                numSpan?.classList.add('bg-primary-start/20', 'text-primary-start');
                this.querySelector('p:first-of-type')?.classList.remove('text-white/80');
                this.querySelector('p:first-of-type')?.classList.add('text-white');

                videoSource.src = src;
                player.load();
                player.play();
                videoTitle.textContent = title;
            });
        });
    })();
</script>
@endpush
@endsection
