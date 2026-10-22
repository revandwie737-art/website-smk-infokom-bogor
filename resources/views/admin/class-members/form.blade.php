@extends('layouts.admin')
@section('title', $member->exists ? 'Edit Anggota Kelas' : 'Tambah Anggota Kelas')
@section('content')
<form method="POST" action="{{ $member->exists ? route('admin.class-members.update', $member) : route('admin.class-members.store') }}" enctype="multipart/form-data" class="bg-white rounded-2xl border border-slate-100 p-6 space-y-5 max-w-xl">
    @csrf
    @if($member->exists) @method('PUT') @endif
    <div>
        <label class="block text-sm font-medium text-slate-600 mb-1.5">Kelas</label>
        <select name="class_id" required class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
            @foreach($classes as $c)
                <option value="{{ $c->id }}" @selected(old('class_id', $member->class_id ?? $classId) == $c->id)>{{ $c->name }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label class="block text-sm font-medium text-slate-600 mb-1.5">Nama</label>
        <input type="text" name="name" value="{{ old('name', $member->name) }}" required class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
    </div>
    <div>
        <label class="block text-sm font-medium text-slate-600 mb-1.5">Peran</label>
        <input type="text" name="role" value="{{ old('role', $member->role ?? 'Anggota') }}" placeholder="cth: Ketua Kelas, Sekretaris, Bendahara, Anggota" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
    </div>
    <div>
        <label class="block text-sm font-medium text-slate-600 mb-1.5">Foto (opsional)</label>
        @if($member->photo) <img src="{{ asset('storage/' . $member->photo) }}" class="h-20 rounded-xl mb-2"> @endif
        <input type="file" name="photo" class="w-full text-sm">
    </div>
    <div>
        <label class="block text-sm font-medium text-slate-600 mb-1.5">Urutan Tampil</label>
        <input type="number" name="sort_order" value="{{ old('sort_order', $member->sort_order ?? 0) }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
    </div>
    <div class="flex gap-3 pt-2">
        <button type="submit" class="px-8 py-3 rounded-xl bg-navy-700 text-white font-semibold hover:bg-navy-800">Simpan</button>
        <a href="{{ route('admin.class-members.index', ['class_id' => $classId]) }}" class="px-8 py-3 rounded-xl border border-slate-200 text-slate-600 font-medium">Batal</a>
    </div>
</form>
@endsection
