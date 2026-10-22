@extends('layouts.public')
@section('content')

<section class="relative overflow-hidden bg-gradient-to-b from-sky-50 via-white to-white pt-32 pb-20">
    <div class="float-a absolute top-10 -left-16 w-72 h-72 rounded-full bg-sky-200/50 blur-3xl pointer-events-none"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative grid lg:grid-cols-2 gap-12 items-center">
        <div data-reveal>
            <p class="text-sky-600 font-medium text-sm mb-3">PKL</p>
            <h1 class="font-display text-4xl md:text-5xl text-navy-900 leading-[1.08]">Praktik Kerja Lapangan</h1>
            <p class="text-slate-500 mt-6 leading-relaxed text-lg">
                {{ $content['about'] ?: 'Praktik Kerja Lapangan (PKL) adalah program wajib bagi siswa SMK Infokom Bogor untuk menerapkan langsung ilmu dan keterampilan yang dipelajari di sekolah ke dunia industri dan dunia kerja (DUDI) yang sesungguhnya.' }}
            </p>
        </div>
        <div data-reveal="scale">
            <div class="rounded-[2rem] overflow-hidden shadow-xl shadow-navy-900/10 ring-1 ring-navy-900/5 aspect-video bg-gradient-to-br from-navy-50 to-sky-50">
                @if($content['hero_image'])
                    <img src="{{ asset('storage/' . $content['hero_image']) }}" class="w-full h-full object-cover" alt="Praktik Kerja Lapangan">
                @else
                    <div class="w-full h-full grid place-items-center text-navy-200"><svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m-4 6h16M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg></div>
                @endif
            </div>
        </div>
    </div>
</section>

<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
    <div class="grid md:grid-cols-2 gap-6">
        <div data-reveal="left" class="rounded-[1.75rem] bg-white border border-slate-200 p-8">
            <div class="h-11 w-11 rounded-xl bg-sky-50 text-sky-600 grid place-items-center mb-4"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg></div>
            <p class="font-display text-xl text-navy-900 mb-3">Tujuan PKL</p>
            <p class="text-slate-500 leading-relaxed whitespace-pre-line">{{ $content['purpose'] ?: 'Mempersiapkan siswa agar memiliki pengalaman kerja nyata, meningkatkan kompetensi sesuai bidang keahlian, serta membangun etos kerja profesional sebelum memasuki dunia industri.' }}</p>
        </div>
        <div data-reveal="right" class="rounded-[1.75rem] bg-white border border-slate-200 p-8">
            <div class="h-11 w-11 rounded-xl bg-gold-50 text-gold-500 grid place-items-center mb-4"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg></div>
            <p class="font-display text-xl text-navy-900 mb-3">Manfaat PKL bagi Siswa</p>
            <p class="text-slate-500 leading-relaxed whitespace-pre-line">{{ $content['benefits'] ?: 'Menambah wawasan dunia kerja, melatih tanggung jawab dan kedisiplinan, memperluas relasi profesional, serta menjadi bekal untuk berkarier maupun melanjutkan pendidikan.' }}</p>
        </div>
    </div>
</section>

@if($fields->count())
<section class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 pb-20">
    <div data-reveal class="text-center max-w-2xl mx-auto mb-10">
        <p class="text-sky-600 font-medium text-sm mb-3">Program</p>
        <h2 class="font-display text-3xl text-navy-900">Bidang PKL yang Tersedia</h2>
    </div>
    <div data-reveal class="flex flex-wrap justify-center gap-3">
        @foreach($fields as $field)
            <span class="px-5 py-2.5 rounded-full bg-navy-50 text-navy-700 font-medium text-sm border border-navy-100">{{ $field }}</span>
        @endforeach
    </div>
</section>
@endif

<section class="bg-slate-50 py-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div data-reveal class="text-center max-w-2xl mx-auto mb-14">
            <p class="text-sky-600 font-medium text-sm mb-3">Mitra</p>
            <h2 class="font-display text-3xl md:text-4xl text-navy-900">Perusahaan &amp; Instansi Mitra PKL</h2>
            <p class="text-slate-500 mt-4">Tempat siswa SMK Infokom Bogor menjalani Praktik Kerja Lapangan.</p>
        </div>

        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($partners as $i => $partner)
                <div data-reveal data-reveal-delay="{{ min($i, 6) }}" class="group rounded-[1.5rem] bg-white border border-slate-200 overflow-hidden hover:border-navy-300 hover:shadow-xl hover:shadow-navy-900/[0.06] transition-all duration-300">
                    <div class="aspect-video bg-navy-50 overflow-hidden">
                        @if($partner->logo)
                            <img src="{{ asset('storage/' . $partner->logo) }}" class="w-full h-full object-contain p-6 group-hover:scale-105 transition duration-500" alt="{{ $partner->name }}">
                        @else
                            <div class="w-full h-full grid place-items-center text-navy-200"><svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2M19 21H5m0 0H3m8-14h.01M11 11h.01M11 15h.01M7 11h.01M7 15h.01M15 11h.01M15 15h.01"/></svg></div>
                        @endif
                    </div>
                    <div class="p-6">
                        <p class="font-semibold text-navy-900">{{ $partner->name }}</p>
                        @if($partner->field)
                            <p class="text-xs text-sky-600 font-semibold mt-1">{{ $partner->field }}</p>
                        @endif
                        @if($partner->address)
                            <p class="text-sm text-slate-500 mt-2.5 flex items-start gap-1.5"><svg class="w-3.5 h-3.5 mt-0.5 shrink-0 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M17.657 16.657L13.414 20.9a2 2 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>{{ $partner->address }}</p>
                        @endif
                        @if($partner->website)
                            <a href="{{ $partner->website }}" target="_blank" rel="noopener" data-cursor-hover class="inline-flex items-center gap-1 mt-3 text-xs font-semibold text-sky-600 hover:text-sky-700">Kunjungi Situs <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg></a>
                        @endif
                    </div>
                </div>
            @empty
                <p class="text-slate-400 text-sm col-span-3">Data mitra PKL belum tersedia.</p>
            @endforelse
        </div>
    </div>
</section>

@if($galleries->count())
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
    <div data-reveal class="text-center max-w-2xl mx-auto mb-14">
        <p class="text-sky-600 font-medium text-sm mb-3">Dokumentasi</p>
        <h2 class="font-display text-3xl md:text-4xl text-navy-900">Momen Kegiatan PKL</h2>
    </div>
    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
        @foreach($galleries as $i => $g)
            <a href="{{ route('gallery.show', $g->slug) }}" data-cursor-hover data-reveal="scale" data-reveal-delay="{{ min($i, 6) }}" class="group block rounded-2xl overflow-hidden aspect-square bg-navy-50">
                @if($g->cover)
                    <img src="{{ asset('storage/' . $g->cover) }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500" alt="{{ $g->title }}">
                @endif
            </a>
        @endforeach
    </div>
</section>
@endif

@if($news->count())
<section class="bg-slate-50 py-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between mb-12" data-reveal>
            <div>
                <p class="text-sky-600 font-medium text-sm mb-3">Informasi Terbaru</p>
                <h2 class="font-display text-3xl md:text-4xl text-navy-900">Berita Seputar PKL</h2>
            </div>
            <a href="{{ route('news.index', ['category' => 'pkl']) }}" data-cursor-hover class="text-navy-800 font-medium text-sm hover:text-sky-600 transition hidden sm:block">Lihat Semua &rarr;</a>
        </div>
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($news as $i => $item)
                <a href="{{ route('news.show', $item->slug) }}" data-cursor-hover data-reveal data-reveal-delay="{{ min($i, 6) }}" class="group block rounded-[1.5rem] overflow-hidden border border-slate-200 bg-white hover:border-navy-300 hover:shadow-xl hover:shadow-navy-900/[0.06] transition-all duration-300">
                    <div class="aspect-video bg-navy-50 overflow-hidden">
                        @if($item->thumbnail)
                            <img src="{{ asset('storage/' . $item->thumbnail) }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500" alt="{{ $item->title }}">
                        @endif
                    </div>
                    <div class="p-6">
                        <p class="text-xs text-slate-400 mb-1.5">{{ $item->published_at?->translatedFormat('d F Y') }}</p>
                        <p class="font-semibold text-navy-900 line-clamp-2 group-hover:text-sky-600 transition">{{ $item->title }}</p>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>
@endif

<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
    <div data-reveal="scale" class="rounded-[2rem] bg-gradient-to-br from-sky-50 via-white to-gold-50 ring-1 ring-navy-900/10 shadow-xl shadow-navy-900/5 p-10 md:p-16 text-center relative overflow-hidden">
        <h2 class="font-display text-3xl md:text-4xl text-navy-900 mb-4">Ingin Bermitra untuk PKL?</h2>
        <p class="text-slate-500 max-w-xl mx-auto mb-8">Perusahaan atau instansi yang ingin bekerja sama sebagai tempat Praktik Kerja Lapangan siswa dapat menghubungi kami.</p>
        <a href="{{ route('contact.index') }}" data-cursor-hover class="magnetic inline-flex items-center gap-2 px-8 py-3.5 rounded-full bg-navy-900 text-white font-semibold hover:bg-navy-800 transition shadow-lg shadow-navy-900/15">Hubungi Kami</a>
    </div>
</section>
@endsection
