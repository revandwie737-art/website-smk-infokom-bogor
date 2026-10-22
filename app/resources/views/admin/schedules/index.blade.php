@extends('layouts.admin')
@section('title', 'Jadwal')
@section('content')

<x-admin.page-header
    title="Jadwal Pelajaran"
    description="Kelola jadwal mata pelajaran tiap kelas."
    cta="{{ route('admin.schedules.create') }}"
    cta-label="Tambah Jadwal"
/>

<form method="GET" class="mb-6 animate-fade-in-up">
    <div class="relative max-w-xs">
        <i data-lucide="school" class="w-4 h-4 absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400"></i>
        <select name="class_id" onchange="this.form.submit()" class="w-full pl-9 pr-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-sky-300 transition">
            <option value="">Semua Kelas</option>
            @foreach($classes as $c)
                <option value="{{ $c->id }}" @selected($classId == $c->id)>{{ $c->name }}</option>
            @endforeach
        </select>
    </div>
</form>

<div class="bg-white rounded-2xl border border-slate-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="text-left text-[11px] font-bold uppercase tracking-wider text-slate-400 bg-slate-50/70 border-b border-slate-100">
                    <th class="px-5 py-3.5">Hari</th>
                    <th class="px-5 py-3.5">Waktu</th>
                    <th class="px-5 py-3.5">Mata Pelajaran</th>
                    <th class="px-5 py-3.5">Guru</th>
                    <th class="px-5 py-3.5">Ruang</th>
                    <th class="px-5 py-3.5 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($schedules as $s)
                    <tr class="hover:bg-slate-50/60 transition-colors">
                        <td class="px-5 py-3.5"><x-admin.badge color="navy" :label="ucfirst($s->day)" /></td>
                        <td class="px-5 py-3.5 text-slate-500 inline-flex items-center gap-1.5"><i data-lucide="clock" class="w-3.5 h-3.5 text-slate-400"></i>{{ \Illuminate\Support\Carbon::parse($s->start_time)->format('H:i') }} - {{ \Illuminate\Support\Carbon::parse($s->end_time)->format('H:i') }}</td>
                        <td class="px-5 py-3.5 font-medium text-slate-700">{{ $s->subject->name ?? '-' }}</td>
                        <td class="px-5 py-3.5 text-slate-500">{{ $s->teacher->user->name ?? '-' }}</td>
                        <td class="px-5 py-3.5 text-slate-500">{{ $s->room ?? '-' }}</td>
                        <td class="px-5 py-3.5">
                            <div class="flex gap-2 justify-end">
                                <x-admin.icon-link :href="route('admin.schedules.edit', $s)" icon="pencil" color="sky" label="Edit" />
                                <x-admin.icon-delete-form :action="route('admin.schedules.destroy', $s)" />
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6"><x-admin.empty-state icon="clock" title="Belum ada jadwal" description="Pilih kelas untuk melihat jadwal, atau tambahkan jadwal baru." /></td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
