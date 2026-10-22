@extends('layouts.admin')
@section('title', 'Pesan Masuk')
@section('content')

<x-admin.page-header
    title="Pesan Masuk"
    description="Pesan yang dikirim melalui formulir kontak di website."
    :count="$messages->total()"
    count-label="pesan"
/>

<div class="bg-white rounded-2xl border border-slate-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="text-left text-[11px] font-bold uppercase tracking-wider text-slate-400 bg-slate-50/70 border-b border-slate-100">
                    <th class="px-5 py-3.5">Pengirim</th>
                    <th class="px-5 py-3.5">Subjek</th>
                    <th class="px-5 py-3.5">Tanggal</th>
                    <th class="px-5 py-3.5">Status</th>
                    <th class="px-5 py-3.5 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($messages as $msg)
                    <tr class="hover:bg-slate-50/60 transition-colors {{ !$msg->is_read ? 'bg-sky-50/30' : '' }}">
                        <td class="px-5 py-3.5">
                            <div class="flex items-center gap-3">
                                <div class="h-9 w-9 rounded-full bg-gradient-to-br from-navy-600 to-sky-500 text-white grid place-items-center text-xs font-bold shrink-0">{{ strtoupper(substr($msg->name,0,1)) }}</div>
                                <div class="min-w-0">
                                    <p class="font-medium text-slate-700 truncate">{{ $msg->name }}</p>
                                    <p class="text-xs text-slate-400 truncate">{{ $msg->email }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-5 py-3.5 text-slate-500 max-w-[220px] truncate">{{ $msg->subject ?? '-' }}</td>
                        <td class="px-5 py-3.5 text-slate-500">{{ $msg->created_at->format('d M Y') }}</td>
                        <td class="px-5 py-3.5">
                            <x-admin.badge :color="$msg->is_read ? 'slate' : 'sky'" :label="$msg->is_read ? 'Dibaca' : 'Baru'" />
                        </td>
                        <td class="px-5 py-3.5">
                            <div class="flex gap-2 justify-end">
                                <x-admin.icon-link :href="route('admin.messages.show', $msg)" icon="eye" color="sky" label="Lihat" />
                                <x-admin.icon-delete-form :action="route('admin.messages.destroy', $msg)" />
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5"><x-admin.empty-state icon="mail" title="Belum ada pesan masuk" /></td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
<div class="mt-6">{{ $messages->links() }}</div>
@endsection
