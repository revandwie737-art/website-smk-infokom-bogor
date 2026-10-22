@extends('layouts.public')
@section('content')
<section class="pt-32 pb-24" x-data="{ lightbox: false, active: null }">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div data-reveal class="text-center mb-14 max-w-xl mx-auto">
            <p class="text-sky-600 font-medium text-sm mb-3">Galeri</p>
            <h1 class="font-display text-3xl md:text-4xl text-navy-900">{{ $gallery->title }}</h1>
            @if($gallery->event_date)
                <p class="text-slate-400 mt-3">{{ $gallery->event_date->translatedFormat('d F Y') }}</p>
            @endif
        </div>

        <div class="columns-2 md:columns-3 gap-4 [column-fill:balance]">
            @forelse($gallery->images as $i => $image)
                <div data-reveal="scale" data-reveal-delay="{{ min($i % 6, 6) }}" data-cursor-hover class="break-inside-avoid mb-4 rounded-2xl overflow-hidden cursor-pointer group"
                    @click="lightbox = true; active = '{{ asset('storage/' . $image->image) }}'">
                    <img src="{{ asset('storage/' . $image->image) }}" class="w-full group-hover:scale-105 transition duration-500" alt="{{ $image->alt_text ?? $gallery->title }}">
                </div>
            @empty
                <p class="text-slate-400 text-sm">Belum ada foto pada album ini.</p>
            @endforelse
        </div>
    </div>

    <div x-show="lightbox" x-transition style="display:none" @click="lightbox = false"
        class="fixed inset-0 bg-navy-900/95 z-50 grid place-items-center p-6 cursor-zoom-out">
        <img :src="active" class="max-h-[85vh] max-w-full rounded-2xl shadow-2xl" alt="Preview">
    </div>
</section>
@endsection
