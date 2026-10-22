@extends('layouts.admin')
@section('title', 'Prestasi')
@section('content')

<x-admin.page-header
    title="Prestasi"
    description="Kelola daftar prestasi siswa yang tampil di halaman publik."
    cta="{{ route('admin.achievements.create') }}"
    cta-label="Tambah Prestasi"
    :count="$achievements->count()"
    count-label="prestasi"
/>

<div class="bg-white rounded-2xl border border-slate-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="text-left text-[11px] font-bold uppercase tracking-wider text-slate-400 bg-slate-50/70 border-b border-slate-100">
                    <th class="px-5 py-3.5">Judul</th>
                    <th class="px-5 py-3.5">Kategori</th>
                    <th class="px-5 py-3.5">Tingkat</th>
                    <th class="px-5 py-3.5">Tahun</th>
                    <th class="px-5 py-3.5 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($achievements as $ach)
                    <tr class="hover:bg-slate-50/60 transition-colors">
                        <td class="px-5 py-3.5">
                            <div class="flex items-center gap-3">
                                <div class="h-9 w-9 rounded-xl bg-amber-50 text-amber-500 grid place-items-center shrink-0"><i data-lucide="trophy" class="w-4 h-4"></i></div>
                                <span class="font-medium text-slate-700">{{ $ach->title }}</span>
                            </div>
                        </td>
                        <td class="px-5 py-3.5 text-slate-500 capitalize">{{ $ach->category }}</td>
                        <td class="px-5 py-3.5 text-slate-500 capitalize">{{ str_replace('_',' ',$ach->level) }}</td>
                        <td class="px-5 py-3.5 text-slate-500">{{ $ach->year }}</td>
                        <td class="px-5 py-3.5">
                            <div class="flex gap-2 justify-end">
                                <x-admin.icon-link :href="route('admin.achievements.edit', $ach)" icon="pencil" color="sky" label="Edit" />
                                <x-admin.icon-delete-form :action="route('admin.achievements.destroy', $ach)" />
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5"><x-admin.empty-state icon="trophy" title="Belum ada data prestasi" description="Tambahkan prestasi pertama sekolah." /></td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
<div class="mt-6">{{ $achievements->links() }}</div>
@endsection
