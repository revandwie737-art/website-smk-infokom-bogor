<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun Siswa - SMK Infokom Bogor</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = { theme: { extend: { colors: {
            navy: { 50:'#eff6ff',700:'#1e40af',800:'#172554',900:'#0f172a' }, sky: { 500:'#0ea5e9' }
        } } } }
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style> body { font-family: 'Plus Jakarta Sans', system-ui, sans-serif; } </style>
</head>
<body class="min-h-screen bg-gradient-to-br from-sky-50 via-white to-navy-50 grid place-items-center px-4 py-12">
    <div class="w-full max-w-xl bg-white rounded-3xl shadow-2xl p-8 sm:p-10 border border-slate-100">
        <div class="text-center mb-8">
            @php($authLogo = \App\Models\SchoolSetting::get('site_logo'))
            @if($authLogo)
                <div class="h-14 w-14 rounded-full bg-white overflow-hidden grid place-items-center mx-auto mb-4 ring-1 ring-slate-100">
                    <img src="{{ asset('storage/' . $authLogo) }}" class="w-full h-full object-contain" alt="Logo">
                </div>
            @else
                <div class="h-14 w-14 rounded-full bg-navy-700 text-white grid place-items-center font-bold text-xl mx-auto mb-4">SI</div>
            @endif
            <h1 class="text-xl font-bold text-navy-900">Daftar Akun Siswa</h1>
            <p class="text-sm text-slate-400 mt-1">Akun akan aktif setelah disetujui oleh admin</p>
        </div>

        @if($errors->any())
            <div class="mb-5 rounded-xl bg-red-50 border border-red-200 text-red-700 px-4 py-3 text-sm">
                <ul class="list-disc list-inside space-y-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('student.register') }}" class="space-y-5">
            @csrf
            <div>
                <label class="block text-sm font-medium text-slate-600 mb-1.5">Nama Lengkap</label>
                <input type="text" name="name" value="{{ old('name') }}" required class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
            </div>
            <div class="grid sm:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-medium text-slate-600 mb-1.5">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-600 mb-1.5">NISN</label>
                    <input type="text" name="nisn" value="{{ old('nisn') }}" required class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
                </div>
            </div>
            <div class="grid sm:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-medium text-slate-600 mb-1.5">Password</label>
                    <input type="password" name="password" required class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
                    <p class="text-xs text-slate-400 mt-1">Minimal 8 karakter</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-600 mb-1.5">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" required class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
                </div>
            </div>
            <div class="grid sm:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-medium text-slate-600 mb-1.5">No. HP</label>
                    <input type="text" name="phone" value="{{ old('phone') }}" required class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-600 mb-1.5">Tanggal Lahir</label>
                    <input type="date" name="birth_date" value="{{ old('birth_date') }}" required class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-600 mb-1.5">Alamat</label>
                <textarea name="address" rows="3" required class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">{{ old('address') }}</textarea>
            </div>
            <button type="submit" class="w-full py-3 rounded-xl bg-navy-700 text-white font-semibold hover:bg-navy-800 transition">
                Daftar
            </button>
        </form>

        <p class="text-center text-sm text-slate-500 mt-6">
            Sudah punya akun? <a href="{{ route('student.login') }}" class="text-sky-600 font-semibold">Masuk di sini</a>
        </p>
    </div>
</body>
</html>
