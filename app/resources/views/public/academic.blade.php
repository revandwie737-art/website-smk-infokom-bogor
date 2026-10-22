@extends('layouts.public')
@section('content')
@php
    $set = fn($key, $default = null) => App\Models\SchoolSetting::get($key, $default);
    $items = [
        ['n' => '01', 'title' => 'Kalender Akademik', 'desc' => 'Kalender akademik tahun ajaran berjalan dapat diunduh melalui menu Dokumen, atau hubungi bagian tata usaha sekolah.'],
        ['n' => '02', 'title' => 'Jadwal Pelajaran', 'desc' => 'Jadwal pelajaran per kelas dapat dilihat oleh siswa yang sudah login melalui Portal Siswa pada menu Jadwal.'],
        ['n' => '03', 'title' => 'Kurikulum', 'desc' => 'SMK Infokom Bogor menerapkan kurikulum yang selaras dengan kebutuhan industri untuk setiap program keahlian.'],
        ['n' => '04', 'title' => 'Kegiatan Akademik', 'desc' => 'Informasi kegiatan akademik terbaru dapat dilihat pada halaman Agenda dan Berita.'],
    ];
@endphp

<x-public.page-hero eyebrow="Akademik" title="Semua yang perlu kamu tahu tentang kegiatan belajar." description="Kalender, jadwal, kurikulum, hingga kegiatan akademik terbaru di SMK Infokom Bogor." />

<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-8 pb-24">
    <div class="grid sm:grid-cols-2 gap-5">
        @foreach($items as $i => $item)
            <div data-reveal data-reveal-delay="{{ $i }}" class="group relative p-8 rounded-[1.75rem] bg-white border border-slate-200 hover:border-navy-300 hover:shadow-xl hover:shadow-navy-900/[0.06] hover:-translate-y-1 transition-all duration-300">
                <span class="absolute top-6 right-7 font-display text-4xl text-navy-50 group-hover:text-sky-100 transition">{{ $item['n'] }}</span>
                <p class="font-semibold text-navy-900 text-lg mb-2">{{ $item['title'] }}</p>
                <p class="text-sm text-slate-500 leading-relaxed max-w-sm">
                    {!! str_replace(['Agenda', 'Berita'], ['<a href="'.route('agenda.index').'" class="text-sky-600 font-medium hover:underline">Agenda</a>', '<a href="'.route('news.index').'" class="text-sky-600 font-medium hover:underline">Berita</a>'], e($item['desc'])) !!}
                </p>
            </div>
        @endforeach
    </div>
</section>

<section class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 pb-24">
    <div data-reveal class="bg-navy-900 rounded-[2rem] p-8 md:p-12 grid grid-cols-2 md:grid-cols-4 gap-8 text-center text-white relative overflow-hidden">
        <div class="float-a absolute -top-10 -right-10 w-56 h-56 rounded-full bg-sky-500/20 blur-3xl pointer-events-none"></div>
        @php
            $stats = [
                ['label' => 'Program Keahlian', 'value' => (int) \App\Models\Program::where('is_active', true)->count()],
                ['label' => 'Guru & Tenaga Pengajar', 'value' => (int) $set('jumlah_guru', 0)],
                ['label' => 'Total Siswa', 'value' => (int) $set('siswa_laki', 0) + (int) $set('siswa_perempuan', 0)],
                ['label' => 'Rombongan Belajar', 'value' => (int) $set('rombel', 0)],
            ];
        @endphp
        @foreach($stats as $s)
            <div class="relative">
                <p class="font-display text-3xl md:text-4xl"><span data-counter="{{ $s['value'] }}">0</span></p>
                <p class="text-xs md:text-sm text-slate-400 mt-1.5">{{ $s['label'] }}</p>
            </div>
        @endforeach
    </div>
</section>

<section class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 pb-28">
    <div class="grid sm:grid-cols-2 gap-5">
        <a href="{{ route('agenda.index') }}" data-cursor-hover data-reveal="left" class="group p-8 rounded-[1.75rem] bg-white border border-slate-200 hover:border-navy-300 hover:shadow-xl hover:shadow-navy-900/[0.06] transition-all">
            <p class="font-display text-2xl text-navy-900">Lihat Agenda</p>
            <p class="text-sm text-slate-400 mt-1.5">Jadwal kegiatan sekolah terbaru</p>
            <span class="inline-flex items-center gap-1.5 text-sky-600 font-medium text-sm mt-5">Selengkapnya <svg class="w-3.5 h-3.5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg></span>
        </a>
        <a href="{{ route('news.index') }}" data-cursor-hover data-reveal="right" class="group p-8 rounded-[1.75rem] bg-white border border-slate-200 hover:border-navy-300 hover:shadow-xl hover:shadow-navy-900/[0.06] transition-all">
            <p class="font-display text-2xl text-navy-900">Lihat Berita</p>
            <p class="text-sm text-slate-400 mt-1.5">Update terbaru seputar sekolah</p>
            <span class="inline-flex items-center gap-1.5 text-sky-600 font-medium text-sm mt-5">Selengkapnya <svg class="w-3.5 h-3.5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg></span>
        </a>
    </div>
</section>
@endsection
