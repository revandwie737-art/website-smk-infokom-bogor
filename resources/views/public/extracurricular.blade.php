@extends('layouts.public')
@section('content')
@php($set = fn($key, $default = null) => \App\Models\SchoolSetting::get($key, $default))
<section class="relative overflow-hidden bg-gradient-to-b from-navy-50 via-white to-white py-20">
    <div class="blob absolute -top-16 -left-16 w-72 h-72 rounded-full bg-rose-200/40 blur-3xl pointer-events-none"></div>
    <div class="blob-slow absolute bottom-0 -right-10 w-64 h-64 rounded-full bg-pink-100/40 blur-3xl pointer-events-none"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
        <div class="text-center max-w-2xl mx-auto mb-14" data-aos="fade-up">
            <span class="inline-block px-4 py-1.5 rounded-full badge-shimmer text-navy-700 text-xs font-semibold mb-4">{{ $set('extracurricular_badge', 'Ekstrakurikuler') }}</span>
            <h1 class="text-3xl md:text-4xl font-extrabold text-navy-900">{{ $set('extracurricular_title', 'Ekstrakurikuler SMK Infokom Bogor') }}</h1>
            <p class="text-slate-500 mt-4">{{ $set('extracurricular_subtitle', 'Kembangkan minat dan bakatmu lewat berbagai kegiatan ekstrakurikuler.') }}</p>
        </div>

        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-5">
            @forelse($items as $i => $item)
                <div x-data="{ open: false }" data-aos="fade-up" data-aos-delay="{{ $i * 60 }}" @click="open = !open"
                    class="tilt-hover cursor-pointer rounded-2xl bg-white border border-slate-900/15 overflow-hidden hover:shadow-xl hover:shadow-rose-100 transition-all duration-300 p-6">
                    <div class="flex items-start gap-4">
                        @if($item->logo)
                            <img src="{{ asset('storage/' . $item->logo) }}" class="h-14 w-20 rounded-xl object-cover shrink-0" alt="{{ $item->name }}">
                        @else
                            <div class="h-14 w-14 rounded-2xl bg-gradient-to-br from-rose-400 to-navy-700 text-white grid place-items-center text-xl font-bold shrink-0">
                                {{ mb_substr($item->name, 0, 1) }}
                            </div>
                        @endif
                        <div class="min-w-0">
                            <p class="font-semibold text-navy-800">{{ $item->name }}</p>
                            @if($item->coach)
                                <p class="text-xs text-slate-400 mt-1">Pembina: {{ $item->coach }}</p>
                            @endif
                            @if($item->schedule)
                                <p class="text-xs text-sky-600 font-medium mt-1">{{ $item->schedule }}</p>
                            @endif
                        </div>
                    </div>
                    @if($item->description)
                        <p class="text-sm text-slate-500 mt-4 leading-relaxed" x-show="open" x-transition x-cloak>{{ $item->description }}</p>
                        <p class="text-xs text-rose-500 font-semibold mt-3" x-text="open ? 'Tutup' : 'Lihat detail'"></p>
                    @endif
                </div>
            @empty
                <p class="text-slate-400 text-sm col-span-3">Data belum tersedia.</p>
            @endforelse
        </div>
    </div>
</section>
@endsection