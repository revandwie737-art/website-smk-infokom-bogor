@extends('layouts.admin')
@section('title', $video->exists ? 'Edit Video' : 'Tambah Video')
@section('content')
<form method="POST" action="{{ $video->exists ? route('admin.videos.update', $video) : route('admin.videos.store') }}" class="bg-white rounded-2xl border border-slate-100 p-6 space-y-5 max-w-2xl">
    @csrf
    @if($video->exists) @method('PUT') @endif
    <div>
        <label class="block text-sm font-medium text-slate-600 mb-1.5">Judul</label>
        <input type="text" name="title" value="{{ old('title', $video->title) }}" required class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
    </div>
    <div>
        <label class="block text-sm font-medium text-slate-600 mb-1.5">URL YouTube</label>
        <input type="text" name="youtube_url" value="{{ old('youtube_url', $video->youtube_url) }}" required placeholder="https://www.youtube.com/watch?v=..." class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
    </div>
    <div>
        <label class="block text-sm font-medium text-slate-600 mb-1.5">Deskripsi</label>
        <textarea name="description" rows="3" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">{{ old('description', $video->description) }}</textarea>
    </div>
    <div>
        <label class="block text-sm font-medium text-slate-600 mb-1.5">Urutan Tampil</label>
        <input type="number" name="sort_order" value="{{ old('sort_order', $video->sort_order) }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
    </div>
    <div class="flex gap-3 pt-2">
        <button type="submit" class="px-8 py-3 rounded-xl bg-navy-700 text-white font-semibold hover:bg-navy-800">Simpan</button>
        <a href="{{ route('admin.videos.index') }}" class="px-8 py-3 rounded-xl border border-slate-200 text-slate-600 font-medium">Batal</a>
    </div>
</form>
@endsection
