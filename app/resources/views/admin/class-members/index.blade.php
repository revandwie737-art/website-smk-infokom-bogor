@extends('layouts.admin')
@section('title', 'Pengurus / Anggota Kelas')
@section('content')

<x-admin.page-header
    title="Pengurus / Anggota Kelas"
    description="Data ini murni untuk ditampilkan sebagai daftar teman sekelas di Portal Siswa & dashboard admin — bukan akun login. Untuk akun siswa yang bisa login, gunakan menu Siswa."
/>

<div class="flex items-center justify-between mb-6 flex-wrap gap-3">
    <form method="GET" class="flex gap-2">
        <div class="relative">
            <i data-lucide="school" class="w-4 h-4 absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400"></i>
            <select name="class_id" onchange="this.form.submit()" class="pl-9 pr-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-sky-300 transition">
                <option value="">Pilih Kelas</option>
                @foreach($classes as $c)
                    <option value="{{ $c->id }}" @selected($classId == $c->id)>{{ $c->name }}</option>
                @endforeach
            </select>
        </div>
    </form>
    @if($classId)
        <a href="{{ route('admin.class-members.create', ['class_id' => $classId]) }}" class="group inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-gradient-to-r from-navy-700 to-navy-900 text-white text-sm font-semibold hover:shadow-lg hover:shadow-navy-900/20 transition">
            <i data-lucide="plus" class="w-4 h-4 transition-transform group-hover:rotate-90"></i> Tambah Anggota
        </a>
    @endif
</div>

<div class="bg-white rounded-2xl border border-slate-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="text-left text-[11px] font-bold uppercase tracking-wider text-slate-400 bg-slate-50/70 border-b border-slate-100">
                    <th class="px-5 py-3.5 w-14">No.</th>
                    <th class="px-5 py-3.5">Nama</th>
                    <th class="px-5 py-3.5">Peran</th>
                    <th class="px-5 py-3.5 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($members as $i => $member)
                    <tr class="hover:bg-slate-50/60 transition-colors">
                        <td class="px-5 py-3.5 text-slate-400">{{ $i + 1 }}</td>
                        <td class="px-5 py-3.5">
                            <div class="flex items-center gap-3">
                                <div class="h-8 w-8 rounded-full bg-gradient-to-br from-navy-600 to-sky-500 text-white grid place-items-center text-xs font-bold shrink-0 overflow-hidden">
                                    @if($member->photo)
                                        <img src="{{ asset('storage/' . $member->photo) }}" class="h-full w-full object-cover">
                                    @else
                                        {{ strtoupper(substr($member->name,0,1)) }}
                                    @endif
                                </div>
                                <span class="font-medium text-slate-700">{{ $member->name }}</span>
                            </div>
                        </td>
                        <td class="px-5 py-3.5"><x-admin.badge color="sky" :label="$member->role" /></td>
                        <td class="px-5 py-3.5">
                            <div class="flex gap-2 justify-end">
                                <x-admin.icon-link :href="route('admin.class-members.edit', $member)" icon="pencil" color="sky" label="Edit" />
                                <x-admin.icon-delete-form :action="route('admin.class-members.destroy', $member)" />
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="4"><x-admin.empty-state icon="users" :title="$classId ? 'Belum ada anggota untuk kelas ini' : 'Pilih kelas terlebih dahulu'" /></td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
