@extends('layouts.admin')
@section('title', $subject->exists ? 'Edit Mata Pelajaran' : 'Tambah Mata Pelajaran')
@section('content')
<form method="POST" action="{{ $subject->exists ? route('admin.subjects.update', $subject) : route('admin.subjects.store') }}" class="bg-white rounded-2xl border border-slate-100 p-6 space-y-5 max-w-xl">
    @csrf
    @if($subject->exists) @method('PUT') @endif
    <div>
        <label class="block text-sm font-medium text-slate-600 mb-1.5">Nama Mata Pelajaran</label>
        <input type="text" name="name" value="{{ old('name', $subject->name) }}" required class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
    </div>
    <div class="grid sm:grid-cols-2 gap-5">
        <div>
            <label class="block text-sm font-medium text-slate-600 mb-1.5">Kode</label>
            <input type="text" name="code" value="{{ old('code', $subject->code) }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
        </div>
        <div>
            <label class="block text-sm font-medium text-slate-600 mb-1.5">Program Keahlian</label>
            <select name="program_id" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
                <option value="">Umum (semua program)</option>
                @foreach($programs as $p)
                    <option value="{{ $p->id }}" @selected(old('program_id', $subject->program_id) == $p->id)>{{ $p->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="flex gap-3 pt-2">
        <button type="submit" class="px-8 py-3 rounded-xl bg-navy-700 text-white font-semibold hover:bg-navy-800">Simpan</button>
        <a href="{{ route('admin.subjects.index') }}" class="px-8 py-3 rounded-xl border border-slate-200 text-slate-600 font-medium">Batal</a>
    </div>
</form>
@endsection
