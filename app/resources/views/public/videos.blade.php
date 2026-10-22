@extends('layouts.public')
@section('content')

<x-public.page-hero eyebrow="Video" title="Tonton momen dan aktivitas sekolah." description="Kumpulan video kegiatan SMK Infokom Bogor." />

<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-6 pb-28">
    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($videos as $i => $video)
            <div data-reveal data-reveal-delay="{{ min($i, 6) }}" class="rounded-[1.5rem] overflow-hidden border border-slate-200 hover:shadow-xl hover:shadow-navy-900/[0.06] transition-all duration-300 bg-white">
                <div class="aspect-video">
                    <iframe class="w-full h-full" src="{{ $video->embed_url }}" title="{{ $video->title }}" frameborder="0" allowfullscreen loading="lazy"></iframe>
                </div>
                <div class="p-6">
                    <p class="font-semibold text-navy-900">{{ $video->title }}</p>
                    @if($video->description)
                        <p class="text-sm text-slate-500 mt-1.5 line-clamp-2">{{ $video->description }}</p>
                    @endif
                </div>
            </div>
        @empty
            <p class="text-slate-400 text-sm col-span-3">Belum ada video.</p>
        @endforelse
    </div>

    <div class="mt-14">{{ $videos->links() }}</div>
</section>
@endsection
