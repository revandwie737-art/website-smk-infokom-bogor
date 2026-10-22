<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $seoTitle ?? (isset($title) ? $title . ' - ' . App\Models\SchoolSetting::get('site_name', 'SMK Infokom Bogor') : App\Models\SchoolSetting::get('seo_title', 'SMK Infokom Bogor')) }}</title>
    <meta name="description" content="{{ $seoDescription ?? App\Models\SchoolSetting::get('seo_description', '') }}">
    <link rel="icon" href="{{ App\Models\SchoolSetting::get('site_favicon') ? asset('storage/' . App\Models\SchoolSetting::get('site_favicon')) : '' }}">

    <!-- Transisi pindah halaman (panel hitam jatuh). Script TANPA defer di head supaya tidak ada kilatan konten. -->
    <link rel="stylesheet" href="{{ asset('css/page-transition.css') }}">
    <script src="{{ asset('js/page-transition.js') }}"></script>

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        navy: { 50:'#eff6ff',100:'#dbeafe',200:'#bfdbfe',300:'#93c5fd',400:'#3b82f6',500:'#2563eb',600:'#1d4ed8',700:'#1e40af',800:'#172554',900:'#0f172a',950:'#020617' },
                        sky: { 50:'#eff6ff',100:'#dbeafe',200:'#bfdbfe',300:'#7dd3fc',400:'#38bdf8',500:'#0ea5e9' },
                    },
                    fontFamily: { sans: ['"Plus Jakarta Sans"', 'system-ui', 'sans-serif'], serif: ['"Playfair Display"', '"Fraunces"', 'ui-serif', 'Georgia', 'serif'] },
                }
            }
        }
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Playfair+Display:ital,wght@0,500;0,600;0,700;0,800;1,500;1,600;1,700&family=Fraunces:ital,opsz,wght@0,9..144,300;0,9..144,500;0,9..144,600;1,9..144,400;1,9..144,500&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <style>
        [x-cloak] { display: none !important; }
        body { font-family: 'Plus Jakarta Sans', system-ui, sans-serif; }
        .counter { transition: all .3s; }
        ::selection { background: #e2e8f0; }
        html { scroll-behavior: smooth; }

        /* ===== Tipografi serif: Playfair Display, judul lebih tebal di seluruh situs ===== */
        .font-serif { font-weight: 600; letter-spacing: -.005em; }
        .font-serif.font-light, .font-serif.font-normal, .font-serif.font-medium { font-weight: 600 !important; }
        .font-serif.font-semibold { font-weight: 600; }
        .font-serif.font-bold { font-weight: 700; }
        p.font-serif { font-weight: 500 !important; }

        /* ===== Premium interaction toolkit (site-wide) ===== */
        .magnetic-btn { display: inline-flex; transition: transform .25s cubic-bezier(.2,.8,.2,1); }
        .gradient-text { background: linear-gradient(100deg, #172554, #1d4ed8 45%, #0ea5e9); -webkit-background-clip: text; background-clip: text; color: transparent; }
        .reveal-mask { position: relative; overflow: hidden; }
        .reveal-mask .reveal-img { transform: scale(1.15); opacity: 0; transition: transform 1.1s cubic-bezier(.16,1,.3,1), opacity .9s ease; }
        .reveal-mask.aos-animate .reveal-img, .reveal-mask.in-view .reveal-img { transform: scale(1); opacity: 1; }
        .float-card { animation: floatCard 6s ease-in-out infinite; }
        @keyframes floatCard { 0%,100% { transform: translateY(0); } 50% { transform: translateY(-10px); } }
        .arch { border-radius: 999px 999px 24px 24px; }
        .tilt-hover { transition: transform .35s ease, box-shadow .35s ease; }
        .tilt-hover:hover { transform: perspective(800px) rotateX(2deg) rotateY(-2deg) translateY(-6px); }

        /* ===== Real 3D tilt system (mouse-tracking) — site-wide photo upgrade ===== */
        .tilt-3d {
            transform-style: preserve-3d;
            transition: transform .7s cubic-bezier(.22,1,.36,1), box-shadow .5s ease;
            will-change: transform;
        }
        .tilt-3d.is-tilting { transition: transform .08s linear, box-shadow .3s ease; }
        .tilt-3d.is-tilting { box-shadow: 0 30px 55px -18px rgba(15,23,42,.4); }
        .tilt-shine {
            position: absolute; inset: 0; border-radius: inherit; pointer-events: none;
            opacity: 0; transition: opacity .4s ease; mix-blend-mode: overlay; z-index: 6;
        }
        .tilt-3d.is-tilting > .tilt-shine { opacity: 1; }
        @media (prefers-reduced-motion: reduce), (hover: none) and (pointer: coarse) {
            .tilt-3d { transition: transform .35s ease !important; }
        }

        /* Partner logo badges: bigger, smoother, grayscale-to-color reveal */
        .partner-badge { transition: transform .5s cubic-bezier(.22,1,.36,1), box-shadow .5s cubic-bezier(.22,1,.36,1); }
        .partner-badge:hover { transform: translateY(-6px) scale(1.08); box-shadow: 0 22px 40px -14px rgba(15,23,42,.25); }
        .partner-badge img { filter: grayscale(65%) opacity(0.85); transition: filter .5s ease, transform .6s cubic-bezier(.22,1,.36,1); }
        .partner-badge:hover img { filter: grayscale(0%) opacity(1); transform: scale(1.1); }
        .split-line { display: inline-block; overflow: hidden; }
        .bento-cell { transition: transform .35s cubic-bezier(.2,.8,.2,1), box-shadow .35s ease; }
        .bento-cell:hover { transform: translateY(-6px); box-shadow: 0 24px 48px -18px rgba(15,23,42,.25); }
        .hscroll { display: flex; overflow-x: auto; scroll-snap-type: x mandatory; scrollbar-width: none; }
        .hscroll::-webkit-scrollbar { display: none; }
        .hscroll > * { scroll-snap-align: start; }
        .cursor-glow { position: fixed; width: 380px; height: 380px; border-radius: 999px; pointer-events: none; z-index: 1; background: radial-gradient(circle, rgba(212,175,55,.16), transparent 70%); transform: translate(-50%,-50%); transition: opacity .3s ease; opacity: 0; }

        @keyframes floatBlob {
            0%, 100% { transform: translate(0, 0) scale(1); }
            33% { transform: translate(20px, -30px) scale(1.05); }
            66% { transform: translate(-15px, 15px) scale(0.97); }
        }
        .blob { animation: floatBlob 12s ease-in-out infinite; }
        .blob-slow { animation: floatBlob 18s ease-in-out infinite; animation-delay: -4s; }

        a, button { transition: transform .2s ease, background-color .2s ease, color .2s ease, box-shadow .2s ease, border-color .2s ease; }
        a.hover-lift:hover, .hover-lift:hover { transform: translateY(-4px); }

        @keyframes shimmer {
            0% { background-position: -200% 0; }
            100% { background-position: 200% 0; }
        }
        .badge-shimmer {
            background: linear-gradient(90deg, #f1f5f9 25%, #e2e8f0 50%, #f1f5f9 75%);
            background-size: 200% 100%;
            animation: shimmer 3s linear infinite;
        }

        @keyframes marquee {
            from { transform: translateX(0); }
            to { transform: translateX(-50%); }
        }
        .marquee-track {
            display: flex;
            width: max-content;
            animation: marquee 32s linear infinite;
        }
        .marquee-container:hover .marquee-track { animation-play-state: paused; }
        .marquee-container {
            overflow: hidden;
            -webkit-mask-image: linear-gradient(90deg, transparent, black 5%, black 95%, transparent);
            mask-image: linear-gradient(90deg, transparent, black 5%, black 95%, transparent);
        }

        @media (prefers-reduced-motion: reduce) {
            * { animation: none !important; transition: none !important; }
        }

        /* Site-wide polish additions */
        ::-webkit-scrollbar { width: 10px; height: 10px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 999px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
        html { scrollbar-color: #cbd5e1 transparent; }

        a.hover-lift:hover, .hover-lift:hover { box-shadow: 0 20px 40px -12px rgba(15,23,42,.15); }

        #scroll-progress { position: fixed; top: 0; left: 0; height: 3px; background: linear-gradient(90deg, #0ea5e9, #1e40af); z-index: 60; width: 0%; transition: width .1s ease-out; }

        #scroll-top-btn { position: fixed; bottom: 24px; right: 24px; z-index: 50; width: 46px; height: 46px; border-radius: 999px; background: #172554; color: #fff; display: grid; place-items: center; box-shadow: 0 10px 30px -8px rgba(23,37,84,.5); opacity: 0; pointer-events: none; transform: translateY(12px); transition: opacity .3s ease, transform .3s ease, background-color .2s ease; }
        #scroll-top-btn.visible { opacity: 1; pointer-events: auto; transform: translateY(0); }
        #scroll-top-btn:hover { background: #1e40af; }

        .link-underline { position: relative; }
        .link-underline::after { content: ''; position: absolute; left: 0; bottom: -2px; width: 0; height: 2px; background: currentColor; transition: width .25s ease; }
        .link-underline:hover::after { width: 100%; }

        .glass-nav { backdrop-filter: blur(14px) saturate(160%); -webkit-backdrop-filter: blur(14px) saturate(160%); }

        /* ===== Cinematic / storytelling upgrade toolkit ===== */
        [data-parallax] { will-change: transform; }

        /* Scroll storytelling chapters */
        .story-chapter { opacity: .35; transform: translateY(14px); transition: opacity .6s ease, transform .6s ease; }
        .story-chapter.is-active { opacity: 1; transform: translateY(0); }
        .story-dot { width: 8px; height: 8px; border-radius: 999px; background: #cbd5e1; transition: all .4s ease; }
        .story-dot.is-active { background: #0ea5e9; width: 24px; }

        /* Interactive journey / timeline */
        .journey-track { position: relative; }
        .journey-line { position: absolute; left: 27px; top: 0; bottom: 0; width: 2px; background: #e2e8f0; }
        .journey-line-fill { position: absolute; left: 0; top: 0; width: 100%; height: 0%; background: linear-gradient(180deg,#0ea5e9,#172554); transition: height .2s linear; }
        .journey-node { transition: transform .35s cubic-bezier(.2,.8,.2,1), background-color .35s ease, box-shadow .35s ease; }
        .journey-step.is-active .journey-node { transform: scale(1.15); background: #172554; box-shadow: 0 0 0 6px rgba(23,37,84,.12); }
        .journey-step { cursor: pointer; }
        .journey-step .journey-detail { max-height: 0; opacity: 0; overflow: hidden; transition: max-height .5s ease, opacity .4s ease; }
        .journey-step.is-open .journey-detail { max-height: 240px; opacity: 1; }

        /* Interactive facility flip cards */
        .flip-card { perspective: 1400px; }
        .flip-inner { position: relative; width: 100%; height: 100%; transition: transform .7s cubic-bezier(.2,.8,.2,1); transform-style: preserve-3d; }
        .flip-card:hover .flip-inner, .flip-card.is-flipped .flip-inner { transform: rotateY(180deg); }
        .flip-face { position: absolute; inset: 0; backface-visibility: hidden; -webkit-backface-visibility: hidden; border-radius: inherit; overflow: hidden; }
        .flip-back { transform: rotateY(180deg); }


        /* Ripple micro-interaction */
        .ripple-btn { position: relative; overflow: hidden; }
        .ripple-btn .ripple { position: absolute; border-radius: 999px; background: rgba(255,255,255,.55); transform: scale(0); animation: rippleAnim .6s ease-out forwards; pointer-events: none; }
        .ripple-btn.ripple-dark .ripple { background: rgba(23,37,84,.18); }
        @keyframes rippleAnim { to { transform: scale(2.6); opacity: 0; } }

        /* Horizontal scroll section affordance */
        .hscroll-cinematic { display: flex; gap: 1.25rem; overflow-x: auto; scroll-snap-type: x mandatory; scrollbar-width: none; padding-bottom: .5rem; }
        .hscroll-cinematic::-webkit-scrollbar { display: none; }
        .hscroll-cinematic > * { scroll-snap-align: start; flex-shrink: 0; }
        .hscroll-hint { animation: hscrollHint 1.8s ease-in-out infinite; }
        @keyframes hscrollHint { 0%,100% { transform: translateX(0); } 50% { transform: translateX(6px); } }

        @media (prefers-reduced-motion: reduce) {
            .flip-inner, .journey-node, .story-chapter { transition: none !important; }
        }

        /* Meteor shower (used on the no-photo featured news banner) */
        .meteor-field { position: absolute; inset: 0; overflow: hidden; }
        .meteor { position: absolute; top: -80px; width: 2px; height: 90px; background: linear-gradient(180deg, rgba(203,213,225,0.95), rgba(203,213,225,0)); transform: rotate(215deg); opacity: 0; animation: meteorFall linear infinite; }
        @keyframes meteorFall {
            0% { transform: translate(0, -10%) rotate(215deg); opacity: 0; }
            8% { opacity: 1; }
            70% { opacity: .6; }
            100% { transform: translate(-260px, 520px) rotate(215deg); opacity: 0; }
        }
    </style>
</head>
<body class="bg-white text-slate-700 antialiased">

    <div id="scroll-progress"></div>

    <!-- NAVBAR -->
    <header x-data="{ open: false, scrolled: false }" x-init="window.addEventListener('scroll', () => scrolled = window.scrollY > 20)"
        :class="scrolled ? 'bg-white/85 shadow-sm glass-nav' : 'bg-white/60 glass-nav'"
        class="fixed top-0 inset-x-0 z-50 transition-all duration-300 border-b border-slate-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div :class="scrolled ? 'h-14 md:h-16' : 'h-16 md:h-20'" class="flex items-center justify-between transition-all duration-300">
                <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                    @php $logo = \App\Models\SchoolSetting::get('site_logo'); @endphp
                    @if($logo)
                        <img src="{{ asset('storage/' . $logo) }}" class="h-10 w-10 rounded-full object-contain bg-white ring-1 ring-slate-100 transition-transform duration-300 group-hover:scale-110" alt="Logo">
                    @else
                        <div class="h-10 w-10 rounded-full bg-navy-700 text-white grid place-items-center font-bold transition-transform duration-300 group-hover:scale-110">SI</div>
                    @endif
                    <div class="leading-tight">
                        <p class="font-bold text-navy-800 text-sm md:text-base">SMK Infokom Bogor</p>
                        <p class="text-[11px] text-slate-400 hidden md:block">Terakreditasi A</p>
                    </div>
                </a>

                <nav class="hidden lg:flex items-center gap-7 text-sm font-medium text-slate-600">
                    <a href="{{ route('home') }}" class="hover:text-navy-700 transition">Beranda</a>
                    <a href="{{ route('programs.index') }}" class="hover:text-navy-700 transition">Program Keahlian</a>
                    <a href="{{ route('academic.index') }}" class="hover:text-navy-700 transition">Akademik</a>
                    <a href="{{ route('news.index') }}" class="hover:text-navy-700 transition">Berita</a>

                    <div class="relative" x-data="{ infoOpen: false }" @mouseleave="infoOpen = false">
                        <button @click="infoOpen = !infoOpen" @mouseenter="infoOpen = true" class="flex items-center gap-1 hover:text-navy-700 transition">
                            Informasi
                            <svg class="w-3.5 h-3.5 transition-transform" :class="infoOpen && 'rotate-180'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </button>
                        <div x-show="infoOpen"
                            x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 -translate-y-2 scale-95"
                            x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                            x-transition:leave="transition ease-in duration-200"
                            x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                            x-transition:leave-end="opacity-0 -translate-y-2 scale-95"
                            class="absolute top-full left-1/2 -translate-x-1/2 pt-3 w-[560px]" style="display:none">
                            <div class="relative bg-white/95 backdrop-blur-xl rounded-3xl shadow-2xl shadow-navy-900/20 border border-slate-900/10 p-3 grid grid-cols-2 gap-1 overflow-hidden">
                                <div class="absolute -top-10 -right-10 w-40 h-40 rounded-full bg-sky-100/60 blur-2xl pointer-events-none"></div>
                                @php
                                    $infoLinks = \App\Models\InfoMenuItem::forMenu();
                                @endphp
                                @foreach($infoLinks as $link)
                                    <a href="{{ str_starts_with($link->url, 'http') ? $link->url : url($link->url) }}" class="group relative flex items-start gap-3 px-4 py-3 rounded-2xl hover:bg-navy-50 transition-colors duration-200">
                                        <span class="shrink-0 h-10 w-10 rounded-xl bg-navy-50 group-hover:bg-white grid place-items-center text-lg group-hover:scale-110 group-hover:shadow-md transition-all duration-200">{{ $link->icon ?: '🔗' }}</span>
                                        <span>
                                            <span class="block text-sm font-semibold text-navy-800 group-hover:text-navy-900">{{ $link->label }}</span>
                                            @if($link->description)
                                                <span class="block text-xs text-slate-400 mt-0.5">{{ $link->description }}</span>
                                            @endif
                                        </span>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <a href="{{ route('ppdb.index') }}" class="hover:text-navy-700 transition">PPDB</a>
                    <a href="{{ route('contact.index') }}" class="hover:text-navy-700 transition">Kontak</a>
                </nav>

                <button @click="open = !open" class="lg:hidden p-2 rounded-lg text-navy-800">
                    <svg x-show="!open" class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                    <svg x-show="open" class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display:none"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
        </div>

        <div x-show="open" x-transition style="display:none" class="lg:hidden bg-white border-t border-slate-100 px-4 py-4 space-y-1">
            <a href="{{ route('home') }}" class="block py-2 text-slate-600">Beranda</a>
            <a href="{{ route('programs.index') }}" class="block py-2 text-slate-600">Program Keahlian</a>
            <a href="{{ route('academic.index') }}" class="block py-2 text-slate-600">Akademik</a>
            <a href="{{ route('news.index') }}" class="block py-2 text-slate-600">Berita</a>
            @foreach($infoLinks as $link)
                <a href="{{ str_starts_with($link->url, 'http') ? $link->url : url($link->url) }}" class="block py-2 text-slate-600">{{ $link->label }}</a>
            @endforeach
            <a href="{{ route('ppdb.index') }}" class="block py-2 text-slate-600">PPDB</a>
            <a href="{{ route('contact.index') }}" class="block py-2 text-slate-600">Kontak</a>
        </div>
    </header>

    <main class="pt-16 md:pt-20">
        @if(session('success'))
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
                <div class="rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 text-sm">
                    {{ session('success') }}
                </div>
            </div>
        @endif
        {{ $slot ?? '' }}
        @yield('content')
    </main>

    <!-- FOOTER -->
    <footer class="relative bg-navy-900 text-slate-300 overflow-hidden">
        <div class="absolute top-0 inset-x-0 h-px bg-gradient-to-r from-transparent via-sky-400/60 to-transparent"></div>
        <div class="blob-slow absolute -top-24 -left-24 w-80 h-80 rounded-full bg-sky-500/10 blur-3xl pointer-events-none"></div>
        <div class="blob absolute bottom-0 right-0 w-96 h-96 rounded-full bg-navy-700/30 blur-3xl pointer-events-none"></div>

        <!-- CTA strip -->
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-20 md:pt-24">
            <div class="rounded-3xl bg-gradient-to-r from-navy-800 to-navy-700 border border-white/10 p-8 md:p-10 flex flex-col md:flex-row items-center justify-between gap-6 shadow-2xl shadow-navy-900/40" data-aos="fade-up">
                <div>
                    <p class="text-white font-bold text-xl md:text-2xl">Siap bergabung dengan SMK Infokom Bogor?</p>
                    <p class="text-slate-400 text-sm mt-1">Daftarkan dirimu dan mulai perjalanan menuju karier impianmu.</p>
                </div>
                <a href="{{ route('ppdb.index') }}" class="ripple-btn magnetic-btn shrink-0 inline-flex items-center gap-2 px-7 py-3.5 rounded-full bg-white text-navy-800 font-bold hover:bg-slate-100 transition shadow-lg">
                    Daftar PPDB &rarr;
                </a>
            </div>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 grid grid-cols-1 md:grid-cols-4 gap-10">
            <div>
                <div class="flex items-center gap-2.5 mb-4">
                    <div class="h-10 w-10 rounded-xl bg-white/10 grid place-items-center">
                        @if(App\Models\SchoolSetting::get('site_logo'))
                            <img
                               src="{{ asset('storage/' . App\Models\SchoolSetting::get('site_logo')) }}"
                               class="h-6 w-6 object-contain"
                               alt="Logo SMK Infokom"
                            >
                        @else
                            <span class="text-white font-bold text-sm">SI</span>
                        @endif
                    </div>
                    <p class="text-white font-bold text-lg">SMK Infokom Bogor</p>
                </div>
                <p class="text-sm text-slate-400 leading-relaxed flex gap-2">
                    <svg class="w-4 h-4 shrink-0 mt-0.5 text-sky-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a2 2 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    <span>{{ App\Models\SchoolSetting::get('address') }}</span>
                </p>
            </div>
            <div>
                <p class="text-white font-semibold mb-4 text-sm tracking-wide uppercase">Sekolah</p>
                <ul class="space-y-2.5 text-sm text-slate-400">
                    <li><a href="{{ route('programs.index') }}" class="hover:text-white hover:translate-x-1 inline-block transition-all duration-200">Program Keahlian</a></li>
                    <li><a href="{{ route('news.index') }}" class="hover:text-white hover:translate-x-1 inline-block transition-all duration-200">Berita</a></li>
                    <li><a href="{{ route('gallery.index') }}" class="hover:text-white hover:translate-x-1 inline-block transition-all duration-200">Galeri</a></li>
                </ul>
            </div>
            <div>
                <p class="text-white font-semibold mb-4 text-sm tracking-wide uppercase">Informasi</p>
                <ul class="space-y-2.5 text-sm text-slate-400">
                    <li><a href="{{ route('academic.index') }}" class="hover:text-white hover:translate-x-1 inline-block transition-all duration-200">Akademik</a></li>
                    <li><a href="{{ route('ppdb.index') }}" class="hover:text-white hover:translate-x-1 inline-block transition-all duration-200">PPDB</a></li>
                    <li><a href="{{ route('agenda.index') }}" class="hover:text-white hover:translate-x-1 inline-block transition-all duration-200">Agenda</a></li>
                    <li><a href="{{ route('achievements.index') }}" class="hover:text-white hover:translate-x-1 inline-block transition-all duration-200">Prestasi</a></li>
                    <li><a href="{{ route('pkl.index') }}" class="hover:text-white hover:translate-x-1 inline-block transition-all duration-200">PKL</a></li>
                    <li><a href="{{ route('bkk.index') }}" class="hover:text-white hover:translate-x-1 inline-block transition-all duration-200">BKK</a></li>
                </ul>
            </div>
            <div>
                <p class="text-white font-semibold mb-4 text-sm tracking-wide uppercase">Kontak</p>
                <ul class="space-y-3 text-sm text-slate-400">
                    <li class="flex items-center gap-2.5">
                        <span class="h-8 w-8 rounded-lg bg-white/5 grid place-items-center shrink-0">
                            <svg class="w-4 h-4 text-sky-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                        </span>
                        {{ App\Models\SchoolSetting::get('phone') }}
                    </li>
                    <li class="flex items-center gap-2.5">
                        <span class="h-8 w-8 rounded-lg bg-white/5 grid place-items-center shrink-0">
                            <svg class="w-4 h-4 text-sky-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        </span>
                        {{ App\Models\SchoolSetting::get('email') }}
                    </li>
                </ul>
                @php
    $socials = [
        'facebook'  => \App\Models\SchoolSetting::get('facebook'),
        'instagram' => \App\Models\SchoolSetting::get('instagram'),
        'youtube'   => \App\Models\SchoolSetting::get('youtube'),
        'whatsapp'  => \App\Models\SchoolSetting::get('whatsapp'),
    ];
@endphp

@if(collect($socials)->filter()->isNotEmpty())
    <div class="flex gap-3 mt-5">
        @if($socials['facebook'])
            <a href="{{ $socials['facebook'] }}" target="_blank" rel="noopener" aria-label="Facebook" class="h-10 w-10 rounded-full bg-white/5 hover:bg-sky-500 grid place-items-center transition-all duration-200 hover:-translate-y-1 hover:shadow-lg hover:shadow-sky-500/30">
                <svg class="w-4 h-4 fill-white" viewBox="0 0 24 24"><path d="M22 12a10 10 0 10-11.6 9.9v-7H7.9V12h2.5V9.8c0-2.5 1.5-3.9 3.8-3.9 1.1 0 2.2.2 2.2.2v2.5h-1.3c-1.2 0-1.6.8-1.6 1.6V12h2.8l-.4 2.9h-2.4v7A10 10 0 0022 12z"/></svg>
            </a>
        @endif

        @if($socials['instagram'])
            <a href="{{ $socials['instagram'] }}" target="_blank" rel="noopener" aria-label="Instagram" class="h-10 w-10 rounded-full bg-white/5 hover:bg-gradient-to-tr hover:from-amber-500 hover:via-pink-600 hover:to-purple-600 grid place-items-center transition-all duration-200 hover:-translate-y-1 hover:shadow-lg">
                <svg class="w-4 h-4 fill-white" viewBox="0 0 24 24"><path d="M12 2.2c3.2 0 3.6 0 4.9.07 3.3.15 4.8 1.7 5 5C22 8.5 22 8.9 22 12s0 3.6-.07 4.9c-.15 3.3-1.7 4.8-5 5C15.6 22 15.2 22 12 22s-3.6 0-4.9-.07c-3.3-.15-4.8-1.7-5-5C2 15.6 2 15.2 2 12s0-3.6.07-4.9c.15-3.3 1.7-4.8 5-5C8.4 2.2 8.8 2.2 12 2.2zM12 7a5 5 0 100 10 5 5 0 000-10zm0 8.3a3.3 3.3 0 110-6.6 3.3 3.3 0 010 6.6zm5.2-8.5a1.2 1.2 0 100 2.4 1.2 1.2 0 000-2.4z"/></svg>
            </a>
        @endif

        @if($socials['youtube'])
            <a href="{{ $socials['youtube'] }}" target="_blank" rel="noopener" aria-label="YouTube" class="h-10 w-10 rounded-full bg-white/5 hover:bg-red-600 grid place-items-center transition-all duration-200 hover:-translate-y-1 hover:shadow-lg hover:shadow-red-600/30">
                <svg class="w-4 h-4 fill-white" viewBox="0 0 24 24"><path d="M23.5 6.2a3 3 0 00-2.1-2.1C19.5 3.6 12 3.6 12 3.6s-7.5 0-9.4.5A3 3 0 00.5 6.2C0 8.1 0 12 0 12s0 3.9.5 5.8a3 3 0 002.1 2.1c1.9.5 9.4.5 9.4.5s7.5 0 9.4-.5a3 3 0 002.1-2.1c.5-1.9.5-5.8.5-5.8s0-3.9-.5-5.8zM9.6 15.6V8.4l6.2 3.6-6.2 3.6z"/></svg>
            </a>
        @endif

        @if($socials['whatsapp'])
            <a href="https://wa.me/{{ preg_replace('/\D/', '', $socials['whatsapp']) }}" target="_blank" rel="noopener" aria-label="WhatsApp" class="h-10 w-10 rounded-full bg-white/5 hover:bg-emerald-500 grid place-items-center transition-all duration-200 hover:-translate-y-1 hover:shadow-lg hover:shadow-emerald-500/30">
                <svg class="w-4 h-4 fill-white" viewBox="0 0 24 24"><path d="M17.5 14.4c-.3-.1-1.7-.8-2-1-.3-.1-.5-.1-.6.1-.2.3-.7 1-.9 1.2-.2.2-.3.2-.6.1a8 8 0 01-2.3-1.4 8.6 8.6 0 01-1.6-2c-.2-.3 0-.5.1-.6l.4-.5.3-.4c.1-.2 0-.3 0-.5l-1-2.2c-.2-.5-.4-.4-.6-.4h-.5c-.2 0-.5.1-.7.3C7 7.4 6.4 8 6.4 9.4c0 1.4 1 2.7 1.1 2.9.1.2 2 3.1 4.9 4.3.7.3 1.2.5 1.6.6.7.2 1.3.2 1.8.1.5-.1 1.7-.7 2-1.4.2-.6.2-1.2.2-1.3-.1-.1-.3-.2-.5-.3zM12 2a10 10 0 00-8.6 15.1L2 22l5-1.3A10 10 0 1012 2z"/></svg>
            </a>
        @endif
    </div>
@endif
            </div>
        </div>
        <div class="relative border-t border-white/10 py-5 text-center text-xs text-slate-500">
            {{ App\Models\SchoolSetting::get('footer_copyright', '© ' . date('Y') . ' SMK Infokom Bogor') }}
        </div>
    </footer>

    <div class="cursor-glow hidden md:block" id="cursor-glow"></div>

    <button id="scroll-top-btn" aria-label="Kembali ke atas" onclick="window.scrollTo({top:0,behavior:'smooth'})">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" /></svg>
    </button>

    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script>
        AOS.init({ duration: 700, once: true, easing: 'ease-out-cubic' });

        // Scroll progress bar + scroll-to-top button
        const progressBar = document.getElementById('scroll-progress');
        const topBtn = document.getElementById('scroll-top-btn');
        window.addEventListener('scroll', () => {
            const h = document.documentElement;
            const scrolled = (h.scrollTop) / (h.scrollHeight - h.clientHeight) * 100;
            if (progressBar) progressBar.style.width = scrolled + '%';
            if (topBtn) topBtn.classList.toggle('visible', h.scrollTop > 400);
        }, { passive: true });

        // Cursor glow (desktop only, subtle)
        const glow = document.getElementById('cursor-glow');
        if (glow && window.matchMedia('(hover: hover)').matches) {
            window.addEventListener('mousemove', (e) => {
                glow.style.opacity = '1';
                glow.style.left = e.clientX + 'px';
                glow.style.top = e.clientY + 'px';
            }, { passive: true });
        }

        // Magnetic buttons: gently follow cursor within their bounds
        document.querySelectorAll('.magnetic-btn').forEach(btn => {
            btn.addEventListener('mousemove', (e) => {
                const r = btn.getBoundingClientRect();
                const x = e.clientX - r.left - r.width / 2;
                const y = e.clientY - r.top - r.height / 2;
                btn.style.transform = `translate(${x * 0.25}px, ${y * 0.3}px)`;
            });
            btn.addEventListener('mouseleave', () => { btn.style.transform = 'translate(0,0)'; });
        });

        // Reveal-mask images: play the zoom/fade reveal once visible
        const revealObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) { entry.target.classList.add('in-view'); revealObserver.unobserve(entry.target); }
            });
        }, { threshold: 0.2 });
        document.querySelectorAll('.reveal-mask').forEach(el => revealObserver.observe(el));

        // Animated counter
        function animateCounters() {
            document.querySelectorAll('[data-counter]').forEach(el => {
                const target = parseInt(el.getAttribute('data-counter'), 10) || 0;
                let started = false;
                const obs = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting && !started) {
                            started = true;
                            let current = 0;
                            const step = Math.max(target / 60, 1);
                            const tick = () => {
                                current += step;
                                if (current >= target) { el.textContent = target.toLocaleString('id-ID'); return; }
                                el.textContent = Math.floor(current).toLocaleString('id-ID');
                                requestAnimationFrame(tick);
                            };
                            tick();
                        }
                    });
                }, { threshold: 0.4 });
                obs.observe(el);
            });
        }
        document.addEventListener('DOMContentLoaded', animateCounters);

        // Parallax layers: [data-parallax="0.3"] moves slower/faster than scroll
        const parallaxEls = document.querySelectorAll('[data-parallax]');
        if (parallaxEls.length && !window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
            let ticking = false;
            const updateParallax = () => {
                const vh = window.innerHeight;
                parallaxEls.forEach(el => {
                    const speed = parseFloat(el.getAttribute('data-parallax')) || 0.15;
                    const rect = el.getBoundingClientRect();
                    const center = rect.top + rect.height / 2 - vh / 2;
                    el.style.transform = `translate3d(0, ${(-center * speed).toFixed(1)}px, 0)`;
                });
                ticking = false;
            };
            window.addEventListener('scroll', () => {
                if (!ticking) { requestAnimationFrame(updateParallax); ticking = true; }
            }, { passive: true });
            window.addEventListener('resize', updateParallax);
            updateParallax();
        }

        // Scroll storytelling: highlight active chapter + progress dots
        document.querySelectorAll('[data-story]').forEach(story => {
            const chapters = story.querySelectorAll('.story-chapter');
            const dots = story.querySelectorAll('.story-dot');
            if (!chapters.length) return;
            const storyObs = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    const idx = [...chapters].indexOf(entry.target);
                    if (entry.isIntersecting) {
                        chapters.forEach(c => c.classList.remove('is-active'));
                        entry.target.classList.add('is-active');
                        dots.forEach(d => d.classList.remove('is-active'));
                        if (dots[idx]) dots[idx].classList.add('is-active');
                    }
                });
            }, { threshold: 0.5, rootMargin: '-15% 0px -15% 0px' });
            chapters.forEach(c => storyObs.observe(c));
        });

        // Interactive journey: fill connecting line as steps scroll into view, click to expand detail
        document.querySelectorAll('.journey-track').forEach(track => {
            const fill = track.querySelector('.journey-line-fill');
            const steps = track.querySelectorAll('.journey-step');
            const journeyObs = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) entry.target.classList.add('is-active');
                });
                if (fill) {
                    const activeCount = [...steps].filter(s => s.classList.contains('is-active')).length;
                    fill.style.height = (activeCount / steps.length * 100) + '%';
                }
            }, { threshold: 0.5 });
            steps.forEach(s => journeyObs.observe(s));
            steps.forEach(step => {
                step.addEventListener('click', () => {
                    const wasOpen = step.classList.contains('is-open');
                    steps.forEach(s => s.classList.remove('is-open'));
                    if (!wasOpen) step.classList.add('is-open');
                });
            });
        });

        // Interactive facility flip cards (tap to flip on touch devices)
        document.querySelectorAll('.flip-card').forEach(card => {
            card.addEventListener('click', () => { if (!card.getAttribute('data-lightbox-src')) card.classList.toggle('is-flipped'); });
        });

        // Ripple micro-interaction on buttons/links
        document.querySelectorAll('.ripple-btn').forEach(btn => {
            btn.addEventListener('click', function (e) {
                const r = this.getBoundingClientRect();
                const ripple = document.createElement('span');
                const size = Math.max(r.width, r.height);
                ripple.className = 'ripple';
                ripple.style.width = ripple.style.height = size + 'px';
                ripple.style.left = (e.clientX - r.left - size / 2) + 'px';
                ripple.style.top = (e.clientY - r.top - size / 2) + 'px';
                this.appendChild(ripple);
                setTimeout(() => ripple.remove(), 650);
            });
        });

        // Premium fullscreen photo viewer (shared: home collage, news, ...)
        (function () {
            const init = () => {
                const lb = document.getElementById('cinematic-lightbox');
                if (!lb) return;
                const frame = lb.querySelector('.lb-frame');
                const img = document.getElementById('cinematic-lightbox-img');
                const cap = document.getElementById('cinematic-lightbox-caption');
                const capWrap = lb.querySelector('.lb-cap');
                const metaEl = document.getElementById('lb-meta');
                const descEl = document.getElementById('lb-desc');
                const curEl = document.getElementById('lb-cur');
                const totEl = document.getElementById('lb-total');
                const closeBtn = document.getElementById('cinematic-lightbox-close');
                const reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
                const EASE = 'cubic-bezier(.16,1,.3,1)';
                const pad = n => String(n).padStart(2, '0');
                const wait = ms => new Promise(r => setTimeout(r, ms));
                const triggers = [...document.querySelectorAll('[data-lightbox-src]')].filter(t => t.getAttribute('data-lightbox-src'));
                let idx = -1, open = false, token = 0, lastFocus = null, touchX = null;

                const photoEl = t => {
                    const src = t.getAttribute('data-lightbox-src');
                    return [...t.querySelectorAll('img')].find(i => i.getAttribute('src') === src) || t;
                };
                const decode = async (src) => {
                    img.src = src;
                    try { if (img.decode) await img.decode(); } catch (e) {}
                };
                const preload = i => {
                    if (i < 0 || i >= triggers.length) return;
                    const im = new Image(); im.src = triggers[i].getAttribute('data-lightbox-src');
                };
                const setMeta = i => {
                    const t = triggers[i];
                    cap.textContent = t.getAttribute('data-lightbox-caption') || '';
                    const desc = t.getAttribute('data-lightbox-desc') || '', meta = t.getAttribute('data-lightbox-meta') || '';
                    descEl.textContent = desc; descEl.style.display = desc ? '' : 'none';
                    metaEl.textContent = meta; metaEl.style.display = meta ? '' : 'none';
                    lb.classList.toggle('lb-has-desc', !!desc);
                    capWrap.style.display = (cap.textContent || desc) ? '' : 'none';
                    curEl.textContent = pad(i + 1);
                    totEl.textContent = pad(triggers.length);
                };
                const flipTransform = (rect) => {
                    const to = frame.getBoundingClientRect();
                    const dx = rect.left + rect.width / 2 - (to.left + to.width / 2);
                    const dy = rect.top + rect.height / 2 - (to.top + to.height / 2);
                    const sc = Math.max(.05, rect.width / to.width);
                    return `translate(${dx}px, ${dy}px) scale(${sc})`;
                };
                const inView = r => r.width > 0 && r.bottom > 0 && r.right > 0 && r.top < innerHeight && r.left < innerWidth;

                async function openAt(i) {
                    if (open) return;
                    open = true; idx = i; const my = ++token;
                    lastFocus = document.activeElement;
                    const t = triggers[i];
                    const from = photoEl(t).getBoundingClientRect();
                    const sbw = innerWidth - document.documentElement.clientWidth;
                    document.body.style.overflow = 'hidden';
                    if (sbw > 0) document.body.style.paddingRight = sbw + 'px';
                    lb.classList.toggle('lb-single', triggers.length < 2);
                    setMeta(i);
                    frame.classList.remove('is-settled'); capWrap.classList.remove('is-in');
                    frame.style.transition = 'none'; frame.style.opacity = '0';
                    lb.classList.add('is-open');
                    await decode(t.getAttribute('data-lightbox-src'));
                    if (my !== token) return;
                    requestAnimationFrame(() => lb.classList.add('is-in'));
                    if (reduce || !inView(from)) {
                        frame.style.transform = 'scale(.96)'; frame.getBoundingClientRect();
                        frame.style.transition = `transform .5s ${EASE}, opacity .4s ease`;
                        frame.style.transform = 'none'; frame.style.opacity = '1';
                    } else {
                        frame.style.transform = flipTransform(from); frame.style.opacity = '1';
                        frame.getBoundingClientRect();
                        frame.style.transition = `transform .85s ${EASE}`;
                        frame.style.transform = 'none';
                    }
                    setTimeout(() => { if (my === token) { frame.classList.add('is-settled'); capWrap.classList.add('is-in'); } }, reduce ? 50 : 520);
                    closeBtn.focus({ preventScroll: true });
                    preload(i + 1); preload(i - 1);
                }

                async function go(dir) {
                    if (!open || triggers.length < 2) return;
                    const my = ++token;
                    const n = (idx + dir + triggers.length) % triggers.length;
                    capWrap.classList.remove('is-in'); frame.classList.remove('is-settled');
                    frame.style.transition = `transform .3s ease-in, opacity .3s ease`;
                    frame.style.transform = `translateX(${-dir * 60}px)`; frame.style.opacity = '0';
                    await wait(reduce ? 0 : 300);
                    if (my !== token) return;
                    idx = n; setMeta(n);
                    await decode(triggers[n].getAttribute('data-lightbox-src'));
                    if (my !== token) return;
                    frame.style.transition = 'none';
                    frame.style.transform = `translateX(${dir * 60}px)`; frame.getBoundingClientRect();
                    frame.style.transition = `transform .8s ${EASE}, opacity .5s ease`;
                    frame.style.transform = 'none'; frame.style.opacity = '1';
                    setTimeout(() => { if (my === token) { frame.classList.add('is-settled'); capWrap.classList.add('is-in'); } }, reduce ? 50 : 400);
                    preload(n + dir);
                }

                async function close() {
                    if (!open) return;
                    open = false; const my = ++token;
                    capWrap.classList.remove('is-in'); frame.classList.remove('is-settled');
                    const to = photoEl(triggers[idx]).getBoundingClientRect();
                    lb.classList.remove('is-in');
                    if (!reduce && inView(to)) {
                        frame.style.transition = `transform .6s cubic-bezier(.65,0,.35,1), opacity .55s ease .05s`;
                        frame.style.transform = flipTransform(to); frame.style.opacity = '0';
                    } else {
                        frame.style.transition = 'transform .4s ease, opacity .4s ease';
                        frame.style.transform = 'scale(.96)'; frame.style.opacity = '0';
                    }
                    await wait(reduce ? 0 : 650);
                    if (my !== token) return;
                    lb.classList.remove('is-open');
                    document.body.style.overflow = ''; document.body.style.paddingRight = '';
                    if (lastFocus && lastFocus.focus) lastFocus.focus({ preventScroll: true });
                }

                triggers.forEach((t, i) => {
                    t.addEventListener('click', e => { e.preventDefault(); openAt(i); });
                    if (!/^(BUTTON|A)$/.test(t.tagName)) t.addEventListener('keydown', e => { if (e.key === 'Enter' || e.key === ' ') { e.preventDefault(); openAt(i); } });
                });
                closeBtn.addEventListener('click', close);
                document.getElementById('lb-prev').addEventListener('click', () => go(-1));
                document.getElementById('lb-next').addEventListener('click', () => go(1));
                lb.addEventListener('click', e => {
                    if (e.target === lb || e.target.classList.contains('lb-backdrop') || e.target.classList.contains('lb-stage')) close();
                });
                document.addEventListener('keydown', e => {
                    if (!open) return;
                    if (e.key === 'Escape') close();
                    else if (e.key === 'ArrowRight') go(1);
                    else if (e.key === 'ArrowLeft') go(-1);
                });
                lb.addEventListener('touchstart', e => { touchX = e.changedTouches[0].clientX; }, { passive: true });
                lb.addEventListener('touchend', e => {
                    if (touchX === null) return;
                    const dx = e.changedTouches[0].clientX - touchX; touchX = null;
                    if (Math.abs(dx) > 55) go(dx < 0 ? 1 : -1);
                }, { passive: true });
            };
            if (document.readyState === 'loading') document.addEventListener('DOMContentLoaded', init); else init();
        })();

        // Horizontal scroll sections: fade the "scroll hint" once user has scrolled
        document.querySelectorAll('.hscroll-cinematic').forEach(track => {
            const hint = track.parentElement.querySelector('.hscroll-hint');
            if (!hint) return;
            track.addEventListener('scroll', () => { hint.style.opacity = track.scrollLeft > 20 ? '0' : '1'; }, { passive: true });
        });

        // Real 3D tilt (mouse-tracking) for every photo on the site: replaces flat zoom-only hovers
        (function initTilt3D() {
            const canTilt = window.matchMedia('(hover: hover) and (pointer: fine)').matches
                && !window.matchMedia('(prefers-reduced-motion: reduce)').matches;
            document.querySelectorAll('.tilt-3d').forEach(card => {
                if (!card.querySelector(':scope > .tilt-shine')) {
                    const shine = document.createElement('div');
                    shine.className = 'tilt-shine';
                    card.appendChild(shine);
                }
                if (!canTilt) return;
                const shine = card.querySelector(':scope > .tilt-shine');
                const strength = parseFloat(card.dataset.tiltStrength || '9');
                const scaleTo = parseFloat(card.dataset.tiltScale || '1.045');
                let rect = null;
                card.addEventListener('pointerenter', () => {
                    rect = card.getBoundingClientRect();
                    card.classList.add('is-tilting');
                });
                card.addEventListener('pointermove', (e) => {
                    if (!rect) rect = card.getBoundingClientRect();
                    const px = (e.clientX - rect.left) / rect.width;
                    const py = (e.clientY - rect.top) / rect.height;
                    const rotateY = (px - 0.5) * strength;
                    const rotateX = (0.5 - py) * strength;
                    card.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) scale3d(${scaleTo},${scaleTo},${scaleTo})`;
                    shine.style.background = `radial-gradient(circle at ${px * 100}% ${py * 100}%, rgba(255,255,255,.4), transparent 55%)`;
                });
                card.addEventListener('pointerleave', () => {
                    card.classList.remove('is-tilting');
                    card.style.transform = 'perspective(1000px) rotateX(0deg) rotateY(0deg) scale3d(1,1,1)';
                    rect = null;
                });
            });
        })();
    </script>

    <!-- Premium fullscreen photo viewer (shared across pages) -->
    <style>
        #cinematic-lightbox { position: fixed; inset: 0; z-index: 100; display: none; color: #fff; }
        #cinematic-lightbox.is-open { display: block; }
        .lb-backdrop { position: absolute; inset: 0; opacity: 0; transition: opacity .6s ease;
            background: radial-gradient(ellipse 70% 55% at 50% 35%, rgba(30,64,175,.28), transparent 65%), radial-gradient(ellipse 50% 40% at 85% 95%, rgba(232,196,110,.10), transparent 60%), rgba(2,6,23,.95);
            -webkit-backdrop-filter: blur(16px); backdrop-filter: blur(16px); }
        #cinematic-lightbox.is-in .lb-backdrop { opacity: 1; }
        .lb-grain { position: absolute; inset: 0; pointer-events: none; opacity: .05; background-image: radial-gradient(circle, #fff 1px, transparent 1px); background-size: 24px 24px; }

        .lb-stage { position: absolute; inset: 0; display: flex; flex-direction: column; align-items: center; justify-content: center; padding: 4.5rem 5.5rem 4.75rem; }
        .lb-frame { position: relative; line-height: 0; will-change: transform, opacity; box-shadow: 0 50px 140px rgba(0,0,0,.65), 0 0 0 1px rgba(255,255,255,.08); }
        .lb-frame img { display: block; max-width: calc(100vw - 11rem); max-height: calc(100vh - 12.5rem); object-fit: contain; background: #0b1224; }
        .lb-frame::before, .lb-frame::after { content: ''; position: absolute; width: 34px; height: 34px; border: 0 solid #e8c46e; opacity: 0; transition: opacity .7s ease, transform .9s cubic-bezier(.16,1,.3,1); pointer-events: none; }
        .lb-frame::before { top: -12px; left: -12px; border-top-width: 2px; border-left-width: 2px; transform: translate(10px,10px); }
        .lb-frame::after { bottom: -12px; right: -12px; border-bottom-width: 2px; border-right-width: 2px; transform: translate(-10px,-10px); }
        .lb-frame.is-settled::before, .lb-frame.is-settled::after { opacity: 1; transform: none; }

        .lb-cap { margin-top: 1.6rem; text-align: center; opacity: 0; transform: translateY(14px); transition: opacity .7s ease, transform .9s cubic-bezier(.16,1,.3,1); max-width: 46rem; }
        .lb-cap.is-in { opacity: 1; transform: none; }
        .lb-cap i { display: block; width: 2.5rem; height: 1px; margin: 0 auto .85rem; background: #e8c46e; }
        .lb-cap p { font-family: 'Playfair Display', Georgia, serif; font-weight: 600; font-size: 1.12rem; line-height: 1.4; color: #f8fafc; }
        .lb-cap small { display: block; font-size: 10.5px; letter-spacing: .24em; text-transform: uppercase; color: #e8c46e; font-weight: 600; margin-bottom: .5rem; }
        .lb-cap em { font-style: normal; margin: .65rem auto 0; max-width: 38rem; font-size: .9rem; line-height: 1.6; color: rgba(226,232,240,.75); display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; }
        .lb-has-desc .lb-frame img { max-height: calc(100vh - 16.5rem); }

        .lb-top { position: absolute; top: 0; left: 0; right: 0; display: flex; align-items: center; justify-content: space-between; padding: 1.25rem 1.5rem; z-index: 2; opacity: 0; transform: translateY(-10px); transition: opacity .6s ease .15s, transform .8s cubic-bezier(.16,1,.3,1) .15s; pointer-events: none; }
        #cinematic-lightbox.is-in .lb-top { opacity: 1; transform: none; }
        .lb-top > * { pointer-events: auto; }
        .lb-count { font-family: 'Playfair Display', Georgia, serif; font-weight: 600; font-size: 1.05rem; letter-spacing: .12em; color: #e8c46e; display: flex; align-items: center; gap: .7rem; }
        .lb-count b { font-weight: 500; color: rgba(255,255,255,.45); }
        .lb-count i { width: 2rem; height: 1px; background: rgba(232,196,110,.5); }
        .lb-single .lb-count, .lb-single .lb-nav { display: none; }

        .lb-close { display: inline-flex; align-items: center; gap: .65rem; height: 46px; padding: 0 .55rem 0 1.05rem; border-radius: 999px; border: 1px solid rgba(255,255,255,.2); background: rgba(255,255,255,.06); color: #fff; cursor: pointer; transition: background .4s ease, border-color .4s ease, transform .4s cubic-bezier(.16,1,.3,1); margin-left: auto; }
        .lb-close span { font-size: 10.5px; letter-spacing: .22em; text-transform: uppercase; color: rgba(255,255,255,.65); }
        .lb-close em { display: grid; place-items: center; width: 34px; height: 34px; border-radius: 999px; background: rgba(255,255,255,.1); transition: transform .5s cubic-bezier(.16,1,.3,1), background .4s ease; }
        .lb-close:hover { background: rgba(232,196,110,.16); border-color: rgba(232,196,110,.7); }
        .lb-close:hover em { transform: rotate(90deg); background: #e8c46e; color: #0f172a; }
        .lb-close:focus-visible, .lb-nav:focus-visible { outline: 2px solid #e8c46e; outline-offset: 3px; }

        .lb-nav { position: absolute; top: 50%; z-index: 2; width: 54px; height: 54px; margin-top: -27px; border-radius: 999px; border: 1px solid rgba(255,255,255,.2); background: rgba(255,255,255,.06); color: #fff; display: grid; place-items: center; cursor: pointer; opacity: 0; transition: opacity .6s ease .25s, background .4s ease, border-color .4s ease, transform .5s cubic-bezier(.16,1,.3,1); }
        #cinematic-lightbox.is-in .lb-nav { opacity: 1; }
        .lb-prev { left: 1.5rem; } .lb-next { right: 1.5rem; }
        .lb-nav:hover { background: rgba(232,196,110,.16); border-color: rgba(232,196,110,.7); }
        .lb-prev:hover { transform: translateX(-4px); } .lb-next:hover { transform: translateX(4px); }

        @media (max-width: 767px) {
            .lb-stage { padding: 4.25rem 1rem 4.5rem; }
            .lb-frame img { max-width: calc(100vw - 2rem); max-height: calc(100vh - 11rem); }
            .lb-has-desc .lb-frame img { max-height: calc(100vh - 15rem); }
            .lb-close span { display: none; } .lb-close { padding: 0 .4rem; }
            .lb-nav { top: auto; bottom: 1rem; margin-top: 0; width: 46px; height: 46px; }
            .lb-prev { left: 1rem; } .lb-next { right: 1rem; }
            .lb-cap p { font-size: 1rem; }
        }
        @media (prefers-reduced-motion: reduce) { .lb-backdrop, .lb-cap, .lb-top, .lb-nav, .lb-frame::before, .lb-frame::after { transition-duration: .01ms !important; } }
    </style>
    <div id="cinematic-lightbox" role="dialog" aria-modal="true" aria-label="Penampil foto">
        <div class="lb-backdrop"></div>
        <div class="lb-grain"></div>
        <div class="lb-top">
            <div class="lb-count"><span id="lb-cur">01</span><i></i><b id="lb-total">01</b></div>
            <button id="cinematic-lightbox-close" type="button" class="lb-close" aria-label="Tutup">
                <span>Esc</span>
                <em><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg></em>
            </button>
        </div>
        <button id="lb-prev" type="button" class="lb-nav lb-prev" aria-label="Foto sebelumnya"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M15 5l-7 7 7 7"/></svg></button>
        <button id="lb-next" type="button" class="lb-nav lb-next" aria-label="Foto berikutnya"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M9 5l7 7-7 7"/></svg></button>
        <div class="lb-stage">
            <div class="lb-frame"><img id="cinematic-lightbox-img" src="" alt=""></div>
            <div class="lb-cap"><i></i><small id="lb-meta"></small><p id="cinematic-lightbox-caption"></p><em id="lb-desc"></em></div>
        </div>
    </div>
    @stack('scripts')
</body>
</html>