@extends('layouts.admin')
@section('title', $partner->exists ? 'Edit Mitra Industri' : 'Tambah Mitra Industri')
@section('content')

<x-admin.form-header :title="$partner->exists ? 'Edit Mitra Industri' : 'Tambah Mitra Industri'" :back-route="route('admin.bkk-partners.index')" />

<form method="POST" action="{{ $partner->exists ? route('admin.bkk-partners.update', $partner) : route('admin.bkk-partners.store') }}" enctype="multipart/form-data" class="max-w-2xl space-y-6">
    @csrf
    @if($partner->exists) @method('PUT') @endif

    <x-admin.section title="Informasi Mitra" icon="🏢">
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-1.5">Nama Perusahaan</label>
            <input type="text" name="name" value="{{ old('name', $partner->name) }}" required class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
        </div>
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-1.5">Deskripsi</label>
            <textarea name="description" rows="3" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">{{ old('description', $partner->description) }}</textarea>
        </div>
        <div class="grid sm:grid-cols-2 gap-5">
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1.5">Website (opsional)</label>
                <input type="url" name="website" value="{{ old('website', $partner->website) }}" placeholder="https://" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1.5">Urutan Tampil</label>
                <input type="number" name="sort_order" value="{{ old('sort_order', $partner->sort_order ?? 0) }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
            </div>
        </div>
    </x-admin.section>

    <x-admin.section title="Logo" icon="🖼️">
        <div class="max-w-md">
            <x-admin.file-drop name="logo" label="Logo Perusahaan" ratio="aspect-video" :current="$partner->logo ? asset('storage/' . $partner->logo) : null" help="Format gambar, maks 2MB." />
        </div>
    </x-admin.section>

    <x-admin.form-actions :cancel-route="route('admin.bkk-partners.index')" />
</form>
@endsection
