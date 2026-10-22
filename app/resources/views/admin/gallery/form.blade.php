@extends('layouts.admin')
@section('title', $gallery->exists ? 'Kelola Album' : 'Tambah Album')
@section('content')

<x-admin.page-header
    :title="$gallery->exists ? 'Kelola Album: ' . $gallery->title : 'Tambah Album'"
    description="Album ini akan tampil sebagai kartu di halaman Galeri."
/>

<form method="POST" action="{{ $gallery->exists ? route('admin.gallery.update', $gallery) : route('admin.gallery.store') }}" enctype="multipart/form-data" class="max-w-3xl space-y-6">
    @csrf
    @if($gallery->exists) @method('PUT') @endif

    <x-admin.section title="Informasi Album" description="Judul, kategori, dan tanggal kegiatan." icon="📋">
        <div>
            <label class="block text-sm font-medium text-slate-600 mb-1.5">Judul Album</label>
            <input type="text" name="title" value="{{ old('title', $gallery->title) }}" required placeholder="cth: Praktik di Laboratorium" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
        </div>
        <div class="grid sm:grid-cols-2 gap-5">
            <div>
                <label class="block text-sm font-medium text-slate-600 mb-1.5">Kategori</label>
                <input type="text" name="category" value="{{ old('category', $gallery->category) }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-600 mb-1.5">Tanggal Kegiatan</label>
                <input type="date" name="event_date" value="{{ old('event_date', optional($gallery->event_date)->format('Y-m-d')) }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
            </div>
        </div>
    </x-admin.section>

    <x-admin.section title="Foto Cover" description="Cover memenuhi penuh kartu Galeri (tanpa blur di sekelilingnya)." icon="🖼️">
        <div class="max-w-md">
            <x-admin.file-drop
                name="cover"
                label="Foto Cover"
                ratio="aspect-video"
                :current="$gallery->cover ? asset('storage/' . $gallery->cover) : null"
                help="Foto ini akan memenuhi kartu album (sedikit terpotong menyesuaikan bentuk kartu) agar tidak ada ruang kosong."
            />
        </div>
    </x-admin.section>

    <x-admin.section title="Foto dalam Album" description="Tambahkan beberapa foto sekaligus ke album ini." icon="📸">
        <div>
            <label class="block text-sm font-medium text-slate-600 mb-1.5">Tambah Foto (bisa pilih banyak sekaligus)</label>
            <input type="file" name="images[]" multiple accept="image/*" class="w-full text-sm file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:bg-navy-50 file:text-navy-700 file:font-medium hover:file:bg-navy-100">
        </div>
    </x-admin.section>

    <x-admin.form-actions :cancel-route="route('admin.gallery.index')" />
</form>

@if($gallery->exists && $gallery->images->count())
    <div class="mt-8 max-w-3xl bg-white rounded-2xl border border-slate-100 shadow-sm shadow-slate-100/60 p-6 sm:p-7">
        <div class="flex items-center gap-3 mb-5">
            <div class="h-9 w-9 rounded-xl bg-navy-50 text-navy-700 grid place-items-center text-base">📸</div>
            <p class="font-semibold text-slate-800">Foto dalam Album ({{ $gallery->images->count() }})</p>
        </div>
        <div class="grid grid-cols-3 sm:grid-cols-4 gap-4">
            @foreach($gallery->images as $image)
                <div class="relative group rounded-xl overflow-hidden">
                    <x-media-frame ratio="aspect-square" :src="asset('storage/' . $image->image)" icon="🖼️" />
                    <form method="POST" action="{{ route('admin.gallery.images.destroy', $image) }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')" class="absolute top-1.5 right-1.5">
                        @csrf @method('DELETE')
                        <button class="h-7 w-7 rounded-full bg-white/90 text-red-500 grid place-items-center shadow hover:bg-white transition"><i data-lucide="x" class="w-3.5 h-3.5"></i></button>
                    </form>
                </div>
            @endforeach
        </div>
    </div>
@endif
@endsection
