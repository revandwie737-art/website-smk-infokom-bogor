<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Siswa - SMK Infokom Bogor</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = { theme: { extend: { colors: {
            navy: { 50:'#eff6ff',700:'#1e40af',800:'#172554',900:'#0f172a' }, sky: { 500:'#0ea5e9' }
        } } } }
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <style> body { font-family: 'Plus Jakarta Sans', system-ui, sans-serif; } </style>
</head>
<body class="min-h-screen bg-gradient-to-br from-sky-50 via-white to-navy-50 grid place-items-center px-4">
    <div class="w-full max-w-md bg-white rounded-3xl shadow-2xl p-8 sm:p-10 border border-slate-100">
        <div class="text-center mb-8">
            @php($authLogo = \App\Models\SchoolSetting::get('site_logo'))
            @if($authLogo)
                <div class="h-14 w-14 rounded-full bg-white overflow-hidden grid place-items-center mx-auto mb-4 ring-1 ring-slate-100">
                    <img src="{{ asset('storage/' . $authLogo) }}" class="w-full h-full object-contain" alt="Logo">
                </div>
            @else
                <div class="h-14 w-14 rounded-full bg-navy-700 text-white grid place-items-center font-bold text-xl mx-auto mb-4">SI</div>
            @endif
            <h1 class="text-xl font-bold text-navy-900">Portal Siswa</h1>
            <p class="text-sm text-slate-400 mt-1">SMK Infokom Bogor</p>
        </div>

        @if(session('success'))
            <div class="mb-5 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 text-sm">
                {{ session('success') }}
            </div>
        @endif
        @if($errors->any())
            <div class="mb-5 rounded-xl bg-red-50 border border-red-200 text-red-700 px-4 py-3 text-sm">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('student.login') }}" class="space-y-5" x-data="{ show: false }">
            @csrf
            <div>
                <label class="block text-sm font-medium text-slate-600 mb-1.5">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required autofocus
                    class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-600 mb-1.5">Password</label>
                <div class="relative">
                    <input :type="show ? 'text' : 'password'" name="password" required
                        class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300 pr-12">
                    <button type="button" @click="show = !show" class="absolute right-3 top-1/2 -translate-y-1/2 text-xs text-slate-400 font-medium">
                        <span x-text="show ? 'Sembunyikan' : 'Lihat'"></span>
                    </button>
                </div>
            </div>
            <div class="flex items-center justify-between text-sm">
                <label class="flex items-center gap-2 text-slate-500">
                    <input type="checkbox" name="remember" class="rounded border-slate-300">
                    Ingat saya
                </label>
                <a href="{{ route('password.request') }}" class="text-sky-600 font-medium">Lupa password?</a>
            </div>
            <button type="submit" class="w-full py-3 rounded-xl bg-navy-700 text-white font-semibold hover:bg-navy-800 transition">
                Masuk
            </button>
        </form>

        <p class="text-center text-sm text-slate-500 mt-6">
            Belum punya akun? <a href="{{ route('student.register') }}" class="text-sky-600 font-semibold">Daftar di sini</a>
        </p>
        <p class="text-center text-xs text-slate-400 mt-4">
            <a href="{{ route('home') }}" class="hover:text-navy-700">&larr; Kembali ke Website</a>
        </p>
    </div>
</body>
</html>
