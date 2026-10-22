@extends('layouts.admin')
@section('title', 'Pengumuman')
@section('content')
<div class="flex justify-end mb-6">
    <a href="{{ route('admin.announcements.create') }}" class="px-5 py-2.5 rounded-xl bg-navy-700 text-white text-sm font-semibold hover:bg-navy-800">+ Tambah Pengumuman</a>
</div>
<div class="bg-white rounded-2xl border border-slate-100 overflow-x-auto">
    <table class="w-full text-sm">
        <thead>
            <tr class="text-left text-slate-400 border-b border-slate-100">
                <th class="px-5 py-3">Judul</th>
                <th class="px-5 py-3">Prioritas</th>
                <th class="px-5 py-3">Status</th>
                <th class="px-5 py-3">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-100">
            @forelse($announcements as $a)
                <tr>
                    <td class="px-5 py-3 font-medium text-slate-700">{{ $a->title }}</td>
                    <td class="px-5 py-3 text-slate-500 capitalize">{{ $a->priority }}</td>
                    <td class="px-5 py-3">
                        <span class="text-xs px-2.5 py-1 rounded-full {{ $a->is_active ? 'bg-emerald-50 text-emerald-600' : 'bg-slate-100 text-slate-500' }}">{{ $a->is_active ? 'Aktif' : 'Nonaktif' }}</span>
                    </td>
                    <td class="px-5 py-3">
                        <div class="flex gap-3">
                            <a href="{{ route('admin.announcements.edit', $a) }}" class="text-sky-600 font-medium">Edit</a>
                            <form method="POST" action="{{ route('admin.announcements.destroy', $a) }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                @csrf @method('DELETE')
                                <button class="text-red-500 font-medium">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr><td colspan="4" class="px-5 py-8 text-center text-slate-400">Belum ada pengumuman.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-6">{{ $announcements->links() }}</div>
@endsection
