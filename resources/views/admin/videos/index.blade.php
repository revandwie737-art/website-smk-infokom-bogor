@extends('layouts.admin')
@section('title', 'Video')
@section('content')
<div class="flex justify-end mb-6">
    <a href="{{ route('admin.videos.create') }}" class="px-5 py-2.5 rounded-xl bg-navy-700 text-white text-sm font-semibold hover:bg-navy-800">+ Tambah Video</a>
</div>
<div class="bg-white rounded-2xl border border-slate-100 overflow-x-auto">
    <table class="w-full text-sm">
        <thead>
            <tr class="text-left text-slate-400 border-b border-slate-100">
                <th class="px-5 py-3">Judul</th>
                <th class="px-5 py-3">URL YouTube</th>
                <th class="px-5 py-3">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-100">
            @forelse($videos as $video)
                <tr>
                    <td class="px-5 py-3 font-medium text-slate-700">{{ $video->title }}</td>
                    <td class="px-5 py-3 text-slate-400 truncate max-w-xs">{{ $video->youtube_url }}</td>
                    <td class="px-5 py-3">
                        <div class="flex gap-3">
                            <a href="{{ route('admin.videos.edit', $video) }}" class="text-sky-600 font-medium">Edit</a>
                            <form method="POST" action="{{ route('admin.videos.destroy', $video) }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                @csrf @method('DELETE')
                                <button class="text-red-500 font-medium">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr><td colspan="3" class="px-5 py-8 text-center text-slate-400">Belum ada video.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
