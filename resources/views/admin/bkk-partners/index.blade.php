@extends('layouts.admin')
@section('title', 'Mitra Industri (BKK)')
@section('content')

<x-admin.page-header
    title="Mitra Industri (BKK)"
    description="Perusahaan yang bekerja sama merekrut lulusan/alumni lewat BKK."
    cta="{{ route('admin.bkk-partners.create') }}"
    cta-label="Tambah Mitra"
    :count="$partners->count()"
    count-label="mitra terdaftar"
/>

<div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-5">
    @forelse($partners as $p)
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm shadow-slate-100/60 overflow-hidden">
            <x-media-frame ratio="aspect-video" :src="$p->logo ? asset('storage/' . $p->logo) : null" fit="cover" icon="🏢" :alt="$p->name" />
            <div class="p-5">
                <p class="font-semibold text-slate-800">{{ $p->name }}</p>
                @if($p->description)
                    <p class="text-xs text-slate-400 mt-2 line-clamp-2">{{ $p->description }}</p>
                @endif
                <div class="flex items-center gap-4 mt-4 pt-4 border-t border-slate-100">
                    <a href="{{ route('admin.bkk-partners.edit', $p) }}" class="text-sky-600 text-sm font-medium hover:text-sky-700">Edit</a>
                    <form method="POST" action="{{ route('admin.bkk-partners.destroy', $p) }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                        @csrf @method('DELETE')
                        <button class="text-red-500 text-sm font-medium hover:text-red-600">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    @empty
        <div class="col-span-full bg-white rounded-2xl border border-dashed border-slate-200 py-16 text-center">
            <div class="text-4xl mb-3">🏢</div>
            <p class="text-slate-500 font-medium">Belum ada mitra industri BKK</p>
        </div>
    @endforelse
</div>
@endsection
