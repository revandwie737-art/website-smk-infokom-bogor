@extends('layouts.admin')
@section('title', 'Kategori Berita')
@section('content')
<div class="grid lg:grid-cols-3 gap-6">
    <div class="lg:col-span-2 bg-white rounded-2xl border border-slate-100 overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="text-left text-slate-400 border-b border-slate-100">
                    <th class="px-5 py-3">Nama Kategori</th>
                    <th class="px-5 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($categories as $cat)
                    <tr>
                        <td class="px-5 py-3 font-medium text-slate-700">{{ $cat->name }}</td>
                        <td class="px-5 py-3">
                            <form method="POST" action="{{ route('admin.categories.destroy', $cat) }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                @csrf @method('DELETE')
                                <button class="text-red-500 font-medium">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="2" class="px-5 py-8 text-center text-slate-400">Belum ada kategori.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="bg-white rounded-2xl border border-slate-100 p-6">
        <p class="font-semibold text-slate-800 mb-4">Tambah Kategori</p>
        <form method="POST" action="{{ route('admin.categories.store') }}" class="space-y-4">
            @csrf
            <input type="text" name="name" placeholder="Nama kategori" required class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
            <button class="w-full py-2.5 rounded-xl bg-navy-700 text-white font-semibold">Tambah</button>
        </form>
    </div>
</div>
@endsection
