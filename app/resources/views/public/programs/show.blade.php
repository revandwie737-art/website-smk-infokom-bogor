@extends('layouts.public')
@section('content')

<section class="relative overflow-hidden bg-gradient-to-b from-sky-50 via-white to-white pt-32 pb-20">
    <div class="float-a absolute top-10 -right-16 w-72 h-72 rounded-full bg-sky-200/50 blur-3xl pointer-events-none"></div>
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative">
        <span data-reveal class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white ring-1 ring-navy-100 text-navy-700 text-xs font-semibold mb-5 shadow-sm">{{ $program->code }}</span>
        <h1 data-reveal data-reveal-delay="1" class="font-display text-4xl md:text-5xl text-navy-900 leading-tight">{{ $program->name }}</h1>
    </div>
</section>

<section class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 pb-8">
    @if($program->photo)
        <div data-reveal="scale" class="rounded-[2rem] overflow-hidden shadow-2xl shadow-navy-900/10 bg-navy-50 max-h-[520px] flex items-center justify-center ring-1 ring-navy-900/5">
            <img src="{{ asset('storage/' . $program->photo) }}" class="w-full max-h-[520px] object-cover" alt="{{ $program->name }}">
        </div>
    @endif
</section>

<section class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <div class="grid md:grid-cols-3 gap-10">
        <div class="md:col-span-2 space-y-12">
            <div data-reveal>
                <p class="text-sky-600 font-medium text-sm mb-2">Deskripsi</p>
                <p class="text-slate-600 leading-relaxed text-lg font-display">{{ $program->description ?: 'Data belum tersedia.' }}</p>
            </div>

            @if($program->competencies)
                <div data-reveal>
                    <p class="text-sky-600 font-medium text-sm mb-3">Kompetensi</p>
                    <p class="text-slate-600 leading-relaxed whitespace-pre-line">{{ $program->competencies }}</p>
                </div>
            @endif

            @if($program->subjects)
                <div data-reveal>
                    <p class="text-sky-600 font-medium text-sm mb-3">Mata Pelajaran Utama</p>
                    <p class="text-slate-600 leading-relaxed whitespace-pre-line">{{ $program->subjects }}</p>
                </div>
            @endif
        </div>

        <div class="space-y-5">
            @if($program->prospects)
                <div data-reveal="right" class="rounded-[1.75rem] bg-navy-900 text-white p-7">
                    <p class="text-xs font-semibold uppercase tracking-wider text-sky-300/80 mb-3">Prospek Karier</p>
                    <p class="text-sm text-slate-300 leading-relaxed whitespace-pre-line">{{ $program->prospects }}</p>
                </div>
            @endif
            @if($program->facilities)
                <div data-reveal="right" data-reveal-delay="1" class="rounded-[1.75rem] border border-slate-200 p-7">
                    <p class="text-xs font-semibold uppercase tracking-wider text-navy-400 mb-3">Fasilitas Pendukung</p>
                    <p class="text-sm text-slate-500 leading-relaxed whitespace-pre-line">{{ $program->facilities }}</p>
                </div>
            @endif
            <a href="{{ route('ppdb.index') }}" data-cursor-hover class="magnetic flex items-center justify-center gap-2 w-full px-7 py-4 rounded-full bg-navy-900 text-white font-semibold hover:bg-navy-800 transition shadow-lg shadow-navy-900/15">
                Daftar Jurusan Ini
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
            </a>
        </div>
    </div>
</section>

@if($related->count())
<section class="bg-slate-50 py-20">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <p data-reveal class="font-display text-2xl text-navy-900 mb-7">Program Keahlian Lainnya</p>
        <div class="grid sm:grid-cols-3 gap-5">
            @foreach($related as $i => $r)
                <a href="{{ route('programs.show', $r->slug) }}" data-cursor-hover data-reveal data-reveal-delay="{{ $i + 1 }}" class="group p-6 rounded-[1.5rem] bg-white border border-slate-200 hover:border-navy-300 hover:shadow-lg transition-all">
                    <span class="text-xs font-semibold text-sky-600">{{ $r->code }}</span>
                    <p class="font-semibold text-navy-900 mt-1.5 group-hover:text-sky-600 transition">{{ $r->name }}</p>
                </a>
            @endforeach
        </div>
    </div>
</section>
@endif
@endsection
