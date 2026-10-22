@extends('layouts.admin')
@section('title', $partner->exists ? 'Edit Mitra PKL' : 'Tambah Mitra PKL')
@section('content')

<x-admin.page-header
    :title="$partner->exists ? 'Edit Mitra PKL' : 'Tambah Mitra PKL'"
    description="Data ini akan tampil sebagai kartu mitra di halaman PKL."
/>

<form method="POST" action="{{ $partner->exists ? route('admin.pkl-partners.update', $partner) : route('admin.pkl-partners.store') }}" enctype="multipart/form-data" class="max-w-3xl space-y-6">
    @csrf
    @if($partner->exists) @method('PUT') @endif

    <x-admin.section title="Informasi Mitra" description="Nama perusahaan/instansi, bidang, dan alamat." icon="🏢">
        <div>
            <label class="block text-sm font-medium text-slate-600 mb-1.5">Nama Perusahaan / Instansi</label>
            <input type="text" name="name" value="{{ old('name', $partner->name) }}" required placeholder="cth: PT Telekomunikasi Indonesia" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
        </div>
        <div class="grid sm:grid-cols-2 gap-5">
            <div>
                <label class="block text-sm font-medium text-slate-600 mb-1.5">Bidang / Program PKL</label>
                <input type="text" name="field" value="{{ old('field', $partner->field) }}" placeholder="cth: Rekayasa Perangkat Lunak" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-600 mb-1.5">Website (opsional)</label>
                <input type="url" name="website" value="{{ old('website', $partner->website) }}" placeholder="https://" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
            </div>
        </div>
        <div>
            <label class="block text-sm font-medium text-slate-600 mb-1.5">Alamat</label>
            <input type="text" name="address" value="{{ old('address', $partner->address) }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
        </div>
        <div>
            <label class="block text-sm font-medium text-slate-600 mb-1.5">Deskripsi</label>
            <textarea name="description" rows="3" placeholder="Bidang usaha, jumlah siswa yang diterima, dsb." class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">{{ old('description', $partner->description) }}</textarea>
        </div>
        <div>
            <label class="block text-sm font-medium text-slate-600 mb-1.5">Urutan Tampil</label>
            <input type="number" name="sort_order" value="{{ old('sort_order', $partner->sort_order ?? 0) }}" class="w-40 px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
        </div>
        <label class="flex items-center gap-3">
            <input type="hidden" name="is_active" value="0">
            <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $partner->is_active ?? true)) class="rounded border-slate-300">
            <span class="text-sm text-slate-600">Aktif &mdash; tampilkan di halaman PKL</span>
        </label>
    </x-admin.section>

    <x-admin.section title="Logo" description="Logo/foto mitra akan memenuhi kartu (sedikit terpotong menyesuaikan bentuk kartu)." icon="🖼️">
        <div class="max-w-md">
            <x-admin.file-drop
                name="logo"
                label="Logo / Foto Mitra"
                ratio="aspect-video"
                :current="$partner->logo ? asset('storage/' . $partner->logo) : null"
                help="Format gambar, maks 2MB."
            />
        </div>
    </x-admin.section>

    <div class="flex gap-3 pb-2">
        <button type="submit" class="px-8 py-3 rounded-xl bg-navy-700 text-white font-semibold hover:bg-navy-800 transition">Simpan</button>
        <a href="{{ route('admin.pkl-partners.index') }}" class="px-8 py-3 rounded-xl border border-slate-200 text-slate-600 font-medium hover:bg-slate-50 transition">Batal</a>
    </div>
</form>
@endsection
