@extends('layouts.admin')
@section('title', $student->exists ? 'Edit Siswa' : 'Tambah Siswa')
@section('content')

<x-admin.form-header :title="$student->exists ? 'Edit Siswa' : 'Tambah Siswa'" :back-route="route('admin.students.index')" />

<form method="POST" action="{{ $student->exists ? route('admin.students.update', $student) : route('admin.students.store') }}" class="bg-white rounded-2xl border border-slate-100 p-6 sm:p-8 space-y-5 max-w-xl animate-fade-in-up">
    @csrf
    @if($student->exists) @method('PUT') @endif
    <div>
        <label class="block text-sm font-semibold text-slate-700 mb-1.5">Nama Lengkap</label>
        <input type="text" name="name" value="{{ old('name', $student->user->name ?? '') }}" required class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
    </div>
    <div>
        <label class="block text-sm font-semibold text-slate-700 mb-1.5">Email</label>
        <input type="email" name="email" value="{{ old('email', $student->user->email ?? '') }}" required class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
    </div>
    @if(!$student->exists)
    <div>
        <label class="block text-sm font-semibold text-slate-700 mb-1.5">Password</label>
        <input type="password" name="password" required class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
    </div>
    <div>
        <label class="block text-sm font-semibold text-slate-700 mb-1.5">NISN</label>
        <input type="text" name="nisn" value="{{ old('nisn') }}" required class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
    </div>
    @endif
    <div>
        <label class="block text-sm font-semibold text-slate-700 mb-1.5">Kelas</label>
        <select name="class_id" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
            <option value="">-</option>
            @foreach($classes as $c)
                <option value="{{ $c->id }}" @selected(old('class_id', $student->class_id) == $c->id)>{{ $c->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="grid sm:grid-cols-2 gap-5">
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-1.5">No. HP</label>
            <input type="text" name="phone" value="{{ old('phone', $student->phone) }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
        </div>
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-1.5">Tanggal Lahir</label>
            <input type="date" name="birth_date" value="{{ old('birth_date', optional($student->birth_date)->format('Y-m-d')) }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
        </div>
    </div>
    <div>
        <label class="block text-sm font-semibold text-slate-700 mb-1.5">Alamat</label>
        <textarea name="address" rows="3" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">{{ old('address', $student->address) }}</textarea>
    </div>

    <x-admin.form-actions :cancel-route="route('admin.students.index')" />
</form>
@endsection
