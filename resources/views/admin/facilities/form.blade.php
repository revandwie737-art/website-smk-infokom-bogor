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

    @if($facility->exists && $facility->supportsGallery())
    <x-admin.section title="Foto Tambahan (Galeri)" description="Foto utama di atas menjadi foto pertama galeri. Tambahkan foto lain di sini, lalu saat kartu diklik semua foto tampil berurutan dan bisa digeser. Untuk 4 foto: foto utama + 3 foto tambahan." icon="📸">
        @php $extras = $facility->extra_photos ?? []; @endphp
        @if(count($extras))
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
                @foreach($extras as $extra)
                    <label class="block rounded-xl overflow-hidden border border-slate-200 bg-white cursor-pointer">
                        <img src="{{ asset('storage/' . $extra) }}" alt="" class="w-full aspect-video object-cover">
                        <span class="flex items-center gap-2 px-2.5 py-2 text-xs text-slate-600">
                            <input type="checkbox" name="remove_extra[]" value="{{ $extra }}" class="rounded border-slate-300"> Hapus foto ini
                        </span>
                    </label>
                @endforeach
            </div>
        @endif
        <div>
            <label class="block text-sm font-medium text-slate-600 mb-1.5">Tambah Foto (boleh pilih beberapa sekaligus)</label>
            <input type="file" name="extra_photos[]" multiple accept="image/*" class="block w-full text-sm text-slate-600 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:bg-navy-50 file:text-navy-700 file:font-semibold hover:file:bg-navy-100">
            <p class="text-xs text-slate-400 mt-1.5">Maksimal 2 MB per foto. Centang &ldquo;Hapus foto ini&rdquo; lalu Simpan untuk menghapus foto tambahan.</p>
        </div>
    </x-admin.section>
    @endif

    <div class="flex gap-3 pb-2">
        <button type="submit" class="px-8 py-3 rounded-xl bg-navy-700 text-white font-semibold hover:bg-navy-800 transition">Simpan</button>
        <a href="{{ route('admin.facilities.index') }}" class="px-8 py-3 rounded-xl border border-slate-200 text-slate-600 font-medium hover:bg-slate-50 transition">Batal</a>
    </div>
</form>
@endsection