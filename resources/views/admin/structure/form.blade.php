@extends('layouts.admin')
@section('title', $member->exists ? 'Edit Anggota Struktur' : 'Tambah Anggota Struktur')
@section('content')
<form method="POST" action="{{ $member->exists ? route('admin.structure.update', $member) : route('admin.structure.store') }}" class="bg-white rounded-2xl border border-slate-100 p-6 space-y-5 max-w-xl" x-data>
    @csrf
    @if($member->exists) @method('PUT') @endif

    <div>
        <label class="block text-sm font-medium text-slate-600 mb-1.5">Kelompok</label>
        <select name="section" x-on:change="$refs.groupLabelWrap.style.display = $event.target.value === 'staff' ? 'block' : 'none'" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
            @foreach(\App\Models\StructureMember::SECTIONS as $key => $label)
                <option value="{{ $key }}" @selected(old('section', $member->section) === $key)>{{ $label }}</option>
            @endforeach
        </select>
        <p class="text-xs text-slate-400 mt-1">Pilih "Staf / Guru Lain" untuk kelompok bebas seperti Pembina OSIS, Staf Tata Usaha, dsb.</p>
    </div>

    <div x-ref="groupLabelWrap" style="display: {{ old('section', $member->section) === 'staff' ? 'block' : 'none' }}">
        <label class="block text-sm font-medium text-slate-600 mb-1.5">Judul Kelompok</label>
        <input type="text" name="group_label" value="{{ old('group_label', $member->group_label) }}" placeholder="cth: Pembina OSIS" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
    </div>

    <div>
        <label class="block text-sm font-medium text-slate-600 mb-1.5">Nama</label>
        <input type="text" name="name" required value="{{ old('name', $member->name) }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
    </div>

    <div>
        <label class="block text-sm font-medium text-slate-600 mb-1.5">Jabatan (opsional untuk kelompok Staf)</label>
        <input type="text" name="role" value="{{ old('role', $member->role) }}" placeholder="cth: Bidang Kurikulum" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
    </div>

    <div>
        <label class="block text-sm font-medium text-slate-600 mb-1.5">Urutan Tampil</label>
        <input type="number" name="sort_order" value="{{ old('sort_order', $member->sort_order ?? 0) }}" class="w-32 px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
        <p class="text-xs text-slate-400 mt-1">Angka lebih kecil tampil lebih dulu.</p>
    </div>

    <div class="flex gap-3 pt-2">
        <button type="submit" class="px-6 py-2.5 rounded-xl bg-navy-700 text-white text-sm font-semibold hover:bg-navy-800">Simpan</button>
        <a href="{{ route('admin.structure.index') }}" class="px-6 py-2.5 rounded-xl border border-slate-200 text-sm font-semibold text-slate-600">Batal</a>
    </div>
</form>
@endsection