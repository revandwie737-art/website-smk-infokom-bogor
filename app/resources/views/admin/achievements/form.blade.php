@extends('layouts.admin')
@section('title', $achievement->exists ? 'Edit Prestasi' : 'Tambah Prestasi')
@section('content')

<x-admin.form-header
    :title="$achievement->exists ? 'Edit Prestasi' : 'Tambah Prestasi'"
    description="Lengkapi detail prestasi siswa di bawah ini."
    :back-route="route('admin.achievements.index')"
/>

<form method="POST" action="{{ $achievement->exists ? route('admin.achievements.update', $achievement) : route('admin.achievements.store') }}" enctype="multipart/form-data" class="bg-white rounded-2xl border border-slate-100 p-6 sm:p-8 space-y-5 max-w-2xl animate-fade-in-up">
    @csrf
    @if($achievement->exists) @method('PUT') @endif

    <div>
        <label class="block text-sm font-semibold text-slate-700 mb-1.5">Judul Prestasi</label>
        <input type="text" name="title" value="{{ old('title', $achievement->title) }}" required class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300 focus:border-sky-300 transition">
    </div>
    <div>
        <label class="block text-sm font-semibold text-slate-700 mb-1.5">Nama Siswa/Tim (opsional)</label>
        <input type="text" name="student_name" value="{{ old('student_name', $achievement->student_name) }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300 focus:border-sky-300 transition">
    </div>
    <div class="grid sm:grid-cols-3 gap-5">
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-1.5">Kategori</label>
            <select name="category" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300 focus:border-sky-300 transition">
                @foreach(['akademik','olahraga','seni','teknologi','lainnya'] as $c)
                    <option value="{{ $c }}" @selected(old('category', $achievement->category) === $c)>{{ ucfirst($c) }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-1.5">Tingkat</label>
            <select name="level" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300 focus:border-sky-300 transition">
                @foreach(['sekolah'=>'Sekolah','kabupaten_kota'=>'Kabupaten/Kota','provinsi'=>'Provinsi','nasional'=>'Nasional','internasional'=>'Internasional'] as $val => $label)
                    <option value="{{ $val }}" @selected(old('level', $achievement->level) === $val)>{{ $label }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-1.5">Tahun</label>
            <input type="number" name="year" value="{{ old('year', $achievement->year ?? date('Y')) }}" required class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300 focus:border-sky-300 transition">
        </div>
    </div>
    <div>
        <label class="block text-sm font-semibold text-slate-700 mb-1.5">Deskripsi</label>
        <textarea name="description" rows="3" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300 focus:border-sky-300 transition">{{ old('description', $achievement->description) }}</textarea>
    </div>
    <div class="grid sm:grid-cols-2 gap-5">
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-1.5">Foto</label>
            @if($achievement->photo) <img src="{{ asset('storage/' . $achievement->photo) }}" class="h-24 rounded-xl mb-2 ring-1 ring-slate-100"> @endif
            <input type="file" name="photo" class="w-full text-sm file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:bg-slate-100 file:text-slate-600 file:font-medium hover:file:bg-slate-200 transition">
            <p class="text-xs text-slate-400 mt-1">Foto ini akan memenuhi kartu prestasi (sedikit terpotong menyesuaikan bentuk kartu), bukan diberi latar blur lagi.</p>
        </div>
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-1.5">Sertifikat</label>
            <input type="file" name="certificate" class="w-full text-sm file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:bg-slate-100 file:text-slate-600 file:font-medium hover:file:bg-slate-200 transition">
        </div>
    </div>
    <div>
        <label class="block text-sm font-semibold text-slate-700 mb-1.5">Link (opsional)</label>
        <input type="url" name="link" value="{{ old('link', $achievement->link) }}" placeholder="https://... (berita, postingan, dsb)" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300 focus:border-sky-300 transition">
        <p class="text-xs text-slate-400 mt-1">Kalau diisi, akan muncul tombol link di bagian bawah kartu prestasi ini di halaman publik. Kalau dikosongkan, tidak ada yang ditampilkan.</p>
    </div>

    <x-admin.form-actions :cancel-route="route('admin.achievements.index')" />
</form>
@endsection
