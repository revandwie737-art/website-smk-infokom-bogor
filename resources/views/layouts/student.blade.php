<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') - Portal Siswa</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = { theme: { extend: { colors: {
            navy: { 50:'#eff6ff',600:'#1d4ed8',700:'#1e40af',800:'#172554',900:'#0f172a' },
            sky: { 500:'#0ea5e9' },
        } } } }
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <style> body { font-family: 'Plus Jakarta Sans', system-ui, sans-serif; } </style>
</head>
<body class="bg-slate-50 text-slate-700" x-data="{ sidebar: false }">

    <div class="flex min-h-screen">
        <aside :class="sidebar ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
            class="fixed lg:static z-40 inset-y-0 left-0 w-64 bg-navy-900 text-slate-200 transition-transform duration-300">
            <div class="px-6 py-5 flex items-center gap-3 border-b border-white/10">
                @php($studentLogo = \App\Models\SchoolSetting::get('site_logo'))
                @if($studentLogo)
                    <div class="h-10 w-10 rounded-full bg-white overflow-hidden grid place-items-center">
                        <img src="{{ asset('storage/' . $studentLogo) }}" class="w-full h-full object-contain" alt="Logo">
                    </div>
                @else
                    <div class="h-10 w-10 rounded-full bg-white text-navy-800 grid place-items-center font-bold">SI</div>
                @endif
                <div>
                    <p class="text-white font-semibold text-sm">Portal Siswa</p>
                    <p class="text-xs text-slate-400">SMK Infokom Bogor</p>
                </div>
            </div>
            <nav class="px-3 py-4 text-sm space-y-1">
                @php($active = fn($r) => request()->routeIs($r) ? 'bg-white/10 text-white' : 'text-slate-300 hover:bg-white/5 hover:text-white')
                <a href="{{ route('student.dashboard') }}" class="block px-3 py-2.5 rounded-lg {{ $active('student.dashboard') }}">Dashboard</a>
                <a href="{{ route('student.profile') }}" class="block px-3 py-2.5 rounded-lg {{ $active('student.profile') }}">Profil</a>
                <a href="{{ route('student.schedule') }}" class="block px-3 py-2.5 rounded-lg {{ $active('student.schedule') }}">Jadwal</a>
                <a href="{{ route('student.classmates') }}" class="block px-3 py-2.5 rounded-lg {{ $active('student.classmates') }}">Teman Sekelas</a>
                <a href="{{ route('student.grades') }}" class="block px-3 py-2.5 rounded-lg {{ $active('student.grades') }}">Nilai</a>
                <a href="{{ route('student.attendance') }}" class="block px-3 py-2.5 rounded-lg {{ $active('student.attendance') }}">Kehadiran</a>
                <a href="{{ route('student.announcements') }}" class="block px-3 py-2.5 rounded-lg {{ $active('student.announcements') }}">Pengumuman</a>
            </nav>
        </aside>

        <div x-show="sidebar" @click="sidebar=false" style="display:none" class="fixed inset-0 bg-black/40 z-30 lg:hidden"></div>

        <div class="flex-1 min-w-0">
            <header class="sticky top-0 z-20 bg-white border-b border-slate-200">
                <div class="flex items-center justify-between px-4 sm:px-6 py-3.5">
                    <div class="flex items-center gap-3">
                        <button @click="sidebar = !sidebar" class="lg:hidden p-2 rounded-lg hover:bg-slate-100">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                        </button>
                        <h1 class="font-semibold text-slate-800 text-lg">@yield('title', 'Dashboard')</h1>
                    </div>
                    <form method="POST" action="{{ route('student.logout') }}">
                        @csrf
                        <button class="text-sm text-slate-500 hover:text-red-600 font-medium">Keluar</button>
                    </form>
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
</body>
</html>
