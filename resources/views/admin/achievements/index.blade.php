@extends('layouts.admin')
@section('title', 'Prestasi')
@section('content')
<div class="flex justify-end mb-6">
    <a href="{{ route('admin.achievements.create') }}" class="px-5 py-2.5 rounded-xl bg-navy-700 text-white text-sm font-semibold hover:bg-navy-800">+ Tambah Prestasi</a>
</div>
<div class="bg-white rounded-2xl border border-slate-100 overflow-x-auto">
    <table class="w-full text-sm">
        <thead>
            <tr class="text-left text-slate-400 border-b border-slate-100">
                <th class="px-5 py-3">Judul</th>
                <th class="px-5 py-3">Kategori</th>
                <th class="px-5 py-3">Tingkat</th>
                <th class="px-5 py-3">Tahun</th>
                <th class="px-5 py-3">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-100">
            @forelse($achievements as $ach)
                <tr>
                    <td class="px-5 py-3 font-medium text-slate-700">{{ $ach->title }}</td>
                    <td class="px-5 py-3 text-slate-500 capitalize">{{ $ach->category }}</td>
                    <td class="px-5 py-3 text-slate-500 capitalize">{{ str_replace('_',' ',$ach->level) }}</td>
                    <td class="px-5 py-3 text-slate-500">{{ $ach->year }}</td>
                    <td class="px-5 py-3">
                        <div class="flex gap-3">
                            <a href="{{ route('admin.achievements.edit', $ach) }}" class="text-sky-600 font-medium">Edit</a>
                            <form method="POST" action="{{ route('admin.achievements.destroy', $ach) }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                @csrf @method('DELETE')
                                <button class="text-red-500 font-medium">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="px-5 py-8 text-center text-slate-400">Belum ada data prestasi.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-6">{{ $achievements->links() }}</div>
@endsection
