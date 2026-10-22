@extends('layouts.public')
@section('content')
<section class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-16" x-data="{ lightbox: false, active: null }">
    <div class="text-center mb-12" data-aos="fade-up">
        <h1 class="text-3xl md:text-4xl font-extrabold text-navy-900">{{ $gallery->title }}</h1>
        @if($gallery->event_date)
            <p class="text-slate-400 mt-2">{{ $gallery->event_date->translatedFormat('d F Y') }}</p>
        @endif
    </div>

    <div class="columns-2 md:columns-3 gap-4 space-y-4">
        @forelse($gallery->images as $i => $image)
            <div data-aos="zoom-in" data-aos-delay="{{ $i * 40 }}" class="tilt-3d break-inside-avoid rounded-2xl overflow-hidden cursor-pointer"
                data-tilt-strength="8" data-tilt-scale="1.05"
                @click="lightbox = true; active = '{{ asset('storage/' . $image->image) }}'">
                <img src="{{ asset('storage/' . $image->image) }}" class="w-full" alt="{{ $image->alt_text ?? $gallery->title }}">
            </div>
        @empty
            <p class="text-slate-400 text-sm">Belum ada foto pada album ini.</p>
        @endforelse
    </div>

    <div x-show="lightbox" x-transition style="display:none" @click="lightbox = false"
        class="fixed inset-0 bg-black/90 z-50 grid place-items-center p-6 cursor-zoom-out">
        <img :src="active" x-show="lightbox" class="lightbox-enter max-h-[85vh] max-w-full rounded-xl shadow-2xl" alt="Preview">
    </div>
</section>
@endsection
