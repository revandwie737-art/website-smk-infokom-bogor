@extends('layouts.admin')
@section('title', $news->exists ? 'Edit Berita' : 'Tambah Berita')
@section('content')
<form method="POST" action="{{ $news->exists ? route('admin.news.update', $news) : route('admin.news.store') }}" enctype="multipart/form-data" class="bg-white rounded-2xl border border-slate-100 p-6 space-y-5 max-w-3xl">
    @csrf
    @if($news->exists) @method('PUT') @endif

    <div>
        <label class="block text-sm font-medium text-slate-600 mb-1.5">Judul</label>
        <input type="text" name="title" value="{{ old('title', $news->title) }}" required class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
    </div>

    <div class="grid sm:grid-cols-2 gap-5">
        <div>
            <label class="block text-sm font-medium text-slate-600 mb-1.5">Kategori</label>
            <select name="category_id" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
                <option value="">Tanpa Kategori</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" @selected(old('category_id', $news->category_id) == $cat->id)>{{ $cat->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="block text-sm font-medium text-slate-600 mb-1.5">Status</label>
            <select name="status" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
                <option value="draft" @selected(old('status', $news->status) === 'draft')>Draft</option>
                <option value="published" @selected(old('status', $news->status) === 'published')>Published</option>
            </select>
        </div>
    </div>

    <div>
        <label class="block text-sm font-medium text-slate-600 mb-1.5">Thumbnail</label>
        @if($news->thumbnail) <img src="{{ asset('storage/' . $news->thumbnail) }}" class="h-28 rounded-xl mb-2"> @endif
        <input type="file" name="thumbnail" class="w-full text-sm">
    </div>

    <div>
        <label class="block text-sm font-medium text-slate-600 mb-1.5">Ringkasan (Excerpt)</label>
        <textarea name="excerpt" rows="2" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">{{ old('excerpt', $news->excerpt) }}</textarea>
    </div>

    <div>
        <label class="block text-sm font-medium text-slate-600 mb-1.5">Link Instagram (opsional)</label>
        <input type="url" name="instagram_url" value="{{ old('instagram_url', $news->instagram_url) }}" placeholder="https://www.instagram.com/p/..." class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
        <p class="text-xs text-slate-400 mt-1">Jika diisi, klik berita ini di halaman publik akan langsung membuka postingan Instagram (tab baru), bukan halaman detail berita.</p>
    </div>

    <div>
        <label class="block text-sm font-medium text-slate-600 mb-1.5">Isi Berita</label>
        <textarea name="content" rows="10" required class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">{{ old('content', $news->content) }}</textarea>
        <p class="text-xs text-slate-400 mt-1">Mendukung tag HTML dasar untuk format teks (paragraf, bold, list, dsb).</p>
    </div>

    <div class="grid sm:grid-cols-2 gap-5">
        <div>
            <label class="block text-sm font-medium text-slate-600 mb-1.5">SEO Title</label>
            <input type="text" name="seo_title" value="{{ old('seo_title', $news->seo_title) }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
        </div>
        <div>
            <label class="block text-sm font-medium text-slate-600 mb-1.5">SEO Description</label>
            <input type="text" name="seo_description" value="{{ old('seo_description', $news->seo_description) }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
        </div>
    </div>

    <div class="flex gap-3 pt-2">
        <button type="submit" class="px-8 py-3 rounded-xl bg-navy-700 text-white font-semibold hover:bg-navy-800">Simpan</button>
        <a href="{{ route('admin.news.index') }}" class="px-8 py-3 rounded-xl border border-slate-200 text-slate-600 font-medium">Batal</a>
    </div>
</form>
@endsection
