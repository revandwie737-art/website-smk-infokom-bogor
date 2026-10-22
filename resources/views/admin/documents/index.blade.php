@extends('layouts.admin')
@section('title', 'Dokumen')
@section('content')

<x-admin.page-header
    title="Dokumen Akademik"
    description="File yang bisa diunduh publik dari halaman Informasi Akademik (kalender akademik, dsb)."
    cta="{{ route('admin.documents.create') }}"
    cta-label="Unggah Dokumen"
    :count="$documents->count()"
    count-label="dokumen"
/>

<div class="bg-white rounded-2xl border border-slate-100 overflow-x-auto hover-lift">
    <table class="w-full text-sm">
        <thead class="bg-slate-50 text-slate-500 text-left">
            <tr>
                <th class="px-5 py-3">Judul</th>
                <th class="px-5 py-3">Kategori</th>
                <th class="px-5 py-3">Status</th>
                <th class="px-5 py-3">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-100">
            @forelse($documents as $doc)
                <tr>
                    <td class="px-5 py-3 font-medium text-slate-700">{{ $doc->title }}</td>
                    <td class="px-5 py-3 text-slate-500">{{ $doc->category ?: '-' }}</td>
                    <td class="px-5 py-3">
                        <span class="text-xs font-semibold px-2.5 py-1 rounded-full {{ $doc->is_public ? 'bg-emerald-50 text-emerald-600' : 'bg-slate-100 text-slate-500' }}">{{ $doc->is_public ? 'Publik' : 'Privat' }}</span>
                    </td>
                    <td class="px-5 py-3">
                        <a href="{{ asset('storage/' . $doc->file) }}" target="_blank" class="text-sky-600 font-medium mr-3">Lihat</a>
                        <a href="{{ route('admin.documents.edit', $doc) }}" class="text-sky-600 font-medium mr-3">Edit</a>
                        <form method="POST" action="{{ route('admin.documents.destroy', $doc) }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')" class="inline">
                            @csrf @method('DELETE')
                            <button class="text-red-500 font-medium">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="4" class="px-5 py-8 text-center text-slate-400">Belum ada dokumen.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
