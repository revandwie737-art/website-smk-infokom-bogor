@extends('layouts.admin')
@section('title', 'Galeri')
@section('content')

<x-admin.page-header
    title="Galeri Kegiatan"
    description="Kelola album foto kegiatan sekolah yang tampil di halaman Galeri."
    cta="{{ route('admin.gallery.create') }}"
    cta-label="Tambah Album"
    :count="$galleries->count()"
    count-label="album galeri"
/>

<div x-data="{ q: '' }">
    @if($galleries->count())
        <div class="relative max-w-sm mb-6">
            <svg class="absolute left-3.5 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M17 11a6 6 0 11-12 0 6 6 0 0112 0z" /></svg>
            <input x-model="q" type="text" placeholder="Cari album..." class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-sky-300">
        </div>
    @endif

    <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-5">
        @forelse($galleries as $gallery)
            <div x-show="q === '' || '{{ Str::lower($gallery->title) }}'.includes(q.toLowerCase())"
                class="group bg-white rounded-2xl border border-slate-100 shadow-sm shadow-slate-100/60 overflow-hidden hover:shadow-lg hover:shadow-slate-200/60 hover:-translate-y-0.5 transition-all duration-300">
                <x-media-frame
                    ratio="aspect-video"
                    :src="$gallery->cover ? asset('storage/' . $gallery->cover) : null"
                    fit="cover"
                    icon="🖼️"
                    :alt="$gallery->title"
                />
                <div class="p-4">
                    <p class="font-semibold text-slate-700 text-sm">{{ $gallery->title }}</p>
                    <p class="text-xs text-slate-400 mt-1">{{ $gallery->images_count }} foto</p>
                    <div class="flex items-center gap-2 mt-3 pt-3 border-t border-slate-100">
                        <x-admin.icon-link :href="route('admin.gallery.edit', $gallery)" icon="settings-2" color="sky" label="Kelola" />
                        <x-admin.icon-delete-form :action="route('admin.gallery.destroy', $gallery)" />
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full bg-white rounded-2xl border border-dashed border-slate-200 py-16 text-center">
                <div class="h-14 w-14 rounded-2xl bg-slate-50 text-slate-300 grid place-items-center mx-auto mb-3"><i data-lucide="image" class="w-6 h-6"></i></div>
                <p class="text-slate-500 font-semibold text-sm">Belum ada album galeri</p>
                <p class="text-slate-400 text-xs mt-1">Buat album pertama untuk mulai mendokumentasikan kegiatan sekolah.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection
