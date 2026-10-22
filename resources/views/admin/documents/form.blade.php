@extends('layouts.admin')
@section('title', $document->exists ? 'Edit Dokumen' : 'Unggah Dokumen')
@section('content')

<x-admin.page-header :title="$document->exists ? 'Edit Dokumen' : 'Unggah Dokumen'" />

<form method="POST" action="{{ $document->exists ? route('admin.documents.update', $document) : route('admin.documents.store') }}" enctype="multipart/form-data" class="max-w-2xl space-y-6">
    @csrf
    @if($document->exists) @method('PUT') @endif

    <x-admin.section title="Informasi Dokumen" icon="📄">
        <div>
            <label class="block text-sm font-medium text-slate-600 mb-1.5">Judul Dokumen</label>
            <input type="text" name="title" value="{{ old('title', $document->title) }}" required placeholder="cth: Kalender Akademik 2026/2027" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
        </div>
        <div>
            <label class="block text-sm font-medium text-slate-600 mb-1.5">Kategori (opsional)</label>
            <input type="text" name="category" value="{{ old('category', $document->category) }}" placeholder="cth: Kalender Akademik" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
        </div>
        <div>
            <label class="block text-sm font-medium text-slate-600 mb-1.5">File</label>
            @if($document->file)
                <p class="text-xs text-slate-400 mb-2">File saat ini: <a href="{{ asset('storage/' . $document->file) }}" target="_blank" class="text-sky-600">lihat</a></p>
            @endif
            <input type="file" name="file" {{ $document->exists ? '' : 'required' }} class="w-full text-sm">
            <p class="text-xs text-slate-400 mt-1">PDF, Word, atau Excel. Maks 10MB.</p>
        </div>
        <label class="flex items-center gap-3">
            <input type="hidden" name="is_public" value="0">
            <input type="checkbox" name="is_public" value="1" @checked(old('is_public', $document->is_public ?? true)) class="rounded border-slate-300">
            <span class="text-sm text-slate-600">Publik &mdash; tampilkan tombol unduh di halaman Informasi Akademik</span>
        </label>
    </x-admin.section>

    <div class="flex gap-3 pb-2">
        <button type="submit" class="px-8 py-3 rounded-xl bg-navy-700 text-white font-semibold hover:bg-navy-800 transition">Simpan</button>
        <a href="{{ route('admin.documents.index') }}" class="px-8 py-3 rounded-xl border border-slate-200 text-slate-600 font-medium hover:bg-slate-50 transition">Batal</a>
    </div>
</form>
@endsection
