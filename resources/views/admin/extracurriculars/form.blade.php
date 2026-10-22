@extends('layouts.admin')
@section('title', $item->exists ? 'Edit Ekstrakurikuler' : 'Tambah Ekstrakurikuler')
@section('content')

<x-admin.page-header
    :title="$item->exists ? 'Edit Ekstrakurikuler' : 'Tambah Ekstrakurikuler'"
    description="Data ini akan tampil sebagai kartu di halaman Ekstrakurikuler."
/>

<form method="POST" action="{{ $item->exists ? route('admin.extracurriculars.update', $item) : route('admin.extracurriculars.store') }}" enctype="multipart/form-data" class="max-w-3xl space-y-6">
    @csrf
    @if($item->exists) @method('PUT') @endif

    <x-admin.section title="Informasi Dasar" description="Nama, pembina, dan jadwal kegiatan." icon="📋">
        <div>
            <label class="block text-sm font-medium text-slate-600 mb-1.5">Nama</label>
            <input type="text" name="name" value="{{ old('name', $item->name) }}" required placeholder="cth: Pramuka" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
        </div>
        <div class="grid sm:grid-cols-2 gap-5">
            <div>
                <label class="block text-sm font-medium text-slate-600 mb-1.5">Pembina</label>
                <input type="text" name="coach" value="{{ old('coach', $item->coach) }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-600 mb-1.5">Jadwal</label>
                <input type="text" name="schedule" value="{{ old('schedule', $item->schedule) }}" placeholder="cth: Setiap Jumat, 15:00" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
            </div>
        </div>
        <div>
            <label class="block text-sm font-medium text-slate-600 mb-1.5">Deskripsi</label>
            <textarea name="description" rows="3" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">{{ old('description', $item->description) }}</textarea>
        </div>
        <label class="flex items-center gap-3">
            <input type="hidden" name="is_active" value="0">
            <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $item->is_active ?? true)) class="rounded border-slate-300">
            <span class="text-sm text-slate-600">Aktif &mdash; tampilkan di halaman publik</span>
        </label>
    </x-admin.section>

    <x-admin.section title="Foto" description="Foto/logo utama tetap tampil utuh (tidak dipotong) di halaman publik." icon="🖼️">
        <div class="max-w-md">
            <x-admin.file-drop
                name="logo"
                label="Foto / Logo"
                ratio="aspect-video"
                :current="$item->logo ? asset('storage/' . $item->logo) : null"
                help="Foto ini ditampilkan utuh, tanpa dipotong, di kartu Ekstrakurikuler."
            />
        </div>
    </x-admin.section>

    <div class="flex gap-3 pb-2">
        <button type="submit" class="px-8 py-3 rounded-xl bg-navy-700 text-white font-semibold hover:bg-navy-800 transition">Simpan</button>
        <a href="{{ route('admin.extracurriculars.index') }}" class="px-8 py-3 rounded-xl border border-slate-200 text-slate-600 font-medium hover:bg-slate-50 transition">Batal</a>
    </div>
</form>
@endsection
