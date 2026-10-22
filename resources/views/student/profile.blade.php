@extends('layouts.student')
@section('title', 'Profil')
@section('content')
<div class="grid lg:grid-cols-2 gap-6">
    <form method="POST" action="{{ route('student.profile.update') }}" enctype="multipart/form-data" class="bg-white rounded-2xl border border-slate-100 p-6 space-y-5">
        @csrf
        <p class="font-semibold text-slate-800">Data Diri</p>

        <div class="flex items-center gap-4">
            <div class="h-16 w-16 rounded-full bg-navy-100 overflow-hidden">
                @if($student && $student->photo)
                    <img src="{{ asset('storage/' . $student->photo) }}" class="w-full h-full object-contain">
                @endif
            </div>
            <input type="file" name="photo" class="text-sm">
        </div>

        <div>
            <label class="block text-sm font-medium text-slate-600 mb-1.5">Nama Lengkap</label>
            <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}" required class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
        </div>
        <div>
            <label class="block text-sm font-medium text-slate-600 mb-1.5">Email</label>
            <input type="email" value="{{ auth()->user()->email }}" disabled class="w-full px-4 py-2.5 rounded-xl border border-slate-200 bg-slate-50 text-slate-400">
        </div>
        <div>
            <label class="block text-sm font-medium text-slate-600 mb-1.5">NISN</label>
            <input type="text" value="{{ $student->nisn ?? '-' }}" disabled class="w-full px-4 py-2.5 rounded-xl border border-slate-200 bg-slate-50 text-slate-400">
        </div>
        <div>
            <label class="block text-sm font-medium text-slate-600 mb-1.5">No. HP</label>
            <input type="text" name="phone" value="{{ old('phone', $student->phone ?? '') }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
        </div>
        <div>
            <label class="block text-sm font-medium text-slate-600 mb-1.5">Alamat</label>
            <textarea name="address" rows="3" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">{{ old('address', $student->address ?? '') }}</textarea>
        </div>
        <button type="submit" class="px-8 py-3 rounded-xl bg-navy-700 text-white font-semibold hover:bg-navy-800">Simpan Perubahan</button>
    </form>

    <form method="POST" action="{{ route('student.profile.password') }}" class="bg-white rounded-2xl border border-slate-100 p-6 space-y-5 h-fit">
        @csrf
        <p class="font-semibold text-slate-800">Ubah Password</p>
        <div>
            <label class="block text-sm font-medium text-slate-600 mb-1.5">Password Saat Ini</label>
            <input type="password" name="current_password" required class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
        </div>
        <div>
            <label class="block text-sm font-medium text-slate-600 mb-1.5">Password Baru</label>
            <input type="password" name="password" required class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
        </div>
        <div>
            <label class="block text-sm font-medium text-slate-600 mb-1.5">Konfirmasi Password Baru</label>
            <input type="password" name="password_confirmation" required class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
        </div>
        <button type="submit" class="px-8 py-3 rounded-xl bg-slate-800 text-white font-semibold hover:bg-slate-900">Ubah Password</button>
    </form>
</div>
@endsection
