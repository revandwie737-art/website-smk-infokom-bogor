<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - SMK Infokom Bogor</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = { theme: { extend: { colors: {
            navy: { 50:'#eff6ff',100:'#dbeafe',200:'#bfdbfe',600:'#1d4ed8',700:'#1e40af',800:'#172554',900:'#0f172a' },
            sky: { 400:'#38bdf8', 500:'#0ea5e9' },
        } } } }
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js" defer></script>
    <style>
        body { font-family: 'Plus Jakarta Sans', system-ui, sans-serif; }
        @keyframes blob { 0%,100%{ transform: translate(0,0) scale(1); } 33%{ transform: translate(30px,-40px) scale(1.1); } 66%{ transform: translate(-20px,20px) scale(.95); } }
        @keyframes fadeInUp { from{ opacity:0; transform:translateY(18px); } to{ opacity:1; transform:translateY(0); } }
        @keyframes gridPan { from{ background-position:0 0; } to{ background-position:60px 60px; } }
        .blob { animation: blob 12s ease-in-out infinite; }
        .card-enter { animation: fadeInUp .6s cubic-bezier(.16,1,.3,1) both; }
        .bg-grid { background-image: linear-gradient(rgba(255,255,255,.06) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,.06) 1px, transparent 1px); background-size: 34px 34px; animation: gridPan 16s linear infinite; }
        [x-cloak]{ display:none !important; }
    </style>
</head>
<body class="min-h-screen relative overflow-hidden bg-navy-900 grid place-items-center px-4 py-10">

    <div class="absolute inset-0 bg-gradient-to-br from-navy-900 via-navy-800 to-slate-950"></div>
    <div class="absolute inset-0 bg-grid opacity-40"></div>
    <div class="blob pointer-events-none absolute top-[-10%] left-[-8%] h-80 w-80 rounded-full bg-sky-500/25 blur-[90px]"></div>
    <div class="blob pointer-events-none absolute bottom-[-12%] right-[-8%] h-96 w-96 rounded-full bg-navy-400/25 blur-[100px]" style="animation-delay:2s"></div>
    <div class="blob pointer-events-none absolute top-1/3 right-1/4 h-52 w-52 rounded-full bg-indigo-400/10 blur-[80px]" style="animation-delay:4s"></div>

    <div class="relative w-full max-w-md card-enter">
        <div class="bg-white/95 backdrop-blur-xl rounded-3xl shadow-2xl shadow-black/40 p-8 sm:p-10 ring-1 ring-white/10">
            <div class="text-center mb-8">
                @php($authLogo = \App\Models\SchoolSetting::get('site_logo'))
                @if($authLogo)
                    <div class="h-16 w-16 rounded-2xl bg-white overflow-hidden grid place-items-center mx-auto mb-4 ring-1 ring-slate-100 shadow-lg shadow-navy-900/10">
                        <img src="{{ asset('storage/' . $authLogo) }}" class="w-full h-full object-contain" alt="Logo">
                    </div>
                @else
                    <div class="h-16 w-16 rounded-2xl bg-gradient-to-br from-navy-700 to-sky-500 text-white grid place-items-center font-extrabold text-2xl mx-auto mb-4 shadow-lg shadow-navy-900/20">SI</div>
                @endif
                <h1 class="text-xl font-extrabold text-navy-900 tracking-tight">Login Dashboard Admin</h1>
                <p class="text-sm text-slate-400 mt-1">SMK Infokom Bogor</p>
            </div>

            @if($errors->any())
                <div class="mb-5 rounded-xl bg-red-50 border border-red-200 text-red-700 px-4 py-3 text-sm flex items-start gap-2.5">
                    <i data-lucide="alert-triangle" class="w-4 h-4 mt-0.5 shrink-0"></i>
                    <span>{{ $errors->first() }}</span>
                </div>
            @endif

            <form method="POST" action="{{ route('admin.login') }}" class="space-y-5" x-data="{ show: false, loading: false }" @submit="loading = true">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-slate-600 mb-1.5">Email</label>
                    <div class="relative">
                        <i data-lucide="mail" class="w-4 h-4 absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400"></i>
                        <input type="email" name="email" value="{{ old('email') }}" required autofocus
                            class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300 focus:border-sky-300 transition">
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-600 mb-1.5">Password</label>
                    <div class="relative">
                        <i data-lucide="lock" class="w-4 h-4 absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400"></i>
                        <input :type="show ? 'text' : 'password'" name="password" required
                            class="w-full pl-10 pr-11 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300 focus:border-sky-300 transition">
                        <button type="button" @click="show = !show" class="absolute right-3.5 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600 transition">
                            <i data-lucide="eye" class="w-4 h-4" x-show="!show"></i>
                            <i data-lucide="eye-off" class="w-4 h-4" x-show="show" x-cloak></i>
                        </button>
                    </div>
                </div>
                <div class="flex items-center justify-between text-sm">
                    <label class="flex items-center gap-2 text-slate-500 cursor-pointer select-none">
                        <input type="checkbox" name="remember" class="rounded border-slate-300 text-sky-600 focus:ring-sky-300">
                        Ingat saya
                    </label>
                    <a href="{{ route('password.request') }}" class="text-sky-600 font-medium hover:text-sky-700">Lupa password?</a>
                </div>
                <button type="submit" :disabled="loading"
                    class="w-full py-3 rounded-xl bg-gradient-to-r from-navy-700 to-navy-900 text-white font-semibold hover:shadow-lg hover:shadow-navy-900/20 transition flex items-center justify-center gap-2 disabled:opacity-70">
                    <svg x-show="loading" x-cloak class="animate-spin h-4 w-4" viewBox="0 0 24 24" fill="none"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path></svg>
                    <span x-text="loading ? 'Memproses...' : 'Masuk'"></span>
                </button>
            </form>

            <p class="text-center text-xs text-slate-400 mt-8">
                <a href="{{ route('home') }}" class="inline-flex items-center gap-1.5 hover:text-navy-700 transition"><i data-lucide="arrow-left" class="w-3.5 h-3.5"></i> Kembali ke Website</a>
            </p>
        </div>
    </div>

    <script>document.addEventListener('DOMContentLoaded', () => window.lucide && lucide.createIcons());</script>
</body>
</html>
