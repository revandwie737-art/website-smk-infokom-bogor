@extends('layouts.student')
@section('title', 'Teman Sekelas')
@section('content')
@if(!$student || !$student->class_id)
    <p class="text-slate-400 text-sm">Kelas Anda belum ditentukan. Hubungi admin untuk mengatur kelas.</p>
@else
    <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-5">
        @forelse($members as $member)
            <div class="bg-white rounded-2xl border border-slate-100 overflow-hidden">
                <div class="aspect-square bg-navy-50 overflow-hidden">
                    @if($member->photo)
                        <img src="{{ asset('storage/' . $member->photo) }}" class="w-full h-full object-contain" alt="{{ $member->name }}">
                    @else
                        <div class="w-full h-full grid place-items-center text-navy-200 text-3xl">👤</div>
                    @endif
                </div>
                <div class="p-4 text-center">
                    <p class="font-semibold text-slate-700 text-sm">{{ $member->name }}</p>
                    <p class="text-xs text-slate-400 mt-1">{{ $member->role }}</p>
                </div>
            </div>
        @empty
            <p class="text-slate-400 text-sm col-span-4">Data teman sekelas belum tersedia.</p>
        @endforelse
    </div>
@endif
@endsection
