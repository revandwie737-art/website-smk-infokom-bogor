@extends('layouts.admin')
@section('title', 'Pendaftaran PPDB')
@section('content')
<form method="GET" class="mb-6">
    <select name="status" onchange="this.form.submit()" class="px-4 py-2.5 rounded-xl border border-slate-200 text-sm">
        <option value="">Semua Status</option>
        <option value="pending" @selected(request('status') === 'pending')>Pending</option>
        <option value="diterima" @selected(request('status') === 'diterima')>Diterima</option>
        <option value="ditolak" @selected(request('status') === 'ditolak')>Ditolak</option>
    </select>
</form>

<div class="bg-white rounded-2xl border border-slate-100 overflow-x-auto">
    <table class="w-full text-sm">
        <thead>
            <tr class="text-left text-slate-400 border-b border-slate-100">
                <th class="px-5 py-3">Nama</th>
                <th class="px-5 py-3">Kontak</th>
                <th class="px-5 py-3">Program</th>
                <th class="px-5 py-3">Gelombang</th>
                <th class="px-5 py-3">Status</th>
                <th class="px-5 py-3">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-100">
            @forelse($registrations as $reg)
                <tr>
                    <td class="px-5 py-3 font-medium text-slate-700">{{ $reg->full_name }}</td>
                    <td class="px-5 py-3 text-slate-500">{{ $reg->email }}<br><span class="text-xs">{{ $reg->phone }}</span></td>
                    <td class="px-5 py-3 text-slate-500">{{ $reg->program->name ?? '-' }}</td>
                    <td class="px-5 py-3 text-slate-500">{{ $reg->wave_label ?? '-' }}</td>
                    <td class="px-5 py-3">
                        <form method="POST" action="{{ route('admin.ppdb.update-status', $reg) }}">
                            @csrf @method('PATCH')
                            <select name="status" onchange="this.form.submit()" class="text-xs px-2.5 py-1.5 rounded-full border border-slate-200">
                                <option value="pending" @selected($reg->status === 'pending')>Pending</option>
                                <option value="diterima" @selected($reg->status === 'diterima')>Diterima</option>
                                <option value="ditolak" @selected($reg->status === 'ditolak')>Ditolak</option>
                            </select>
                        </form>
                    </td>
                    <td class="px-5 py-3">
                        <a href="{{ route('admin.ppdb.show', $reg) }}" class="text-navy-700 font-medium mr-3">Detail</a>
                        @if($reg->document_file)
                            <a href="{{ asset('storage/' . $reg->document_file) }}" target="_blank" class="text-sky-600 font-medium mr-3">Lihat Berkas</a>
                        @endif
                        <form method="POST" action="{{ route('admin.ppdb.destroy', $reg) }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')" class="inline">
                            @csrf @method('DELETE')
                            <button class="text-red-500 font-medium">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" class="px-5 py-8 text-center text-slate-400">Belum ada pendaftar PPDB.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-6">{{ $registrations->links() }}</div>
@endsection
