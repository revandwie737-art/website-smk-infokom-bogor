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
            <div class="group bg-white rounded-2xl border border-slate-100 shadow-sm shadow-slate-100/60 overflow-hidden">
                <div class="aspect-video bg-slate-50 grid place-items-center p-4">
                    @if($p->logo)
                        <img src="{{ asset('storage/' . $p->logo) }}" class="max-h-full max-w-full object-contain transition-transform duration-500 group-hover:scale-105" alt="{{ $p->name }}">
                    @else
                        <i data-lucide="landmark" class="w-8 h-8 text-slate-300"></i>
                    @endif
                </div>
                <div class="p-4">
                    <p class="font-semibold text-slate-800 text-sm truncate">{{ $p->name }}</p>
                    <div class="flex items-center gap-2 mt-3 pt-3 border-t border-slate-100">
                        <x-admin.icon-link :href="route('admin.partners.edit', $p)" icon="pencil" color="sky" label="Edit" />
                        <x-admin.icon-delete-form :action="route('admin.partners.destroy', $p)" />
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full bg-white rounded-2xl border border-dashed border-slate-200 py-10 text-center">
                <p class="text-slate-400 text-sm">Belum ada data mitra {{ $label }}.</p>
            </div>
        @endforelse
    </div>
@endforeach
@endsection
