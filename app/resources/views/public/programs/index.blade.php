@extends('layouts.public')
@section('content')

<x-public.page-hero eyebrow="Program Keahlian" title="Empat jalur keahlian, satu tujuan: siap kerja." description="Kurikulum dirancang bersama mitra industri agar kompetensi yang kamu pelajari benar-benar terpakai di dunia kerja." />

<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-6 pb-28">
    <div class="grid sm:grid-cols-2 gap-6">
        @foreach($programs as $i => $program)
            <a href="{{ route('programs.show', $program->slug) }}" data-cursor-hover data-reveal data-reveal-delay="{{ min($i, 6) }}"
                class="group rounded-[1.75rem] border border-slate-200 overflow-hidden bg-white hover:border-navy-300 hover:shadow-xl hover:shadow-navy-900/[0.07] transition-all duration-300">
                <div class="aspect-video bg-navy-50 overflow-hidden relative">
                    @if($program->photo)
                        <img src="{{ asset('storage/' . $program->photo) }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-700" alt="{{ $program->name }}">
                    @else
                        <div class="w-full h-full bg-gradient-to-br from-navy-100 to-sky-100 grid place-items-center text-navy-400 font-display text-4xl">{{ $program->code }}</div>
                    @endif
                    <div class="absolute inset-0 bg-gradient-to-t from-navy-900/50 via-transparent to-transparent"></div>
                    <span class="absolute bottom-4 left-6 text-white font-display text-xl">{{ $program->code }}</span>
                </div>
                <div class="p-7">
                    <p class="font-display text-xl text-navy-900">{{ $program->name }}</p>
                    <p class="text-sm text-slate-500 mt-2.5 line-clamp-3 leading-relaxed">{{ $program->description }}</p>
                    <span class="inline-flex items-center gap-1.5 text-sky-600 font-medium text-sm mt-5">
                        Lihat Detail
                        <svg class="w-3.5 h-3.5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </span>
                </div>
            </a>
        @endforeach
    </div>
</section>
@endsection
