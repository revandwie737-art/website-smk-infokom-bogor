@extends('layouts.public')
@section('content')
@php
    $set = fn($key, $default = null) => App\Models\SchoolSetting::get($key, $default);
    $heroWords = explode(' ', $set('hero_title', 'Membangun Generasi Digital yang Kreatif, Kompeten, dan Berkarakter'));
@endphp

<!-- ================= HERO ================= -->
<section class="relative overflow-hidden bg-gradient-to-b from-sky-50 via-white to-white">
    <div class="absolute inset-0 opacity-[0.4]" style="background-image:radial-gradient(circle, #cbd5e1 1px, transparent 1px); background-size:26px 26px; mask-image: linear-gradient(180deg, black, transparent);"></div>
    <div class="float-a absolute top-24 -right-20 w-[420px] h-[420px] rounded-full bg-sky-200/50 blur-[100px] pointer-events-none"></div>
    <div class="float-b absolute bottom-0 -left-20 w-[380px] h-[380px] rounded-full bg-gold-200/40 blur-[100px] pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-32 pb-40 md:pt-40 md:pb-52 relative">
        <div class="max-w-4xl">
            <div class="flex items-center gap-2 mb-8 overflow-hidden">
                <span class="inline-flex items-center gap-2 text-[12.5px] font-medium text-navy-700 border border-navy-100 rounded-full px-4 py-1.5 bg-white shadow-sm">
                    <span class="h-1.5 w-1.5 rounded-full bg-sky-500 animate-pulse"></span>
                    SMK Infokom Bogor &middot; Terakreditasi {{ $set('akreditasi', 'A') }}
                </span>
            </div>

            <h1 class="font-display font-medium text-[13vw] sm:text-6xl md:text-7xl leading-[1.02] tracking-tight text-navy-900">
                @foreach($heroWords as $i => $word)
                    <span class="inline-block overflow-hidden align-top mr-[0.2em]"><span class="inline-block" data-reveal="scale" data-reveal-delay="{{ min($i, 6) }}">{{ $word }}</span></span>
                @endforeach
            </h1>

            <p data-reveal data-reveal-delay="4" class="mt-8 text-slate-500 text-lg md:text-xl leading-relaxed max-w-xl">
                {{ $set('hero_subtitle') }}
            </p>

            <div data-reveal data-reveal-delay="5" class="mt-10 flex flex-wrap items-center gap-4">
                <a href="{{ route('programs.index') }}" data-cursor-hover class="magnetic inline-flex items-center gap-2 px-7 py-4 rounded-full bg-navy-900 text-white font-semibold hover:bg-navy-800 transition shadow-lg shadow-navy-900/15">
                    Lihat Program Keahlian
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
                <a href="#tentang" data-cursor-hover class="inline-flex items-center gap-2 text-navy-700 font-medium hover:text-navy-900 transition group">
                    Jelajahi Sekolah
                    <svg class="w-4 h-4 group-hover:translate-y-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/></svg>
                </a>
            </div>
        </div>

        <!-- floating photo cluster -->
        <div class="mt-20 md:mt-24 grid grid-cols-12 gap-4 md:gap-5 items-end">
            <div data-reveal="left" class="col-span-7 md:col-span-5 aspect-[4/3] rounded-[2rem] overflow-hidden ring-1 ring-navy-900/10 shadow-xl shadow-navy-900/5 relative">
                @if($set('hero_image'))
                    <img src="{{ asset('storage/' . $set('hero_image')) }}" class="w-full h-full object-cover" alt="SMK Infokom Bogor">
                @else
                    <div class="w-full h-full bg-gradient-to-br from-navy-100 to-sky-100 grid place-items-center text-navy-400 text-sm p-6 text-center">Foto sekolah belum diunggah</div>
                @endif
            </div>
            <div data-reveal="right" data-reveal-delay="2" class="col-span-5 md:col-span-3 aspect-square rounded-[1.75rem] overflow-hidden ring-1 ring-navy-900/10 shadow-xl shadow-navy-900/5 -mb-6 md:-mb-10">
                @if($set('about_image'))
                    <img src="{{ asset('storage/' . $set('about_image')) }}" class="w-full h-full object-cover" alt="Kegiatan siswa">
                @else
                    <div class="w-full h-full bg-navy-50 grid place-items-center text-navy-300 text-xs">Kegiatan Siswa</div>
                @endif
            </div>
            <div data-reveal data-reveal-delay="3" class="hidden md:flex col-span-4 aspect-[4/3] rounded-[1.75rem] bg-white ring-1 ring-navy-900/10 shadow-xl shadow-navy-900/5 flex-col justify-between p-7">
                <p class="font-display text-5xl text-navy-900">{{ $set('akreditasi', 'A') }}</p>
                <p class="text-xs text-slate-400 leading-relaxed">Akreditasi resmi sekolah, ditetapkan oleh Badan Akreditasi Nasional Sekolah/Madrasah.</p>
            </div>
        </div>
    </div>
</section>

<!-- ================= STATS ================= -->
<section class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 -mt-14 md:-mt-20 relative z-10">
    <div data-reveal class="bg-white rounded-[1.75rem] shadow-2xl shadow-navy-900/10 grid grid-cols-2 md:grid-cols-4 divide-x divide-y md:divide-y-0 divide-slate-100">
        @php
            $stats = [
                ['label' => 'Siswa Aktif', 'value' => (int)$set('siswa_laki', 0) + (int)$set('siswa_perempuan', 0)],
                ['label' => 'Tenaga Pengajar', 'value' => (int)$set('jumlah_guru', 0)],
                ['label' => 'Program Keahlian', 'value' => $programs->count()],
                ['label' => 'Ruang Kelas', 'value' => (int)$set('ruang_kelas', 0)],
            ];
        @endphp
        @foreach($stats as $s)
            <div class="p-7 md:p-9 text-center group">
                <p class="font-display text-4xl md:text-5xl text-navy-900 group-hover:text-sky-600 transition-colors"><span data-counter="{{ $s['value'] }}">0</span></p>
                <p class="text-[12.5px] md:text-sm text-slate-400 mt-1.5">{{ $s['label'] }}</p>
            </div>
        @endforeach
    </div>
</section>

<!-- ================= TENTANG (storytelling) ================= -->
<section id="tentang" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-28 md:py-36">
    <div class="grid lg:grid-cols-12 gap-12 lg:gap-8 items-start">
        <div class="lg:col-span-5" data-reveal="left">
            <p class="text-sky-600 font-medium text-sm mb-3">Tentang Kami</p>
            <h2 class="font-display text-4xl md:text-5xl text-navy-900 leading-[1.1]">Sekolah yang menyiapkan kariermu sejak hari pertama.</h2>
            <p class="text-slate-500 leading-relaxed mt-7">{{ $set('about_text') }}</p>
        </div>

        <div class="lg:col-span-7 lg:pl-8">
            <div class="relative" data-reveal="right">
                <div class="rounded-[2rem] overflow-hidden aspect-[16/10] bg-slate-100">
                    @if($set('about_image'))
                        <img src="{{ asset('storage/' . $set('about_image')) }}" class="w-full h-full object-cover" alt="Siswa SMK Infokom Bogor">
                    @else
                        <div class="w-full h-full grid place-items-center text-slate-300 text-sm">Foto kegiatan sekolah</div>
                    @endif
                </div>
                <div class="absolute -bottom-8 -left-6 md:-left-10 w-[55%] bg-white rounded-2xl shadow-xl shadow-navy-900/10 p-6">
                    <p class="text-xs font-semibold text-navy-400 uppercase tracking-wider mb-1">Akreditasi</p>
                    <p class="font-display text-3xl text-navy-900">{{ $set('akreditasi', 'A') }} &mdash; Unggul</p>
                </div>
            </div>

            <div class="grid sm:grid-cols-2 gap-4 mt-16">
                <div data-reveal data-reveal-delay="1" x-data="{ open: true }" class="rounded-2xl border border-slate-200 p-6 cursor-pointer hover:border-navy-300 transition" @click="open = !open">
                    <div class="flex items-center justify-between">
                        <p class="font-semibold text-navy-900">Visi</p>
                        <svg class="w-4 h-4 text-slate-400 transition-transform" :class="open && 'rotate-45'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    </div>
                    <p x-show="open" x-collapse class="text-sm text-slate-500 mt-3 leading-relaxed">{{ $set('vision') }}</p>
                </div>
                <div data-reveal data-reveal-delay="2" x-data="{ open: false }" class="rounded-2xl border border-slate-200 p-6 cursor-pointer hover:border-navy-300 transition" @click="open = !open">
                    <div class="flex items-center justify-between">
                        <p class="font-semibold text-navy-900">Misi</p>
                        <svg class="w-4 h-4 text-slate-400 transition-transform" :class="open && 'rotate-45'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    </div>
                    <p x-show="open" x-collapse class="text-sm text-slate-500 mt-3 leading-relaxed whitespace-pre-line">{{ $set('mission') }}</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ================= SAMBUTAN KEPALA SEKOLAH ================= -->
<section class="bg-navy-50/60 overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 md:py-32 grid lg:grid-cols-12 gap-12 items-center">
        <div class="lg:col-span-4" data-reveal="scale">
            <div class="relative w-full max-w-sm mx-auto">
                <div class="absolute -inset-3 rounded-[2.2rem] border border-navy-200/60"></div>
                <div class="rounded-[2rem] overflow-hidden aspect-[4/5] bg-white shadow-xl shadow-navy-900/5">
                    @if($set('principal_photo'))
                        <img src="{{ asset('storage/' . $set('principal_photo')) }}" class="w-full h-full object-cover" alt="{{ $set('principal_name') }}">
                    @else
                        <div class="w-full h-full grid place-items-center text-navy-200 text-sm">Foto Kepala Sekolah</div>
                    @endif
                </div>
            </div>
        </div>
        <div class="lg:col-span-8" data-reveal>
            <svg class="w-10 h-10 text-sky-300 mb-4" fill="currentColor" viewBox="0 0 24 24"><path d="M9.5 3C5.9 3 3 5.9 3 9.5c0 3.4 2.5 6.1 5.8 6.5-.4 1.8-1.9 3.3-3.8 3.8v2C9.6 21.3 13 17.2 13 12.5V9.5C13 5.9 10.1 3 6.5 3zm11 0c-3.6 0-6.5 2.9-6.5 6.5 0 3.4 2.5 6.1 5.8 6.5-.4 1.8-1.9 3.3-3.8 3.8v2c4.6-.5 8-4.6 8-9.3V9.5C24 5.9 21.1 3 17.5 3z"/></svg>
            <p class="font-display text-2xl md:text-[2rem] leading-relaxed text-navy-900">
                {{ $set('principal_message') }}
            </p>
            <div class="mt-8 flex items-center gap-4">
                <div class="h-px w-10 bg-sky-400"></div>
                <div>
                    <p class="font-semibold text-navy-900">{{ $set('principal_name') }}</p>
                    <p class="text-sm text-slate-400">{{ $set('principal_position', 'Kepala Sekolah') }}</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ================= PROGRAM KEAHLIAN (interactive expand) ================= -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-28 md:py-32" x-data="{ activeProgram: null }">
    <div class="flex flex-wrap items-end justify-between gap-6 mb-14" data-reveal>
        <div>
            <p class="text-sky-600 font-medium text-sm mb-3">Program Keahlian</p>
            <h2 class="font-display text-4xl md:text-5xl text-navy-900">Pilih jalur keahlianmu.</h2>
        </div>
        <p class="text-slate-400 text-sm max-w-xs">Klik salah satu program untuk melihat kompetensi dan prospek kariernya.</p>
    </div>

    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-5">
        @foreach($programs as $i => $program)
            <button type="button" @click="activeProgram = activeProgram === {{ $program->id }} ? null : {{ $program->id }}" data-cursor-hover data-reveal data-reveal-delay="{{ min($i, 6) }}"
                class="group text-left rounded-[1.75rem] border border-slate-200 hover:border-navy-300 hover:shadow-xl hover:shadow-navy-900/[0.06] transition-all duration-300 bg-white overflow-hidden relative">
                <div class="aspect-[16/10] bg-navy-50 overflow-hidden relative">
                    @if($program->photo)
                        <img src="{{ asset('storage/' . $program->photo) }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-700" alt="{{ $program->name }}">
                    @else
                        <div class="w-full h-full bg-gradient-to-br from-navy-700 to-sky-600 grid place-items-center text-white font-display text-3xl">{{ $program->code }}</div>
                    @endif
                    <div class="absolute inset-0 bg-gradient-to-t from-navy-900/60 via-transparent to-transparent"></div>
                    <span class="absolute bottom-4 left-5 text-white font-display text-lg">{{ $program->code }}</span>
                </div>
                <div class="p-6">
                    <p class="font-semibold text-navy-900">{{ $program->name }}</p>
                    <p class="text-sm text-slate-400 mt-2 line-clamp-2">{{ $program->description }}</p>
                    <span class="inline-flex items-center gap-1.5 text-sky-600 text-sm font-medium mt-4">
                        <span x-text="activeProgram === {{ $program->id }} ? 'Tutup detail' : 'Lihat detail'"></span>
                        <svg class="w-3.5 h-3.5 transition-transform" :class="activeProgram === {{ $program->id }} && 'rotate-90'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M9 5l7 7-7 7"/></svg>
                    </span>
                </div>
            </button>
        @endforeach
    </div>

    @foreach($programs as $program)
        <div x-show="activeProgram === {{ $program->id }}" x-collapse x-cloak class="mt-6">
            <div class="rounded-[1.75rem] bg-navy-900 text-white p-8 md:p-10 grid md:grid-cols-2 gap-8">
                <div>
                    <p class="font-display text-2xl mb-3">{{ $program->name }}</p>
                    <p class="text-slate-300 text-sm leading-relaxed">{{ $program->description }}</p>
                    <a href="{{ route('programs.show', $program->slug) }}" data-cursor-hover class="inline-flex items-center gap-2 text-sky-300 text-sm font-medium mt-5 hover:text-sky-200 transition">
                        Halaman lengkap program
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </a>
                </div>
                @if($program->prospects)
                    <div>
                        <p class="text-xs font-semibold text-sky-300/80 uppercase tracking-wider mb-3">Prospek Karier</p>
                        <p class="text-slate-300 text-sm leading-relaxed whitespace-pre-line">{{ $program->prospects }}</p>
                    </div>
                @endif
            </div>
        </div>
    @endforeach
</section>

<!-- ================= PENGUMUMAN (ticker) ================= -->
@if($announcements->count())
<section class="border-y border-slate-100 bg-navy-50/50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex items-center gap-5">
        <span class="shrink-0 inline-flex items-center gap-2 text-xs font-semibold text-navy-800 bg-white rounded-full px-3.5 py-1.5 ring-1 ring-navy-100">
            <span class="h-1.5 w-1.5 rounded-full bg-gold-400 animate-pulse"></span> Pengumuman
        </span>
        <div class="marquee-container flex-1">
            <div class="marquee-track gap-12">
                @foreach($announcements->concat($announcements) as $a)
                    <span class="text-sm text-slate-600 whitespace-nowrap">{{ $a->title }}</span>
                @endforeach
            </div>
        </div>
    </div>
</section>
@endif

<!-- ================= BERITA (featured + grid) ================= -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-28 md:py-32">
    <div class="flex items-end justify-between mb-14" data-reveal>
        <div>
            <p class="text-sky-600 font-medium text-sm mb-3">Berita</p>
            <h2 class="font-display text-4xl md:text-5xl text-navy-900">Kabar terbaru dari sekolah.</h2>
        </div>
        <a href="{{ route('news.index') }}" data-cursor-hover class="hidden sm:inline-flex items-center gap-1.5 text-navy-800 font-medium text-sm hover:text-sky-600 transition">
            Lihat Semua
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
        </a>
    </div>

    @if($latestNews->count())
        <div class="grid lg:grid-cols-2 gap-6 mb-6">
            @php($featured = $latestNews->first())
            <a href="{{ $featured->instagram_url ?: route('news.show', $featured->slug) }}" @if($featured->instagram_url) target="_blank" rel="noopener" @endif data-cursor-hover data-reveal="left"
                class="group relative rounded-[1.75rem] overflow-hidden aspect-[4/3] lg:aspect-auto lg:row-span-2 bg-navy-900">
                @if($featured->thumbnail)
                    <img src="{{ asset('storage/' . $featured->thumbnail) }}" class="absolute inset-0 w-full h-full object-cover opacity-80 group-hover:scale-105 group-hover:opacity-90 transition duration-700" alt="{{ $featured->title }}">
                @endif
                <div class="absolute inset-0 bg-gradient-to-t from-navy-900 via-navy-900/20 to-transparent"></div>
                <div class="absolute bottom-0 left-0 right-0 p-7 md:p-9">
                    <p class="text-xs text-sky-300 font-medium mb-2">{{ $featured->published_at?->translatedFormat('d F Y') }}</p>
                    <p class="font-display text-2xl md:text-3xl text-white leading-tight">{{ $featured->title }}</p>
                </div>
            </a>

            <div class="grid sm:grid-cols-2 lg:grid-cols-1 gap-6">
                @foreach($latestNews->skip(1)->take(2) as $i => $news)
                    <a href="{{ $news->instagram_url ?: route('news.show', $news->slug) }}" @if($news->instagram_url) target="_blank" rel="noopener" @endif data-cursor-hover data-reveal="right" data-reveal-delay="{{ $i + 1 }}"
                        class="group flex gap-5 rounded-2xl hover:bg-slate-50 p-3 -m-3 transition">
                        <div class="w-28 h-24 md:w-32 md:h-28 shrink-0 rounded-xl overflow-hidden bg-navy-50">
                            @if($news->thumbnail)
                                <img src="{{ asset('storage/' . $news->thumbnail) }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500" alt="{{ $news->title }}">
                            @endif
                        </div>
                        <div class="min-w-0">
                            <p class="text-xs text-slate-400 mb-1.5">{{ $news->published_at?->translatedFormat('d F Y') }}</p>
                            <p class="font-semibold text-navy-900 line-clamp-2 group-hover:text-sky-600 transition">{{ $news->title }}</p>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    @else
        <p class="text-slate-400 text-sm">Belum ada berita.</p>
    @endif
</section>

<!-- ================= PRESTASI (stacked scroll carousel) ================= -->
@if($achievements->count())
<section class="bg-slate-50 py-28 md:py-32 overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-end justify-between mb-14" data-reveal>
            <div>
                <p class="text-sky-600 font-medium text-sm mb-3">Prestasi</p>
                <h2 class="font-display text-4xl md:text-5xl text-navy-900">Karya dan pencapaian siswa.</h2>
            </div>
        </div>
    </div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex gap-5 overflow-x-auto pb-6 snap-x snap-mandatory" style="scrollbar-width:none;">
            @foreach($achievements as $i => $ach)
                <div data-reveal data-reveal-delay="{{ min($i, 6) }}" class="snap-start shrink-0 w-[280px] md:w-[320px] bg-white rounded-[1.75rem] p-7 ring-1 ring-slate-900/5 hover:ring-navy-200 hover:-translate-y-1.5 transition-all duration-300">
                    <div class="flex items-center justify-between mb-6">
                        <span class="h-11 w-11 rounded-xl bg-gold-50 text-gold-500 grid place-items-center">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M8 21h8m-4-4v4M7 4h10l-.6 6.6a4.5 4.5 0 01-8.8 0L7 4zM3 6h4m10 0h4M5 6a2 2 0 002 2m10-2a2 2 0 01-2 2"/></svg>
                        </span>
                        <span class="text-xs font-semibold text-slate-400">{{ $ach->year }}</span>
                    </div>
                    <span class="text-[11px] font-semibold text-sky-600 uppercase tracking-wider">{{ str_replace('_',' ',$ach->level) }}</span>
                    <p class="font-display text-xl text-navy-900 mt-2 leading-snug">{{ $ach->title }}</p>
                    @if($ach->student_name)
                        <p class="text-sm text-slate-400 mt-3">{{ $ach->student_name }}</p>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- ================= GALERI (masonry) ================= -->
@if($galleries->count())
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-28 md:py-32">
    <div class="flex items-end justify-between mb-14" data-reveal>
        <div>
            <p class="text-sky-600 font-medium text-sm mb-3">Galeri</p>
            <h2 class="font-display text-4xl md:text-5xl text-navy-900">Momen di SMK Infokom Bogor.</h2>
        </div>
        <a href="{{ route('gallery.index') }}" data-cursor-hover class="hidden sm:inline-flex items-center gap-1.5 text-navy-800 font-medium text-sm hover:text-sky-600 transition">
            Lihat Semua
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
        </a>
    </div>
    <div class="columns-2 md:columns-3 gap-4 [column-fill:balance]">
        @foreach($galleries as $i => $g)
            <a href="{{ route('gallery.show', $g->slug) }}" data-cursor-hover data-reveal="scale" data-reveal-delay="{{ min($i, 6) }}" class="group block rounded-2xl overflow-hidden mb-4 break-inside-avoid {{ $i % 3 === 0 ? 'aspect-[3/4]' : 'aspect-square' }}">
                <x-media-frame
                    ratio="h-full"
                    :src="$g->cover ? asset('storage/' . $g->cover) : null"
                    fit="cover"
                    icon="🖼️"
                    :alt="$g->title"
                    img-class="group-hover:scale-110 transition duration-700"
                />
            </a>
        @endforeach
    </div>
</section>
@endif

<!-- ================= KERJASAMA ================= -->
@if($partners->count())
<section class="bg-white border-y border-slate-100 py-20 overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-xl mx-auto mb-12" data-reveal>
            <p class="text-sky-600 font-medium text-sm mb-3">Kerjasama</p>
            <h2 class="font-display text-3xl md:text-4xl text-navy-900">Mitra universitas &amp; industri.</h2>
        </div>
        @foreach(['universitas' => 'Universitas', 'industri' => 'Industri'] as $type => $label)
            @if($partners->where('type', $type)->count())
            <p class="text-xs font-semibold uppercase tracking-wide text-navy-400 mb-4 mt-8 first:mt-0 text-center">{{ $label }}</p>
            <div class="marquee-container">
                <div class="marquee-track gap-4">
                    @foreach($partners->where('type', $type)->concat($partners->where('type', $type)) as $p)
                        <div data-cursor-hover class="h-16 px-7 rounded-xl bg-white border border-slate-100 grid place-items-center shrink-0 hover:border-navy-200 transition">
                            @if($p->logo)
                                <img src="{{ asset('storage/' . $p->logo) }}" alt="{{ $p->name }}" class="max-h-9 max-w-[130px] object-contain grayscale hover:grayscale-0 transition">
                            @else
                                <span class="text-xs font-semibold text-navy-600 whitespace-nowrap">{{ $p->name }}</span>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
            @endif
        @endforeach
    </div>
</section>
@endif

<!-- ================= CTA PPDB ================= -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-28 md:py-32">
    <div data-reveal="scale" class="relative rounded-[2rem] bg-gradient-to-br from-sky-50 via-white to-gold-50 ring-1 ring-navy-900/10 shadow-xl shadow-navy-900/5 p-10 md:p-20 text-center overflow-hidden">
        <div class="float-a absolute -top-10 -left-10 w-64 h-64 rounded-full bg-sky-200/50 blur-3xl pointer-events-none"></div>
        <div class="float-b absolute -bottom-10 -right-10 w-64 h-64 rounded-full bg-gold-200/50 blur-3xl pointer-events-none"></div>
        <p class="text-sky-600 font-medium text-sm mb-4 relative">Penerimaan Peserta Didik Baru</p>
        <h2 class="font-display text-4xl md:text-5xl mb-6 relative max-w-2xl mx-auto leading-tight text-navy-900">Langkah pertamamu menuju karier digital dimulai di sini.</h2>
        <a href="{{ route('ppdb.index') }}" data-cursor-hover class="magnetic relative inline-flex items-center gap-2 px-8 py-4 rounded-full bg-navy-900 text-white font-semibold hover:bg-navy-800 transition shadow-lg shadow-navy-900/15">
            Daftar PPDB Sekarang
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
        </a>
    </div>
</section>
@endsection
