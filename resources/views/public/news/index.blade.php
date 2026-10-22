@extends('layouts.public')
@section('content')
<section class="relative overflow-hidden py-20">
    <div class="blob absolute -top-16 -right-16 w-72 h-72 rounded-full bg-sky-100/60 blur-3xl pointer-events-none"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
    <div class="text-center max-w-2xl mx-auto mb-12" data-aos="fade-up">
        <span class="text-sky-600 font-semibold text-sm">Berita</span>
        <h1 class="text-3xl md:text-4xl font-extrabold text-navy-900 mt-2">Berita &amp; Informasi Sekolah</h1>
    </div>

    <form method="GET" class="flex flex-wrap gap-3 mb-12 justify-center" data-aos="fade-up">
        <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari berita..."
            class="px-4 py-2.5 rounded-full border border-slate-200 text-sm w-64 focus:outline-none focus:ring-2 focus:ring-sky-300">
        <select name="category" class="px-4 py-2.5 rounded-full border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-sky-300">
            <option value="">Semua Kategori</option>
            @foreach($categories as $cat)
                <option value="{{ $cat->slug }}" @selected(request('category') == $cat->slug)>{{ $cat->name }}</option>
            @endforeach
        </select>
        <button class="px-6 py-2.5 rounded-full bg-navy-700 text-white text-sm font-semibold hover:bg-navy-800 transition">Cari</button>
    </form>

    @php
        $isFiltered = request('q') || request('category');
        $featured = (!$isFiltered && $news->currentPage() === 1) ? $news->first() : null;
        $restNews = $featured ? $news->skip(1) : $news;
    @endphp

    @if($featured)
        <a href="{{ $featured->instagram_url ?: route('news.show', $featured->slug) }}" @if($featured->instagram_url) target="_blank" rel="noopener" @endif
            data-aos="fade-up" data-tilt-strength="5" data-tilt-scale="1.02" class="group tilt-3d relative block rounded-3xl overflow-hidden mb-10 min-h-[420px] flex items-end ring-1 ring-white/10 shadow-2xl shadow-navy-900/20">
            @if($featured->thumbnail)
                <div class="reveal-mask absolute inset-0">
                    <img src="{{ asset('storage/' . $featured->thumbnail) }}" class="reveal-img w-full h-full object-cover" alt="{{ $featured->title }}">
                </div>
                <div class="absolute inset-0 bg-gradient-to-t from-navy-900/95 via-navy-900/40 to-transparent"></div>
                <div class="absolute inset-0 bg-gradient-to-r from-navy-900/50 to-transparent"></div>
                <div class="relative p-8 md:p-12 max-w-2xl">
                    <span class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-full bg-sky-400/15 ring-1 ring-sky-300/30 text-sky-300 text-xs font-semibold mb-4 backdrop-blur-sm">
                        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path d="M11.3 1.046a1 1 0 01.7.954v6h5a1 1 0 01.82 1.573l-8 11.5A1 1 0 018 20v-6H3a1 1 0 01-.82-1.573l8-11.5a1 1 0 011.12-.38z"/></svg>
                        Sorotan Utama
                    </span>
                    @if($featured->category)
                        <span class="text-xs font-semibold text-sky-300 uppercase tracking-wider">{{ $featured->category->name }}</span>
                    @endif
                    <p class="font-extrabold text-white text-2xl md:text-4xl mt-2 leading-snug group-hover:text-sky-200 transition">{{ $featured->title }}</p>
                    <div class="flex items-center gap-3 mt-4">
                        <p class="text-xs text-slate-300">{{ $featured->published_at?->translatedFormat('d F Y') }}</p>
                        <span class="inline-flex items-center gap-1 text-xs font-semibold text-white opacity-0 group-hover:opacity-100 translate-x-0 group-hover:translate-x-1 transition-all duration-300">
                            Baca selengkapnya &rarr;
                        </span>
                    </div>
                </div>
            @else
                <div class="absolute inset-0 bg-slate-300"></div>
                <div class="absolute inset-0 flex items-center justify-center text-center p-8 md:p-12">
                    <div class="max-w-2xl">
                        <span class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-full bg-white/60 ring-1 ring-slate-400/30 text-slate-600 text-xs font-semibold mb-4 backdrop-blur-sm">
                            <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path d="M11.3 1.046a1 1 0 01.7.954v6h5a1 1 0 01.82 1.573l-8 11.5A1 1 0 018 20v-6H3a1 1 0 01-.82-1.573l8-11.5a1 1 0 011.12-.38z"/></svg>
                            Sorotan Utama
                        </span>
                        @if($featured->category)
                            <span class="text-xs font-semibold text-slate-500 uppercase tracking-wider block">{{ $featured->category->name }}</span>
                        @endif
                        <p class="font-extrabold text-slate-600 text-2xl md:text-4xl mt-2 leading-snug transition">{{ $featured->title }}</p>
                        <div class="flex items-center justify-center gap-3 mt-4">
                            <p class="text-xs text-slate-500">{{ $featured->published_at?->translatedFormat('d F Y') }}</p>
                            <span class="inline-flex items-center gap-1 text-xs font-semibold text-slate-600 opacity-0 group-hover:opacity-100 transition-all duration-300">
                                Baca selengkapnya &rarr;
                            </span>
                        </div>
                    </div>
                </div>
            @endif
        </a>
    @endif

    <div class="grid lg:grid-cols-3 gap-10">
        <div class="lg:col-span-2 grid sm:grid-cols-2 gap-6">
            @forelse($restNews as $i => $item)
                <a href="{{ $item->instagram_url ?: route('news.show', $item->slug) }}" @if($item->instagram_url) target="_blank" rel="noopener" @endif data-aos="fade-up" data-aos-delay="{{ $i * 70 }}" data-tilt-strength="8" data-tilt-scale="1.03" class="group tilt-3d block rounded-2xl overflow-hidden border border-slate-900/15 bg-white hover:shadow-xl hover:shadow-navy-100 transition-all duration-300">
                    <div class="aspect-[4/5] bg-navy-50 overflow-hidden">
                        @if($item->thumbnail)
                            <img src="{{ asset('storage/' . $item->thumbnail) }}" class="w-full h-full object-cover object-top" alt="{{ $item->title }}">
                        @else
                            <div class="w-full h-full grid place-items-center text-navy-200 text-3xl">📰</div>
                        @endif
                    </div>
                    <div class="p-5">
                        @if($item->category)
                            <span class="text-xs font-semibold text-sky-600 uppercase">{{ $item->category->name }}</span>
                        @endif
                        <p class="font-semibold text-navy-800 mt-1.5 line-clamp-2 group-hover:text-navy-600 transition">{{ $item->title }}</p>
                        <p class="text-xs text-slate-400 mt-2">{{ $item->published_at?->translatedFormat('d F Y') }}</p>
                    </div>
                </a>
            @empty
                @if(!$featured)
                    <p class="text-slate-400 text-sm col-span-2">Belum ada berita yang ditemukan.</p>
                @endif
            @endforelse
        </div>

        <aside class="space-y-8">
            <div data-aos="fade-up" class="hover-lift rounded-2xl bg-white border border-slate-900/15 p-6">
                <p class="font-bold text-navy-800 mb-4">🔥 Berita Populer</p>
                <ul class="space-y-4">
                    @foreach($popular as $i => $p)
                        <li class="flex gap-3">
                            <span class="shrink-0 text-2xl font-extrabold text-navy-100">{{ $i + 1 }}</span>
                            <a href="{{ $p->instagram_url ?: route('news.show', $p->slug) }}" @if($p->instagram_url) target="_blank" rel="noopener" @endif class="text-sm text-slate-600 hover:text-navy-800 transition line-clamp-2 pt-1">{{ $p->title }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </aside>
    </div>

    <div class="mt-12">{{ $news->links() }}</div>
    </div>
</section>
@endsection
