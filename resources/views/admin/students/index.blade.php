@extends('layouts.admin')
@section('title', 'Siswa')
@section('content')
<div class="flex items-center justify-between mb-6 flex-wrap gap-3">
    <form method="GET" class="flex gap-2">
        <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari nama / NISN..." class="px-4 py-2 rounded-xl border border-slate-200 text-sm">
        <select name="status" class="px-4 py-2 rounded-xl border border-slate-200 text-sm">
            <option value="">Semua Status</option>
            <option value="active" @selected(request('status') === 'active')>Aktif</option>
            <option value="pending" @selected(request('status') === 'pending')>Pending</option>
            <option value="suspended" @selected(request('status') === 'suspended')>Nonaktif</option>
        </select>
        <button class="px-4 py-2 rounded-xl bg-slate-100 text-sm font-medium">Cari</button>
    </form>
    <a href="{{ route('admin.students.create') }}" class="px-5 py-2.5 rounded-xl bg-navy-700 text-white text-sm font-semibold hover:bg-navy-800">+ Tambah Siswa</a>
</div>

<div class="bg-white rounded-2xl border border-slate-100 overflow-x-auto">
    <table class="w-full text-sm">
        <thead>
            <tr class="text-left text-slate-400 border-b border-slate-100">
                <th class="px-5 py-3">Nama</th>
                <th class="px-5 py-3">NISN</th>
                <th class="px-5 py-3">Kelas</th>
                <th class="px-5 py-3">Status</th>
                <th class="px-5 py-3">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-100">
            @forelse($students as $student)
                <tr>
                    <td class="px-5 py-3 font-medium text-slate-700">{{ $student->user->name }}</td>
                    <td class="px-5 py-3 text-slate-500">{{ $student->nisn }}</td>
                    <td class="px-5 py-3 text-slate-500">{{ $student->schoolClass->name ?? '-' }}</td>
                    <td class="px-5 py-3">
                        @php($statusColor = ['active' => 'bg-emerald-50 text-emerald-600', 'pending' => 'bg-amber-50 text-amber-600', 'suspended' => 'bg-red-50 text-red-500'])
                        <span class="text-xs px-2.5 py-1 rounded-full {{ $statusColor[$student->user->status] ?? '' }}">{{ ucfirst($student->user->status) }}</span>
                    </td>
                    <td class="px-5 py-3">
                        <div class="flex gap-3 flex-wrap">
                            <a href="{{ route('admin.students.edit', $student) }}" class="text-sky-600 font-medium">Edit</a>
                            @if($student->user->status === 'pending')
                                <form method="POST" action="{{ route('admin.students.approve', $student) }}">
                                    @csrf
                                    <button class="text-emerald-600 font-medium">Setujui</button>
                                </form>
                            @elseif($student->user->status === 'active')
                                <form method="POST" action="{{ route('admin.students.suspend', $student) }}">
                                    @csrf
                                    <button class="text-amber-600 font-medium">Nonaktifkan</button>
                                </form>
                            @endif
                            <form method="POST" action="{{ route('admin.students.destroy', $student) }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                @csrf @method('DELETE')
                                <button class="text-red-500 font-medium">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="px-5 py-8 text-center text-slate-400">Belum ada data siswa.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-6">{{ $students->links() }}</div>
@endsection
