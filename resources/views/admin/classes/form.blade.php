@extends('layouts.admin')
@section('title', $schoolClass->exists ? 'Edit Kelas' : 'Tambah Kelas')
@section('content')
<form method="POST" action="{{ $schoolClass->exists ? route('admin.classes.update', $schoolClass) : route('admin.classes.store') }}" class="bg-white rounded-2xl border border-slate-100 p-6 space-y-5 max-w-xl">
    @csrf
    @if($schoolClass->exists) @method('PUT') @endif
    <div>
        <label class="block text-sm font-medium text-slate-600 mb-1.5">Nama Kelas</label>
        <input type="text" name="name" value="{{ old('name', $schoolClass->name) }}" required placeholder="cth: X RPL 1" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
    </div>
    <div class="grid sm:grid-cols-2 gap-5">
        <div>
            <label class="block text-sm font-medium text-slate-600 mb-1.5">Program Keahlian</label>
            <select name="program_id" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
                <option value="">-</option>
                @foreach($programs as $p)
                    <option value="{{ $p->id }}" @selected(old('program_id', $schoolClass->program_id) == $p->id)>{{ $p->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="block text-sm font-medium text-slate-600 mb-1.5">Tingkat</label>
            <select name="grade" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
                @foreach(['X','XI','XII'] as $g)
                    <option value="{{ $g }}" @selected(old('grade', $schoolClass->grade) === $g)>{{ $g }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div>
        <label class="block text-sm font-medium text-slate-600 mb-1.5">Wali Kelas</label>
        <select name="homeroom_teacher_id" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
            <option value="">-</option>
            @foreach($teachers as $t)
                <option value="{{ $t->id }}" @selected(old('homeroom_teacher_id', $schoolClass->homeroom_teacher_id) == $t->id)>{{ $t->user->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="flex gap-3 pt-2">
        <button type="submit" class="px-8 py-3 rounded-xl bg-navy-700 text-white font-semibold hover:bg-navy-800">Simpan</button>
        <a href="{{ route('admin.classes.index') }}" class="px-8 py-3 rounded-xl border border-slate-200 text-slate-600 font-medium">Batal</a>
    </div>
</form>
@endsection
