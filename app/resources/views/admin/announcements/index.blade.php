@extends('layouts.admin')
@section('title', 'Pengumuman')
@section('content')

<x-admin.page-header
    title="Pengumuman"
    description="Kelola pengumuman yang tampil di halaman publik sekolah."
    cta="{{ route('admin.announcements.create') }}"
    cta-label="Tambah Pengumuman"
    :count="$announcements->count()"
    count-label="pengumuman"
/>

<div class="bg-white rounded-2xl border border-slate-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="text-left text-[11px] font-bold uppercase tracking-wider text-slate-400 bg-slate-50/70 border-b border-slate-100">
                    <th class="px-5 py-3.5">Judul</th>
                    <th class="px-5 py-3.5">Prioritas</th>
                    <th class="px-5 py-3.5">Status</th>
                    <th class="px-5 py-3.5 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($announcements as $a)
                    <tr class="hover:bg-slate-50/60 transition-colors">
                        <td class="px-5 py-3.5">
                            <div class="flex items-center gap-3">
                                <div class="h-9 w-9 rounded-xl bg-sky-50 text-sky-600 grid place-items-center shrink-0"><i data-lucide="megaphone" class="w-4 h-4"></i></div>
                                <span class="font-medium text-slate-700">{{ $a->title }}</span>
                            </div>
                        </td>
                        <td class="px-5 py-3.5">
                            @php($pColor = ['low'=>'slate','normal'=>'sky','high'=>'red'][$a->priority] ?? 'slate')
                            <x-admin.badge :color="$pColor" :label="ucfirst($a->priority)" />
                        </td>
                        <td class="px-5 py-3.5">
                            <x-admin.badge :color="$a->is_active ? 'emerald' : 'slate'" :label="$a->is_active ? 'Aktif' : 'Nonaktif'" />
                        </td>
                        <td class="px-5 py-3.5">
                            <div class="flex gap-2 justify-end">
                                <x-admin.icon-link :href="route('admin.announcements.edit', $a)" icon="pencil" color="sky" label="Edit" />
                                <x-admin.icon-delete-form :action="route('admin.announcements.destroy', $a)" />
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="4"><x-admin.empty-state icon="megaphone" title="Belum ada pengumuman" /></td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
<div class="mt-6">{{ $announcements->links() }}</div>
@endsection
