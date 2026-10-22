@extends('layouts.admin')
@section('title', $program->exists ? 'Edit Program' : 'Tambah Program')
@section('content')

<x-admin.page-header
    :title="$program->exists ? 'Edit Program Keahlian' : 'Tambah Program Keahlian'"
    description="Data ini akan tampil di beranda dan halaman Program Keahlian."
/>

<form method="POST" action="{{ $program->exists ? route('admin.programs.update', $program) : route('admin.programs.store') }}" enctype="multipart/form-data" class="max-w-3xl space-y-6">
    @csrf
    @if($program->exists) @method('PUT') @endif

    <x-admin.section title="Informasi Dasar" description="Nama dan kode program keahlian." icon="📋">
        <div class="grid sm:grid-cols-2 gap-5">
            <div>
                <label class="block text-sm font-medium text-slate-600 mb-1.5">Nama Program</label>
                <input type="text" name="name" value="{{ old('name', $program->name) }}" required class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-600 mb-1.5">Kode</label>
                <input type="text" name="code" value="{{ old('code', $program->code) }}" required class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
            </div>
        </div>
        <div class="grid sm:grid-cols-2 gap-5 items-center">
            <div>
                <label class="block text-sm font-medium text-slate-600 mb-1.5">Urutan Tampil</label>
                <input type="number" name="sort_order" value="{{ old('sort_order', $program->sort_order) }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
            </div>
            <label class="flex items-center gap-3 mt-6">
                <input type="hidden" name="is_active" value="0">
                <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $program->is_active ?? true)) class="rounded border-slate-300">
                <span class="text-sm text-slate-600">Tampilkan di website</span>
            </label>
        </div>
    </x-admin.section>

    <x-admin.section title="Foto & Logo" description="Foto cover dan logo tetap tampil utuh (tidak dipotong)." icon="🖼️">
        <div class="grid sm:grid-cols-2 gap-6">
            <x-admin.file-drop
                name="photo"
                label="Foto Cover Jurusan"
                ratio="aspect-video"
                :current="$program->photo ? asset('storage/' . $program->photo) : null"
                help="Foto besar yang tampil di kartu &amp; halaman detail jurusan."
            />
            <x-admin.file-drop
                name="logo"
                label="Logo Jurusan"
                ratio="aspect-square"
                :current="$program->logo ? asset('storage/' . $program->logo) : null"
                help="Logo kecil yang tampil menggantikan badge kode jurusan di kartu (beranda &amp; daftar program). Kosongkan untuk tetap pakai badge kode."
            />
        </div>
    </x-admin.section>

    <x-admin.section title="Detail Program" description="Informasi lengkap yang tampil di halaman detail jurusan." icon="📝">
        <div>
            <label class="block text-sm font-medium text-slate-600 mb-1.5">Deskripsi</label>
            <textarea name="description" rows="3" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">{{ old('description', $program->description) }}</textarea>
        </div>
        <div>
            <label class="block text-sm font-medium text-slate-600 mb-1.5">Kompetensi</label>
            <textarea name="competencies" rows="3" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">{{ old('competencies', $program->competencies) }}</textarea>
        </div>
        <div>
            <label class="block text-sm font-medium text-slate-600 mb-1.5">Prospek Karier</label>
            <textarea name="prospects" rows="3" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">{{ old('prospects', $program->prospects) }}</textarea>
        </div>
        <div>
            <label class="block text-sm font-medium text-slate-600 mb-1.5">Fasilitas Pendukung</label>
            <textarea name="facilities" rows="3" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">{{ old('facilities', $program->facilities) }}</textarea>
        </div>
        <div>
            <label class="block text-sm font-medium text-slate-600 mb-1.5">Mata Pelajaran Utama</label>
            <textarea name="subjects" rows="3" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">{{ old('subjects', $program->subjects) }}</textarea>
        </div>
    </x-admin.section>

    <x-admin.form-actions :cancel-route="route('admin.programs.index')" />
</form>
@endsection
