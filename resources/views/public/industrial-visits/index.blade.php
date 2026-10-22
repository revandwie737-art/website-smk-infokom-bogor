@extends('layouts.public')
@section('content')
@php
    $S = fn ($key, $default) => \App\Models\SchoolSetting::get($key) ?: $default;
@endphp

<section class="relative bg-navy-950 text-white overflow-hidden">
    <div class="pointer-events-none absolute inset-0" style="background: radial-gradient(ellipse 55% 45% at 50% 0%, rgba(232,196,110,.12), transparent 65%);"></div>
    <div class="blob pointer-events-none absolute -top-20 -left-16 w-72 h-72 rounded-full bg-sky-500/10 blur-3xl"></div>
    <div class="blob-slow pointer-events-none absolute -bottom-24 right-0 w-80 h-80 rounded-full bg-navy-700/40 blur-3xl"></div>

    <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 pt-16 pb-16 md:pb-20 text-center" data-aos="fade-up">
        <div class="flex items-center justify-center gap-3 mb-4">
            <span class="h-px w-8 bg-amber-300/60"></span>
            <span class="text-amber-300 font-semibold text-[11px] tracking-[0.25em] uppercase">{{ $S('industrial_visit_eyebrow', 'Kunjungan Industri') }}</span>
            <span class="h-px w-8 bg-amber-300/60"></span>
        </div>
        <h1 class="font-serif text-3xl md:text-5xl text-white">{{ $S('industrial_visit_title', 'Belajar Langsung dari Dunia Industri') }}</h1>
        <p class="mt-5 text-slate-300 leading-relaxed max-w-2xl mx-auto">
            {{ $S('industrial_visit_subtitle', 'Siswa SMK Infokom Bogor mengenal dunia kerja secara langsung melalui kunjungan ke perusahaan, lembaga, dan kampus mitra.') }}
        </p>
    </div>
</section>

<section class="bg-slate-50 py-14 md:py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
            @forelse($visits as $i => $visit)
                <a href="{{ route('industrial-visits.show', $visit->slug) }}"
                    class="group flex flex-col bg-white rounded-3xl overflow-hidden border border-slate-100 shadow-sm hover:shadow-2xl hover:shadow-navy-900/10 hover:-translate-y-1.5 transition-all duration-500"
                    data-aos="fade-up" data-aos-delay="{{ ($i % 3) * 80 }}">

                    <div class="relative aspect-[4/3] overflow-hidden bg-navy-900">
                        @if($visit->cover_url)
                            <img src="{{ $visit->cover_url }}" alt="{{ $visit->title }}" loading="lazy"
                                class="h-full w-full object-cover transition-transform duration-[1400ms] ease-out group-hover:scale-[1.07]">
                        @else
                            <div class="h-full w-full grid place-items-center text-5xl" style="background: radial-gradient(circle at 30% 20%, rgba(30,58,138,.5), transparent 60%), linear-gradient(135deg, #0f172a, #172554);">🏭</div>
                        @endif
                        <div class="absolute inset-x-0 bottom-0 h-1/2 bg-gradient-to-t from-navy-950/70 to-transparent opacity-80"></div>

                        @if($visit->visit_date)
                            <span class="absolute top-4 left-4 inline-flex items-center gap-1.5 rounded-full bg-white/90 backdrop-blur px-3 py-1.5 text-[11px] font-semibold tracking-wide text-navy-800 shadow">
                                <svg class="w-3.5 h-3.5 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3M4 11h16M5 5h14a1 1 0 011 1v13a1 1 0 01-1 1H5a1 1 0 01-1-1V6a1 1 0 011-1z"/></svg>
                                {{ $visit->visit_date->translatedFormat('d F Y') }}
                            </span>
                        @endif
                        @if($visit->photos->count())
                            <span class="absolute top-4 right-4 inline-flex items-center gap-1.5 rounded-full bg-navy-950/70 backdrop-blur px-3 py-1.5 text-[11px] font-semibold text-white">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4-4a2 2 0 012.8 0L16 17m-2-2l1-1a2 2 0 012.8 0L20 16M14 8h.01M5 20h14a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v14a1 1 0 001 1z"/></svg>
                                {{ $visit->photos->count() }} foto
                            </span>
                        @endif
                    </div>

                    <div class="flex flex-1 flex-col p-6">
                        @if($visit->company)
                            <p class="text-[11px] font-semibold tracking-[0.2em] uppercase text-[#9a7318] mb-2">{{ $visit->company }}</p>
                        @endif
                        <h2 class="font-serif text-xl leading-snug text-navy-900 group-hover:text-navy-700 transition-colors">{{ $visit->title }}</h2>
                        @if($visit->description)
                            <p class="mt-3 text-sm leading-relaxed text-slate-500 line-clamp-3">{{ $visit->description }}</p>
                        @endif
                        <div class="mt-auto pt-5">
                            <span class="inline-flex items-center gap-2 text-sm font-semibold text-navy-700">
                                Lihat galeri foto
                                <svg class="w-4 h-4 transition-transform duration-300 group-hover:translate-x-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14m-6-6l6 6-6 6"/></svg>
                            </span>
                        </div>
                    </div>
                </a>
            @empty
                <div class="col-span-full rounded-3xl border border-dashed border-slate-200 bg-white py-20 text-center">
                    <div class="text-4xl mb-3">🏭</div>
                    <p class="text-slate-500 font-medium">Belum ada kegiatan kunjungan industri.</p>
                    <p class="text-slate-400 text-sm mt-1">Dokumentasi kunjungan akan tampil di sini.</p>
                </div>
            @endforelse
        </div>

        @if($visits->hasPages())
            <div class="mt-12">{{ $visits->links() }}</div>
        @endif
    </div>
</section>
@endsection