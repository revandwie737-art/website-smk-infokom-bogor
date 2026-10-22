@extends('layouts.public')
@section('content')
@php
    // Galeri: foto utama + foto tambahan (hanya fasilitas Laboratorium yang punya foto tambahan)
    $galleryData = [];
    foreach ($facilities as $f) {
        if ($f->supportsGallery()) {
            $photos = collect([$f->photo])
                ->merge($f->extra_photos ?? [])
                ->filter()
                ->map(fn ($p) => asset('storage/' . $p))
                ->values()
                ->all();
            if (count($photos) > 1) {
                $galleryData[$f->id] = [
                    'name'   => $f->name,
                    'meta'   => $f->quantity ? $f->quantity . ' unit' : '',
                    'photos' => $photos,
                ];
            }
        }
    }
@endphp

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,500;9..144,600&display=swap" rel="stylesheet">
<style>
    .fx-serif { font-family: 'Fraunces', Georgia, serif; }
    .fx-cell { position: relative; overflow: hidden; background: #0b1226; outline: none; }
    .fx-cell img { width: 100%; height: 100%; object-fit: cover; transition: transform 1.1s cubic-bezier(.16,1,.3,1), filter .6s ease; }
    .fx-cell:hover img, .fx-cell:focus-visible img { transform: scale(1.07); filter: brightness(.55); }
    .fx-cap { position: absolute; inset: 0; display: flex; flex-direction: column; justify-content: flex-end; padding: 1rem;
        background: linear-gradient(to top, rgba(5,8,22,.92) 0%, rgba(5,8,22,.25) 45%, transparent 70%); }
    .fx-more { max-height: 0; opacity: 0; overflow: hidden; transition: max-height .6s cubic-bezier(.16,1,.3,1), opacity .5s ease, margin .5s ease; }
    .fx-cell:hover .fx-more, .fx-cell:focus-visible .fx-more { max-height: 5.5rem; opacity: 1; margin-top: .4rem; }
    .fx-cell::after { content: ''; position: absolute; left: 0; right: 0; bottom: 0; height: 2px; background: linear-gradient(90deg, #c9a24b, #f3d98f, #c9a24b);
        transform: scaleX(0); transform-origin: left; transition: transform .8s cubic-bezier(.16,1,.3,1); }
    .fx-cell:hover::after, .fx-cell:focus-visible::after { transform: scaleX(1); }
    .fx-cell:focus-visible { box-shadow: inset 0 0 0 2px #e8c46e; }
    @media (hover: none) { .fx-more { max-height: 5.5rem; opacity: 1; margin-top: .4rem; } .fx-cell img { filter: brightness(.7); } }
    @media (prefers-reduced-motion: reduce) { .fx-cell img, .fx-more, .fx-cell::after { transition: none !important; } }
</style>

<section class="relative overflow-hidden py-24 md:py-28 min-h-[80vh]"
    style="background: radial-gradient(ellipse 60% 40% at 50% 0%, rgba(30,64,175,.22), transparent 70%), linear-gradient(#050816, #03060f);"
    x-data="facGallery()" x-effect="document.body.style.overflow = sel !== null ? 'hidden' : ''">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 relative">
        <div class="text-center max-w-2xl mx-auto mb-12" data-aos="fade-up">
            <div class="flex items-center justify-center gap-3 mb-5">
                <span class="h-px w-7 bg-[#e8c46e]/70"></span>
                <span class="text-[#e8c46e] font-semibold text-[11px] tracking-[0.25em] uppercase">{{ $set('facilities_page_eyebrow', 'Fasilitas') }}</span>
                <span class="h-px w-7 bg-[#e8c46e]/70"></span>
            </div>
            <h1 class="fx-serif text-4xl md:text-5xl font-semibold text-white tracking-tight">{{ $set('facilities_page_title', 'Fasilitas SMK Infokom Bogor') }}</h1>
            <p class="text-slate-400 mt-4 text-sm md:text-base">{{ $set('facilities_page_subtitle', 'Sarana dan prasarana yang mendukung proses belajar mengajar.') }}</p>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-1" data-aos="fade-up">
            @forelse($facilities as $i => $facility)
                @php $hasGallery = isset($galleryData[$facility->id]); @endphp
                <div class="fx-cell aspect-[4/3] {{ $facility->photo ? 'cursor-zoom-in' : '' }}"
                    @if($hasGallery)
                        @click="open({{ $facility->id }})" @keydown.enter.prevent="open({{ $facility->id }})" @keydown.space.prevent="open({{ $facility->id }})"
                        role="button" tabindex="0" aria-label="Lihat {{ count($galleryData[$facility->id]['photos']) }} foto {{ $facility->name }}"
                    @elseif($facility->photo)
                        data-lightbox-src="{{ asset('storage/' . $facility->photo) }}"
                        data-lightbox-caption="{{ $facility->name }}"
                        data-lightbox-meta="{{ $facility->quantity ? $facility->quantity . ' unit' : '' }}"
                        role="button" tabindex="0" aria-label="Perbesar foto {{ $facility->name }}"
                    @endif>
                    @if($facility->photo)
                        <img src="{{ asset('storage/' . $facility->photo) }}" alt="{{ $facility->name }}" loading="lazy">
                    @else
                        <div class="w-full h-full grid place-items-center text-4xl bg-gradient-to-br from-navy-800 to-navy-900">🏫</div>
                    @endif

                    @if($hasGallery)
                        <span class="absolute top-2 right-2 z-10 inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-white/90 text-navy-800 text-[10px] font-semibold ring-1 ring-[#c9a24b]/60">
                            <svg class="w-3 h-3 text-[#9a7318]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4-4a3 3 0 014 0l4 4m-2-2l1-1a3 3 0 014 0l2 2M4 6h16v12H4z"/></svg>
                            {{ count($galleryData[$facility->id]['photos']) }} foto
                        </span>
                    @endif

                    <div class="fx-cap">
                        <p class="fx-serif text-white font-medium text-[15px] leading-tight">{{ $facility->name }}</p>
                        @if($facility->quantity)
                            <p class="text-[11px] text-[#e8c46e] font-semibold mt-1">{{ $facility->quantity }} unit</p>
                        @endif
                        <p class="fx-more text-slate-300 text-xs leading-relaxed line-clamp-3">{{ $facility->description ?: 'Fasilitas ini mendukung kegiatan belajar mengajar siswa SMK Infokom Bogor.' }}</p>
                    </div>
                </div>
            @empty
                <p class="text-slate-400 text-sm col-span-full text-center py-10">Data belum tersedia.</p>
            @endforelse
        </div>
    </div>

    <!-- Galeri foto fasilitas -->
    <div x-show="sel !== null" x-cloak
        x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
        @keydown.escape.window="close()" @keydown.arrow-right.window="sel !== null && step(1)" @keydown.arrow-left.window="sel !== null && step(-1)"
        class="fixed inset-0 z-[90] flex items-center justify-center p-3 sm:p-6" role="dialog" aria-modal="true" aria-label="Galeri foto fasilitas">
        <div class="absolute inset-0 bg-black/90 backdrop-blur-md" @click="close()"></div>

        <template x-if="cur">
            <div class="relative w-full max-w-5xl flex flex-col max-h-full">
                <div class="flex items-end justify-between gap-4 mb-3 px-1">
                    <div class="min-w-0">
                        <p class="fx-serif text-white font-medium text-xl leading-tight truncate" x-text="cur.name"></p>
                        <p class="text-xs text-[#e8c46e] font-semibold mt-0.5" x-show="cur.meta" x-text="cur.meta"></p>
                    </div>
                    <div class="flex items-center gap-3 shrink-0">
                        <p class="text-xs text-slate-300 tabular-nums"><span x-text="idx + 1"></span> / <span x-text="cur.photos.length"></span></p>
                        <button type="button" @click="close()" aria-label="Tutup" class="h-10 w-10 rounded-full bg-white/10 ring-1 ring-white/20 grid place-items-center text-white hover:bg-white/20 transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                        </button>
                    </div>
                </div>

                <div class="relative rounded-xl overflow-hidden bg-black/40 ring-1 ring-[#c9a24b]/40 flex items-center justify-center" style="height: min(68vh, 640px);">
                    <img :src="cur.photos[idx]" :alt="cur.name + ' foto ' + (idx + 1)" class="max-w-full max-h-full object-contain select-none">
                    <button type="button" @click="step(-1)" aria-label="Foto sebelumnya" class="absolute left-3 top-1/2 -translate-y-1/2 h-11 w-11 rounded-full bg-white/90 text-navy-800 grid place-items-center shadow-lg hover:bg-white transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5l-7 7 7 7"/></svg>
                    </button>
                    <button type="button" @click="step(1)" aria-label="Foto berikutnya" class="absolute right-3 top-1/2 -translate-y-1/2 h-11 w-11 rounded-full bg-white/90 text-navy-800 grid place-items-center shadow-lg hover:bg-white transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </button>
                </div>

                <div class="flex gap-2 mt-3 overflow-x-auto pb-1 justify-center">
                    <template x-for="(p, n) in cur.photos" :key="n">
                        <button type="button" @click="idx = n" :aria-label="'Foto ' + (n + 1)"
                            class="shrink-0 h-14 w-20 rounded-lg overflow-hidden ring-2 transition"
                            :class="idx === n ? 'ring-[#e8c46e] opacity-100' : 'ring-transparent opacity-50 hover:opacity-90'">
                            <img :src="p" alt="" class="w-full h-full object-cover">
                        </button>
                    </template>
                </div>
            </div>
        </template>
    </div>
</section>

@push('scripts')
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('facGallery', () => ({
            galleries: {{ \Illuminate\Support\Js::from((object) $galleryData) }},
            sel: null,
            idx: 0,
            get cur() { return this.sel !== null ? this.galleries[this.sel] : null; },
            open(id) { this.sel = id; this.idx = 0; },
            close() { this.sel = null; },
            step(d) {
                if (!this.cur) return;
                const n = this.cur.photos.length;
                this.idx = (this.idx + d + n) % n;
            },
        }));
    });
</script>
@endpush
@endsection