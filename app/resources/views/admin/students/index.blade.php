@extends('layouts.admin')
@section('title', 'Siswa')
@section('content')

<x-admin.page-header
    title="Siswa"
    description="Kelola data akun siswa, kelas, dan status keanggotaan."
    cta="{{ route('admin.students.create') }}"
    cta-label="Tambah Siswa"
    :count="$students->total()"
    count-label="siswa terdaftar"
/>

<form method="GET" class="flex flex-wrap gap-2 mb-6 animate-fade-in-up">
    <div class="relative flex-1 max-w-xs">
        <i data-lucide="search" class="w-4 h-4 absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400"></i>
        <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari nama / NISN..." class="w-full pl-9 pr-3 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-sky-300 transition">
    </div>
    <select name="status" class="px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-sky-300 transition">
        <option value="">Semua Status</option>
        <option value="active" @selected(request('status') === 'active')>Aktif</option>
        <option value="pending" @selected(request('status') === 'pending')>Pending</option>
        <option value="suspended" @selected(request('status') === 'suspended')>Nonaktif</option>
    </select>
    <button class="px-4 py-2.5 rounded-xl bg-slate-100 text-slate-600 text-sm font-medium hover:bg-slate-200 transition inline-flex items-center gap-1.5"><i data-lucide="search" class="w-3.5 h-3.5"></i> Cari</button>
</form>

<div class="bg-white rounded-2xl border border-slate-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="text-left text-[11px] font-bold uppercase tracking-wider text-slate-400 bg-slate-50/70 border-b border-slate-100">
                    <th class="px-5 py-3.5">Nama</th>
                    <th class="px-5 py-3.5">NISN</th>
                    <th class="px-5 py-3.5">Kelas</th>
                    <th class="px-5 py-3.5">Status</th>
                    <th class="px-5 py-3.5 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($students as $student)
                    <tr class="hover:bg-slate-50/60 transition-colors">
                        <td class="px-5 py-3.5">
                            <div class="flex items-center gap-3">
                                <div class="h-8 w-8 rounded-full bg-gradient-to-br from-navy-600 to-sky-500 text-white grid place-items-center text-xs font-bold shrink-0">{{ strtoupper(substr($student->user->name,0,1)) }}</div>
                                <span class="font-medium text-slate-700">{{ $student->user->name }}</span>
                            </div>
                        </td>
                        <td class="px-5 py-3.5 text-slate-500">{{ $student->nisn }}</td>
                        <td class="px-5 py-3.5 text-slate-500">{{ $student->schoolClass->name ?? '-' }}</td>
                        <td class="px-5 py-3.5">
                            @php($statusColor = ['active' => 'emerald', 'pending' => 'amber', 'suspended' => 'red'])
                            <x-admin.badge :color="$statusColor[$student->user->status] ?? 'slate'" :label="ucfirst($student->user->status)" />
                        </td>
                        <td class="px-5 py-3.5">
                            <div class="flex gap-2 justify-end">
                                <x-admin.icon-link :href="route('admin.students.edit', $student)" icon="pencil" color="sky" label="Edit" />
                                @if($student->user->status === 'pending')
                                    <form method="POST" action="{{ route('admin.students.approve', $student) }}">
                                        @csrf
                                        <button type="submit" title="Setujui" class="inline-flex items-center justify-center h-8 w-8 rounded-lg bg-emerald-50 text-emerald-600 hover:bg-emerald-100 transition"><i data-lucide="check" class="w-[15px] h-[15px]"></i></button>
                                    </form>
                                @elseif($student->user->status === 'active')
                                    <form method="POST" action="{{ route('admin.students.suspend', $student) }}">
                                        @csrf
                                        <button type="submit" title="Nonaktifkan" class="inline-flex items-center justify-center h-8 w-8 rounded-lg bg-amber-50 text-amber-600 hover:bg-amber-100 transition"><i data-lucide="user-x" class="w-[15px] h-[15px]"></i></button>
                                    </form>
                                @endif
                                <x-admin.icon-delete-form :action="route('admin.students.destroy', $student)" />
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5"><x-admin.empty-state icon="user-round" title="Belum ada data siswa" /></td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
<div class="mt-6">{{ $students->links() }}</div>
@endsection
