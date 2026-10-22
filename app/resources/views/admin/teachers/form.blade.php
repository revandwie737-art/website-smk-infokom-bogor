@extends('layouts.admin')
@section('title', $teacher->exists ? 'Edit Guru' : 'Tambah Guru')
@section('content')

<x-admin.form-header :title="$teacher->exists ? 'Edit Guru' : 'Tambah Guru'" :back-route="route('admin.teachers.index')" />

<form method="POST" action="{{ $teacher->exists ? route('admin.teachers.update', $teacher) : route('admin.teachers.store') }}" enctype="multipart/form-data" class="bg-white rounded-2xl border border-slate-100 p-6 sm:p-8 space-y-5 max-w-xl animate-fade-in-up">
    @csrf
    @if($teacher->exists) @method('PUT') @endif
    <div>
        <label class="block text-sm font-semibold text-slate-700 mb-1.5">Nama Lengkap</label>
        <input type="text" name="name" value="{{ old('name', $teacher->user->name ?? '') }}" required class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
    </div>
    <div>
        <label class="block text-sm font-semibold text-slate-700 mb-1.5">Email</label>
        <input type="email" name="email" value="{{ old('email', $teacher->user->email ?? '') }}" required class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
    </div>
    @if(!$teacher->exists)
    <div>
        <label class="block text-sm font-semibold text-slate-700 mb-1.5">Password</label>
        <input type="password" name="password" required class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
    </div>
    @endif
    <div class="grid sm:grid-cols-2 gap-5">
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-1.5">NIP</label>
            <input type="text" name="nip" value="{{ old('nip', $teacher->nip) }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
        </div>
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-1.5">Jabatan</label>
            <input type="text" name="position" value="{{ old('position', $teacher->position) }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
        </div>
    </div>
    <div>
        <label class="block text-sm font-semibold text-slate-700 mb-1.5">No. HP</label>
        <input type="text" name="phone" value="{{ old('phone', $teacher->phone) }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
    </div>
    <div>
        <label class="block text-sm font-semibold text-slate-700 mb-1.5">Mata Pelajaran yang Diajar</label>
        <textarea name="subjects" rows="3" placeholder="Satu mata pelajaran per baris, cth:&#10;Matematika&#10;Fisika" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">{{ old('subjects', $teacher->subjects) }}</textarea>
        <p class="text-xs text-slate-400 mt-1">Tulis satu mata pelajaran per baris jika lebih dari satu.</p>
    </div>
    <div>
        <label class="block text-sm font-semibold text-slate-700 mb-1.5">Foto</label>
        @if($teacher->photo) <img src="{{ asset('storage/' . $teacher->photo) }}" class="h-20 rounded-xl mb-2 ring-1 ring-slate-100"> @endif
        <input type="file" name="photo" class="w-full text-sm file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:bg-slate-100 file:text-slate-600 file:font-medium hover:file:bg-slate-200 transition">
    </div>

    <x-admin.form-actions :cancel-route="route('admin.teachers.index')" />
</form>
@endsection
