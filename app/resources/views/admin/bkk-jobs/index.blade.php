@extends('layouts.admin')
@section('title', 'Lowongan Kerja (BKK)')
@section('content')

<x-admin.page-header
    title="Lowongan Kerja (BKK)"
    description="Kelola lowongan kerja yang tampil di halaman Bursa Kerja Khusus."
    cta="{{ route('admin.bkk-jobs.create') }}"
    cta-label="Tambah Lowongan"
    :count="$jobs->count()"
    count-label="lowongan"
/>

<div class="bg-white rounded-2xl border border-slate-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="text-left text-[11px] font-bold uppercase tracking-wider text-slate-400 bg-slate-50/70 border-b border-slate-100">
                    <th class="px-5 py-3.5">Posisi</th>
                    <th class="px-5 py-3.5">Perusahaan</th>
                    <th class="px-5 py-3.5">Jurusan</th>
                    <th class="px-5 py-3.5">Batas Daftar</th>
                    <th class="px-5 py-3.5">Status</th>
                    <th class="px-5 py-3.5 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($jobs as $job)
                    <tr class="hover:bg-slate-50/60 transition-colors">
                        <td class="px-5 py-3.5">
                            <div class="flex items-center gap-3">
                                <div class="h-9 w-9 rounded-xl bg-navy-50 text-navy-600 grid place-items-center shrink-0"><i data-lucide="briefcase-business" class="w-4 h-4"></i></div>
                                <span class="font-medium text-slate-700">{{ $job->position }}</span>
                            </div>
                        </td>
                        <td class="px-5 py-3.5 text-slate-500">{{ $job->company_name }}</td>
                        <td class="px-5 py-3.5 text-slate-500">{{ $job->program->code ?? 'Semua Jurusan' }}</td>
                        <td class="px-5 py-3.5 text-slate-500">{{ optional($job->deadline)->translatedFormat('d M Y') ?? '-' }}</td>
                        <td class="px-5 py-3.5">
                            <x-admin.badge :color="$job->is_active ? 'emerald' : 'slate'" :label="$job->is_active ? 'Aktif' : 'Nonaktif'" />
                        </td>
                        <td class="px-5 py-3.5">
                            <div class="flex gap-2 justify-end">
                                <x-admin.icon-link :href="route('admin.bkk-jobs.edit', $job)" icon="pencil" color="sky" label="Edit" />
                                <x-admin.icon-delete-form :action="route('admin.bkk-jobs.destroy', $job)" />
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6"><x-admin.empty-state icon="briefcase-business" title="Belum ada lowongan" description="Tambahkan lowongan pertama." /></td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
