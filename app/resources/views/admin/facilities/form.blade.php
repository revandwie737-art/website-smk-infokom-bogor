@extends('layouts.admin')
@section('title', $facility->exists ? 'Edit Fasilitas' : 'Tambah Fasilitas')
@section('content')

<x-admin.page-header
    :title="$facility->exists ? 'Edit Fasilitas' : 'Tambah Fasilitas'"
    description="Data ini akan tampil sebagai kartu di halaman Fasilitas."
/>

<form method="POST" action="{{ $facility->exists ? route('admin.facilities.update', $facility) : route('admin.facilities.store') }}" enctype="multipart/form-data" class="max-w-3xl space-y-6">
    @csrf
    @if($facility->exists) @method('PUT') @endif

    <x-admin.section title="Informasi Dasar" description="Nama dan detail fasilitas." icon="📋">
        <div>
            <label class="block text-sm font-medium text-slate-600 mb-1.5">Nama Fasilitas</label>
            <input type="text" name="name" value="{{ old('name', $facility->name) }}" required placeholder="cth: Laboratorium Komputer" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
        </div>
        <div>
            <label class="block text-sm font-medium text-slate-600 mb-1.5">Deskripsi</label>
            <textarea name="description" rows="3" placeholder="Ceritakan sedikit tentang fasilitas ini..." class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">{{ old('description', $facility->description) }}</textarea>
        </div>
        <div class="grid sm:grid-cols-2 gap-5">
            <div>
                <label class="block text-sm font-medium text-slate-600 mb-1.5">Jumlah</label>
                <input type="number" name="quantity" value="{{ old('quantity', $facility->quantity) }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-600 mb-1.5">Urutan Tampil</label>
                <input type="number" name="sort_order" value="{{ old('sort_order', $facility->sort_order) }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
            </div>
        </div>
    </x-admin.section>

    <x-admin.section title="Foto" description="Foto utama tetap tampil utuh (tidak dipotong) di halaman publik." icon="🖼️">
        <div class="max-w-md">
            <x-admin.file-drop
                name="photo"
                label="Foto Fasilitas"
                ratio="aspect-video"
                :current="$facility->photo ? asset('storage/' . $facility->photo) : null"
                help="Foto ini ditampilkan utuh, tanpa dipotong, di kartu Fasilitas."
            />
        </div>
    </x-admin.section>

    <x-admin.form-actions :cancel-route="route('admin.facilities.index')" />
</form>
@endsection
