@extends('layouts.student')
@section('title', 'Jadwal Pelajaran')
@section('content')
@if(!$student || !$student->class_id)
    <p class="text-slate-400 text-sm">Kelas Anda belum ditentukan. Hubungi admin untuk mengatur kelas.</p>
@else
    <div class="space-y-6">
        @forelse(['senin','selasa','rabu','kamis','jumat','sabtu'] as $day)
            @if(isset($schedules[$day]))
                <div class="bg-white rounded-2xl border border-slate-100 overflow-hidden">
                    <div class="px-5 py-3 bg-navy-50 font-semibold text-navy-800 capitalize">{{ $day }}</div>
                    <div class="divide-y divide-slate-100">
                        @foreach($schedules[$day] as $s)
                            <div class="px-5 py-3 flex justify-between items-center text-sm">
                                <div>
                                    <p class="font-medium text-slate-700">{{ $s->subject->name ?? '-' }}</p>
                                    <p class="text-xs text-slate-400">{{ $s->teacher->user->name ?? '-' }} @if($s->room) &bull; {{ $s->room }} @endif</p>
                                </div>
                                <p class="text-slate-500">{{ \Illuminate\Support\Carbon::parse($s->start_time)->format('H:i') }} - {{ \Illuminate\Support\Carbon::parse($s->end_time)->format('H:i') }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        @empty
        @endforelse
        @if($schedules->isEmpty())
            <p class="text-slate-400 text-sm">Jadwal untuk kelas Anda belum tersedia.</p>
        @endif
    </div>
@endif
@endsection
