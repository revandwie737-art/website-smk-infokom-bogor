@extends('layouts.admin')
@section('title', $job->exists ? 'Edit Lowongan' : 'Tambah Lowongan')
@section('content')

<x-admin.page-header :title="$job->exists ? 'Edit Lowongan' : 'Tambah Lowongan'" description="Lowongan ini akan tampil di halaman BKK setelah disimpan (jika status Aktif)." />

<form method="POST" action="{{ $job->exists ? route('admin.bkk-jobs.update', $job) : route('admin.bkk-jobs.store') }}" class="max-w-3xl space-y-6">
    @csrf
    @if($job->exists) @method('PUT') @endif

    <x-admin.section title="Informasi Lowongan" icon="💼">
        <div class="grid sm:grid-cols-2 gap-5">
            <div>
                <label class="block text-sm font-medium text-slate-600 mb-1.5">Nama Perusahaan</label>
                <input type="text" name="company_name" value="{{ old('company_name', $job->company_name) }}" required class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-600 mb-1.5">Posisi</label>
                <input type="text" name="position" value="{{ old('position', $job->position) }}" required class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
            </div>
        </div>
        <div class="grid sm:grid-cols-3 gap-5">
            <div>
                <label class="block text-sm font-medium text-slate-600 mb-1.5">Lokasi</label>
                <input type="text" name="location" value="{{ old('location', $job->location) }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-600 mb-1.5">Jurusan yang Sesuai</label>
                <select name="program_id" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
                    <option value="">Semua Jurusan</option>
                    @foreach($programs as $program)
                        <option value="{{ $program->id }}" @selected(old('program_id', $job->program_id) == $program->id)>{{ $program->code }} — {{ $program->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-600 mb-1.5">Jenis Pekerjaan</label>
                <select name="job_type" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
                    <option value="penuh_waktu" @selected(old('job_type', $job->job_type ?? 'penuh_waktu') === 'penuh_waktu')>Penuh Waktu</option>
                    <option value="paruh_waktu" @selected(old('job_type', $job->job_type) === 'paruh_waktu')>Paruh Waktu</option>
                    <option value="magang" @selected(old('job_type', $job->job_type) === 'magang')>Magang</option>
                    <option value="kontrak" @selected(old('job_type', $job->job_type) === 'kontrak')>Kontrak</option>
                </select>
            </div>
        </div>
        <div>
            <label class="block text-sm font-medium text-slate-600 mb-1.5">Kualifikasi</label>
            <textarea name="qualifications" rows="3" placeholder="Satu poin per baris" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">{{ old('qualifications', $job->qualifications) }}</textarea>
        </div>
        <div>
            <label class="block text-sm font-medium text-slate-600 mb-1.5">Deskripsi Pekerjaan</label>
            <textarea name="description" rows="4" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">{{ old('description', $job->description) }}</textarea>
        </div>
        <div class="grid sm:grid-cols-2 gap-5">
            <div>
                <label class="block text-sm font-medium text-slate-600 mb-1.5">Batas Pendaftaran</label>
                <input type="date" name="deadline" value="{{ old('deadline', optional($job->deadline)->format('Y-m-d')) }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-600 mb-1.5">Link Lamar (opsional)</label>
                <input type="url" name="apply_link" value="{{ old('apply_link', $job->apply_link) }}" placeholder="https://" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
            </div>
        </div>
        <label class="flex items-center gap-3">
            <input type="hidden" name="is_active" value="0">
            <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $job->is_active ?? true)) class="rounded border-slate-300">
            <span class="text-sm text-slate-600">Aktif &mdash; tampilkan di halaman BKK</span>
        </label>
    </x-admin.section>

    <div class="flex gap-3 pb-2">
        <button type="submit" class="px-8 py-3 rounded-xl bg-navy-700 text-white font-semibold hover:bg-navy-800 transition">Simpan</button>
        <a href="{{ route('admin.bkk-jobs.index') }}" class="px-8 py-3 rounded-xl border border-slate-200 text-slate-600 font-medium hover:bg-slate-50 transition">Batal</a>
    </div>
</form>
@endsection
