@extends('layouts.admin')
@section('title', $schedule->exists ? 'Edit Jadwal' : 'Tambah Jadwal')
@section('content')

<x-admin.form-header :title="$schedule->exists ? 'Edit Jadwal' : 'Tambah Jadwal'" :back-route="route('admin.schedules.index')" />

<form method="POST" action="{{ $schedule->exists ? route('admin.schedules.update', $schedule) : route('admin.schedules.store') }}" class="bg-white rounded-2xl border border-slate-100 p-6 sm:p-8 space-y-5 max-w-xl animate-fade-in-up">
    @csrf
    @if($schedule->exists) @method('PUT') @endif
    <div>
        <label class="block text-sm font-semibold text-slate-700 mb-1.5">Kelas</label>
        <select name="class_id" required class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
            @foreach($classes as $c)
                <option value="{{ $c->id }}" @selected(old('class_id', $schedule->class_id) == $c->id)>{{ $c->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="grid sm:grid-cols-2 gap-5">
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-1.5">Mata Pelajaran</label>
            <select name="subject_id" required class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
                @foreach($subjects as $s)
                    <option value="{{ $s->id }}" @selected(old('subject_id', $schedule->subject_id) == $s->id)>{{ $s->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-1.5">Guru</label>
            <select name="teacher_id" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
                <option value="">-</option>
                @foreach($teachers as $t)
                    <option value="{{ $t->id }}" @selected(old('teacher_id', $schedule->teacher_id) == $t->id)>{{ $t->user->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="grid sm:grid-cols-3 gap-5">
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-1.5">Hari</label>
            <select name="day" required class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
                @foreach(['senin','selasa','rabu','kamis','jumat','sabtu'] as $d)
                    <option value="{{ $d }}" @selected(old('day', $schedule->day) === $d)>{{ ucfirst($d) }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-1.5">Mulai</label>
            <input type="time" name="start_time" value="{{ old('start_time', $schedule->start_time) }}" required class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
        </div>
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-1.5">Selesai</label>
            <input type="time" name="end_time" value="{{ old('end_time', $schedule->end_time) }}" required class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
        </div>
    </div>
    <div>
        <label class="block text-sm font-semibold text-slate-700 mb-1.5">Ruang</label>
        <input type="text" name="room" value="{{ old('room', $schedule->room) }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
    </div>

    <x-admin.form-actions :cancel-route="route('admin.schedules.index')" />
</form>
@endsection
