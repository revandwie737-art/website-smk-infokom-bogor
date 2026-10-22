@extends('layouts.admin')
@section('title', 'Detail Pendaftar PPDB')
@section('content')

<div class="flex items-center justify-between mb-6">
    <a href="{{ route('admin.ppdb.index') }}" class="text-sm text-slate-500 hover:text-navy-700">&larr; Kembali ke daftar pendaftar</a>
    <form method="POST" action="{{ route('admin.ppdb.update-status', $ppdbRegistration) }}">
        @csrf @method('PATCH')
        <select name="status" onchange="this.form.submit()" class="text-sm px-3 py-2 rounded-full border border-slate-200">
            <option value="pending" @selected($ppdbRegistration->status === 'pending')>Pending</option>
            <option value="diterima" @selected($ppdbRegistration->status === 'diterima')>Diterima</option>
            <option value="ditolak" @selected($ppdbRegistration->status === 'ditolak')>Ditolak</option>
        </select>
    </form>
</div>

<div class="space-y-6 max-w-4xl">

    <div class="bg-white rounded-2xl border border-slate-100 p-6">
        <h2 class="text-lg font-bold text-navy-900">{{ $ppdbRegistration->full_name }}</h2>
        <p class="text-sm text-slate-400">Dikirim {{ $ppdbRegistration->created_at->translatedFormat('d F Y, H:i') }}</p>
    </div>

    {{-- A. Identitas --}}
    <div class="bg-white rounded-2xl border border-slate-100 p-6">
        <h3 class="text-sm font-bold text-navy-800 uppercase tracking-wide border-b border-slate-100 pb-2 mb-4">A. Identitas Calon Peserta Didik</h3>
        <dl class="grid sm:grid-cols-2 gap-x-8 gap-y-3 text-sm">
            <div><dt class="text-slate-400">Nama Lengkap</dt><dd class="text-slate-700 font-medium">{{ $ppdbRegistration->full_name }}</dd></div>
            <div><dt class="text-slate-400">NISN</dt><dd class="text-slate-700">{{ $ppdbRegistration->nisn ?: '-' }}</dd></div>
            <div><dt class="text-slate-400">Tempat, Tanggal Lahir</dt><dd class="text-slate-700">{{ $ppdbRegistration->birth_place ?: '-' }}{{ $ppdbRegistration->birth_date ? ', ' . $ppdbRegistration->birth_date->translatedFormat('d F Y') : '' }}</dd></div>
            <div><dt class="text-slate-400">Jenis Kelamin</dt><dd class="text-slate-700">{{ $ppdbRegistration->gender_label ?: '-' }}</dd></div>
            <div><dt class="text-slate-400">Asal Sekolah</dt><dd class="text-slate-700">{{ $ppdbRegistration->previous_school ?: '-' }}</dd></div>
            <div><dt class="text-slate-400">Email</dt><dd class="text-slate-700">{{ $ppdbRegistration->email }}</dd></div>
            <div><dt class="text-slate-400">No. HP / WhatsApp</dt><dd class="text-slate-700">{{ $ppdbRegistration->phone }}</dd></div>
        </dl>
    </div>

    {{-- B. Alamat --}}
    <div class="bg-white rounded-2xl border border-slate-100 p-6">
        <h3 class="text-sm font-bold text-navy-800 uppercase tracking-wide border-b border-slate-100 pb-2 mb-4">B. Alamat / Tempat Tinggal</h3>
        <p class="text-sm text-slate-700">{{ $ppdbRegistration->full_address ?: '-' }}</p>
    </div>

    {{-- C. Data Orang Tua --}}
    <div class="bg-white rounded-2xl border border-slate-100 p-6">
        <h3 class="text-sm font-bold text-navy-800 uppercase tracking-wide border-b border-slate-100 pb-2 mb-4">C. Data Orang Tua</h3>
        <div class="grid sm:grid-cols-2 gap-6 text-sm">
            <div>
                <p class="text-xs font-semibold text-slate-400 uppercase mb-2">Ayah</p>
                <dl class="space-y-2">
                    <div><dt class="text-slate-400">Nama</dt><dd class="text-slate-700">{{ $ppdbRegistration->father_name ?: '-' }}</dd></div>
                    <div><dt class="text-slate-400">Pekerjaan</dt><dd class="text-slate-700">{{ $ppdbRegistration->father_job ?: '-' }}</dd></div>
                    <div><dt class="text-slate-400">No. HP/WA</dt><dd class="text-slate-700">{{ $ppdbRegistration->father_phone ?: '-' }}</dd></div>
                </dl>
            </div>
            <div>
                <p class="text-xs font-semibold text-slate-400 uppercase mb-2">Ibu</p>
                <dl class="space-y-2">
                    <div><dt class="text-slate-400">Nama</dt><dd class="text-slate-700">{{ $ppdbRegistration->mother_name ?: '-' }}</dd></div>
                    <div><dt class="text-slate-400">Pekerjaan</dt><dd class="text-slate-700">{{ $ppdbRegistration->mother_job ?: '-' }}</dd></div>
                    <div><dt class="text-slate-400">No. HP/WA</dt><dd class="text-slate-700">{{ $ppdbRegistration->mother_phone ?: '-' }}</dd></div>
                </dl>
            </div>
        </div>
    </div>

    {{-- D. Data Wali --}}
    @if($ppdbRegistration->guardian_name || $ppdbRegistration->guardian_phone)
    <div class="bg-white rounded-2xl border border-slate-100 p-6">
        <h3 class="text-sm font-bold text-navy-800 uppercase tracking-wide border-b border-slate-100 pb-2 mb-4">D. Data Wali</h3>
        <dl class="grid sm:grid-cols-2 gap-x-8 gap-y-3 text-sm">
            <div><dt class="text-slate-400">Nama Wali</dt><dd class="text-slate-700">{{ $ppdbRegistration->guardian_name ?: '-' }}</dd></div>
            <div><dt class="text-slate-400">Hubungan</dt><dd class="text-slate-700">{{ $ppdbRegistration->guardian_relation ?: '-' }}</dd></div>
            <div><dt class="text-slate-400">Pekerjaan</dt><dd class="text-slate-700">{{ $ppdbRegistration->guardian_job ?: '-' }}</dd></div>
            <div><dt class="text-slate-400">No. HP/WA</dt><dd class="text-slate-700">{{ $ppdbRegistration->guardian_phone ?: '-' }}</dd></div>
            <div class="sm:col-span-2"><dt class="text-slate-400">Alamat Wali</dt><dd class="text-slate-700">{{ $ppdbRegistration->guardian_address ?: '-' }}</dd></div>
        </dl>
    </div>
    @endif

    {{-- E. Program & Gelombang --}}
    <div class="bg-white rounded-2xl border border-slate-100 p-6">
        <h3 class="text-sm font-bold text-navy-800 uppercase tracking-wide border-b border-slate-100 pb-2 mb-4">E. Pilihan Program Keahlian & Gelombang</h3>
        <dl class="grid sm:grid-cols-2 gap-x-8 gap-y-3 text-sm">
            <div><dt class="text-slate-400">Program Keahlian</dt><dd class="text-slate-700 font-medium">{{ $ppdbRegistration->program->name ?? '-' }}</dd></div>
            <div><dt class="text-slate-400">Gelombang</dt><dd class="text-slate-700 font-medium">{{ $ppdbRegistration->wave_label ?? '-' }}</dd></div>
        </dl>
    </div>

    {{-- F. Berkas --}}
    <div class="bg-white rounded-2xl border border-slate-100 p-6">
        <h3 class="text-sm font-bold text-navy-800 uppercase tracking-wide border-b border-slate-100 pb-2 mb-4">F. Berkas</h3>
        @if($ppdbRegistration->document_file)
            <a href="{{ asset('storage/' . $ppdbRegistration->document_file) }}" target="_blank" class="text-sky-600 font-medium text-sm">Lihat Berkas Terunggah</a>
        @else
            <p class="text-sm text-slate-400">Belum ada berkas diunggah.</p>
        @endif
    </div>

    <div class="pt-2">
        <form method="POST" action="{{ route('admin.ppdb.destroy', $ppdbRegistration) }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
            @csrf @method('DELETE')
            <button class="text-red-500 text-sm font-medium">Hapus Data Pendaftar</button>
        </form>
    </div>
</div>
@endsection
