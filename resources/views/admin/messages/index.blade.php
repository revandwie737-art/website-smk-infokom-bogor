@extends('layouts.admin')
@section('title', 'Pesan Masuk')
@section('content')
<div class="bg-white rounded-2xl border border-slate-100 overflow-x-auto">
    <table class="w-full text-sm">
        <thead>
            <tr class="text-left text-slate-400 border-b border-slate-100">
                <th class="px-5 py-3">Pengirim</th>
                <th class="px-5 py-3">Subjek</th>
                <th class="px-5 py-3">Tanggal</th>
                <th class="px-5 py-3">Status</th>
                <th class="px-5 py-3">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-100">
            @forelse($messages as $msg)
                <tr>
                    <td class="px-5 py-3 font-medium text-slate-700">{{ $msg->name }}<br><span class="text-xs text-slate-400">{{ $msg->email }}</span></td>
                    <td class="px-5 py-3 text-slate-500">{{ $msg->subject ?? '-' }}</td>
                    <td class="px-5 py-3 text-slate-500">{{ $msg->created_at->format('d M Y') }}</td>
                    <td class="px-5 py-3">
                        <span class="text-xs px-2.5 py-1 rounded-full {{ $msg->is_read ? 'bg-slate-100 text-slate-500' : 'bg-sky-50 text-sky-600' }}">{{ $msg->is_read ? 'Dibaca' : 'Baru' }}</span>
                    </td>
                    <td class="px-5 py-3">
                        <div class="flex gap-3">
                            <a href="{{ route('admin.messages.show', $msg) }}" class="text-sky-600 font-medium">Lihat</a>
                            <form method="POST" action="{{ route('admin.messages.destroy', $msg) }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                @csrf @method('DELETE')
                                <button class="text-red-500 font-medium">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="px-5 py-8 text-center text-slate-400">Belum ada pesan masuk.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-6">{{ $messages->links() }}</div>
@endsection
