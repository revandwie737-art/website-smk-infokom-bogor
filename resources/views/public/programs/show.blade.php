@extends('layouts.public')
@section('content')

<!-- HERO -->
<section class="relative overflow-hidden bg-navy-900 text-white py-24">
    <div class="blob absolute -top-24 -right-24 w-96 h-96 rounded-full bg-sky-500/20 blur-3xl pointer-events-none"></div>
    <p class="hidden lg:block absolute -bottom-6 left-1/2 -translate-x-1/2 text-[10rem] font-extrabold text-white/[0.04] tracking-tighter select-none pointer-events-none leading-none whitespace-nowrap">{{ $program->code }}</p>
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative" data-aos="fade-up">
        @if($program->logo)
            <div class="h-16 w-16 rounded-2xl bg-white/95 grid place-items-center overflow-hidden p-2 mx-auto mb-5 shadow-xl">
                <img src="{{ asset('storage/' . $program->logo) }}" class="w-full h-full object-contain" alt="{{ $program->name }}">
            </div>
        @else
            <span class="inline-block px-4 py-1.5 rounded-full bg-white/10 text-sky-300 text-xs font-semibold mb-4">{{ $program->code }}</span>
        @endif
        <h1 class="text-3xl md:text-5xl font-extrabold leading-tight">{{ $program->name }}</h1>
        @if($program->description)
            <p class="text-slate-300 mt-5 max-w-2xl mx-auto leading-relaxed">{{ $program->description }}</p>
        @endif
    </div>
</section>

<!-- FOTO -->
@if($program->photo)
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 -mt-16 relative z-10" data-aos="fade-up">
        <div class="reveal-mask rounded-3xl overflow-hidden shadow-2xl aspect-[16/9] bg-slate-50 flex items-center justify-center p-8">
            <img src="{{ asset('storage/' . $program->photo) }}" class="reveal-img max-w-full max-h-full object-contain" alt="{{ $program->name }}">
        </div>
    </div>
@endif

@php
    $toList = fn ($text) => $text ? array_values(array_filter(array_map('trim', explode("\n", $text)))) : [];
    $competencies = $toList($program->competencies);
    $prospects = $toList($program->prospects);
    $facilities = $toList($program->facilities);
    $subjects = $toList($program->subjects);
@endphp

<!-- KOMPETENSI -->
@if(count($competencies))
<section class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <div class="text-center max-w-2xl mx-auto mb-10" data-aos="fade-up">
        <span class="text-sky-600 font-semibold text-sm">Yang Dipelajari</span>
        <h2 class="text-2xl md:text-3xl font-extrabold text-navy-900 mt-2">Kompetensi</h2>
    </div>
    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach($competencies as $i => $item)
            <div data-aos="fade-up" data-aos-delay="{{ $i * 50 }}" class="tilt-hover flex items-start gap-3 p-5 rounded-2xl bg-white border border-slate-900/15">
                <span class="shrink-0 h-9 w-9 rounded-xl bg-navy-50 text-navy-700 grid place-items-center font-bold text-sm">{{ $i + 1 }}</span>
                <p class="text-slate-700 font-medium leading-snug pt-1.5">{{ $item }}</p>
            </div>
        @endforeach
    </div>
</section>
@endif

<!-- PROSPEK KARIER -->
@if(count($prospects))
<section class="bg-navy-50/50 py-16">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-2xl mx-auto mb-10" data-aos="fade-up">
            <span class="text-sky-600 font-semibold text-sm">Setelah Lulus</span>
            <h2 class="text-2xl md:text-3xl font-extrabold text-navy-900 mt-2">Prospek Karier</h2>
        </div>
        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-4">
            @foreach($prospects as $i => $item)
                <div data-aos="zoom-in" data-aos-delay="{{ $i * 60 }}" class="tilt-hover text-center p-6 rounded-2xl bg-white border border-slate-900/15">
                    <span class="text-2xl">💼</span>
                    <p class="text-navy-800 font-semibold mt-3 text-sm leading-snug">{{ $item }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- FASILITAS PENDUKUNG -->
@if(count($facilities) || $program->lab_photo)
<section class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <div class="text-center max-w-2xl mx-auto mb-10" data-aos="fade-up">
        <span class="text-sky-600 font-semibold text-sm">Sarana</span>
        <h2 class="text-2xl md:text-3xl font-extrabold text-navy-900 mt-2">Fasilitas Pendukung</h2>
    </div>
    @if($program->lab_photo)
        <div class="max-w-3xl mx-auto mb-10 rounded-3xl overflow-hidden shadow-lg" data-aos="fade-up">
            <img src="{{ asset('storage/' . $program->lab_photo) }}" class="w-full aspect-video object-cover" alt="Laboratorium {{ $program->name }}">
            <p class="text-center text-sm text-slate-500 py-3 bg-white">Laboratorium {{ $program->name }}</p>
        </div>
    @endif
    @if(count($facilities))
    <div class="flex flex-wrap justify-center gap-3">
        @foreach($facilities as $item)
            <span data-aos="fade-up" class="hover-lift px-5 py-2.5 rounded-full bg-white border border-slate-900/15 text-navy-700 font-medium text-sm">🏫 {{ $item }}</span>
        @endforeach
    </div>
    @endif
</section>
@endif

<!-- MATA PELAJARAN -->
@if(count($subjects))
<section class="bg-navy-50/50 py-16">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <div class="max-w-2xl mx-auto mb-8" data-aos="fade-up">
            <span class="text-sky-600 font-semibold text-sm">Kurikulum</span>
            <h2 class="text-2xl md:text-3xl font-extrabold text-navy-900 mt-2">Mata Pelajaran Utama</h2>
        </div>
        <div class="flex flex-wrap justify-center gap-2.5" data-aos="fade-up">
            @foreach($subjects as $item)
                <span class="px-4 py-2 rounded-full bg-white border border-navy-100 text-navy-700 text-sm font-medium">{{ $item }}</span>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- CTA -->
<section class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-16 text-center" data-aos="fade-up">
    <a href="{{ route('ppdb.index') }}" class="ripple-btn magnetic-btn inline-block px-9 py-4 rounded-full bg-navy-800 text-white font-bold hover:bg-navy-900 transition shadow-xl shadow-navy-800/25">
        Daftar Jurusan Ini &rarr;
    </a>
</section>

<!-- PROGRAM LAIN -->
@if($related->count())
<section class="bg-slate-50 py-16">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-xl font-bold text-navy-800 mb-6" data-aos="fade-up">Program Keahlian Lainnya</h2>
        <div class="grid sm:grid-cols-3 gap-5">
            @foreach($related as $r)
                <a href="{{ route('programs.show', $r->slug) }}" data-aos="fade-up" class="hover-lift p-5 rounded-2xl bg-white border border-slate-900/15 transition">
                    <span class="text-xs font-semibold text-sky-600">{{ $r->code }}</span>
                    <p class="font-semibold text-navy-800 mt-1">{{ $r->name }}</p>
                </a>
            @endforeach
        </div>
    </div>
</section>
@endif
@endsection