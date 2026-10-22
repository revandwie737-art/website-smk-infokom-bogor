@extends('layouts.admin')
@section('title', 'Berita')
@section('content')
<div class="flex items-center justify-between mb-6">
    <form method="GET" class="flex gap-2">
        <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari berita..." class="px-4 py-2 rounded-xl border border-slate-200 text-sm">
        <button class="px-4 py-2 rounded-xl bg-slate-100 text-sm font-medium">Cari</button>
    </form>
    <a href="{{ route('admin.news.create') }}" class="px-5 py-2.5 rounded-xl bg-navy-700 text-white text-sm font-semibold hover:bg-navy-800">+ Tambah Berita</a>
</div>

<div class="bg-white rounded-2xl border border-slate-100 overflow-x-auto">
    <table class="w-full text-sm">
        <thead>
            <tr class="text-left text-slate-400 border-b border-slate-100">
                <th class="px-5 py-3">Judul</th>
                <th class="px-5 py-3">Kategori</th>
                <th class="px-5 py-3">Status</th>
                <th class="px-5 py-3">Dilihat</th>
                <th class="px-5 py-3">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-100">
            @forelse($news as $item)
                <tr>
                    <td class="px-5 py-3 font-medium text-slate-700">{{ $item->title }}</td>
                    <td class="px-5 py-3 text-slate-500">{{ $item->category->name ?? '-' }}</td>
                    <td class="px-5 py-3">
                        <span class="text-xs px-2.5 py-1 rounded-full {{ $item->status === 'published' ? 'bg-emerald-50 text-emerald-600' : 'bg-slate-100 text-slate-500' }}">{{ ucfirst($item->status) }}</span>
                    </td>
                    <td class="px-5 py-3 text-slate-500">{{ $item->views }}</td>
                    <td class="px-5 py-3">
                        <div class="flex gap-3">
                            <a href="{{ route('admin.news.edit', $item) }}" class="text-sky-600 font-medium">Edit</a>
                            <form method="POST" action="{{ route('admin.news.destroy', $item) }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                @csrf @method('DELETE')
                                <button class="text-red-500 font-medium">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="px-5 py-8 text-center text-slate-400">Belum ada berita.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-6">{{ $news->links() }}</div>
@endsection
