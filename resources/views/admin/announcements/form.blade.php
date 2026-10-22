@extends('layouts.admin')
@section('title', $announcement->exists ? 'Edit Pengumuman' : 'Tambah Pengumuman')
@section('content')
<form method="POST" action="{{ $announcement->exists ? route('admin.announcements.update', $announcement) : route('admin.announcements.store') }}" class="bg-white rounded-2xl border border-slate-100 p-6 space-y-5 max-w-2xl">
    @csrf
    @if($announcement->exists) @method('PUT') @endif
    <div>
        <label class="block text-sm font-medium text-slate-600 mb-1.5">Judul</label>
        <input type="text" name="title" value="{{ old('title', $announcement->title) }}" required class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
    </div>
    <div>
        <label class="block text-sm font-medium text-slate-600 mb-1.5">Isi Pengumuman</label>
        <textarea name="content" rows="5" required class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">{{ old('content', $announcement->content) }}</textarea>
    </div>
    <div class="grid sm:grid-cols-2 gap-5">
        <div>
            <label class="block text-sm font-medium text-slate-600 mb-1.5">Prioritas</label>
            <select name="priority" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
                @foreach(['low'=>'Rendah','normal'=>'Normal','high'=>'Tinggi'] as $val => $label)
                    <option value="{{ $val }}" @selected(old('priority', $announcement->priority) === $val)>{{ $label }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="block text-sm font-medium text-slate-600 mb-1.5">Tanggal Kadaluarsa (opsional)</label>
            <input type="date" name="expires_at" value="{{ old('expires_at', optional($announcement->expires_at)->format('Y-m-d')) }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
        </div>
    </div>
    <label class="flex items-center gap-3">
        <input type="hidden" name="is_active" value="0">
        <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $announcement->is_active ?? true)) class="rounded border-slate-300">
        <span class="text-sm text-slate-600">Aktif / Tampilkan</span>
    </label>
    <div class="flex gap-3 pt-2">
        <button type="submit" class="px-8 py-3 rounded-xl bg-navy-700 text-white font-semibold hover:bg-navy-800">Simpan</button>
        <a href="{{ route('admin.announcements.index') }}" class="px-8 py-3 rounded-xl border border-slate-200 text-slate-600 font-medium">Batal</a>
    </div>
</form>
@endsection
