@extends('layouts.admin')
@section('title', 'Menu Informasi')
@section('content')

<x-admin.page-header
    title="Menu Dropdown &quot;Informasi&quot;"
    description="Kelola ikon, judul, deskripsi, tautan, urutan, dan tampil/sembunyikan tiap item di menu Informasi pada navbar situs."
    cta="{{ route('admin.info-menu.create') }}"
    cta-label="Tambah Menu"
    :count="$items->count()"
    count-label="menu terdaftar"
/>

<div class="bg-white rounded-2xl border border-slate-100 divide-y divide-slate-100 overflow-hidden">
    @forelse($items as $i => $item)
        <div class="flex items-center gap-4 px-5 py-4 {{ !$item->is_active ? 'opacity-50' : '' }}">
            <div class="flex flex-col gap-1 shrink-0">
                <form method="POST" action="{{ route('admin.info-menu.move', $item) }}">
                    @csrf
                    <input type="hidden" name="direction" value="up">
                    <button type="submit" {{ $i === 0 ? 'disabled' : '' }} class="w-6 h-6 grid place-items-center rounded-md text-slate-400 hover:bg-slate-100 hover:text-navy-700 disabled:opacity-25 disabled:hover:bg-transparent">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"/></svg>
                    </button>
                </form>
                <form method="POST" action="{{ route('admin.info-menu.move', $item) }}">
                    @csrf
                    <input type="hidden" name="direction" value="down">
                    <button type="submit" {{ $i === $items->count() - 1 ? 'disabled' : '' }} class="w-6 h-6 grid place-items-center rounded-md text-slate-400 hover:bg-slate-100 hover:text-navy-700 disabled:opacity-25 disabled:hover:bg-transparent">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                </form>
            </div>

            <span class="shrink-0 h-11 w-11 rounded-xl bg-navy-50 grid place-items-center text-xl">{{ $item->icon ?: '🔗' }}</span>

            <div class="flex-1 min-w-0">
                <p class="font-semibold text-slate-800">{{ $item->label }}</p>
                <p class="text-xs text-slate-400 mt-0.5">{{ $item->description ?: '—' }} &middot; <span class="font-mono">{{ $item->url }}</span></p>
            </div>

            <form method="POST" action="{{ route('admin.info-menu.update', $item) }}" class="shrink-0">
                @csrf @method('PUT')
                <input type="hidden" name="label" value="{{ $item->label }}">
                <input type="hidden" name="icon" value="{{ $item->icon }}">
                <input type="hidden" name="description" value="{{ $item->description }}">
                <input type="hidden" name="url" value="{{ $item->url }}">
                <input type="hidden" name="is_active" value="{{ $item->is_active ? '0' : '1' }}">
                <button type="submit" class="text-xs font-semibold px-3 py-1.5 rounded-full {{ $item->is_active ? 'bg-emerald-50 text-emerald-600' : 'bg-slate-100 text-slate-500' }}">
                    {{ $item->is_active ? 'Tampil' : 'Tersembunyi' }}
                </button>
            </form>

            <div class="flex items-center gap-4 shrink-0">
                <a href="{{ route('admin.info-menu.edit', $item) }}" class="text-sky-600 text-sm font-medium hover:text-sky-700">Edit</a>
                <form method="POST" action="{{ route('admin.info-menu.destroy', $item) }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus menu ini?')">
                    @csrf @method('DELETE')
                    <button class="text-red-500 text-sm font-medium hover:text-red-600">Hapus</button>
                </form>
            </div>
        </div>
    @empty
        <div class="py-16 text-center">
            <div class="text-4xl mb-3">🧭</div>
            <p class="text-slate-500 font-medium">Belum ada menu</p>
            <p class="text-slate-400 text-sm mt-1">Tambahkan item pertama untuk mengisi dropdown "Informasi" di navbar.</p>
        </div>
    @endforelse
</div>
@endsection