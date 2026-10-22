<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') - Admin SMK Infokom Bogor</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = { theme: { extend: { colors: {
            navy: { 50:'#eff6ff',100:'#dbeafe',200:'#bfdbfe',300:'#93c5fd',400:'#3b82f6',500:'#2563eb',600:'#1d4ed8',700:'#1e40af',800:'#172554',900:'#0f172a' },
            sky: { 50:'#f0f9ff',100:'#e0f2fe',200:'#bae6fd',300:'#7dd3fc',400:'#38bdf8',500:'#0ea5e9',600:'#0284c7' },
        }, animation: {
            'fade-in-up': 'fadeInUp .5s cubic-bezier(.16,1,.3,1) both',
            'fade-in': 'fadeIn .4s ease both',
            'float': 'float 7s ease-in-out infinite',
            'float-slow': 'float 11s ease-in-out infinite',
        } } } }
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js" defer></script>
    <style>
        :root{
            --shadow-soft: 0 1px 2px rgba(15,23,42,.04), 0 8px 24px -12px rgba(15,23,42,.08);
            --shadow-lift: 0 4px 10px rgba(15,23,42,.05), 0 18px 40px -16px rgba(15,23,42,.16);
        }
        *{ scrollbar-width: thin; scrollbar-color: #cbd5e1 transparent; }
        body{ font-family:'Plus Jakarta Sans', system-ui, sans-serif; -webkit-font-smoothing:antialiased; }
        ::selection{ background:#0ea5e9; color:#fff; }
        ::-webkit-scrollbar{ width:9px; height:9px; }
        ::-webkit-scrollbar-track{ background:transparent; }
        ::-webkit-scrollbar-thumb{ background:#cbd5e1; border-radius:9999px; border:2px solid transparent; background-clip:content-box; }
        ::-webkit-scrollbar-thumb:hover{ background:#94a3b8; background-clip:content-box; }
        #sidebarScroll::-webkit-scrollbar-thumb{ background:rgba(255,255,255,.15); background-clip:content-box; }
        #sidebarScroll::-webkit-scrollbar-thumb:hover{ background:rgba(255,255,255,.28); background-clip:content-box; }

        @keyframes fadeInUp{ from{ opacity:0; transform:translateY(14px); } to{ opacity:1; transform:translateY(0); } }
        @keyframes fadeIn{ from{ opacity:0; } to{ opacity:1; } }
        @keyframes float{ 0%,100%{ transform:translateY(0) translateX(0); } 50%{ transform:translateY(-14px) translateX(6px); } }
        @keyframes shimmer{ 0%{ background-position:-400px 0; } 100%{ background-position:400px 0; } }
        @keyframes popIn{ 0%{ opacity:0; transform:scale(.85); } 100%{ opacity:1; transform:scale(1); } }

        main.page-enter{ animation: fadeInUp .55s cubic-bezier(.16,1,.3,1) both; }

        /* table row stagger */
        tbody tr{ animation: fadeInUp .45s cubic-bezier(.16,1,.3,1) both; }
        tbody tr:nth-child(1){ animation-delay:.02s } tbody tr:nth-child(2){ animation-delay:.05s }
        tbody tr:nth-child(3){ animation-delay:.08s } tbody tr:nth-child(4){ animation-delay:.11s }
        tbody tr:nth-child(5){ animation-delay:.14s } tbody tr:nth-child(6){ animation-delay:.17s }
        tbody tr:nth-child(7){ animation-delay:.20s } tbody tr:nth-child(8){ animation-delay:.23s }
        tbody tr:nth-child(9){ animation-delay:.26s } tbody tr:nth-child(10){ animation-delay:.29s }
        tbody tr:nth-child(n+11){ animation-delay:.32s }

        /* universal micro-interactions for buttons/links across every admin page, no markup changes needed */
        a[class*="rounded"], button[class*="rounded"]{ transition: transform .18s cubic-bezier(.4,0,.2,1), box-shadow .18s ease, filter .18s ease, background-color .18s ease, opacity .18s ease; }
        a[class*="rounded"]:hover, button[class*="rounded"]:hover{ filter:brightness(1.04); }
        a[class*="rounded-xl"]:hover, button[class*="rounded-xl"]:hover,
        a[class*="rounded-full"]:hover, button[class*="rounded-full"]:hover,
        a[class*="rounded-2xl"]:hover, button[class*="rounded-2xl"]:hover{ transform:translateY(-1px); }
        a[class*="rounded"]:active, button[class*="rounded"]:active{ transform:translateY(0) scale(.96); filter:brightness(.98); }

        /* card lift for white content cards site-wide */
        div[class*="rounded-2xl"][class*="border"], div[class*="rounded-3xl"][class*="border"]{ transition: box-shadow .28s ease, border-color .28s ease; }
        div[class*="rounded-2xl"][class*="border"]:hover, div[class*="rounded-3xl"][class*="border"]:hover{ box-shadow: var(--shadow-lift); }

        /* inputs */
        input[class*="rounded-xl"], select[class*="rounded-xl"], textarea[class*="rounded-xl"]{ transition: box-shadow .2s ease, border-color .2s ease, transform .2s ease; }
        input[class*="rounded-xl"]:focus, select[class*="rounded-xl"]:focus, textarea[class*="rounded-xl"]:focus{ transform:translateY(-1px); }

        /* badges */
        span[class*="rounded-full"][class*="text-xs"]{ transition: transform .18s ease; display:inline-flex; }
        span[class*="rounded-full"][class*="text-xs"]:hover{ transform:scale(1.06); }

        .nav-link{ position:relative; overflow:hidden; }
        .nav-link::before{ content:''; position:absolute; inset:0; background:linear-gradient(90deg, rgba(14,165,233,.16), transparent); transform:translateX(-100%); transition:transform .35s ease; }
        .nav-link:hover::before{ transform:translateX(0); }
        .nav-link.active{ box-shadow: inset 0 0 0 1px rgba(14,165,233,.25); }

        [x-cloak]{ display:none !important; }

        #topProgress{ position:fixed; top:0; left:0; height:3px; width:0%; z-index:200; background:linear-gradient(90deg,#38bdf8,#2563eb); box-shadow:0 0 10px rgba(56,189,248,.6); transition: width .35s ease, opacity .35s ease; }
    </style>
</head>
<body class="bg-slate-50 text-slate-700 antialiased" x-data="{ sidebar: false, profileOpen:false, notifOpen:false }" @keydown.escape.window="profileOpen=false; notifOpen=false">

    <div id="topProgress"></div>

    <div class="flex min-h-screen">
        <!-- SIDEBAR -->
        <aside :class="sidebar ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
            class="fixed lg:static z-40 inset-y-0 left-0 w-[280px] bg-gradient-to-b from-navy-900 via-navy-900 to-slate-950 text-slate-200 transition-transform duration-300 ease-[cubic-bezier(.16,1,.3,1)] flex flex-col shadow-2xl">

            <div class="px-5 py-5 flex items-center gap-3 border-b border-white/10 shrink-0">
                @php($adminLogo = \App\Models\SchoolSetting::get('site_logo'))
                <div class="relative h-11 w-11 shrink-0">
                    <div class="absolute inset-0 rounded-2xl bg-sky-500/30 blur-md animate-float"></div>
                    @if($adminLogo)
                        <div class="relative h-11 w-11 rounded-2xl bg-white overflow-hidden grid place-items-center ring-1 ring-white/20">
                            <img src="{{ asset('storage/' . $adminLogo) }}" class="w-full h-full object-contain" alt="Logo">
                        </div>
                    @else
                        <div class="relative h-11 w-11 rounded-2xl bg-gradient-to-br from-sky-400 to-navy-600 text-white grid place-items-center font-extrabold ring-1 ring-white/20">SI</div>
                    @endif
                </div>
                <div class="min-w-0">
                    <p class="text-white font-bold text-sm truncate">SMK Infokom</p>
                    <p class="text-[11px] text-slate-400 flex items-center gap-1.5">
                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                        Dashboard Admin
                    </p>
                </div>
                <button @click="sidebar=false" class="ml-auto lg:hidden p-1.5 rounded-lg hover:bg-white/10 text-slate-300">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>

            <div class="px-4 pt-4 pb-2 shrink-0" x-data="{ navQuery: '' }" id="navSearchWrap">
                <div class="relative">
                    <i data-lucide="search" class="w-4 h-4 absolute left-3 top-1/2 -translate-y-1/2 text-slate-500"></i>
                    <input type="text" x-model="navQuery" placeholder="Cari menu..."
                        class="w-full pl-9 pr-3 py-2 rounded-xl bg-white/5 border border-white/10 text-sm text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-sky-500/50 focus:bg-white/10 transition">
                </div>

                <nav id="sidebarScroll" class="mt-2 -mx-1 px-1 pb-6 text-sm space-y-0.5 overflow-y-auto" style="max-height: calc(100vh - 172px);">
                    @php
                        $active = fn($pattern) => request()->routeIs($pattern);
                        $navGroups = [
                            ['label' => 'Utama', 'items' => [
                                ['route' => 'admin.dashboard', 'pattern' => 'admin.dashboard', 'label' => 'Dashboard', 'icon' => 'layout-dashboard'],
                            ]],
                            ['label' => 'Website', 'items' => [
                                ['route' => 'admin.settings.index', 'pattern' => 'admin.settings.*', 'label' => 'Pengaturan Website', 'icon' => 'settings'],
                            ]],
                            ['label' => 'Konten', 'items' => [
                                ['route' => 'admin.news.index', 'pattern' => 'admin.news.*', 'label' => 'Berita', 'icon' => 'newspaper'],
                                ['route' => 'admin.categories.index', 'pattern' => 'admin.categories.*', 'label' => 'Kategori Berita', 'icon' => 'tag'],
                                ['route' => 'admin.announcements.index', 'pattern' => 'admin.announcements.*', 'label' => 'Pengumuman', 'icon' => 'megaphone'],
                                ['route' => 'admin.events.index', 'pattern' => 'admin.events.*', 'label' => 'Agenda', 'icon' => 'calendar-days'],
                                ['route' => 'admin.gallery.index', 'pattern' => 'admin.gallery.*', 'label' => 'Galeri', 'icon' => 'image'],
                                ['route' => 'admin.videos.index', 'pattern' => 'admin.videos.*', 'label' => 'Video', 'icon' => 'video'],
                                ['route' => 'admin.achievements.index', 'pattern' => 'admin.achievements.*', 'label' => 'Prestasi', 'icon' => 'trophy'],
                                ['route' => 'admin.programs.index', 'pattern' => 'admin.programs.*', 'label' => 'Program Keahlian', 'icon' => 'graduation-cap'],
                                ['route' => 'admin.extracurriculars.index', 'pattern' => 'admin.extracurriculars.*', 'label' => 'Ekstrakurikuler', 'icon' => 'star'],
                                ['route' => 'admin.facilities.index', 'pattern' => 'admin.facilities.*', 'label' => 'Fasilitas', 'icon' => 'building-2'],
                                ['route' => 'admin.pkl-partners.index', 'pattern' => 'admin.pkl-partners.*', 'label' => 'Mitra PKL', 'icon' => 'briefcase'],
                                ['route' => 'admin.partners.index', 'pattern' => 'admin.partners.*', 'label' => 'Kerjasama', 'icon' => 'handshake'],
                                ['route' => 'admin.bkk-jobs.index', 'pattern' => 'admin.bkk-jobs.*', 'label' => 'Lowongan BKK', 'icon' => 'briefcase-business'],
                                ['route' => 'admin.bkk-partners.index', 'pattern' => 'admin.bkk-partners.*', 'label' => 'Mitra Industri BKK', 'icon' => 'factory'],
                            ]],
                            ['label' => 'Akademik', 'items' => [
                                ['route' => 'admin.classes.index', 'pattern' => 'admin.classes.*', 'label' => 'Kelas', 'icon' => 'school'],
                                ['route' => 'admin.class-members.index', 'pattern' => 'admin.class-members.*', 'label' => 'Pengurus/Anggota Kelas', 'icon' => 'users'],
                                ['route' => 'admin.subjects.index', 'pattern' => 'admin.subjects.*', 'label' => 'Mata Pelajaran', 'icon' => 'book-open'],
                                ['route' => 'admin.schedules.index', 'pattern' => 'admin.schedules.*', 'label' => 'Jadwal', 'icon' => 'clock'],
                                ['route' => 'admin.grades.index', 'pattern' => 'admin.grades.*', 'label' => 'Nilai', 'icon' => 'bar-chart-3'],
                                ['route' => 'admin.attendance.index', 'pattern' => 'admin.attendance.*', 'label' => 'Kehadiran', 'icon' => 'clipboard-check'],
                            ]],
                            ['label' => 'Pengguna', 'items' => [
                                ['route' => 'admin.students.index', 'pattern' => 'admin.students.*', 'label' => 'Siswa', 'icon' => 'user-round'],
                                ['route' => 'admin.teachers.index', 'pattern' => 'admin.teachers.*', 'label' => 'Guru', 'icon' => 'user-cog'],
                            ]],
                            ['label' => 'PPDB & Pesan', 'items' => [
                                ['route' => 'admin.ppdb.index', 'pattern' => 'admin.ppdb.*', 'label' => 'Pendaftaran PPDB', 'icon' => 'inbox'],
                                ['route' => 'admin.messages.index', 'pattern' => 'admin.messages.*', 'label' => 'Pesan Masuk', 'icon' => 'mail'],
                            ]],
                        ];
                    @endphp

                    @foreach($navGroups as $group)
                        <p class="px-3 pt-4 pb-1.5 text-[10.5px] font-bold uppercase tracking-widest text-slate-500 flex items-center gap-2">
                            <span class="h-[3px] w-[3px] rounded-full bg-sky-500"></span>{{ $group['label'] }}
                        </p>
                        @foreach($group['items'] as $item)
                            @php($isActive = $active($item['pattern']))
                            <a href="{{ route($item['route']) }}" data-search="{{ Illuminate\Support\Str::lower($item['label']) }}"
                                x-show="navQuery === '' || ($el.dataset.search || '').includes(navQuery.toLowerCase())"
                                class="nav-link group flex items-center gap-3 px-3 py-2.5 rounded-xl transition-colors duration-200 {{ $isActive ? 'active bg-white/10 text-white' : 'text-slate-300/90 hover:bg-white/5 hover:text-white' }}">
                                @if($isActive)
                                    <span class="absolute left-0 top-1/2 -translate-y-1/2 h-5 w-[3px] rounded-r-full bg-sky-400"></span>
                                @endif
                                <i data-lucide="{{ $item['icon'] }}" class="w-[17px] h-[17px] shrink-0 {{ $isActive ? 'text-sky-400' : 'text-slate-400 group-hover:text-sky-300' }} transition-colors"></i>
                                <span class="truncate">{{ $item['label'] }}</span>
                                @if($isActive)<i data-lucide="chevron-right" class="w-3.5 h-3.5 ml-auto text-sky-400"></i>@endif
                            </a>
                        @endforeach
                    @endforeach
                </nav>
            </div>

            <div class="mt-auto px-4 py-4 border-t border-white/10 shrink-0">
                <a href="{{ route('home') }}" target="_blank" class="flex items-center gap-2 text-[12.5px] text-slate-400 hover:text-sky-300 transition px-1">
                    <i data-lucide="external-link" class="w-3.5 h-3.5"></i> Lihat Website
                </a>
            </div>
        </aside>

        <div x-show="sidebar" x-cloak x-transition.opacity @click="sidebar=false" class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm z-30 lg:hidden"></div>

        <!-- MAIN -->
        <div class="flex-1 min-w-0 flex flex-col">
            <header class="sticky top-0 z-20 bg-white/80 backdrop-blur-md border-b border-slate-200/80">
                <div class="flex items-center justify-between px-4 sm:px-6 py-3.5 gap-3">
                    <div class="flex items-center gap-3 min-w-0">
                        <button @click="sidebar = !sidebar" class="lg:hidden p-2 rounded-xl hover:bg-slate-100 text-slate-600 shrink-0">
                            <i data-lucide="menu" class="w-5 h-5"></i>
                        </button>
                        <div class="min-w-0">
                            <div class="flex items-center gap-1.5 text-[11px] text-slate-400 font-medium">
                                <i data-lucide="home" class="w-3 h-3"></i>
                                <span>Admin</span>
                                <i data-lucide="chevron-right" class="w-3 h-3"></i>
                                <span class="text-sky-600" id="breadcrumbCurrent">@yield('title', 'Dashboard')</span>
                            </div>
                            <h1 class="font-bold text-slate-800 text-lg sm:text-xl tracking-tight truncate">@yield('title', 'Dashboard')</h1>
                        </div>
                    </div>

                    <div class="flex items-center gap-2 sm:gap-3 shrink-0">
                        @php
                            $unreadMessages = \App\Models\ContactMessage::where('is_read', false)->count();
                            $pendingPpdb = \App\Models\PpdbRegistration::where('status', 'pending')->count();
                            $notifTotal = $unreadMessages + $pendingPpdb;
                        @endphp

                        <div class="relative" @click.outside="notifOpen=false">
                            <button @click="notifOpen = !notifOpen; profileOpen=false" class="relative p-2.5 rounded-xl hover:bg-slate-100 text-slate-500 transition">
                                <i data-lucide="bell" class="w-5 h-5"></i>
                                @if($notifTotal > 0)
                                    <span class="absolute -top-0.5 -right-0.5 h-4 w-4 rounded-full bg-red-500 text-white text-[9px] font-bold grid place-items-center ring-2 ring-white animate-pulse">{{ $notifTotal > 9 ? '9+' : $notifTotal }}</span>
                                @endif
                            </button>
                            <div x-show="notifOpen" x-cloak
                                x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95 -translate-y-1" x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                                x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                                class="absolute right-0 mt-2 w-72 bg-white rounded-2xl shadow-xl border border-slate-100 overflow-hidden origin-top-right">
                                <div class="px-4 py-3 border-b border-slate-100">
                                    <p class="text-sm font-semibold text-slate-800">Notifikasi</p>
                                </div>
                                <a href="{{ route('admin.ppdb.index') }}" class="flex items-center gap-3 px-4 py-3 hover:bg-slate-50 transition border-b border-slate-50">
                                    <div class="h-9 w-9 rounded-xl bg-amber-50 text-amber-600 grid place-items-center shrink-0"><i data-lucide="user-plus" class="w-4 h-4"></i></div>
                                    <div class="min-w-0"><p class="text-sm font-medium text-slate-700">{{ $pendingPpdb }} pendaftar PPDB</p><p class="text-xs text-slate-400">Menunggu verifikasi</p></div>
                                </a>
                                <a href="{{ route('admin.messages.index') }}" class="flex items-center gap-3 px-4 py-3 hover:bg-slate-50 transition">
                                    <div class="h-9 w-9 rounded-xl bg-sky-50 text-sky-600 grid place-items-center shrink-0"><i data-lucide="mail" class="w-4 h-4"></i></div>
                                    <div class="min-w-0"><p class="text-sm font-medium text-slate-700">{{ $unreadMessages }} pesan belum dibaca</p><p class="text-xs text-slate-400">Kotak masuk</p></div>
                                </a>
                            </div>
                        </div>

                        <div class="h-8 w-px bg-slate-200 hidden sm:block"></div>

                        <div class="relative" @click.outside="profileOpen=false">
                            <button @click="profileOpen = !profileOpen; notifOpen=false" class="flex items-center gap-2.5 pl-1.5 pr-2.5 sm:pr-3 py-1.5 rounded-xl hover:bg-slate-100 transition">
                                <div class="relative h-9 w-9 rounded-full bg-gradient-to-br from-navy-700 to-sky-500 text-white grid place-items-center text-sm font-bold ring-2 ring-white shadow-sm">
                                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                </div>
                                <div class="text-left hidden sm:block">
                                    <p class="text-sm font-semibold text-slate-700 leading-tight">{{ Str::limit(auth()->user()->name, 16) }}</p>
                                    <p class="text-[11px] text-slate-400 capitalize leading-tight">{{ auth()->user()->role }}</p>
                                </div>
                                <i data-lucide="chevron-down" class="w-4 h-4 text-slate-400 hidden sm:block transition-transform" :class="profileOpen && 'rotate-180'"></i>
                            </button>
                            <div x-show="profileOpen" x-cloak
                                x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95 -translate-y-1" x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                                x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                                class="absolute right-0 mt-2 w-56 bg-white rounded-2xl shadow-xl border border-slate-100 overflow-hidden origin-top-right py-1.5">
                                <div class="px-4 py-2.5 border-b border-slate-100 mb-1">
                                    <p class="text-sm font-semibold text-slate-800 truncate">{{ auth()->user()->name }}</p>
                                    <p class="text-xs text-slate-400 truncate">{{ auth()->user()->email }}</p>
                                </div>
                                <a href="{{ route('home') }}" target="_blank" class="flex items-center gap-2.5 px-4 py-2 text-sm text-slate-600 hover:bg-slate-50 transition"><i data-lucide="globe" class="w-4 h-4 text-slate-400"></i> Lihat Website</a>
                                <form method="POST" action="{{ route('admin.logout') }}">
                                    @csrf
                                    <button class="w-full flex items-center gap-2.5 px-4 py-2 text-sm text-red-500 hover:bg-red-50 transition"><i data-lucide="log-out" class="w-4 h-4"></i> Keluar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <main class="page-enter p-4 sm:p-6 flex-1">
                @if(session('success'))
                    <div x-data="{ show:true }" x-init="setTimeout(() => show=false, 4500)" x-show="show" x-cloak
                        x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 -translate-y-3 scale-95" x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                        x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0 -translate-y-2"
                        class="fixed top-5 right-5 z-[100] max-w-sm w-[calc(100%-2.5rem)] sm:w-full">
                        <div class="flex items-start gap-3 rounded-2xl bg-white border border-emerald-100 shadow-xl shadow-emerald-900/5 px-4 py-3.5">
                            <div class="h-8 w-8 rounded-full bg-emerald-100 text-emerald-600 grid place-items-center shrink-0"><i data-lucide="check" class="w-4 h-4"></i></div>
                            <p class="text-sm text-slate-700 font-medium pt-1">{{ session('success') }}</p>
                            <button @click="show=false" class="ml-auto text-slate-300 hover:text-slate-500 shrink-0"><i data-lucide="x" class="w-4 h-4"></i></button>
                        </div>
                    </div>
                @endif
                @if($errors->any())
                    <div x-data="{ show:true }" x-show="show" x-cloak
                        x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 -translate-y-3 scale-95" x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                        class="mb-5 rounded-2xl bg-red-50 border border-red-200 text-red-700 px-4 py-3.5 text-sm flex items-start gap-3">
                        <i data-lucide="alert-triangle" class="w-4 h-4 mt-0.5 shrink-0"></i>
                        <ul class="list-disc list-inside space-y-1">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button @click="show=false" class="ml-auto text-red-300 hover:text-red-500 shrink-0"><i data-lucide="x" class="w-4 h-4"></i></button>
                    </div>
                @endif

                @yield('content')
            </main>

            <footer class="px-4 sm:px-6 py-4 text-center text-xs text-slate-400">
                &copy; {{ date('Y') }} SMK Infokom Bogor &mdash; Dashboard Admin
            </footer>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            if (window.lucide) lucide.createIcons();

            // top loading progress bar
            const bar = document.getElementById('topProgress');
            const finish = () => { bar.style.width = '100%'; setTimeout(() => { bar.style.opacity = '0'; setTimeout(() => { bar.style.width = '0%'; bar.style.opacity = '1'; }, 300); }, 150); };
            bar.style.width = '35%';
            requestAnimationFrame(finish);

            document.addEventListener('click', (e) => {
                const a = e.target.closest('a[href]');
                if (!a) return;
                const href = a.getAttribute('href');
                if (!href || href.startsWith('#') || a.target === '_blank' || e.metaKey || e.ctrlKey || a.hasAttribute('download')) return;
                bar.style.opacity = '1'; bar.style.width = '75%';
            });
            document.addEventListener('submit', () => { bar.style.opacity = '1'; bar.style.width = '75%'; });
        });
    </script>
</body>
</html>
