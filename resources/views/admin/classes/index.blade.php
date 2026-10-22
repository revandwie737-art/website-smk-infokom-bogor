@extends('layouts.admin')
@section('title', 'Kelas')
@section('content')
<div class="flex justify-end mb-6">
    <a href="{{ route('admin.classes.create') }}" class="px-5 py-2.5 rounded-xl bg-navy-700 text-white text-sm font-semibold hover:bg-navy-800">+ Tambah Kelas</a>
</div>
<div class="bg-white rounded-2xl border border-slate-100 overflow-x-auto">
    <table class="w-full text-sm">
        <thead>
            <tr class="text-left text-slate-400 border-b border-slate-100">
                <th class="px-5 py-3">Nama Kelas</th>
                <th class="px-5 py-3">Program</th>
                <th class="px-5 py-3">Wali Kelas</th>
                <th class="px-5 py-3">Jumlah Siswa</th>
                <th class="px-5 py-3">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-100">
            @forelse($classes as $class)
                <tr>
                    <td class="px-5 py-3 font-medium text-slate-700">{{ $class->name }}</td>
                    <td class="px-5 py-3 text-slate-500">{{ $class->program->code ?? '-' }}</td>
                    <td class="px-5 py-3 text-slate-500">{{ $class->homeroomTeacher->user->name ?? '-' }}</td>
                    <td class="px-5 py-3 text-slate-500">{{ $class->students_count }}</td>
                    <td class="px-5 py-3">
                        <div class="flex gap-3">
                            <a href="{{ route('admin.classes.edit', $class) }}" class="text-sky-600 font-medium">Edit</a>
                            <form method="POST" action="{{ route('admin.classes.destroy', $class) }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                @csrf @method('DELETE')
                                <button class="text-red-500 font-medium">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="px-5 py-8 text-center text-slate-400">Belum ada kelas.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
