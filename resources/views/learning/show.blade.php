@extends('layouts.master')

@section('title', $course->title)

@section('content')
<div class="fixed inset-0 top-20 flex flex-col bg-black lg:flex-row">
        {{-- Materi Player --}}
    <div class="flex flex-1 items-center justify-center bg-black lg:w-7/10">
        <div class="w-full px-4 lg:px-8">

            @php
                $firstMaterial = $course->materials->first();
                $extension = $firstMaterial ? pathinfo($firstMaterial->file_path, PATHINFO_EXTENSION) : null;
            @endphp

            @if(strtolower($extension) === 'pdf')

                <iframe
                    id="pdf-player"
                    src="{{ asset('storage/' . $firstMaterial->file_path) }}"
                    class="h-[70vh] w-full rounded-xl bg-white">
                </iframe>

            @elseif(strtolower($extension) === 'mp4')

                <video id="main-player" class="w-full rounded-xl shadow-2xl" controls autoplay>
                    <source 
                        src="{{ asset('storage/' . $firstMaterial->file_path) }}"
                        type="video/mp4">
                </video>

            @else

                <p class="text-white">
                    Format materi belum didukung.
                </p>

            @endif


            <h2 class="mt-4 text-lg font-semibold text-white">
                {{ $firstMaterial->title ?? 'Belum ada materi' }}
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

    const items = document.querySelectorAll('.playlist-item');
    const contentArea = document.querySelector('.lg\\:w-7\\/10 .w-full');

    const title = document.querySelector('.lg\\:w-7\\/10 h2');


    items.forEach(item => {

        item.addEventListener('click', function() {

            const src = this.dataset.src;
            const materialTitle = this.dataset.title;

            const extension = src.split('.').pop().toLowerCase();


            // Update active playlist
            items.forEach(el => {
                el.classList.remove('bg-white/10');

                el.querySelector('span:first-child')
                    ?.classList.remove(
                        'bg-primary-start/20',
                        'text-primary-start'
                    );

                el.querySelector('span:first-child')
                    ?.classList.add(
                        'bg-white/10',
                        'text-gray-400'
                    );

            });


            this.classList.add('bg-white/10');

            const number = this.querySelector('span:first-child');

            number?.classList.remove(
                'bg-white/10',
                'text-gray-400'
            );

            number?.classList.add(
                'bg-primary-start/20',
                'text-primary-start'
            );


            // Ganti tampilan materi

            let content = "";


            if(extension === 'mp4') {

                content = `
                    <video 
                        class="w-full rounded-xl shadow-2xl"
                        controls
                        autoplay>

                        <source src="${src}" type="video/mp4">

                    </video>
                `;

            } 
            else if(extension === 'pdf') {


                content = `
                    <iframe
                        src="${src}"
                        class="h-[70vh] w-full rounded-xl bg-white">
                    </iframe>
                `;


            }
            else if(extension === 'doc' || extension === 'docx') {


                content = `
                    <div class="flex h-[70vh] flex-col items-center justify-center rounded-xl bg-white">

                        <p class="mb-4 text-gray-700">
                            Dokumen materi tersedia
                        </p>

                        <a href="${src}"
                           target="_blank"
                           class="rounded-full bg-blue-600 px-6 py-3 text-white">
                            Buka Dokumen
                        </a>

                    </div>
                `;

            }
            else {

                content = `
                    <p class="text-white">
                        Format tidak didukung
                    </p>
                `;

            }


            contentArea.innerHTML = content + 
            `
                <h2 class="mt-4 text-lg font-semibold text-white">
                    ${materialTitle}
                </h2>
            `;


        });

    });

})();
</script>
@endpush
@endsection
