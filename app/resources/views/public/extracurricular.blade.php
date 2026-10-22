@extends('layouts.public')
@section('content')

<x-public.page-hero eyebrow="Ekstrakurikuler" title="Kembangkan minat dan bakatmu di luar kelas." description="Beragam kegiatan untuk mengasah soft skill dan passion siswa." />

<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-6 pb-28">
    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($items as $i => $item)
            <div data-reveal data-reveal-delay="{{ min($i, 6) }}" class="group rounded-[1.5rem] bg-white border border-slate-200 overflow-hidden hover:border-navy-300 hover:shadow-xl hover:shadow-navy-900/[0.06] hover:-translate-y-1 transition-all duration-300">
                <div class="aspect-video bg-navy-50 overflow-hidden">
                    @if($item->logo)
                        <img src="{{ asset('storage/' . $item->logo) }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500" alt="{{ $item->name }}">
                    @else
                        <div class="w-full h-full grid place-items-center text-navy-200"><svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/></svg></div>
                    @endif
                </div>
                <div class="p-6">
                    <p class="font-semibold text-navy-900">{{ $item->name }}</p>
                    <div class="flex items-center gap-3 mt-1.5 flex-wrap">
                        @if($item->coach)
                            <span class="text-xs text-slate-400">Pembina: {{ $item->coach }}</span>
                        @endif
                        @if($item->schedule)
                            <span class="text-xs text-sky-600 font-medium">{{ $item->schedule }}</span>
                        @endif
                    </div>
                    @if($item->description)
                        <p class="text-sm text-slate-500 mt-3 line-clamp-3 leading-relaxed">{{ $item->description }}</p>
                    @endif
                </div>
            </div>
        @empty
            <p class="text-slate-400 text-sm col-span-3">Data belum tersedia.</p>
        @endforelse
    </div>
</section>
@endsection
