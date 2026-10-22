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
    @forelse($partners as $i => $p)
        <div class="group bg-white rounded-2xl border border-slate-100 shadow-sm shadow-slate-100/60 overflow-hidden animate-fade-in-up" style="animation-delay: {{ $i * 0.05 }}s">
            <x-media-frame ratio="aspect-video" :src="$p->logo ? asset('storage/' . $p->logo) : null" fit="cover" icon="🏢" :alt="$p->name" />
            <div class="p-5">
                <p class="font-semibold text-slate-800">{{ $p->name }}</p>
                @if($p->description)
                    <p class="text-xs text-slate-400 mt-2 line-clamp-2">{{ $p->description }}</p>
                @endif
                <div class="flex items-center gap-2 mt-4 pt-4 border-t border-slate-100">
                    <x-admin.icon-link :href="route('admin.bkk-partners.edit', $p)" icon="pencil" color="sky" label="Edit" />
                    <x-admin.icon-delete-form :action="route('admin.bkk-partners.destroy', $p)" />
                    @if($p->website)
                        <a href="{{ $p->website }}" target="_blank" class="ml-auto inline-flex items-center justify-center h-8 w-8 rounded-lg bg-slate-50 text-slate-400 hover:bg-slate-100 hover:text-slate-600 transition"><i data-lucide="external-link" class="w-[15px] h-[15px]"></i></a>
                    @endif
                </div>
            </div>
        </div>
    @empty
        <div class="col-span-full bg-white rounded-2xl border border-dashed border-slate-200 py-16 text-center">
            <div class="h-14 w-14 rounded-2xl bg-slate-50 text-slate-300 grid place-items-center mx-auto mb-3"><i data-lucide="factory" class="w-6 h-6"></i></div>
            <p class="text-slate-500 font-semibold text-sm">Belum ada mitra industri BKK</p>
        </div>
    @endforelse
</div>
@endsection
