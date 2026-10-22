@extends('layouts.public')
@section('content')

<x-public.page-hero eyebrow="Fasilitas" title="Sarana belajar yang siap dipakai, bukan sekadar dipajang." description="Klik salah satu fasilitas untuk melihat detailnya." />

<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-6 pb-28" x-data="{ active: null }">
    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-5">
        @forelse($facilities as $i => $facility)
            <button type="button" @click="active = {{ $facility->id }}" data-cursor-hover data-reveal data-reveal-delay="{{ min($i, 6) }}"
                class="group text-left rounded-[1.5rem] bg-white border border-slate-200 overflow-hidden hover:border-navy-300 hover:shadow-xl hover:shadow-navy-900/[0.06] transition-all duration-300 {{ $i % 5 === 0 ? 'sm:col-span-2 sm:row-span-2' : '' }}">
                <div class="{{ $i % 5 === 0 ? 'aspect-[16/10]' : 'aspect-video' }} bg-navy-50 overflow-hidden relative">
                    @if($facility->photo)
                        <img src="{{ asset('storage/' . $facility->photo) }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-700" alt="{{ $facility->name }}">
                    @else
                        <div class="w-full h-full grid place-items-center text-navy-200"><svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 21h18M5 21V7l8-4v18M13 21V11l6 3v7M9 9v.01M9 12v.01M9 15v.01"/></svg></div>
                    @endif
                </div>
                <div class="p-6">
                    <p class="font-semibold text-navy-900">{{ $facility->name }}</p>
                    @if($facility->quantity)
                        <p class="text-xs text-sky-600 font-semibold mt-1">{{ $facility->quantity }} unit</p>
                    @endif
                </div>
            </button>
        @empty
            <p class="text-slate-400 text-sm col-span-3">Data belum tersedia.</p>
        @endforelse
    </div>

    @foreach($facilities as $facility)
        <div x-show="active === {{ $facility->id }}" x-cloak x-transition.opacity @click="active = null" class="fixed inset-0 bg-navy-900/60 backdrop-blur-sm z-50 grid place-items-center p-4 md:p-8">
            <div @click.stop x-show="active === {{ $facility->id }}" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                class="bg-white rounded-[2rem] max-w-2xl w-full overflow-hidden max-h-[85vh] overflow-y-auto">
                <div class="aspect-video bg-navy-50">
                    @if($facility->photo)
                        <img src="{{ asset('storage/' . $facility->photo) }}" class="w-full h-full object-cover" alt="{{ $facility->name }}">
                    @endif
                </div>
                <div class="p-8">
                    <div class="flex items-start justify-between gap-4">
                        <p class="font-display text-2xl text-navy-900">{{ $facility->name }}</p>
                        <button @click="active = null" data-cursor-hover class="h-9 w-9 rounded-full bg-slate-100 hover:bg-slate-200 grid place-items-center shrink-0 transition">
                            <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                        </button>
                    </div>
                    @if($facility->quantity)
                        <p class="text-sm text-sky-600 font-semibold mt-2">{{ $facility->quantity }} unit</p>
                    @endif
                    @if($facility->description)
                        <p class="text-slate-500 leading-relaxed mt-4">{{ $facility->description }}</p>
                    @endif
                </div>
            </div>
        </div>
    @endforeach
</section>
@endsection
