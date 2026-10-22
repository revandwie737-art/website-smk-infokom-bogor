@extends('layouts.public')
@section('content')
<article class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <div data-aos="fade-up">
        @if($article->category)
            <span class="text-xs font-semibold text-sky-600 uppercase">{{ $article->category->name }}</span>
        @endif
        <h1 class="text-3xl md:text-4xl font-extrabold text-navy-900 mt-3 mb-4 leading-tight">{{ $article->title }}</h1>
        <div class="flex items-center gap-4 text-sm text-slate-400 mb-8">
            <span>{{ $article->published_at?->translatedFormat('d F Y') }}</span>
            <span>&bull;</span>
            <span>{{ $article->views }} kali dilihat</span>
            @if($article->author)
                <span>&bull;</span><span>{{ $article->author->name }}</span>
            @endif
        </div>
        @if($article->instagram_url)
            <a href="{{ $article->instagram_url }}" target="_blank" rel="noopener"
                class="ripple-btn inline-flex items-center gap-2 px-4 py-2 rounded-full bg-navy-900 text-white text-sm font-semibold hover:bg-navy-800 transition mb-8">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zM12 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                Lihat Postingan Asli di Instagram
            </a>
        @endif
    </div>

    @if($article->thumbnail)
        <button type="button" data-lightbox-src="{{ asset('storage/' . $article->thumbnail) }}" data-lightbox-caption="{{ $article->title }}"
            data-tilt-strength="6" data-tilt-scale="1.025"
            class="reveal-mask tilt-3d block w-full aspect-video rounded-3xl overflow-hidden mb-10 bg-navy-50" data-aos="fade-up">
            <img src="{{ asset('storage/' . $article->thumbnail) }}" class="reveal-img w-full h-full object-contain" alt="{{ $article->title }}">
        </button>
    @endif

    <div class="prose prose-slate max-w-none prose-headings:text-navy-800 prose-a:text-sky-600" data-aos="fade-up">
        {!! $article->content !!}
    </div>

    @if($related->count())
        <div class="mt-16 pt-10 border-t border-slate-900/15">
            <p class="font-bold text-navy-800 mb-6">Berita Terkait</p>
            <div class="grid sm:grid-cols-3 gap-5">
                @foreach($related as $r)
                    <a href="{{ route('news.show', $r->slug) }}" class="block group tilt-3d" data-tilt-strength="8" data-tilt-scale="1.04">
                        <div class="aspect-video rounded-xl bg-slate-100 overflow-hidden mb-2">
                            @if($r->thumbnail)
                                <img src="{{ asset('storage/' . $r->thumbnail) }}" class="w-full h-full object-contain" alt="{{ $r->title }}">
                            @endif
                        </div>
                        <p class="text-sm font-medium text-navy-800 line-clamp-2 group-hover:text-sky-600 transition">{{ $r->title }}</p>
                    </a>
                @endforeach
            </div>
        </div>
    @endif
</article>
@endsection
