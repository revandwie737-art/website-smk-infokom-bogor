@extends('layouts.admin')
@section('title', 'Kelas')
@section('content')

<x-admin.page-header
    title="Kelas"
    description="Kelola daftar kelas, program keahlian, dan wali kelas."
    cta="{{ route('admin.classes.create') }}"
    cta-label="Tambah Kelas"
    :count="$classes->count()"
    count-label="kelas"
/>

<div class="bg-white rounded-2xl border border-slate-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="text-left text-[11px] font-bold uppercase tracking-wider text-slate-400 bg-slate-50/70 border-b border-slate-100">
                    <th class="px-5 py-3.5">Nama Kelas</th>
                    <th class="px-5 py-3.5">Program</th>
                    <th class="px-5 py-3.5">Wali Kelas</th>
                    <th class="px-5 py-3.5">Jumlah Siswa</th>
                    <th class="px-5 py-3.5 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($classes as $class)
                    <tr class="hover:bg-slate-50/60 transition-colors">
                        <td class="px-5 py-3.5">
                            <div class="flex items-center gap-3">
                                <div class="h-9 w-9 rounded-xl bg-navy-50 text-navy-600 grid place-items-center shrink-0"><i data-lucide="school" class="w-4 h-4"></i></div>
                                <span class="font-medium text-slate-700">{{ $class->name }}</span>
                            </div>
                        </td>
                        <td class="px-5 py-3.5 text-slate-500">{{ $class->program->code ?? '-' }}</td>
                        <td class="px-5 py-3.5 text-slate-500">{{ $class->homeroomTeacher->user->name ?? '-' }}</td>
                        <td class="px-5 py-3.5">
                            <span class="inline-flex items-center gap-1.5 text-slate-600 font-medium"><i data-lucide="users" class="w-3.5 h-3.5 text-slate-400"></i>{{ $class->students_count }}</span>
                        </td>
                        <td class="px-5 py-3.5">
                            <div class="flex gap-2 justify-end">
                                <x-admin.icon-link :href="route('admin.classes.edit', $class)" icon="pencil" color="sky" label="Edit" />
                                <x-admin.icon-delete-form :action="route('admin.classes.destroy', $class)" />
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5"><x-admin.empty-state icon="school" title="Belum ada kelas" /></td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
