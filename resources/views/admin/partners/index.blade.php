@extends('layouts.admin')
@section('title', 'Kerjasama Universitas & Industri')
@section('content')

<x-admin.page-header
    title="Kerjasama Universitas & Industri"
    description="Logo mitra ini tampil di Beranda dan halaman Kerjasama."
    cta="{{ route('admin.partners.create') }}"
    cta-label="Tambah Mitra"
    :count="$partners->count()"
    count-label="mitra terdaftar"
/>

@foreach(['universitas' => 'Universitas', 'industri' => 'Industri'] as $type => $label)
    <p class="text-sm font-semibold text-slate-500 mt-8 mb-3">{{ $label }}</p>
    <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-5">
        @forelse($partners->where('type', $type) as $p)
            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm shadow-slate-100/60 overflow-hidden">
                <div class="aspect-video bg-slate-50 grid place-items-center p-4">
                    @if($p->logo)
                        <img src="{{ asset('storage/' . $p->logo) }}" class="max-h-full max-w-full object-contain" alt="{{ $p->name }}">
                    @else
                        <span class="text-3xl">🏛️</span>
                    @endif
                </div>
                <div class="p-4">
                    <p class="font-semibold text-slate-800 text-sm">{{ $p->name }}</p>
                    <div class="flex items-center gap-4 mt-3 pt-3 border-t border-slate-100">
                        <a href="{{ route('admin.partners.edit', $p) }}" class="text-sky-600 text-xs font-medium hover:text-sky-700">Edit</a>
                        <form method="POST" action="{{ route('admin.partners.destroy', $p) }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                            @csrf @method('DELETE')
                            <button class="text-red-500 text-xs font-medium hover:text-red-600">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-slate-400 text-sm col-span-4">Belum ada data mitra {{ $label }}.</p>
        @endforelse
    </div>
@endforeach
@endsection
