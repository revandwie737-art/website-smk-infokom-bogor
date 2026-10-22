@extends('layouts.public')
@section('content')
@php($set = fn($key, $default = null) => \App\Models\SchoolSetting::get($key, $default))
<section class="relative overflow-hidden bg-gradient-to-b from-navy-50 via-white to-white py-20">
    <div class="blob absolute -top-20 -right-20 w-96 h-96 rounded-full bg-sky-200/40 blur-3xl pointer-events-none"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
        <div class="text-center max-w-2xl mx-auto mb-12" data-aos="fade-up">
            <span class="text-sky-600 font-semibold text-sm">{{ $set('achievements_badge', 'Prestasi') }}</span>
            <h1 class="text-3xl md:text-4xl font-extrabold text-navy-900 mt-2">{{ $set('achievements_title', 'Prestasi Siswa SMK Infokom Bogor') }}</h1>
            <p class="text-slate-500 mt-4">{{ $set('achievements_subtitle', 'Deretan pencapaian membanggakan siswa-siswi kami di berbagai bidang dan tingkat kompetisi.') }}</p>
        </div>

        <form method="GET" class="flex flex-wrap gap-2 justify-center mb-12" data-aos="fade-up">
            @php($cats = ['' => 'Semua', 'akademik' => 'Akademik', 'olahraga' => 'Olahraga', 'seni' => 'Seni', 'teknologi' => 'Teknologi', 'lainnya' => 'Lainnya'])
            @foreach($cats as $val => $label)
                <a href="{{ request()->fullUrlWithQuery(['category' => $val ?: null]) }}"
                    class="ripple-btn px-4 py-2 rounded-full text-sm font-medium transition {{ request('category', '') == $val ? 'bg-navy-700 text-white shadow-md shadow-navy-200' : 'bg-white text-slate-600 border border-slate-900/15 hover:bg-slate-50' }}">
                    {{ $label }}
                </a>
            @endforeach
        </form>
    </div>

    @if($achievements->count())
        <div class="marquee-container mb-6" data-aos="fade-up">
            <div class="marquee-track gap-6 px-4">
                @foreach($achievements->getCollection()->concat($achievements->getCollection()) as $ach)
                    <div class="shrink-0 w-72 rounded-2xl border border-slate-900/15 overflow-hidden hover:shadow-xl transition bg-white">
                        <x-media-frame
                            ratio="aspect-video"
                            :src="$ach->photo ? asset('storage/' . $ach->photo) : null"
                            fit="cover"
                            icon="🏆"
                            :alt="$ach->title"
                            img-class=""
                        />
                        <div class="p-5">
                            <span class="text-xs font-semibold text-sky-600 uppercase">{{ str_replace('_', ' ', $ach->level) }}</span>
                            <p class="font-semibold text-navy-800 mt-2 line-clamp-2">{{ $ach->title }}</p>
                            @if($ach->student_name)
                                <p class="text-sm text-slate-500 mt-1">{{ $ach->student_name }}</p>
                            @endif
                            <div class="flex items-center justify-between mt-2">
                                <p class="text-xs text-slate-400">{{ $ach->year }}</p>
                                @if($ach->link)
                                    <a href="{{ $ach->link }}" target="_blank" rel="noopener" class="text-xs font-semibold text-navy-700 hover:text-navy-900">Lihat &rarr;</a>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</section>

<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-20">
    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($achievements as $i => $ach)
            <div data-aos="zoom-in" data-aos-delay="{{ $i * 80 }}" class="tilt-3d relative rounded-2xl overflow-hidden border border-slate-900/15 aspect-[4/3]" data-tilt-strength="8" data-tilt-scale="1.04">
                <div class="reveal-mask absolute inset-0 bg-navy-50">
                    @if($ach->photo)
                        <img src="{{ asset('storage/' . $ach->photo) }}" class="reveal-img w-full h-full object-cover" alt="{{ $ach->title }}">
                    @else
                        <div class="w-full h-full grid place-items-center text-navy-200 text-3xl">🏆</div>
                    @endif
                </div>
                <div class="absolute inset-0 bg-gradient-to-t from-navy-900 via-navy-900/40 to-transparent"></div>
                <div class="absolute inset-x-0 bottom-0 p-5">
                    <span class="text-xs font-semibold text-sky-300 uppercase">{{ str_replace('_', ' ', $ach->level) }}</span>
                    <p class="font-semibold text-white mt-1 line-clamp-2">{{ $ach->title }}</p>
                    @if($ach->student_name)
                        <p class="text-sm text-slate-300 mt-1">{{ $ach->student_name }}</p>
                    @endif
                    <div class="flex items-center justify-between mt-2">
                        <p class="text-xs text-slate-300">{{ $ach->year }}</p>
                        @if($ach->link)
                            <a href="{{ $ach->link }}" target="_blank" rel="noopener" class="inline-flex items-center gap-1 text-xs font-semibold text-white hover:text-sky-300">
                                Lihat Sumber &rarr;
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <p class="text-slate-400 text-sm col-span-3">Belum ada data prestasi.</p>
        @endforelse
    </div>

    <div class="mt-12">{{ $achievements->links() }}</div>
</section>
@endsection