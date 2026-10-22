<!-- HERO -->
@php
    $heroTitle = trim((string) $set('hero_title', 'Membangun Generasi Digital yang Kreatif, Kompeten, dan Berkarakter'));
    $heroLead = $heroTitle; $heroAccent = '';
    if (($pos = mb_stripos($heroTitle, ' yang ')) !== false) {
        $heroLead = mb_substr($heroTitle, 0, $pos + 5);
        $heroAccent = mb_substr($heroTitle, $pos + 6);
    }
@endphp
<section class="relative overflow-hidden" style="background: linear-gradient(165deg, #0a1a44 0%, #12338a 38%, #1d4ed8 70%, #0ea5e9 100%);">
    <div class="pointer-events-none absolute inset-0" style="background-image: linear-gradient(rgba(255,255,255,.08) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,.08) 1px, transparent 1px); background-size: 41px 41px; -webkit-mask-image: radial-gradient(ellipse 85% 75% at 50% 30%, #000 25%, transparent 85%); mask-image: radial-gradient(ellipse 85% 75% at 50% 30%, #000 25%, transparent 85%);"></div>
    <div class="blob absolute -top-24 -right-24 w-96 h-96 rounded-full bg-sky-300/30 blur-3xl pointer-events-none"></div>
    <div class="blob-slow absolute top-1/3 -left-32 w-80 h-80 rounded-full bg-indigo-300/25 blur-3xl pointer-events-none"></div>
    <div class="pointer-events-none absolute inset-0" style="background: radial-gradient(ellipse 55% 60% at 82% 18%, rgba(125,211,252,.30), transparent 62%), radial-gradient(ellipse 60% 55% at 6% 100%, rgba(10,26,68,.55), transparent 65%);"></div>
    <p class="hidden lg:block absolute top-10 left-1/2 -translate-x-1/2 text-[14rem] font-extrabold text-white/[0.06] tracking-tighter select-none pointer-events-none leading-none">INFOKOM</p>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-16 pb-28 md:pt-24 md:pb-40 grid lg:grid-cols-2 gap-16 items-center relative">
        <div data-aos="fade-up">
            <span class="inline-flex items-center gap-2.5 px-4 py-1.5 rounded-full bg-white/80 backdrop-blur ring-1 ring-navy-900/10 text-navy-800 text-[11px] font-semibold tracking-[0.14em] uppercase mb-7 shadow-sm">
                <span class="h-1.5 w-1.5 rounded-full bg-amber-500"></span>
                SMK Infokom Bogor &middot; Terakreditasi A
            </span>
            <h1 class="text-4xl md:text-[3.4rem] font-bold text-white leading-[1.1] tracking-tight">
                {{ $heroLead }}
                @if($heroAccent)
                    <span class="font-serif italic font-medium text-amber-300">{{ $heroAccent }}</span>
                @endif
            </h1>
            <div class="mt-6 h-px w-16 bg-gradient-to-r from-amber-500 to-transparent"></div>
            <p class="mt-6 text-sky-100/85 text-lg leading-relaxed max-w-lg">
                {{ $set('hero_subtitle') }}
            </p>
            <div class="mt-9 flex flex-wrap gap-4">
                <a href="{{ route('programs.index') }}" class="group magnetic-btn inline-flex items-center gap-2 px-7 py-4 rounded-full bg-amber-400 text-navy-900 font-bold hover:bg-amber-300 transition shadow-xl shadow-black/30">
                    Lihat Program Keahlian <span class="transition-transform duration-300 group-hover:translate-x-1">&rarr;</span>
                </a>
                <a href="#tentang" class="magnetic-btn px-7 py-4 rounded-full bg-white/10 backdrop-blur ring-1 ring-white/40 text-white font-semibold hover:bg-white/20 transition">
                    Jelajahi Sekolah
                </a>
            </div>
        </div>

        <div data-aos="fade-left" data-aos-delay="150" class="relative max-w-lg lg:max-w-none mx-auto w-full">
            <div class="absolute -inset-3 rounded-[2rem] border border-amber-400/35 pointer-events-none"></div>
            <div class="absolute -top-3 -left-3 w-10 h-10 border-t-2 border-l-2 border-amber-500 rounded-tl-[1.6rem] pointer-events-none"></div>
            <div class="absolute -bottom-3 -right-3 w-10 h-10 border-b-2 border-r-2 border-amber-500 rounded-br-[1.6rem] pointer-events-none"></div>
            <div class="reveal-mask relative rounded-[1.5rem] overflow-hidden shadow-2xl shadow-black/40 bg-navy-100 aspect-[6/5] max-h-[440px] ring-1 ring-slate-900/10">
                @if($set('hero_image'))
                    <img data-parallax="0.08" src="{{ asset('storage/' . $set('hero_image')) }}" class="reveal-img w-full h-full object-cover object-top scale-110" alt="SMK Infokom Bogor">
                @else
                    <div class="w-full h-full bg-gradient-to-br from-navy-700 to-sky-500 grid place-items-center text-white/70 text-sm text-center px-6">
                        Foto sekolah belum diunggah — atur di Dashboard Admin
                    </div>
                @endif
            </div>

            <div class="float-card absolute -bottom-7 -left-4 sm:-left-8 flex divide-x divide-navy-900/10 rounded-2xl bg-white/85 backdrop-blur-xl ring-1 ring-navy-900/10 shadow-xl shadow-navy-900/10">
                <div class="px-5 py-3.5">
                    <p class="font-serif text-2xl text-navy-900 leading-none">{{ $set('akreditasi', 'A') }}</p>
                    <p class="text-[10px] uppercase tracking-wider text-slate-400 mt-1.5">Akreditasi</p>
                </div>
                <div class="px-5 py-3.5">
                    <p class="font-serif text-2xl text-navy-900 leading-none">{{ $programs->count() }}</p>
                    <p class="text-[10px] uppercase tracking-wider text-slate-400 mt-1.5">Program Keahlian</p>
                </div>
            </div>
        </div>
    </div>

    <!-- WAVES BRUSH: tepi bawah bergelombang bergaya sapuan kuas -->
    <style>
        @keyframes waveDriftA { 0%,100% { transform: translateX(-24px); } 50% { transform: translateX(24px); } }
        @keyframes waveDriftB { 0%,100% { transform: translateX(20px); } 50% { transform: translateX(-20px); } }
        .wave-a { animation: waveDriftA 11s ease-in-out infinite; }
        .wave-b { animation: waveDriftB 15s ease-in-out infinite; }
        @media (prefers-reduced-motion: reduce) { .wave-a, .wave-b { animation: none; } }
    </style>
    <svg class="pointer-events-none absolute bottom-0 left-0 w-full h-24 md:h-32 lg:h-40 z-0" viewBox="0 0 1440 160" preserveAspectRatio="none" aria-hidden="true">
        <defs>
            <linearGradient id="brushGold" x1="0" x2="1" y1="0" y2="0">
                <stop offset="0" stop-color="#fbbf24" stop-opacity="0"/>
                <stop offset=".16" stop-color="#fbbf24" stop-opacity=".95"/>
                <stop offset=".82" stop-color="#f59e0b" stop-opacity=".9"/>
                <stop offset="1" stop-color="#f59e0b" stop-opacity="0"/>
            </linearGradient>
            <!-- tepi kasar seperti bulu kuas -->
            <filter id="brushRough" x="-2%" y="-25%" width="104%" height="150%">
                <feTurbulence type="fractalNoise" baseFrequency="0.011 0.085" numOctaves="3" seed="7" result="noise"/>
                <feDisplacementMap in="SourceGraphic" in2="noise" scale="15" xChannelSelector="R" yChannelSelector="G"/>
            </filter>
        </defs>
        <g class="wave-a"><path d="M-60,78 C200,122 420,118 640,86 C860,54 1060,60 1250,88 C1350,102 1440,100 1500,92 L1500,200 L-60,200 Z" fill="#ffffff" fill-opacity=".13"/></g>
        <g class="wave-b"><path d="M-60,108 C240,64 480,74 720,104 C960,134 1200,118 1500,84 L1500,200 L-60,200 Z" fill="#bae6fd" fill-opacity=".34"/></g>
        <path filter="url(#brushRough)" d="M0,98 C160,42 340,42 520,82 C700,122 900,138 1090,98 C1260,62 1360,56 1440,78 L1440,200 L0,200 Z" fill="#ffffff"/>
        <path d="M0,93 C160,37 340,37 520,77 C700,117 900,133 1090,93 C1260,57 1360,51 1440,73" fill="none" stroke="url(#brushGold)" stroke-width="2.5" stroke-linecap="round" vector-effect="non-scaling-stroke"/>
        <path d="M70,84 C190,54 320,52 450,72" fill="none" stroke="#ffffff" stroke-opacity=".75" stroke-width="3.5" stroke-linecap="round" vector-effect="non-scaling-stroke"/>
        <path d="M150,70 C230,52 310,50 390,60" fill="none" stroke="#ffffff" stroke-opacity=".45" stroke-width="2" stroke-linecap="round" vector-effect="non-scaling-stroke"/>
        <path d="M940,116 C1020,112 1100,98 1180,80" fill="none" stroke="#ffffff" stroke-opacity=".6" stroke-width="3" stroke-linecap="round" stroke-dasharray="64 12 24 10" vector-effect="non-scaling-stroke"/>
        <path d="M1190,66 C1260,52 1330,48 1400,58" fill="none" stroke="#fbbf24" stroke-opacity=".55" stroke-width="4" stroke-linecap="round" vector-effect="non-scaling-stroke"/>
    </svg>
</section>