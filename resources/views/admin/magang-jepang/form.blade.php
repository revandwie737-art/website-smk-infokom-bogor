@extends('layouts.admin')
@section('title', $item->exists ? 'Edit Foto Magang Jepang' : 'Tambah Foto Magang Jepang')
@section('content')

<x-admin.page-header :title="$item->exists ? 'Edit Foto Magang Jepang' : 'Tambah Foto Magang Jepang'" />

<form method="POST" action="{{ $item->exists ? route('admin.magang-jepang.update', $item) : route('admin.magang-jepang.store') }}" enctype="multipart/form-data" class="max-w-2xl space-y-6">
    @csrf
    @if($item->exists) @method('PUT') @endif

    <x-admin.section title="Foto" icon="🖼️">
        <x-admin.file-drop
            name="image"
            label="Foto Magang Jepang"
            ratio="aspect-[3/4]"
            :current="$item->exists ? $item->image_url : null"
            help="Format JPG, JPEG, PNG, atau WEBP. Maksimal 2 MB. Foto tampil dalam bingkai vertikal (tegak), jadi foto tegak paling pas." />
    </x-admin.section>

    <x-admin.section title="Informasi Foto" icon="📝">
        <div>
            <label class="block text-sm font-medium text-slate-600 mb-1.5">Judul</label>
            <input type="text" name="title" value="{{ old('title', $item->title) }}" required maxlength="150" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
        </div>
        <div>
            <label class="block text-sm font-medium text-slate-600 mb-1.5">Deskripsi</label>
            <textarea name="description" rows="5" maxlength="2000" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">{{ old('description', $item->description) }}</textarea>
        </div>
    </x-admin.section>

    <x-admin.section title="Sumber Foto" description="Isi sesuai sumber asli foto. Kosongkan link jika tidak ada." icon="🔗">
        <div class="grid sm:grid-cols-2 gap-5">
            <div>
                <label class="block text-sm font-medium text-slate-600 mb-1.5">Nama Sumber</label>
                <input type="text" name="source_name" value="{{ old('source_name', $item->source_name) }}" maxlength="150" placeholder="Website / organisasi" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-600 mb-1.5">Link Sumber</label>
                <input type="url" name="source_url" value="{{ old('source_url', $item->source_url) }}" maxlength="500" placeholder="https://" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
            </div>
        </div>
    </x-admin.section>

    <x-admin.section title="Pengaturan Tampil" icon="⚙️">
        <div class="grid sm:grid-cols-2 gap-5 items-end">
            <div>
                <label class="block text-sm font-medium text-slate-600 mb-1.5">Urutan Tampil</label>
                <input type="number" min="0" name="sort_order" value="{{ old('sort_order', $item->sort_order ?? 0) }}" class="w-40 px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
                <p class="text-xs text-slate-400 mt-1.5">Angka kecil tampil lebih dulu.</p>
            </div>
            <div>
                <input type="hidden" name="is_active" value="0">
                <label class="inline-flex items-center gap-3 cursor-pointer">
                    <input type="checkbox" name="is_active" value="1" class="h-5 w-5 rounded border-slate-300 text-navy-700 focus:ring-sky-300"
                        @checked(old('is_active', $item->exists ? $item->is_active : ($activeCount < 3)))>
                    <span class="text-sm font-medium text-slate-700">Tampilkan di halaman publik</span>
                </label>
                <p class="text-xs text-slate-400 mt-1.5">Maksimal 3 foto aktif. Saat ini ada {{ $activeCount }} foto aktif lain.</p>
            </div>
        </div>
    </x-admin.section>

    <div class="flex gap-3 pb-2">
        <button type="submit" class="px-8 py-3 rounded-xl bg-navy-700 text-white font-semibold hover:bg-navy-800 transition">Simpan</button>
        <a href="{{ route('admin.magang-jepang.index') }}" class="px-8 py-3 rounded-xl border border-slate-200 text-slate-600 font-medium hover:bg-slate-50 transition">Batal</a>
    </div>
</form>
@endsection