@extends('layouts.admin')
@section('title', 'Agenda')
@section('content')

<x-admin.page-header
    title="Agenda"
    description="Kelola agenda dan acara sekolah yang tampil di halaman publik."
    cta="{{ route('admin.events.create') }}"
    cta-label="Tambah Agenda"
    :count="$events->count()"
    count-label="agenda"
/>

<div class="bg-white rounded-2xl border border-slate-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="text-left text-[11px] font-bold uppercase tracking-wider text-slate-400 bg-slate-50/70 border-b border-slate-100">
                    <th class="px-5 py-3.5">Judul</th>
                    <th class="px-5 py-3.5">Tanggal</th>
                    <th class="px-5 py-3.5">Lokasi</th>
                    <th class="px-5 py-3.5 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($events as $event)
                    <tr class="hover:bg-slate-50/60 transition-colors">
                        <td class="px-5 py-3.5">
                            <div class="flex items-center gap-3">
                                <div class="h-9 w-9 rounded-xl bg-emerald-50 text-emerald-600 grid place-items-center shrink-0"><i data-lucide="calendar-days" class="w-4 h-4"></i></div>
                                <span class="font-medium text-slate-700">{{ $event->title }}</span>
                            </div>
                        </td>
                        <td class="px-5 py-3.5 text-slate-500">{{ $event->event_date->format('d M Y') }}</td>
                        <td class="px-5 py-3.5 text-slate-500">{{ $event->location ?? '-' }}</td>
                        <td class="px-5 py-3.5">
                            <div class="flex gap-2 justify-end">
                                <x-admin.icon-link :href="route('admin.events.edit', $event)" icon="pencil" color="sky" label="Edit" />
                                <x-admin.icon-delete-form :action="route('admin.events.destroy', $event)" />
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="4"><x-admin.empty-state icon="calendar-days" title="Belum ada agenda" /></td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
<div class="mt-6">{{ $events->links() }}</div>
@endsection
