@extends('layouts.admin')
@section('title', 'Guru')
@section('content')
<div class="flex justify-end mb-6">
    <a href="{{ route('admin.teachers.create') }}" class="px-5 py-2.5 rounded-xl bg-navy-700 text-white text-sm font-semibold hover:bg-navy-800">+ Tambah Guru</a>
</div>
<div class="bg-white rounded-2xl border border-slate-100 overflow-x-auto">
    <table class="w-full text-sm">
        <thead>
            <tr class="text-left text-slate-400 border-b border-slate-100">
                <th class="px-5 py-3">Nama</th>
                <th class="px-5 py-3">NIP</th>
                <th class="px-5 py-3">Jabatan</th>
                <th class="px-5 py-3">Email</th>
                <th class="px-5 py-3">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-100">
            @forelse($teachers as $teacher)
                <tr>
                    <td class="px-5 py-3 font-medium text-slate-700">{{ $teacher->user->name }}</td>
                    <td class="px-5 py-3 text-slate-500">{{ $teacher->nip ?? '-' }}</td>
                    <td class="px-5 py-3 text-slate-500">{{ $teacher->position ?? '-' }}</td>
                    <td class="px-5 py-3 text-slate-500">{{ $teacher->user->email }}</td>
                    <td class="px-5 py-3">
                        <div class="flex gap-3">
                            <a href="{{ route('admin.teachers.edit', $teacher) }}" class="text-sky-600 font-medium">Edit</a>
                            <form method="POST" action="{{ route('admin.teachers.destroy', $teacher) }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                @csrf @method('DELETE')
                                <button class="text-red-500 font-medium">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="px-5 py-8 text-center text-slate-400">Belum ada data guru.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-6">{{ $teachers->links() }}</div>
@endsection
