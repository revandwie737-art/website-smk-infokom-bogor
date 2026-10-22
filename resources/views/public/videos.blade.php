@extends('layouts.public')
@section('content')
@php($set = fn($key, $default = null) => \App\Models\SchoolSetting::get($key, $default))
<section class="relative overflow-hidden bg-gradient-to-b from-navy-50 via-white to-white py-20">
    <div class="blob absolute -top-16 -right-16 w-72 h-72 rounded-full bg-violet-200/40 blur-3xl pointer-events-none"></div>
    <div class="blob-slow absolute bottom-0 -left-10 w-64 h-64 rounded-full bg-fuchsia-100/40 blur-3xl pointer-events-none"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
        <div class="text-center max-w-2xl mx-auto mb-14" data-aos="fade-up">
            <span class="inline-block px-4 py-1.5 rounded-full badge-shimmer text-navy-700 text-xs font-semibold mb-4">{{ $set('videos_badge', 'Video') }}</span>
            <h1 class="text-3xl md:text-4xl font-extrabold text-navy-900">{{ $set('videos_title', 'Video Kegiatan Sekolah') }}</h1>
            <p class="text-slate-500 mt-4">{{ $set('videos_subtitle', 'Tonton berbagai momen dan aktivitas seru di SMK Infokom Bogor.') }}</p>
        </div>

        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($videos as $i => $video)
                <div data-aos="zoom-in" data-aos-delay="{{ $i * 80 }}" class="tilt-hover rounded-2xl overflow-hidden border border-slate-900/15 hover:shadow-xl hover:shadow-navy-100 transition-all duration-300 bg-white">
                    <div class="aspect-video">
                        <iframe class="w-full h-full" src="{{ $video->embed_url }}" title="{{ $video->title }}" frameborder="0" allowfullscreen loading="lazy"></iframe>
                    </div>
                    <div class="p-5">
                        <p class="font-semibold text-navy-800">{{ $video->title }}</p>
                        @if($video->description)
                            <p class="text-sm text-slate-500 mt-1 line-clamp-2">{{ $video->description }}</p>
                        @endif
                    </div>
                </div>
            @empty
                <p class="text-slate-400 text-sm col-span-3">Belum ada video.</p>
            @endforelse
        </div>

        <div class="mt-12">{{ $videos->links() }}</div>
    </div>
</section>
@endsection