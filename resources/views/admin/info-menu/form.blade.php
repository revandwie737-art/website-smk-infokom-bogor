@extends('layouts.admin')
@section('title', $item->exists ? 'Edit Menu Informasi' : 'Tambah Menu Informasi')
@section('content')

<x-admin.page-header
    :title="$item->exists ? 'Edit Menu' : 'Tambah Menu'"
    description="Item ini akan tampil sebagai satu baris di dropdown &quot;Informasi&quot; pada navbar situs."
/>

<form method="POST" action="{{ $item->exists ? route('admin.info-menu.update', $item) : route('admin.info-menu.store') }}" class="max-w-2xl space-y-6">
    @csrf
    @if($item->exists) @method('PUT') @endif

    <x-admin.section title="Isi Menu" description="Ikon boleh berupa emoji (cth: 🎓), judul, dan deskripsi singkat." icon="🧭">
        <div class="grid grid-cols-[6rem_1fr] gap-5">
            <div>
                <label class="block text-sm font-medium text-slate-600 mb-1.5">Ikon</label>
                <input type="text" name="icon" value="{{ old('icon', $item->icon) }}" maxlength="10" placeholder="🎓" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-center text-xl focus:outline-none focus:ring-2 focus:ring-sky-300">
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-600 mb-1.5">Judul</label>
                <input type="text" name="label" value="{{ old('label', $item->label) }}" required placeholder="cth: Data Guru" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
            </div>
        </div>
        <div>
            <label class="block text-sm font-medium text-slate-600 mb-1.5">Deskripsi Singkat</label>
            <input type="text" name="description" value="{{ old('description', $item->description) }}" placeholder="cth: Profil tenaga pendidik" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
        </div>
        <div>
            <label class="block text-sm font-medium text-slate-600 mb-1.5">Tautan</label>
            <input type="text" name="url" value="{{ old('url', $item->url) }}" required placeholder="/guru" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 font-mono text-sm focus:outline-none focus:ring-2 focus:ring-sky-300">
            <p class="text-xs text-slate-400 mt-1.5">Boleh alamat halaman di situs ini (cth: <code>/guru</code>) atau tautan lengkap ke situs lain (cth: <code>https://...</code>).</p>
        </div>
        <label class="flex items-center gap-2.5 text-sm text-slate-600">
            <input type="checkbox" name="is_active" value="1" {{ old('is_active', $item->exists ? $item->is_active : true) ? 'checked' : '' }} class="rounded border-slate-300 text-sky-600 focus:ring-sky-300">
            Tampilkan di navbar
        </label>
    </x-admin.section>

    <div class="flex gap-3 pb-2">
        <button type="submit" class="px-8 py-3 rounded-xl bg-navy-700 text-white font-semibold hover:bg-navy-800 transition">Simpan</button>
        <a href="{{ route('admin.info-menu.index') }}" class="px-8 py-3 rounded-xl border border-slate-200 text-slate-600 font-medium hover:bg-slate-50 transition">Batal</a>
    </div>
</form>
@endsection