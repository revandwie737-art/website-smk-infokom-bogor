@extends('layouts.admin')
@section('title', $member->exists ? 'Edit Anggota Kelas' : 'Tambah Anggota Kelas')
@section('content')

<x-admin.form-header :title="$member->exists ? 'Edit Anggota Kelas' : 'Tambah Anggota Kelas'" :back-route="route('admin.class-members.index', ['class_id' => $classId])" />

<form method="POST" action="{{ $member->exists ? route('admin.class-members.update', $member) : route('admin.class-members.store') }}" enctype="multipart/form-data" class="bg-white rounded-2xl border border-slate-100 p-6 sm:p-8 space-y-5 max-w-xl animate-fade-in-up">
    @csrf
    @if($member->exists) @method('PUT') @endif
    <div>
        <label class="block text-sm font-semibold text-slate-700 mb-1.5">Kelas</label>
        <select name="class_id" required class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
            @foreach($classes as $c)
                <option value="{{ $c->id }}" @selected(old('class_id', $member->class_id ?? $classId) == $c->id)>{{ $c->name }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label class="block text-sm font-semibold text-slate-700 mb-1.5">Nama</label>
        <input type="text" name="name" value="{{ old('name', $member->name) }}" required class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
    </div>
    <div>
        <label class="block text-sm font-semibold text-slate-700 mb-1.5">Peran</label>
        <input type="text" name="role" value="{{ old('role', $member->role ?? 'Anggota') }}" placeholder="cth: Ketua Kelas, Sekretaris, Bendahara, Anggota" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
    </div>
    <div>
        <label class="block text-sm font-semibold text-slate-700 mb-1.5">Foto (opsional)</label>
        @if($member->photo) <img src="{{ asset('storage/' . $member->photo) }}" class="h-20 rounded-xl mb-2 ring-1 ring-slate-100"> @endif
        <input type="file" name="photo" class="w-full text-sm file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:bg-slate-100 file:text-slate-600 file:font-medium hover:file:bg-slate-200 transition">
    </div>
    <div>
        <label class="block text-sm font-semibold text-slate-700 mb-1.5">Urutan Tampil</label>
        <input type="number" name="sort_order" value="{{ old('sort_order', $member->sort_order ?? 0) }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
    </div>

    <x-admin.form-actions :cancel-route="route('admin.class-members.index', ['class_id' => $classId])" />
</form>
@endsection
