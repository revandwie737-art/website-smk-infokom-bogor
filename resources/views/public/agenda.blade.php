@extends('layouts.public')
@section('content')
@php($set = fn($key, $default = null) => \App\Models\SchoolSetting::get($key, $default))
<section class="relative overflow-hidden bg-gradient-to-b from-navy-50 via-white to-white py-20">
    <div class="blob absolute -top-16 -left-16 w-72 h-72 rounded-full bg-amber-200/40 blur-3xl pointer-events-none"></div>
    <div class="blob-slow absolute bottom-0 -right-10 w-64 h-64 rounded-full bg-orange-100/40 blur-3xl pointer-events-none"></div>
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative">
        <div class="text-center max-w-2xl mx-auto mb-14" data-aos="fade-up">
            <span class="inline-block px-4 py-1.5 rounded-full badge-shimmer text-navy-700 text-xs font-semibold mb-4">{{ $set('agenda_badge', 'Agenda') }}</span>
            <h1 class="text-3xl md:text-4xl font-extrabold text-navy-900">{{ $set('agenda_title', 'Agenda Sekolah') }}</h1>
            <p class="text-slate-500 mt-4">{{ $set('agenda_subtitle', 'Jangan sampai ketinggalan kegiatan dan acara penting di SMK Infokom Bogor.') }}</p>
        </div>

        <div class="journey-track pl-2">
            <div class="journey-line" style="left: 35px;"><div class="journey-line-fill"></div></div>
            <div class="space-y-4">
                @forelse($events as $i => $event)
                    <div data-aos="fade-up" data-aos-delay="{{ $i * 70 }}" class="journey-step relative z-10">
                        <div class="hover-lift flex gap-5 p-5 sm:p-6 rounded-2xl bg-white border border-slate-900/15 hover:shadow-xl hover:shadow-navy-100 transition-all duration-300">
                            <div class="journey-node shrink-0 w-16 h-16 rounded-2xl bg-navy-700 text-white grid place-items-center text-center shadow-md shadow-navy-200">
                                <div>
                                    <p class="text-lg font-bold leading-none">{{ $event->event_date->format('d') }}</p>
                                    <p class="text-[10px] uppercase mt-1">{{ $event->event_date->translatedFormat('M') }}</p>
                                </div>
                            </div>
                            <div class="flex-1">
                                <p class="font-semibold text-navy-800">{{ $event->title }}</p>
                                <p class="text-xs text-slate-400 mt-1 flex flex-wrap gap-x-2">
                                    <span>{{ $event->event_date->translatedFormat('d F Y') }}</span>
                                    @if($event->event_time) <span>&bull; {{ \Illuminate\Support\Carbon::parse($event->event_time)->format('H:i') }} WIB</span> @endif
                                    @if($event->location) <span>&bull; {{ $event->location }}</span> @endif
                                </p>
                                @if($event->description)
                                    <div class="journey-detail">
                                        <p class="text-sm text-slate-500 mt-2">{{ $event->description }}</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-slate-400 text-sm text-center">Belum ada agenda mendatang.</p>
                @endforelse
            </div>
        </div>
    </div>
</section>
@endsection