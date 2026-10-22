<!-- BERITA — STACKED DECK + TIDY TOGGLE -->
<style>
    @keyframes newsRing { to { transform: translate(-50%, -50%) rotate(360deg); } }
    .news-ring { animation: newsRing 120s linear infinite; }
    @media (prefers-reduced-motion: reduce) { .news-ring { animation: none; } }
</style>
<div class="relative overflow-hidden bg-gradient-to-b from-white via-navy-100/60 to-white">
    <div class="pointer-events-none absolute inset-0" style="background-image: radial-gradient(circle, rgba(30,64,175,.38) 1.5px, transparent 1.5px); background-size: 26px 26px; -webkit-mask-image: radial-gradient(ellipse 70% 60% at 50% 55%, #000 20%, transparent 80%); mask-image: radial-gradient(ellipse 70% 60% at 50% 55%, #000 20%, transparent 80%);"></div>
    <div class="pointer-events-none absolute left-1/2 top-[58%] -translate-x-1/2 -translate-y-1/2 w-[52rem] h-[52rem] rounded-full" style="background: radial-gradient(circle, rgba(232,180,80,.50), rgba(232,196,110,.18) 45%, transparent 68%);"></div>
    <div class="pointer-events-none absolute left-1/2 top-[58%] -translate-x-1/2 -translate-y-1/2 w-[30rem] h-[30rem] rounded-full border-[1.5px] border-navy-900/[0.20] hidden md:block"></div>
    <div class="pointer-events-none absolute left-1/2 top-[58%] -translate-x-1/2 -translate-y-1/2 w-[46rem] h-[46rem] rounded-full border-[1.5px] border-navy-900/[0.15] hidden md:block"></div>
    <div class="news-ring pointer-events-none absolute left-1/2 top-[58%] w-[62rem] h-[62rem] rounded-full border-2 border-dashed border-amber-600/55 hidden lg:block" style="transform: translate(-50%, -50%);"></div>
    <p class="hidden lg:block pointer-events-none select-none absolute left-1/2 -translate-x-1/2 bottom-2 font-serif italic text-[13rem] leading-none text-navy-900/[0.09] whitespace-nowrap">Berita</p>
    <section class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <div class="flex items-end justify-between gap-6 mb-10" data-aos="fade-up">
        <div>
            <div class="flex items-center gap-3 mb-4">
                <span class="h-px w-9 bg-amber-600/60"></span>
                <span class="text-amber-700 font-semibold text-[11px] tracking-[0.25em] uppercase">{{ $set('home_news_eyebrow', 'Berita') }}</span>
            </div>
            <h2 class="font-serif text-3xl md:text-[2.75rem] leading-tight text-navy-900">{{ $set('home_news_title', 'Berita Terbaru') }}</h2>
            <p class="mt-3 text-slate-500 text-sm max-w-md">{{ $set('home_news_subtitle', 'Kabar dan cerita terkini dari lingkungan SMK Infokom Bogor.') }}</p>
        </div>
        <a href="{{ route('news.index') }}" class="group hidden sm:inline-flex items-center gap-2 text-navy-800 font-semibold text-sm shrink-0 pb-1 relative">
            Lihat Semua
            <span class="transition-transform duration-300 group-hover:translate-x-1">&rarr;</span>
            <span class="absolute left-0 right-0 bottom-0 h-px bg-navy-900/20"></span>
            <span class="absolute left-0 bottom-0 h-px w-0 bg-amber-600 transition-all duration-500 group-hover:w-full"></span>
        </a>
    </div>

    @if($latestNews->count())
        @php
            $newsStack = [
                ['top' => '6%',  'left' => '6%',  'w' => '32%', 'rot' => '-7deg', 'z' => 1],
                ['top' => '0%',  'left' => '34%', 'w' => '34%', 'rot' => '0deg',  'z' => 3],
                ['top' => '6%',  'left' => '62%', 'w' => '32%', 'rot' => '7deg',  'z' => 2],
            ];
            $newsTidy = [];
            foreach ($latestNews as $i => $n) {
                $newsTidy[] = ['top' => '0%', 'left' => ($i * 34) . '%', 'w' => '32%', 'rot' => '0deg', 'z' => 1];
            }
        @endphp
        <div x-data="{ tidy: false }" class="relative">
            <div class="relative mx-auto max-w-md md:max-w-2xl h-[560px] sm:h-[380px] md:h-[400px]">
                @foreach($latestNews as $i => $news)
                    @php $sp = $newsStack[$i % 3]; $tp = $newsTidy[$i]; @endphp
                    <a href="{{ $news->instagram_url ?: route('news.show', $news->slug) }}" @if($news->instagram_url) target="_blank" rel="noopener" @endif
                        data-aos="fade-up" data-aos-delay="{{ $i * 100 }}"
                        class="group absolute block overflow-hidden rounded-none border-2 border-slate-900 bg-white hover:shadow-2xl transition-all duration-700 ease-in-out"
                        :style="tidy
                            ? 'top:{{ $tp['top'] }}; left:{{ $tp['left'] }}; width:{{ $tp['w'] }}; transform: rotate(0deg); z-index:1;'
                            : 'top:{{ $sp['top'] }}; left:{{ $sp['left'] }}; width:{{ $sp['w'] }}; transform: rotate({{ $sp['rot'] }}); z-index:{{ $sp['z'] }};'">
                        <div class="reveal-mask tilt-3d aspect-[4/5] bg-navy-50 overflow-hidden" data-tilt-strength="7" data-tilt-scale="1.04">
                            @if($news->thumbnail)
                                <img src="{{ asset('storage/' . $news->thumbnail) }}" class="reveal-img w-full h-full object-cover object-top" alt="{{ $news->title }}">
                            @else
                                <div class="w-full h-full grid place-items-center text-navy-200 text-3xl">📰</div>
                            @endif
                        </div>
                        <div class="p-4 md:p-5 bg-white">
                            <div class="flex items-center gap-2 mb-1.5">
                                <p class="text-xs text-slate-400">{{ $news->published_at?->translatedFormat('d F Y') }}</p>
                                @if($news->instagram_url)
                                    <span class="text-[10px] font-semibold px-2 py-0.5 bg-navy-50 text-navy-700">Instagram</span>
                                @endif
                            </div>
                            <p class="font-semibold text-navy-800 line-clamp-2 group-hover:text-navy-600 transition text-sm md:text-base">{{ $news->title }}</p>
                        </div>
                    </a>
                @endforeach
            </div>
            <div class="text-center mt-8">
                <button @click="tidy = !tidy" type="button" class="ripple-btn ripple-dark inline-flex items-center gap-2 px-6 py-3 rounded-full border-2 border-slate-900 bg-white text-navy-800 font-semibold text-sm hover:bg-slate-50 transition">
                    <svg class="w-4 h-4 transition-transform duration-500" :class="tidy && 'rotate-180'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                    <span x-text="tidy ? 'Tumpuk Ulang' : 'Rapikan Tampilan'"></span>
                </button>
            </div>
        </div>
    @else
        <p class="text-slate-400 text-sm">Belum ada berita.</p>
    @endif
</section>
</div>