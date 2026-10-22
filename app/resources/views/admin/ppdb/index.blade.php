@extends('layouts.admin')
@section('title', 'Pendaftaran PPDB')
@section('content')

<x-admin.page-header
    title="Pendaftaran PPDB"
    description="Kelola dan verifikasi pendaftar Penerimaan Peserta Didik Baru."
    :count="$registrations->total()"
    count-label="pendaftar"
/>

<form method="GET" class="mb-6 flex items-center gap-3 flex-wrap animate-fade-in-up">
    <div class="relative">
        <i data-lucide="filter" class="w-4 h-4 absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400"></i>
        <select name="status" onchange="this.form.submit()" class="pl-9 pr-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-sky-300 transition">
            <option value="">Semua Status</option>
            <option value="pending" @selected(request('status') === 'pending')>Pending</option>
            <option value="diterima" @selected(request('status') === 'diterima')>Diterima</option>
            <option value="ditolak" @selected(request('status') === 'ditolak')>Ditolak</option>
        </select>
    </div>
</form>

<div class="bg-white rounded-2xl border border-slate-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="text-left text-[11px] font-bold uppercase tracking-wider text-slate-400 bg-slate-50/70 border-b border-slate-100">
                    <th class="px-5 py-3.5">Nama</th>
                    <th class="px-5 py-3.5">Kontak</th>
                    <th class="px-5 py-3.5">Program</th>
                    <th class="px-5 py-3.5">Gelombang</th>
                    <th class="px-5 py-3.5">Status</th>
                    <th class="px-5 py-3.5 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($registrations as $reg)
                    <tr class="hover:bg-slate-50/60 transition-colors">
                        <td class="px-5 py-3.5">
                            <div class="flex items-center gap-3">
                                <div class="h-9 w-9 rounded-full bg-gradient-to-br from-navy-600 to-sky-500 text-white grid place-items-center text-xs font-bold shrink-0">{{ strtoupper(substr($reg->full_name,0,1)) }}</div>
                                <span class="font-medium text-slate-700">{{ $reg->full_name }}</span>
                            </div>
                        </td>
                        <td class="px-5 py-3.5 text-slate-500">
                            <p>{{ $reg->email }}</p>
                            <p class="text-xs text-slate-400">{{ $reg->phone }}</p>
                        </td>
                        <td class="px-5 py-3.5 text-slate-500">{{ $reg->program->name ?? '-' }}</td>
                        <td class="px-5 py-3.5 text-slate-500">{{ $reg->wave_label ?? '-' }}</td>
                        <td class="px-5 py-3.5">
                            <form method="POST" action="{{ route('admin.ppdb.update-status', $reg) }}">
                                @csrf @method('PATCH')
                                @php($sColor = ['pending'=>'amber','diterima'=>'emerald','ditolak'=>'red'][$reg->status] ?? 'slate')
                                <select name="status" onchange="this.form.submit()" class="text-xs font-semibold px-3 py-1.5 rounded-full border-0 ring-1 ring-inset ring-{{ $sColor }}-100 bg-{{ $sColor }}-50 text-{{ $sColor }}-600 focus:outline-none focus:ring-2 focus:ring-{{ $sColor }}-300 transition cursor-pointer">
                                    <option value="pending" @selected($reg->status === 'pending')>Pending</option>
                                    <option value="diterima" @selected($reg->status === 'diterima')>Diterima</option>
                                    <option value="ditolak" @selected($reg->status === 'ditolak')>Ditolak</option>
                                </select>
                            </form>
                        </td>
                        <td class="px-5 py-3.5">
                            <div class="flex gap-2 justify-end">
                                @if($reg->document_file)
                                    <x-admin.icon-link :href="asset('storage/' . $reg->document_file)" target="_blank" icon="file-text" color="navy" label="Lihat Berkas" />
                                @endif
                                <x-admin.icon-delete-form :action="route('admin.ppdb.destroy', $reg)" />
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6"><x-admin.empty-state icon="inbox" title="Belum ada pendaftar PPDB" /></td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
<div class="mt-6">{{ $registrations->links() }}</div>
@endsection
