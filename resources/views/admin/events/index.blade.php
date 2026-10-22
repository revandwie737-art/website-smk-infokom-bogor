@extends('layouts.admin')
@section('title', 'Agenda')
@section('content')
<div class="flex justify-end mb-6">
    <a href="{{ route('admin.events.create') }}" class="px-5 py-2.5 rounded-xl bg-navy-700 text-white text-sm font-semibold hover:bg-navy-800">+ Tambah Agenda</a>
</div>
<div class="bg-white rounded-2xl border border-slate-100 overflow-x-auto">
    <table class="w-full text-sm">
        <thead>
            <tr class="text-left text-slate-400 border-b border-slate-100">
                <th class="px-5 py-3">Judul</th>
                <th class="px-5 py-3">Tanggal</th>
                <th class="px-5 py-3">Lokasi</th>
                <th class="px-5 py-3">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-100">
            @forelse($events as $event)
                <tr>
                    <td class="px-5 py-3 font-medium text-slate-700">{{ $event->title }}</td>
                    <td class="px-5 py-3 text-slate-500">{{ $event->event_date->format('d M Y') }}</td>
                    <td class="px-5 py-3 text-slate-500">{{ $event->location ?? '-' }}</td>
                    <td class="px-5 py-3">
                        <div class="flex gap-3">
                            <a href="{{ route('admin.events.edit', $event) }}" class="text-sky-600 font-medium">Edit</a>
                            <form method="POST" action="{{ route('admin.events.destroy', $event) }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                @csrf @method('DELETE')
                                <button class="text-red-500 font-medium">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr><td colspan="4" class="px-5 py-8 text-center text-slate-400">Belum ada agenda.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-6">{{ $events->links() }}</div>
@endsection
