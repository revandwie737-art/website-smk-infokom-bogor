@extends('layouts.admin')
@section('title', 'Jadwal')
@section('content')
<div class="flex items-center justify-between mb-6">
    <form method="GET" class="flex gap-2">
        <select name="class_id" onchange="this.form.submit()" class="px-4 py-2.5 rounded-xl border border-slate-200 text-sm">
            <option value="">Semua Kelas</option>
            @foreach($classes as $c)
                <option value="{{ $c->id }}" @selected($classId == $c->id)>{{ $c->name }}</option>
            @endforeach
        </select>
    </form>
    <a href="{{ route('admin.schedules.create') }}" class="px-5 py-2.5 rounded-xl bg-navy-700 text-white text-sm font-semibold hover:bg-navy-800">+ Tambah Jadwal</a>
</div>

<div class="bg-white rounded-2xl border border-slate-100 overflow-x-auto">
    <table class="w-full text-sm">
        <thead>
            <tr class="text-left text-slate-400 border-b border-slate-100">
                <th class="px-5 py-3">Hari</th>
                <th class="px-5 py-3">Waktu</th>
                <th class="px-5 py-3">Mata Pelajaran</th>
                <th class="px-5 py-3">Guru</th>
                <th class="px-5 py-3">Ruang</th>
                <th class="px-5 py-3">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-100">
            @forelse($schedules as $s)
                <tr>
                    <td class="px-5 py-3 text-slate-700 capitalize">{{ $s->day }}</td>
                    <td class="px-5 py-3 text-slate-500">{{ \Illuminate\Support\Carbon::parse($s->start_time)->format('H:i') }} - {{ \Illuminate\Support\Carbon::parse($s->end_time)->format('H:i') }}</td>
                    <td class="px-5 py-3 text-slate-700">{{ $s->subject->name ?? '-' }}</td>
                    <td class="px-5 py-3 text-slate-500">{{ $s->teacher->user->name ?? '-' }}</td>
                    <td class="px-5 py-3 text-slate-500">{{ $s->room ?? '-' }}</td>
                    <td class="px-5 py-3">
                        <div class="flex gap-3">
                            <a href="{{ route('admin.schedules.edit', $s) }}" class="text-sky-600 font-medium">Edit</a>
                            <form method="POST" action="{{ route('admin.schedules.destroy', $s) }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                @csrf @method('DELETE')
                                <button class="text-red-500 font-medium">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" class="px-5 py-8 text-center text-slate-400">Belum ada jadwal. Pilih kelas untuk melihat jadwal.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
