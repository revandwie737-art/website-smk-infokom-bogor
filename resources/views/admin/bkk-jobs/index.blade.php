@extends('layouts.admin')
@section('title', 'Lowongan Kerja (BKK)')
@section('content')

<x-admin.page-header
    title="Lowongan Kerja (BKK)"
    description="Kelola lowongan kerja yang tampil di halaman Bursa Kerja Khusus."
    cta="{{ route('admin.bkk-jobs.create') }}"
    cta-label="Tambah Lowongan"
    :count="$jobs->count()"
    count-label="lowongan"
/>

<div class="bg-white rounded-2xl border border-slate-100 overflow-x-auto">
    <table class="w-full text-sm">
        <thead class="bg-slate-50 text-slate-500 text-left">
            <tr>
                <th class="px-5 py-3">Posisi</th>
                <th class="px-5 py-3">Perusahaan</th>
                <th class="px-5 py-3">Jurusan</th>
                <th class="px-5 py-3">Batas Daftar</th>
                <th class="px-5 py-3">Status</th>
                <th class="px-5 py-3">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-100">
            @forelse($jobs as $job)
                <tr>
                    <td class="px-5 py-3 font-medium text-slate-700">{{ $job->position }}</td>
                    <td class="px-5 py-3 text-slate-500">{{ $job->company_name }}</td>
                    <td class="px-5 py-3 text-slate-500">{{ $job->program->code ?? 'Semua Jurusan' }}</td>
                    <td class="px-5 py-3 text-slate-500">{{ optional($job->deadline)->translatedFormat('d M Y') ?? '-' }}</td>
                    <td class="px-5 py-3">
                        <span class="text-xs font-semibold px-2.5 py-1 rounded-full {{ $job->is_active ? 'bg-emerald-50 text-emerald-600' : 'bg-slate-100 text-slate-500' }}">{{ $job->is_active ? 'Aktif' : 'Nonaktif' }}</span>
                    </td>
                    <td class="px-5 py-3">
                        <a href="{{ route('admin.bkk-jobs.edit', $job) }}" class="text-sky-600 font-medium mr-3">Edit</a>
                        <form method="POST" action="{{ route('admin.bkk-jobs.destroy', $job) }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')" class="inline">
                            @csrf @method('DELETE')
                            <button class="text-red-500 font-medium">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" class="px-5 py-8 text-center text-slate-400">Belum ada lowongan. Tambahkan lowongan pertama.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
