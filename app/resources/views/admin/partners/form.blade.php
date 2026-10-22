@extends('layouts.admin')
@section('title', $partner->exists ? 'Edit Mitra Kerjasama' : 'Tambah Mitra Kerjasama')
@section('content')

<x-admin.page-header :title="$partner->exists ? 'Edit Mitra Kerjasama' : 'Tambah Mitra Kerjasama'" />

<form method="POST" action="{{ $partner->exists ? route('admin.partners.update', $partner) : route('admin.partners.store') }}" enctype="multipart/form-data" class="max-w-2xl space-y-6">
    @csrf
    @if($partner->exists) @method('PUT') @endif

    <x-admin.section title="Informasi Mitra" icon="🤝">
        <div class="grid sm:grid-cols-2 gap-5">
            <div>
                <label class="block text-sm font-medium text-slate-600 mb-1.5">Nama Mitra</label>
                <input type="text" name="name" value="{{ old('name', $partner->name) }}" required class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-600 mb-1.5">Kategori</label>
                <select name="type" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
                    <option value="universitas" @selected(old('type', $partner->type) === 'universitas')>Universitas</option>
                    <option value="industri" @selected(old('type', $partner->type ?? 'industri') === 'industri')>Industri</option>
                </select>
            </div>
        </div>
        <div>
            <label class="block text-sm font-medium text-slate-600 mb-1.5">Website (opsional)</label>
            <input type="url" name="website" value="{{ old('website', $partner->website) }}" placeholder="https://" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
        </div>
        <div>
            <label class="block text-sm font-medium text-slate-600 mb-1.5">Urutan Tampil</label>
            <input type="number" name="sort_order" value="{{ old('sort_order', $partner->sort_order ?? 0) }}" class="w-40 px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
        </div>
    </x-admin.section>

    <x-admin.section title="Logo" icon="🖼️">
        <div class="max-w-md">
            <x-admin.file-drop name="logo" label="Logo Mitra" ratio="aspect-video" :current="$partner->logo ? asset('storage/' . $partner->logo) : null" help="Format gambar, latar transparan/putih lebih rapi." />
        </div>
    </x-admin.section>

    <x-admin.form-actions :cancel-route="route('admin.partners.index')" />
</form>
@endsection
