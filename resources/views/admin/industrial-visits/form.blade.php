@extends('layouts.admin')
@section('title', $visit->exists ? 'Kelola Kunjungan Industri' : 'Tambah Kunjungan Industri')
@section('content')

<x-admin.page-header
    :title="$visit->exists ? 'Kelola Kunjungan: ' . $visit->title : 'Tambah Kunjungan Industri'"
    description="Kegiatan ini akan tampil sebagai kartu di halaman Kunjungan Industri."
/>

<form method="POST" action="{{ $visit->exists ? route('admin.industrial-visits.update', $visit) : route('admin.industrial-visits.store') }}" enctype="multipart/form-data" class="max-w-3xl space-y-6">
    @csrf
    @if($visit->exists) @method('PUT') @endif

    <x-admin.section title="Informasi Kegiatan" description="Nama kegiatan, perusahaan yang dikunjungi, tanggal, dan deskripsi." icon="📋">
        <div>
            <label class="block text-sm font-medium text-slate-600 mb-1.5">Nama Kegiatan</label>
            <input type="text" name="title" value="{{ old('title', $visit->title) }}" required placeholder="cth: Kunjungan Industri ke Perusahaan Mitra" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
        </div>
        <div class="grid sm:grid-cols-2 gap-5">
            <div>
                <label class="block text-sm font-medium text-slate-600 mb-1.5">Nama Perusahaan / Instansi (opsional)</label>
                <input type="text" name="company" value="{{ old('company', $visit->company) }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-600 mb-1.5">Tanggal Kunjungan</label>
                <input type="date" name="visit_date" value="{{ old('visit_date', optional($visit->visit_date)->format('Y-m-d')) }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
            </div>
        </div>
        <div>
            <label class="block text-sm font-medium text-slate-600 mb-1.5">Deskripsi</label>
            <textarea name="description" rows="5" placeholder="Ceritakan singkat tentang kegiatan kunjungan ini." class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">{{ old('description', $visit->description) }}</textarea>
            <p class="text-xs text-slate-400 mt-1.5">Di kartu, deskripsi ditampilkan ringkas. Versi lengkap tampil di halaman detail.</p>
        </div>
        <label class="flex items-center gap-3 rounded-xl border border-slate-200 px-4 py-3 cursor-pointer hover:border-sky-300">
            <input type="hidden" name="is_published" value="0">
            <input type="checkbox" name="is_published" value="1" @checked(old('is_published', $visit->exists ? $visit->is_published : true)) class="h-5 w-5 rounded border-slate-300">
            <span class="text-sm font-medium text-slate-700">Tampilkan di website <span class="text-slate-400 font-normal">(hilangkan centang untuk menyimpan sebagai draf)</span></span>
        </label>
    </x-admin.section>

    <x-admin.section title="Foto Cover" description="Foto utama yang tampil di kartu kegiatan." icon="🖼️">
        <div class="max-w-md">
            <x-admin.file-drop
                name="cover"
                label="Foto Cover"
                ratio="aspect-video"
                :current="$visit->cover ? asset('storage/' . $visit->cover) : null"
                help="Kosongkan jika ingin memakai foto pertama dari galeri sebagai cover."
            />
        </div>
    </x-admin.section>

    <x-admin.section title="Tambah Foto Galeri" description="Foto dokumentasi kegiatan. Bisa pilih banyak sekaligus; keterangan tiap foto bisa diisi setelah tersimpan." icon="📸">
        <div>
            <label class="block text-sm font-medium text-slate-600 mb-1.5">Tambah Foto (bisa pilih banyak sekaligus)</label>
            <input type="file" name="images[]" multiple accept="image/*" class="w-full text-sm file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:bg-navy-50 file:text-navy-700 file:font-medium hover:file:bg-navy-100">
            <p class="text-xs text-slate-400 mt-1.5">Maksimal 2 MB per foto.</p>
        </div>
    </x-admin.section>

    <div class="flex gap-3 pb-2">
        <button type="submit" class="px-8 py-3 rounded-xl bg-navy-700 text-white font-semibold hover:bg-navy-800 transition">Simpan</button>
        <a href="{{ route('admin.industrial-visits.index') }}" class="px-8 py-3 rounded-xl border border-slate-200 text-slate-600 font-medium hover:bg-slate-50 transition">Batal</a>
    </div>
</form>

@if($visit->exists && $visit->photos->count())
    <div class="mt-8 max-w-3xl bg-white rounded-2xl border border-slate-100 shadow-sm shadow-slate-100/60 p-6 sm:p-7">
        <div class="flex items-center gap-3 mb-5">
            <div class="h-9 w-9 rounded-xl bg-navy-50 text-navy-700 grid place-items-center text-base">📸</div>
            <p class="font-semibold text-slate-800">Foto Galeri ({{ $visit->photos->count() }})</p>
        </div>

        <div class="grid sm:grid-cols-2 gap-5">
            @foreach($visit->photos as $photo)
                <div class="rounded-xl border border-slate-100 p-3">
                    <div class="relative rounded-lg overflow-hidden">
                        <x-media-frame ratio="aspect-[4/3]" :src="asset('storage/' . $photo->image)" icon="🖼️" />
                        <form method="POST" action="{{ route('admin.industrial-visits.photos.destroy', $photo) }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus foto ini?')" class="absolute top-1.5 right-1.5">
                            @csrf @method('DELETE')
                            <button class="h-7 w-7 rounded-full bg-white/90 text-red-500 grid place-items-center text-xs shadow hover:bg-white" aria-label="Hapus foto">✕</button>
                        </form>
                    </div>

                    <form method="POST" action="{{ route('admin.industrial-visits.photos.update', $photo) }}" enctype="multipart/form-data" class="mt-3 space-y-2.5">
                        @csrf @method('PUT')
                        <input type="text" name="caption" value="{{ $photo->caption }}" maxlength="200" placeholder="Keterangan foto (opsional)" class="w-full px-3 py-2 rounded-lg border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-sky-300">
                        <div>
                            <label class="block text-xs font-medium text-slate-500 mb-1">Ganti file foto (opsional)</label>
                            <input type="file" name="image" accept="image/*" class="w-full text-xs file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:bg-navy-50 file:text-navy-700 file:font-medium hover:file:bg-navy-100">
                        </div>
                        <button type="submit" class="px-4 py-2 rounded-lg bg-navy-700 text-white text-xs font-semibold hover:bg-navy-800 transition">Simpan foto ini</button>
                    </form>
                </div>
            @endforeach
        </div>
    </div>
@endif
@endsection