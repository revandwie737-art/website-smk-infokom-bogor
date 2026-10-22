@extends('layouts.admin')
@section('title', 'Kunjungan Industri')
@section('content')

<x-admin.page-header
    title="Kunjungan Industri"
    description="Kelola kegiatan kunjungan industri beserta galeri fotonya. Data ini tampil di halaman Kunjungan Industri."
    cta="{{ route('admin.industrial-visits.create') }}"
    cta-label="Tambah Kunjungan"
    :count="$visits->count()"
    count-label="kegiatan"
/>

<div x-data="{ q: '' }">
    @if($visits->count())
        <div class="relative max-w-sm mb-6">
            <svg class="absolute left-3.5 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M17 11a6 6 0 11-12 0 6 6 0 0112 0z" /></svg>
            <input x-model="q" type="text" placeholder="Cari kegiatan atau perusahaan..." class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-sky-300">
        </div>
    @endif

    <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-5">
        @forelse($visits as $visit)
            <div x-show="q === '' || @js(Str::lower($visit->title . ' ' . $visit->company)).includes(q.toLowerCase())"
                class="group bg-white rounded-2xl border border-slate-100 shadow-sm shadow-slate-100/60 overflow-hidden hover:shadow-lg hover:shadow-slate-200/60 hover:-translate-y-0.5 transition-all duration-300">
                <div class="relative">
                    <x-media-frame
                        ratio="aspect-video"
                        :src="$visit->cover_url"
                        fit="cover"
                        icon="🏭"
                        :alt="$visit->title"
                    />
                    @unless($visit->is_published)
                        <span class="absolute top-2 left-2 px-2.5 py-1 rounded-full bg-amber-100 text-amber-700 text-[11px] font-semibold">Draf</span>
                    @endunless
                </div>
                <div class="p-4">
                    <p class="font-semibold text-slate-700 text-sm">{{ $visit->title }}</p>
                    @if($visit->company)
                        <p class="text-xs text-slate-500 mt-0.5">{{ $visit->company }}</p>
                    @endif
                    <p class="text-xs text-slate-400 mt-1">
                        {{ $visit->visit_date ? $visit->visit_date->translatedFormat('d F Y') . ' · ' : '' }}{{ $visit->photos_count }} foto
                    </p>
                    <div class="flex gap-3 mt-3 pt-3 border-t border-slate-100">
                        <a href="{{ route('admin.industrial-visits.edit', $visit) }}" class="text-sky-600 text-xs font-semibold hover:text-sky-700">Kelola</a>
                        <form method="POST" action="{{ route('admin.industrial-visits.destroy', $visit) }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini? Semua foto galerinya ikut terhapus.')">
                            @csrf @method('DELETE')
                            <button class="text-red-500 text-xs font-semibold hover:text-red-600">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full bg-white rounded-2xl border border-dashed border-slate-200 py-16 text-center">
                <div class="text-4xl mb-3">🏭</div>
                <p class="text-slate-500 font-medium">Belum ada kunjungan industri</p>
                <p class="text-slate-400 text-sm mt-1">Tambahkan kegiatan pertama untuk mulai mendokumentasikan kunjungan ke dunia industri.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection