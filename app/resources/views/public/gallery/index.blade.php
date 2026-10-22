@extends('layouts.public')
@section('content')

<x-public.page-hero eyebrow="Galeri" title="Momen-momen berharga di sekolah." description="Dokumentasi kegiatan, acara, dan keseharian siswa SMK Infokom Bogor." />

<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-6 pb-28">
    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($galleries as $i => $gallery)
            <a href="{{ route('gallery.show', $gallery->slug) }}" data-cursor-hover data-reveal="scale" data-reveal-delay="{{ min($i, 6) }}"
                class="group block rounded-[1.5rem] overflow-hidden border border-slate-200 bg-white hover:border-navy-300 hover:shadow-xl hover:shadow-navy-900/[0.06] transition-all duration-300">
                <div class="aspect-video bg-navy-50 overflow-hidden">
                    @if($gallery->cover)
                        <img src="{{ asset('storage/' . $gallery->cover) }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500" alt="{{ $gallery->title }}">
                    @else
                        <div class="w-full h-full grid place-items-center text-navy-200"><svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14M4 8h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg></div>
                    @endif
                </div>
                <div class="p-6">
                    <p class="font-semibold text-navy-900 group-hover:text-sky-600 transition">{{ $gallery->title }}</p>
                    @if($gallery->event_date)
                        <p class="text-xs text-slate-400 mt-1.5">{{ $gallery->event_date->translatedFormat('d F Y') }}</p>
                    @endif
                </div>
            </a>
        @empty
            <p class="text-slate-400 text-sm col-span-3">Belum ada album galeri.</p>
        @endforelse
    </div>

    <div class="mt-14">{{ $galleries->links() }}</div>
</section>
@endsection
