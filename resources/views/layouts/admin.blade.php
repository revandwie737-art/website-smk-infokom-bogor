<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') - Admin SMK Infokom Bogor</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = { theme: { extend: { colors: {
            navy: { 50:'#eff6ff',100:'#dbeafe',200:'#bfdbfe',600:'#1d4ed8',700:'#1e40af',800:'#172554',900:'#0f172a' },
            sky: { 500:'#0ea5e9' },
        } } } }
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <style>
        body { font-family: 'Plus Jakarta Sans', system-ui, sans-serif; }
        ::-webkit-scrollbar { width: 9px; height: 9px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #334155; border-radius: 999px; }
        html { scrollbar-color: #334155 transparent; }

        a, button { transition: all .18s ease; }

        @keyframes fadeInPage { from { opacity: 0; transform: translateY(6px); } to { opacity: 1; transform: translateY(0); } }
        main > * { animation: fadeInPage .35s ease-out; }

        .sidebar-link { border-left: 3px solid transparent; }
        .sidebar-link.is-active { border-left-color: #38bdf8; }
        .sidebar-link:hover { transform: translateX(2px); }

        .hover-lift { transition: transform .2s ease, box-shadow .2s ease; }
        .hover-lift:hover { transform: translateY(-3px); box-shadow: 0 16px 32px -12px rgba(15,23,42,.12); }

        [x-cloak] { display: none !important; }

        @media (prefers-reduced-motion: reduce) { * { animation: none !important; transition: none !important; } }
    </style>
</head>
<body class="bg-slate-50 text-slate-700" x-data="{ sidebar: false }">

    <div class="flex min-h-screen">
        <!-- SIDEBAR -->
        <aside :class="sidebar ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
            class="fixed lg:static z-40 inset-y-0 left-0 w-72 bg-navy-900 text-slate-200 transition-transform duration-300 overflow-y-auto">
            <div class="px-6 py-5 flex items-center gap-3 border-b border-white/10">
                @php($adminLogo = \App\Models\SchoolSetting::get('site_logo'))
                @if($adminLogo)
                    <div class="h-10 w-10 rounded-full bg-white overflow-hidden grid place-items-center">
                        <img src="{{ asset('storage/' . $adminLogo) }}" class="w-full h-full object-contain" alt="Logo">
                    </div>
                @else
                    <div class="h-10 w-10 rounded-full bg-white text-navy-800 grid place-items-center font-bold">SI</div>
                @endif
                <div>
                    <p class="text-white font-semibold text-sm">SMK Infokom</p>
                    <p class="text-xs text-slate-400">Dashboard Admin</p>
                </div>
            </div>

            <nav class="px-3 py-4 text-sm space-y-1">
                @php($active = fn($r) => request()->routeIs($r) ? 'is-active bg-white/10 text-white' : 'text-slate-300 hover:bg-white/5 hover:text-white')
                <a href="{{ route('admin.dashboard') }}" class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-lg {{ $active('admin.dashboard') }}">Dashboard</a>

                <p class="px-3 pt-4 pb-1 text-[11px] uppercase tracking-wider text-slate-500">Website</p>
                <a href="{{ route('admin.settings.index') }}" class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-lg {{ $active('admin.settings.*') }}">Pengaturan Website</a>
                <a href="{{ route('admin.home-layout.index') }}" class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-lg {{ $active('admin.home-layout.*') }}">Tata Letak Beranda</a>

                <p class="px-3 pt-4 pb-1 text-[11px] uppercase tracking-wider text-slate-500">Konten</p>
                <a href="{{ route('admin.news.index') }}" class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-lg {{ $active('admin.news.*') }}">Berita</a>
                <a href="{{ route('admin.categories.index') }}" class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-lg {{ $active('admin.categories.*') }}">Kategori Berita</a>
                <a href="{{ route('admin.announcements.index') }}" class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-lg {{ $active('admin.announcements.*') }}">Pengumuman</a>
                <a href="{{ route('admin.events.index') }}" class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-lg {{ $active('admin.events.*') }}">Agenda</a>
                <a href="{{ route('admin.gallery.index') }}" class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-lg {{ $active('admin.gallery.*') }}">Galeri</a>
                <a href="{{ route('admin.videos.index') }}" class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-lg {{ $active('admin.videos.*') }}">Video</a>
                <a href="{{ route('admin.achievements.index') }}" class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-lg {{ $active('admin.achievements.*') }}">Prestasi</a>
                <a href="{{ route('admin.programs.index') }}" class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-lg {{ $active('admin.programs.*') }}">Program Keahlian</a>
                <a href="{{ route('admin.extracurriculars.index') }}" class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-lg {{ $active('admin.extracurriculars.*') }}">Ekstrakurikuler</a>
                <a href="{{ route('admin.facilities.index') }}" class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-lg {{ $active('admin.facilities.*') }}">Fasilitas</a>
                <a href="{{ route('admin.info-menu.index') }}" class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-lg {{ $active('admin.info-menu.*') }}">Menu Informasi (Navbar)</a>
                <a href="{{ route('admin.pkl-partners.index') }}" class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-lg {{ $active('admin.pkl-partners.*') }}">Mitra PKL</a>
                <a href="{{ route('admin.partners.index') }}" class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-lg {{ $active('admin.partners.*') }}">Kerjasama</a>
                <a href="{{ route('admin.industrial-visits.index') }}" class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-lg {{ $active('admin.industrial-visits.*') }}">Kunjungan Industri</a>
                <a href="{{ route('admin.magang-jepang.index') }}" class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-lg {{ $active('admin.magang-jepang.*') }}">Magang Jepang</a>
                <a href="{{ route('admin.bkk-jobs.index') }}" class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-lg {{ $active('admin.bkk-jobs.*') }}">Lowongan BKK</a>
                <a href="{{ route('admin.bkk-partners.index') }}" class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-lg {{ $active('admin.bkk-partners.*') }}">Mitra Industri BKK</a>
                <a href="{{ route('admin.documents.index') }}" class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-lg {{ $active('admin.documents.*') }}">Dokumen</a>

                <p class="px-3 pt-4 pb-1 text-[11px] uppercase tracking-wider text-slate-500">Akademik</p>
                <a href="{{ route('admin.classes.index') }}" class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-lg {{ $active('admin.classes.*') }}">Kelas</a>
                <a href="{{ route('admin.class-members.index') }}" class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-lg {{ $active('admin.class-members.*') }}">Pengurus/Anggota Kelas</a>
                <a href="{{ route('admin.subjects.index') }}" class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-lg {{ $active('admin.subjects.*') }}">Mata Pelajaran</a>
                <a href="{{ route('admin.schedules.index') }}" class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-lg {{ $active('admin.schedules.*') }}">Jadwal</a>
                <a href="{{ route('admin.grades.index') }}" class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-lg {{ $active('admin.grades.*') }}">Nilai</a>
                <a href="{{ route('admin.attendance.index') }}" class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-lg {{ $active('admin.attendance.*') }}">Kehadiran</a>

                <p class="px-3 pt-4 pb-1 text-[11px] uppercase tracking-wider text-slate-500">Pengguna</p>
                <a href="{{ route('admin.students.index') }}" class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-lg {{ $active('admin.students.*') }}">Siswa</a>
                <a href="{{ route('admin.teachers.index') }}" class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-lg {{ $active('admin.teachers.*') }}">Guru</a>

                <p class="px-3 pt-4 pb-1 text-[11px] uppercase tracking-wider text-slate-500">PPDB &amp; Pesan</p>
                <a href="{{ route('admin.ppdb.index') }}" class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-lg {{ $active('admin.ppdb.*') }}">Pendaftaran PPDB</a>
                <a href="{{ route('admin.messages.index') }}" class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-lg {{ $active('admin.messages.*') }}">Pesan Masuk</a>
            </nav>
        </aside>

        <div x-show="sidebar" @click="sidebar=false" style="display:none" class="fixed inset-0 bg-black/40 z-30 lg:hidden"></div>

        <!-- MAIN -->
        <div class="flex-1 min-w-0">
            <header class="sticky top-0 z-20 bg-white border-b border-slate-200">
                <div class="flex items-center justify-between px-4 sm:px-6 py-3.5">
                    <div class="flex items-center gap-3">
                        <button @click="sidebar = !sidebar" class="lg:hidden p-2 rounded-lg hover:bg-slate-100">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                        </button>
                        <h1 class="font-semibold text-slate-800 text-lg">@yield('title', 'Dashboard')</h1>
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="text-right hidden sm:block">
                            <p class="text-sm font-medium text-slate-700">{{ auth()->user()->name }}</p>
                            <p class="text-xs text-slate-400 capitalize">{{ auth()->user()->role }}</p>
                        </div>
                        <div class="h-9 w-9 rounded-full bg-navy-700 text-white grid place-items-center text-sm font-semibold ring-2 ring-navy-100">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>
                        <form method="POST" action="{{ route('admin.logout') }}">
                            @csrf
                            <button class="text-sm text-slate-500 hover:text-red-600 hover:bg-red-50 px-3 py-1.5 rounded-lg font-medium">Keluar</button>
                        </form>
                    </div>
                </div>
            </header>

            <main class="p-4 sm:p-6">
                @if(session('success'))
                    <div class="mb-5 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 text-sm">
                        {{ session('success') }}
                    </div>
                @endif
                @if($errors->any())
                    <div class="mb-5 rounded-xl bg-red-50 border border-red-200 text-red-700 px-4 py-3 text-sm">
                        <ul class="list-disc list-inside space-y-1">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>
    <script>
        document.querySelectorAll('[data-counter]').forEach(el => {
            const target = parseInt(el.getAttribute('data-counter'), 10) || 0;
            let started = false;
            const obs = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting && !started) {
                        started = true;
                        let current = 0;
                        const step = Math.max(target / 40, 1);
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
    </script>
</body>
</html>