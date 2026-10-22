@extends('layouts.admin')
@section('title', 'Program Keahlian')
@section('content')

<x-admin.page-header
    title="Program Keahlian"
    description="Kelola jurusan/program keahlian yang tampil di halaman publik."
    cta="{{ route('admin.programs.create') }}"
    cta-label="Tambah Program"
    :count="$programs->count()"
    count-label="program keahlian"
/>

<div x-data="{ q: '' }">
    @if($programs->count())
        <div class="relative max-w-sm mb-6">
            <svg class="absolute left-3.5 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M17 11a6 6 0 11-12 0 6 6 0 0112 0z" /></svg>
            <input x-model="q" type="text" placeholder="Cari program..." class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-sky-300">
        </div>
    @endif

    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-5">
        @forelse($programs as $program)
            <div x-show="q === '' || '{{ Str::lower($program->name) }}'.includes(q.toLowerCase())"
                class="group bg-white rounded-2xl border border-slate-100 shadow-sm shadow-slate-100/60 overflow-hidden hover:shadow-lg hover:shadow-slate-200/60 hover:-translate-y-0.5 transition-all duration-300">
                <x-media-frame
                    ratio="aspect-video"
                    :src="$program->photo ? asset('storage/' . $program->photo) : null"
                    :background="$program->background ? asset('storage/' . $program->background) : null"
                    icon="🎓"
                    :alt="$program->name"
                />
                <div class="p-5">
                    <div class="flex items-start justify-between gap-3">
                        <div>
                            <span class="text-xs font-semibold text-sky-600">{{ $program->code }}</span>
                            <p class="font-semibold text-slate-800 mt-0.5">{{ $program->name }}</p>
                        </div>
                        <div class="shrink-0"><x-admin.badge :color="$program->is_active ? 'emerald' : 'slate'" :label="$program->is_active ? 'Aktif' : 'Nonaktif'" /></div>
                    </div>
                    <div class="flex items-center gap-2 mt-4 pt-4 border-t border-slate-100">
                        <x-admin.icon-link :href="route('admin.programs.edit', $program)" icon="pencil" color="sky" label="Edit" />
                        <x-admin.icon-delete-form :action="route('admin.programs.destroy', $program)" />
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full bg-white rounded-2xl border border-dashed border-slate-200 py-16 text-center">
                <div class="h-14 w-14 rounded-2xl bg-slate-50 text-slate-300 grid place-items-center mx-auto mb-3"><i data-lucide="graduation-cap" class="w-6 h-6"></i></div>
                <p class="text-slate-500 font-semibold text-sm">Belum ada program keahlian</p>
                <p class="text-slate-400 text-xs mt-1">Tambahkan program keahlian pertama untuk mulai tampil di halaman publik.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection
