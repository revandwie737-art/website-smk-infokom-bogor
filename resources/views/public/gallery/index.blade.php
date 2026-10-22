@extends('layouts.public')
@section('content')
<style>
    .gal-tile { position: relative; display: block; overflow: hidden; background: #0b1224; aspect-ratio: 4 / 3; isolation: isolate; }
    .gal-tile img, .gal-tile .gal-empty { position: absolute; inset: 0; width: 100%; height: 100%; object-fit: cover; transform: scale(1.001); transition: transform 1.6s cubic-bezier(.16,1,.3,1), filter .9s cubic-bezier(.16,1,.3,1); }
    .gal-empty { background: radial-gradient(circle at 30% 20%, #1e3a8a55, transparent 60%), linear-gradient(135deg, #0f172a, #172554); }

    /* dim siblings so the hovered tile becomes the spotlight */
    .gal-grid:hover .gal-tile:not(:hover):not(:focus-visible) img,
    .gal-grid:hover .gal-tile:not(:hover):not(:focus-visible) .gal-empty { filter: brightness(.45) saturate(.7); }

    .gal-tile:hover img, .gal-tile:focus-visible img, .gal-tile:hover .gal-empty { transform: scale(1.09); }

    /* bottom scrim */
    .gal-scrim { position: absolute; inset: 0; z-index: 1; background: linear-gradient(to top, rgba(2,6,23,.92) 0%, rgba(2,6,23,.55) 38%, rgba(2,6,23,0) 70%); opacity: 0; transition: opacity .8s cubic-bezier(.16,1,.3,1); }
    /* thin gold frame that draws in */
    .gal-frame { position: absolute; inset: 10px; z-index: 2; border: 1px solid rgba(232,196,110,.75); opacity: 0; transform: scale(1.06); transition: opacity .7s cubic-bezier(.16,1,.3,1), transform 1s cubic-bezier(.16,1,.3,1); pointer-events: none; }

    .gal-info { position: absolute; left: 0; right: 0; bottom: 0; z-index: 3; padding: 0 1.25rem 1.4rem; pointer-events: none; }
    .gal-date, .gal-title, .gal-line, .gal-arrow { opacity: 0; transform: translateY(22px); transition: opacity .8s cubic-bezier(.16,1,.3,1), transform .9s cubic-bezier(.16,1,.3,1); }
    .gal-date { font-size: 11px; letter-spacing: .22em; text-transform: uppercase; color: #e8c46e; font-weight: 600; margin-bottom: .55rem; }
    .gal-title { font-family: 'Fraunces', Georgia, serif; font-size: 1.1rem; line-height: 1.25; color: #fff; transition-delay: .06s; }
    .gal-line { height: 1px; width: 0; background: #e8c46e; margin-top: 1rem; transform: none; transition: width 1s cubic-bezier(.16,1,.3,1) .12s, opacity .6s ease .1s; }
    .gal-arrow { position: absolute; right: 1.25rem; bottom: 1.4rem; color: #e8c46e; transition-delay: .14s; }

    .gal-tile:hover .gal-scrim, .gal-tile:focus-visible .gal-scrim { opacity: 1; }
    .gal-tile:hover .gal-frame, .gal-tile:focus-visible .gal-frame { opacity: 1; transform: scale(1); }
    .gal-tile:hover .gal-date, .gal-tile:hover .gal-title, .gal-tile:hover .gal-arrow,
    .gal-tile:focus-visible .gal-date, .gal-tile:focus-visible .gal-title, .gal-tile:focus-visible .gal-arrow { opacity: 1; transform: translateY(0); }
    .gal-tile:hover .gal-line, .gal-tile:focus-visible .gal-line { opacity: 1; width: 3rem; }

    /* touch screens have no hover: keep a quiet caption so names stay reachable */
    @media (hover: none) {
        .gal-scrim { opacity: 1; background: linear-gradient(to top, rgba(2,6,23,.85), rgba(2,6,23,0) 55%); }
        .gal-date, .gal-title { opacity: 1; transform: none; }
        .gal-title { font-size: 1.05rem; }
        .gal-frame, .gal-line, .gal-arrow { display: none; }
        .gal-info { padding: 0 1rem 1rem; }
    }
    @media (prefers-reduced-motion: reduce) {
        .gal-tile img, .gal-scrim, .gal-frame, .gal-date, .gal-title, .gal-line, .gal-arrow { transition-duration: .01ms !important; }
    }

    /* entrance */
    .gal-tile { opacity: 0; animation: galIn .9s cubic-bezier(.16,1,.3,1) forwards; animation-delay: var(--d, 0ms); }
    @keyframes galIn { from { opacity: 0; transform: translateY(26px); } to { opacity: 1; transform: none; } }
</style>

<section class="relative bg-navy-950 text-white overflow-hidden">
    <div class="pointer-events-none absolute inset-0" style="background: radial-gradient(ellipse 55% 45% at 50% 0%, rgba(232,196,110,.10), transparent 65%);"></div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-16 pb-10 text-center" data-aos="fade-up">
        <div class="flex items-center justify-center gap-3 mb-4">
            <span class="h-px w-8 bg-amber-300/60"></span>
            <span class="text-amber-300 font-semibold text-[11px] tracking-[0.25em] uppercase">{{ $set('gallery_page_eyebrow', 'Galeri') }}</span>
            <span class="h-px w-8 bg-amber-300/60"></span>
        </div>
        <h1 class="font-serif text-3xl md:text-5xl text-white">{{ $set('gallery_page_title', 'Galeri Kegiatan Sekolah') }}</h1>
    </div>

    <div class="gal-grid relative max-w-6xl mx-auto grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-[2px]">
        @forelse($galleries as $i => $gallery)
            <a href="{{ route('gallery.show', $gallery->slug) }}" class="gal-tile" style="--d: {{ ($i % 8) * 70 }}ms" aria-label="{{ $gallery->title }}">
                @if($gallery->cover)
                    <img src="{{ asset('storage/' . $gallery->cover) }}" alt="{{ $gallery->title }}" loading="lazy">
                @else
                    <div class="gal-empty"></div>
                @endif
                <span class="gal-scrim"></span>
                <span class="gal-frame"></span>
                <div class="gal-info">
                    @if($gallery->event_date)
                        <p class="gal-date">{{ $gallery->event_date->translatedFormat('d F Y') }}</p>
                    @endif
                    <p class="gal-title">{{ $gallery->title }}</p>
                    <span class="gal-line block"></span>
                </div>
                <svg class="gal-arrow w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 12h14m-6-6l6 6-6 6"/></svg>
            </a>
        @empty
            <p class="col-span-full text-center text-slate-400 text-sm py-24">Belum ada album galeri.</p>
        @endforelse
    </div>
    <div class="h-20"></div>
</section>

@if($galleries->hasPages())
    <div class="bg-white py-10"><div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">{{ $galleries->links() }}</div></div>
@endif
@endsection