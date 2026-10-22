@extends('layouts.admin')
@section('title', 'Fasilitas')
@section('content')

<x-admin.page-header
    title="Fasilitas Sekolah"
    description="Kelola sarana &amp; prasarana yang ditampilkan di halaman Fasilitas."
    cta="{{ route('admin.facilities.create') }}"
    cta-label="Tambah Fasilitas"
    :count="$facilities->count()"
    count-label="fasilitas terdaftar"
/>

<div x-data="{ q: '' }">
    @if($facilities->count())
        <div class="relative max-w-sm mb-6">
            <svg class="absolute left-3.5 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M17 11a6 6 0 11-12 0 6 6 0 0112 0z" /></svg>
            <input x-model="q" type="text" placeholder="Cari fasilitas..." class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-sky-300">
        </div>
    @endif

    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-5">
        @forelse($facilities as $f)
            <div x-show="q === '' || '{{ Str::lower($f->name) }}'.includes(q.toLowerCase())"
                class="group bg-white rounded-2xl border border-slate-100 shadow-sm shadow-slate-100/60 overflow-hidden hover:shadow-lg hover:shadow-slate-200/60 hover:-translate-y-0.5 transition-all duration-300">
                <x-media-frame
                    ratio="aspect-video"
                    :src="$f->photo ? asset('storage/' . $f->photo) : null"
                    icon="🏫"
                    :alt="$f->name"
                />
                <div class="p-5">
                    <div class="flex items-start justify-between gap-3">
                        <p class="font-semibold text-slate-800">{{ $f->name }}</p>
                        @if($f->quantity)
                            <span class="shrink-0 text-xs font-semibold px-2.5 py-1 rounded-full bg-sky-50 text-sky-600">{{ $f->quantity }} unit</span>
                        @endif
                    </div>
                    @if($f->description)
                        <p class="text-xs text-slate-400 mt-2 line-clamp-2">{{ $f->description }}</p>
                    @endif
                    <div class="flex items-center gap-4 mt-4 pt-4 border-t border-slate-100">
                        <a href="{{ route('admin.facilities.edit', $f) }}" class="text-sky-600 text-sm font-medium hover:text-sky-700">Edit</a>
                        <form method="POST" action="{{ route('admin.facilities.destroy', $f) }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                            @csrf @method('DELETE')
                            <button class="text-red-500 text-sm font-medium hover:text-red-600">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full bg-white rounded-2xl border border-dashed border-slate-200 py-16 text-center">
                <div class="text-4xl mb-3">🏫</div>
                <p class="text-slate-500 font-medium">Belum ada data fasilitas</p>
                <p class="text-slate-400 text-sm mt-1">Tambahkan fasilitas pertama Anda untuk mulai tampil di halaman publik.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection
