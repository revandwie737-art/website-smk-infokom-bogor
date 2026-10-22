@extends('layouts.public')
@section('content')

<x-public.page-hero eyebrow="Prestasi" title="Deretan pencapaian yang membanggakan." description="Karya dan capaian siswa-siswi SMK Infokom Bogor di berbagai bidang dan tingkat kompetisi.">
    <x-slot:aside>
        @php($cats = ['' => 'Semua', 'akademik' => 'Akademik', 'olahraga' => 'Olahraga', 'seni' => 'Seni', 'teknologi' => 'Teknologi', 'lainnya' => 'Lainnya'])
        <div class="flex flex-wrap gap-2">
            @foreach($cats as $val => $label)
                <a href="{{ request()->fullUrlWithQuery(['category' => $val ?: null]) }}" data-cursor-hover
                    class="px-4 py-2 rounded-full text-sm font-medium transition {{ request('category', '') == $val ? 'bg-navy-900 text-white shadow-md shadow-navy-900/15' : 'bg-white text-slate-600 border border-slate-200 hover:border-navy-300' }}">
                    {{ $label }}
                </a>
            @endforeach
        </div>
    </x-slot:aside>
</x-public.page-hero>

<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-28">
    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($achievements as $i => $ach)
            <div data-reveal data-reveal-delay="{{ min($i, 6) }}" class="group relative rounded-[1.5rem] overflow-hidden border border-slate-200 aspect-[4/3]">
                <div class="absolute inset-0 bg-navy-50">
                    @if($ach->photo)
                        <img src="{{ asset('storage/' . $ach->photo) }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500" alt="{{ $ach->title }}">
                    @else
                        <div class="w-full h-full grid place-items-center text-navy-200"><svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 21h8m-4-4v4M7 4h10l-.6 6.6a4.5 4.5 0 01-8.8 0L7 4zM3 6h4m10 0h4M5 6a2 2 0 002 2m10-2a2 2 0 01-2 2"/></svg></div>
                    @endif
                </div>
                <div class="absolute inset-0 bg-gradient-to-t from-navy-900 via-navy-900/40 to-transparent"></div>
                <div class="absolute inset-x-0 bottom-0 p-6">
                    <span class="text-xs font-semibold text-sky-300 uppercase tracking-wide">{{ str_replace('_', ' ', $ach->level) }}</span>
                    <p class="font-display text-lg text-white mt-1.5 leading-snug">{{ $ach->title }}</p>
                    @if($ach->student_name)
                        <p class="text-sm text-slate-300 mt-1">{{ $ach->student_name }}</p>
                    @endif
                    <div class="flex items-center justify-between mt-3">
                        <p class="text-xs text-slate-400">{{ $ach->year }}</p>
                        @if($ach->link)
                            <a href="{{ $ach->link }}" target="_blank" rel="noopener" data-cursor-hover class="inline-flex items-center gap-1 text-xs font-semibold text-white hover:text-sky-300 transition">
                                Lihat Sumber
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <p class="text-slate-400 text-sm col-span-3">Belum ada data prestasi.</p>
        @endforelse
    </div>

    <div class="mt-14">{{ $achievements->links() }}</div>
</section>
@endsection
