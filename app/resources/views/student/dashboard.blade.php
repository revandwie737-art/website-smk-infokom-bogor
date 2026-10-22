@extends('layouts.student')
@section('title', 'Dashboard')
@section('content')

<div class="bg-navy-900 text-white rounded-2xl p-6 mb-6">
    <p class="text-slate-300 text-sm">Selamat datang,</p>
    <p class="text-xl font-bold">{{ auth()->user()->name }}</p>
    @if($student && $student->schoolClass)
        <p class="text-sm text-slate-400 mt-1">{{ $student->schoolClass->name }} &bull; NISN {{ $student->nisn }}</p>
    @endif
</div>

<div class="grid sm:grid-cols-3 gap-5 mb-6">
    <div class="bg-white rounded-2xl border border-slate-100 p-6">
        <p class="text-3xl font-extrabold text-slate-800">{{ $attendancePercentage }}%</p>
        <p class="text-sm text-slate-400 mt-1">Persentase Kehadiran</p>
    </div>
    <div class="bg-white rounded-2xl border border-slate-100 p-6">
        <p class="text-3xl font-extrabold text-slate-800">{{ $todaySchedule->count() }}</p>
        <p class="text-sm text-slate-400 mt-1">Jadwal Hari Ini</p>
    </div>
    <div class="bg-white rounded-2xl border border-slate-100 p-6">
        <p class="text-3xl font-extrabold text-slate-800">{{ $recentGrades->count() }}</p>
        <p class="text-sm text-slate-400 mt-1">Nilai Terbaru</p>
    </div>
</div>

<div class="grid lg:grid-cols-2 gap-6">
    <div class="bg-white rounded-2xl border border-slate-100 p-6">
        <p class="font-semibold text-slate-800 mb-4">Jadwal Hari Ini</p>
        <div class="divide-y divide-slate-100">
            @forelse($todaySchedule as $s)
                <div class="py-3 flex justify-between text-sm">
                    <div>
                        <p class="font-medium text-slate-700">{{ $s->subject->name ?? '-' }}</p>
                        <p class="text-xs text-slate-400">{{ $s->teacher->user->name ?? '-' }}</p>
                    </div>
                    <p class="text-slate-500">{{ \Illuminate\Support\Carbon::parse($s->start_time)->format('H:i') }} - {{ \Illuminate\Support\Carbon::parse($s->end_time)->format('H:i') }}</p>
                </div>
            @empty
                <p class="text-sm text-slate-400 py-3">Tidak ada jadwal hari ini.</p>
            @endforelse
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-slate-100 p-6">
        <p class="font-semibold text-slate-800 mb-4">Pengumuman Terbaru</p>
        <div class="divide-y divide-slate-100">
            @forelse($announcements as $a)
                <div class="py-3">
                    <p class="text-sm font-medium text-slate-700">{{ $a->title }}</p>
                    <p class="text-xs text-slate-400 mt-1">{{ $a->created_at->diffForHumans() }}</p>
                </div>
            @empty
                <p class="text-sm text-slate-400 py-3">Belum ada pengumuman.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
