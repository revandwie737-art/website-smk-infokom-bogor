@extends('layouts.admin')
@section('title', 'Guru')
@section('content')

<x-admin.page-header
    title="Guru"
    description="Kelola data akun dan profil guru."
    cta="{{ route('admin.teachers.create') }}"
    cta-label="Tambah Guru"
    :count="$teachers->total()"
    count-label="guru terdaftar"
/>

<div class="bg-white rounded-2xl border border-slate-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="text-left text-[11px] font-bold uppercase tracking-wider text-slate-400 bg-slate-50/70 border-b border-slate-100">
                    <th class="px-5 py-3.5">Nama</th>
                    <th class="px-5 py-3.5">NIP</th>
                    <th class="px-5 py-3.5">Jabatan</th>
                    <th class="px-5 py-3.5">Email</th>
                    <th class="px-5 py-3.5 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($teachers as $teacher)
                    <tr class="hover:bg-slate-50/60 transition-colors">
                        <td class="px-5 py-3.5">
                            <div class="flex items-center gap-3">
                                <div class="h-8 w-8 rounded-full bg-gradient-to-br from-navy-600 to-sky-500 text-white grid place-items-center text-xs font-bold shrink-0 overflow-hidden">
                                    @if($teacher->photo)
                                        <img src="{{ asset('storage/' . $teacher->photo) }}" class="h-full w-full object-cover">
                                    @else
                                        {{ strtoupper(substr($teacher->user->name,0,1)) }}
                                    @endif
                                </div>
                                <span class="font-medium text-slate-700">{{ $teacher->user->name }}</span>
                            </div>
                        </td>
                        <td class="px-5 py-3.5 text-slate-500">{{ $teacher->nip ?? '-' }}</td>
                        <td class="px-5 py-3.5 text-slate-500">{{ $teacher->position ?? '-' }}</td>
                        <td class="px-5 py-3.5 text-slate-500">{{ $teacher->user->email }}</td>
                        <td class="px-5 py-3.5">
                            <div class="flex gap-2 justify-end">
                                <x-admin.icon-link :href="route('admin.teachers.edit', $teacher)" icon="pencil" color="sky" label="Edit" />
                                <x-admin.icon-delete-form :action="route('admin.teachers.destroy', $teacher)" />
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5"><x-admin.empty-state icon="user-cog" title="Belum ada data guru" /></td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
<div class="mt-6">{{ $teachers->links() }}</div>
@endsection
