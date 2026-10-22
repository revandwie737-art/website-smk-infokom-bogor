@extends('layouts.public')
@section('content')
@php
    $meta = trim(($visit->company ?: $visit->title) . ($visit->visit_date ? ' · ' . $visit->visit_date->translatedFormat('d F Y') : ''));
@endphp

<section class="relative bg-navy-950 text-white overflow-hidden">
    <div class="pointer-events-none absolute inset-0" style="background: radial-gradient(ellipse 55% 45% at 50% 0%, rgba(232,196,110,.12), transparent 65%);"></div>
    <div class="blob pointer-events-none absolute -top-20 -right-16 w-72 h-72 rounded-full bg-sky-500/10 blur-3xl"></div>

    <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 pt-12 pb-14 md:pb-16" data-aos="fade-up">
        <a href="{{ route('industrial-visits.index') }}" class="inline-flex items-center gap-2 text-sm text-slate-300 hover:text-white transition mb-8">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 12H5m6 6l-6-6 6-6"/></svg>
            Semua Kunjungan Industri
        </a>

        @if($visit->company)
            <p class="text-amber-300 font-semibold text-[11px] tracking-[0.25em] uppercase mb-3">{{ $visit->company }}</p>
        @endif
        <h1 class="font-serif text-3xl md:text-5xl text-white leading-tight">{{ $visit->title }}</h1>

        <div class="mt-5 flex flex-wrap items-center gap-x-5 gap-y-2 text-sm text-slate-300">
            @if($visit->visit_date)
                <span class="inline-flex items-center gap-2">
                    <svg class="w-4 h-4 text-amber-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3M4 11h16M5 5h14a1 1 0 011 1v13a1 1 0 01-1 1H5a1 1 0 01-1-1V6a1 1 0 011-1z"/></svg>
                    {{ $visit->visit_date->translatedFormat('d F Y') }}
                </span>
            @endif
            <span class="inline-flex items-center gap-2">
                <svg class="w-4 h-4 text-amber-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4-4a2 2 0 012.8 0L16 17m-2-2l1-1a2 2 0 012.8 0L20 16M14 8h.01M5 20h14a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v14a1 1 0 001 1z"/></svg>
                {{ $visit->photos->count() }} foto
            </span>
        </div>

        @if($visit->description)
            <p class="mt-6 text-slate-300 leading-relaxed whitespace-pre-line max-w-3xl">{{ $visit->description }}</p>
        @endif
    </div>
</section>

<section class="bg-white py-14 md:py-20">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center gap-3 mb-8" data-aos="fade-up">
            <span class="h-px w-8 bg-[#c9a24b]"></span>
            <h2 class="font-serif text-2xl text-navy-900">Galeri Foto</h2>
        </div>

        @if($visit->photos->count())
            <div class="columns-2 md:columns-3 gap-4 space-y-4">
                @foreach($visit->photos as $i => $photo)
                    <button type="button"
                        data-lightbox-src="{{ asset('storage/' . $photo->image) }}"
                        data-lightbox-caption="{{ $photo->caption ?: $visit->title }}"
                        data-lightbox-meta="{{ $meta }}"
                        data-tilt-strength="7" data-tilt-scale="1.03"
                        data-aos="zoom-in" data-aos-delay="{{ ($i % 6) * 40 }}"
                        aria-label="Perbesar foto: {{ $photo->caption ?: $visit->title }}"
                        class="tilt-3d group relative block w-full break-inside-avoid overflow-hidden rounded-2xl bg-slate-100 shadow-sm cursor-zoom-in">
                        <img src="{{ asset('storage/' . $photo->image) }}" alt="{{ $photo->caption ?: $visit->title }}" loading="lazy" class="w-full">
                        @if($photo->caption)
                            <span class="absolute inset-x-0 bottom-0 px-4 pb-3 pt-10 text-left text-xs font-medium text-white bg-gradient-to-t from-navy-950/85 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500">{{ $photo->caption }}</span>
                        @endif
                    </button>
                @endforeach
            </div>
        @else
            <p class="text-slate-400 text-sm">Belum ada foto pada kegiatan ini.</p>
        @endif
    </div>
</section>

@if($others->count())
    <section class="bg-slate-50 py-14 md:py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between gap-4 mb-8" data-aos="fade-up">
                <h2 class="font-serif text-2xl text-navy-900">Kunjungan Lainnya</h2>
                <a href="{{ route('industrial-visits.index') }}" class="text-sm font-semibold text-navy-700 hover:text-navy-900 link-underline">Lihat semua</a>
            </div>
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($others as $i => $other)
                    <a href="{{ route('industrial-visits.show', $other->slug) }}" class="group bg-white rounded-2xl overflow-hidden border border-slate-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-500" data-aos="fade-up" data-aos-delay="{{ $i * 80 }}">
                        <div class="aspect-[16/10] overflow-hidden bg-navy-900">
                            @if($other->cover_url)
                                <img src="{{ $other->cover_url }}" alt="{{ $other->title }}" loading="lazy" class="h-full w-full object-cover transition-transform duration-[1400ms] group-hover:scale-[1.07]">
                            @else
                                <div class="h-full w-full grid place-items-center text-4xl" style="background: linear-gradient(135deg, #0f172a, #172554);">🏭</div>
                            @endif
                        </div>
                        <div class="p-5">
                            @if($other->visit_date)
                                <p class="text-[11px] font-semibold tracking-[0.2em] uppercase text-[#9a7318] mb-1.5">{{ $other->visit_date->translatedFormat('d F Y') }}</p>
                            @endif
                            <p class="font-serif text-lg leading-snug text-navy-900">{{ $other->title }}</p>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>
@endif
@endsection