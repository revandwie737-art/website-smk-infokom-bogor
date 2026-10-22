<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password - SMK Infokom Bogor</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = { theme: { extend: { colors: {
            navy: { 50:'#eff6ff',700:'#1e40af',800:'#172554',900:'#0f172a' }, sky: { 500:'#0ea5e9' }
        } } } }
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style> body { font-family: 'Plus Jakarta Sans', system-ui, sans-serif; } </style>
</head>
<body class="min-h-screen bg-gradient-to-br from-navy-900 via-navy-800 to-navy-900 grid place-items-center px-4">
    <div class="w-full max-w-md bg-white rounded-3xl shadow-2xl p-8 sm:p-10">
        <div class="text-center mb-8">
            <div class="h-14 w-14 rounded-2xl bg-navy-700 text-white grid place-items-center font-bold text-xl mx-auto mb-4">SI</div>
            <h1 class="text-xl font-bold text-navy-900">Lupa Password</h1>
            <p class="text-sm text-slate-400 mt-1">Masukkan email Anda untuk menerima link reset password</p>
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

        <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
            @csrf
            <div>
                <label class="block text-sm font-medium text-slate-600 mb-1.5">Email</label>
                <input type="email" name="email" required autofocus class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
            </div>
            <button type="submit" class="w-full py-3 rounded-xl bg-navy-700 text-white font-semibold hover:bg-navy-800 transition">
                Kirim Link Reset
            </button>
        </form>
    </div>
</body>
</html>
