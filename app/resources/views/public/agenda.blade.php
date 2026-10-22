@extends('layouts.public')
@section('content')

<x-public.page-hero eyebrow="Agenda" title="Jangan sampai ketinggalan acara sekolah." description="Kalender kegiatan dan acara penting di SMK Infokom Bogor." />

<section class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 -mt-6 pb-28">
    <div class="relative">
        <div class="absolute left-8 top-2 bottom-2 w-px bg-navy-100 hidden sm:block"></div>
        <div class="space-y-5">
            @forelse($events as $i => $event)
                <div data-reveal="left" data-reveal-delay="{{ min($i, 6) }}" class="group relative flex gap-5 p-5 sm:p-6 rounded-[1.5rem] bg-white border border-slate-200 hover:border-navy-300 hover:shadow-xl hover:shadow-navy-900/[0.06] transition-all duration-300">
                    <div class="shrink-0 w-16 h-16 rounded-2xl bg-navy-900 text-white grid place-items-center text-center relative z-10 shadow-md shadow-navy-900/15 group-hover:scale-105 transition-transform">
                        <div>
                            <p class="text-lg font-bold leading-none">{{ $event->event_date->format('d') }}</p>
                            <p class="text-[10px] uppercase mt-1">{{ $event->event_date->translatedFormat('M') }}</p>
                        </div>
                    </div>
                    <div>
                        <p class="font-semibold text-navy-900">{{ $event->title }}</p>
                        <p class="text-xs text-slate-400 mt-1.5 flex flex-wrap gap-x-2">
                            <span>{{ $event->event_date->translatedFormat('d F Y') }}</span>
                            @if($event->event_time) <span>&bull; {{ \Illuminate\Support\Carbon::parse($event->event_time)->format('H:i') }} WIB</span> @endif
                            @if($event->location) <span>&bull; {{ $event->location }}</span> @endif
                        </p>
                        @if($event->description)
                            <p class="text-sm text-slate-500 mt-2.5 leading-relaxed">{{ $event->description }}</p>
                        @endif
                    </div>
                </div>
            @empty
                <p class="text-slate-400 text-sm text-center py-10">Belum ada agenda mendatang.</p>
            @endforelse
        </div>
    </div>
</section>
@endsection
