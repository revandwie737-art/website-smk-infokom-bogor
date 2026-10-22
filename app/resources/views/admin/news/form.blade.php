@extends('layouts.admin')
@section('title', $news->exists ? 'Edit Berita' : 'Tambah Berita')
@section('content')

<x-admin.form-header :title="$news->exists ? 'Edit Berita' : 'Tambah Berita'" :back-route="route('admin.news.index')" />

<form method="POST" action="{{ $news->exists ? route('admin.news.update', $news) : route('admin.news.store') }}" enctype="multipart/form-data" class="space-y-6">
    @csrf
    @if($news->exists) @method('PUT') @endif

    <div class="grid lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 space-y-6">
            <x-admin.section title="Konten Berita" icon="📰">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Judul</label>
                    <input type="text" name="title" value="{{ old('title', $news->title) }}" required class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Ringkasan (Excerpt)</label>
                    <textarea name="excerpt" rows="2" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">{{ old('excerpt', $news->excerpt) }}</textarea>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Isi Berita</label>
                    <textarea name="content" rows="12" required class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300 font-mono text-[13px]">{{ old('content', $news->content) }}</textarea>
                    <p class="text-xs text-slate-400 mt-1.5 flex items-center gap-1.5"><i data-lucide="info" class="w-3.5 h-3.5"></i> Mendukung tag HTML dasar untuk format teks (paragraf, bold, list, dsb).</p>
                </div>
            </x-admin.section>

            <x-admin.section title="SEO" icon="🔍">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">SEO Title</label>
                    <input type="text" name="seo_title" value="{{ old('seo_title', $news->seo_title) }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">SEO Description</label>
                    <input type="text" name="seo_description" value="{{ old('seo_description', $news->seo_description) }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
                </div>
            </x-admin.section>
        </div>

        <div class="space-y-6">
            <x-admin.section title="Publikasi" icon="🚀">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Status</label>
                    <select name="status" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
                        <option value="draft" @selected(old('status', $news->status) === 'draft')>Draft</option>
                        <option value="published" @selected(old('status', $news->status) === 'published')>Published</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Kategori</label>
                    <select name="category_id" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
                        <option value="">Tanpa Kategori</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" @selected(old('category_id', $news->category_id) == $cat->id)>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>
            </x-admin.section>

            <x-admin.section title="Thumbnail" icon="🖼️">
                <div>
                    @if($news->thumbnail) <img src="{{ asset('storage/' . $news->thumbnail) }}" class="rounded-xl mb-3 ring-1 ring-slate-100 w-full aspect-video object-cover"> @endif
                    <input type="file" name="thumbnail" class="w-full text-sm file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:bg-slate-100 file:text-slate-600 file:font-medium hover:file:bg-slate-200 transition">
                </div>
            </x-admin.section>

            <x-admin.section title="Link Instagram" description="Jika diisi, klik berita di halaman publik langsung membuka postingan Instagram." icon="📸">
                <input type="url" name="instagram_url" value="{{ old('instagram_url', $news->instagram_url) }}" placeholder="https://www.instagram.com/p/..." class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
            </x-admin.section>
        </div>
    </div>

    <x-admin.form-actions :cancel-route="route('admin.news.index')" />
</form>
@endsection
