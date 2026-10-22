@extends('layouts.admin')
@section('title', 'Mata Pelajaran')
@section('content')
<div class="flex justify-end mb-6">
    <a href="{{ route('admin.subjects.create') }}" class="px-5 py-2.5 rounded-xl bg-navy-700 text-white text-sm font-semibold hover:bg-navy-800">+ Tambah Mata Pelajaran</a>
</div>
<div class="bg-white rounded-2xl border border-slate-100 overflow-x-auto">
    <table class="w-full text-sm">
        <thead>
            <tr class="text-left text-slate-400 border-b border-slate-100">
                <th class="px-5 py-3">Nama</th>
                <th class="px-5 py-3">Kode</th>
                <th class="px-5 py-3">Program</th>
                <th class="px-5 py-3">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-100">
            @forelse($subjects as $subject)
                <tr>
                    <td class="px-5 py-3 font-medium text-slate-700">{{ $subject->name }}</td>
                    <td class="px-5 py-3 text-slate-500">{{ $subject->code ?? '-' }}</td>
                    <td class="px-5 py-3 text-slate-500">{{ $subject->program->code ?? 'Umum' }}</td>
                    <td class="px-5 py-3">
                        <div class="flex gap-3">
                            <a href="{{ route('admin.subjects.edit', $subject) }}" class="text-sky-600 font-medium">Edit</a>
                            <form method="POST" action="{{ route('admin.subjects.destroy', $subject) }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                @csrf @method('DELETE')
                                <button class="text-red-500 font-medium">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr><td colspan="4" class="px-5 py-8 text-center text-slate-400">Belum ada mata pelajaran.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
