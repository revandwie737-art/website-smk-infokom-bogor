@extends('layouts.admin')
@section('title', $event->exists ? 'Edit Agenda' : 'Tambah Agenda')
@section('content')

<x-admin.form-header :title="$event->exists ? 'Edit Agenda' : 'Tambah Agenda'" :back-route="route('admin.events.index')" />

<form method="POST" action="{{ $event->exists ? route('admin.events.update', $event) : route('admin.events.store') }}" class="bg-white rounded-2xl border border-slate-100 p-6 sm:p-8 space-y-5 max-w-2xl animate-fade-in-up">
    @csrf
    @if($event->exists) @method('PUT') @endif
    <div>
        <label class="block text-sm font-semibold text-slate-700 mb-1.5">Nama Acara</label>
        <input type="text" name="title" value="{{ old('title', $event->title) }}" required class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
    </div>
    <div>
        <label class="block text-sm font-semibold text-slate-700 mb-1.5">Kategori</label>
        <select name="category" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
            <option value="umum" @selected(old('category', $event->category ?? 'umum') === 'umum')>Agenda Umum Sekolah</option>
            <option value="bkk" @selected(old('category', $event->category ?? 'umum') === 'bkk')>Agenda BKK (Bursa Kerja Khusus)</option>
        </select>
    </div>
    <div class="grid sm:grid-cols-2 gap-5">
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-1.5">Tanggal</label>
            <input type="date" name="event_date" value="{{ old('event_date', optional($event->event_date)->format('Y-m-d')) }}" required class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
        </div>
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-1.5">Waktu</label>
            <input type="time" name="event_time" value="{{ old('event_time', $event->event_time) }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
        </div>
    </div>
    <div>
        <label class="block text-sm font-semibold text-slate-700 mb-1.5">Lokasi</label>
        <input type="text" name="location" value="{{ old('location', $event->location) }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
    </div>
    <div>
        <label class="block text-sm font-semibold text-slate-700 mb-1.5">Deskripsi</label>
        <textarea name="description" rows="3" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">{{ old('description', $event->description) }}</textarea>
    </div>

    <x-admin.form-actions :cancel-route="route('admin.events.index')" />
</form>
@endsection
