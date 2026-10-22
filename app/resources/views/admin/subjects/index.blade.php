@extends('layouts.admin')
@section('title', 'Mata Pelajaran')
@section('content')

<x-admin.page-header
    title="Mata Pelajaran"
    description="Kelola daftar mata pelajaran per program keahlian."
    cta="{{ route('admin.subjects.create') }}"
    cta-label="Tambah Mata Pelajaran"
    :count="$subjects->count()"
    count-label="mata pelajaran"
/>

<div class="bg-white rounded-2xl border border-slate-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="text-left text-[11px] font-bold uppercase tracking-wider text-slate-400 bg-slate-50/70 border-b border-slate-100">
                    <th class="px-5 py-3.5">Nama</th>
                    <th class="px-5 py-3.5">Kode</th>
                    <th class="px-5 py-3.5">Program</th>
                    <th class="px-5 py-3.5 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($subjects as $subject)
                    <tr class="hover:bg-slate-50/60 transition-colors">
                        <td class="px-5 py-3.5">
                            <div class="flex items-center gap-3">
                                <div class="h-9 w-9 rounded-xl bg-navy-50 text-navy-600 grid place-items-center shrink-0"><i data-lucide="book-open" class="w-4 h-4"></i></div>
                                <span class="font-medium text-slate-700">{{ $subject->name }}</span>
                            </div>
                        </td>
                        <td class="px-5 py-3.5 text-slate-500">{{ $subject->code ?? '-' }}</td>
                        <td class="px-5 py-3.5 text-slate-500">{{ $subject->program->code ?? 'Umum' }}</td>
                        <td class="px-5 py-3.5">
                            <div class="flex gap-2 justify-end">
                                <x-admin.icon-link :href="route('admin.subjects.edit', $subject)" icon="pencil" color="sky" label="Edit" />
                                <x-admin.icon-delete-form :action="route('admin.subjects.destroy', $subject)" />
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="4"><x-admin.empty-state icon="book-open" title="Belum ada mata pelajaran" /></td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
