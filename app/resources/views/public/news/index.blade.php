@extends('layouts.public')
@section('content')

<x-public.page-hero eyebrow="Berita" title="Kabar dan cerita dari SMK Infokom Bogor.">
    <x-slot:aside>
        <form method="GET" class="flex flex-wrap gap-3">
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari berita..." class="px-5 py-3 rounded-full border border-slate-200 bg-white text-sm w-64 focus:outline-none focus:ring-2 focus:ring-sky-300 transition">
            <select name="category" class="px-5 py-3 rounded-full border border-slate-200 bg-white text-sm focus:outline-none focus:ring-2 focus:ring-sky-300 transition">
                <option value="">Semua Kategori</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->slug }}" @selected(request('category') == $cat->slug)>{{ $cat->name }}</option>
                @endforeach
            </select>
            <button class="px-7 py-3 rounded-full bg-navy-900 text-white text-sm font-semibold hover:bg-navy-800 transition">Cari</button>
        </form>
    </x-slot:aside>
</x-public.page-hero>

<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-28">
    <div class="grid lg:grid-cols-3 gap-12">
        <div class="lg:col-span-2 grid sm:grid-cols-2 gap-6">
            @forelse($news as $i => $item)
                <a href="{{ $item->instagram_url ?: route('news.show', $item->slug) }}" @if($item->instagram_url) target="_blank" rel="noopener" @endif data-cursor-hover data-reveal data-reveal-delay="{{ min($i, 6) }}"
                    class="group block rounded-[1.5rem] overflow-hidden border border-slate-200 bg-white hover:border-navy-300 hover:shadow-xl hover:shadow-navy-900/[0.06] transition-all duration-300">
                    <div class="aspect-video bg-navy-50 overflow-hidden">
                        @if($item->thumbnail)
                            <img src="{{ asset('storage/' . $item->thumbnail) }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500" alt="{{ $item->title }}">
                        @else
                            <div class="w-full h-full grid place-items-center text-navy-200"><svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v12a2 2 0 01-2 2zM9 12h6m-6 4h6M9 8h1"/></svg></div>
                        @endif
                    </div>
                    <div class="p-6">
                        @if($item->category)
                            <span class="text-xs font-semibold text-sky-600 uppercase tracking-wide">{{ $item->category->name }}</span>
                        @endif
                        <p class="font-semibold text-navy-900 mt-2 line-clamp-2 group-hover:text-sky-600 transition">{{ $item->title }}</p>
                        <p class="text-xs text-slate-400 mt-3">{{ $item->published_at?->translatedFormat('d F Y') }}</p>
                    </div>
                </a>
            @empty
                <p class="text-slate-400 text-sm col-span-2">Belum ada berita yang ditemukan.</p>
            @endforelse
        </div>

        <aside class="space-y-6" data-reveal="right">
            <p class="font-display text-xl text-navy-900">Berita Populer</p>
            <ul class="space-y-1">
                @foreach($popular as $i => $p)
                    <li>
                        <a href="{{ $p->instagram_url ?: route('news.show', $p->slug) }}" @if($p->instagram_url) target="_blank" rel="noopener" @endif data-cursor-hover class="group flex items-start gap-4 py-3.5 border-b border-slate-100">
                            <span class="font-display text-2xl text-navy-100 group-hover:text-sky-300 transition shrink-0">{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</span>
                            <span class="text-sm text-slate-600 group-hover:text-navy-900 transition line-clamp-2 pt-1">{{ $p->title }}</span>
                        </a>
                    </li>
                @endforeach
            </ul>
        </aside>
    </div>

    <div class="mt-14">{{ $news->links() }}</div>
</section>
@endsection
