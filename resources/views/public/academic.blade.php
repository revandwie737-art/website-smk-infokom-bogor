@extends('layouts.public')
@section('content')
@php($set = fn($key, $default = null) => \App\Models\SchoolSetting::get($key, $default))

<!-- HERO -->
<section class="relative overflow-hidden bg-gradient-to-br from-navy-50 via-white to-sky-50 py-20">
    <div class="blob absolute -top-16 -right-16 w-72 h-72 rounded-full bg-sky-200/40 blur-3xl pointer-events-none"></div>
    <div class="blob-slow absolute bottom-0 -left-16 w-72 h-72 rounded-full bg-navy-200/30 blur-3xl pointer-events-none"></div>
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 relative">
        <div class="text-center max-w-2xl mx-auto" data-aos="fade-up">
            <span class="inline-block px-4 py-1.5 rounded-full badge-shimmer text-navy-700 text-xs font-semibold mb-4">{{ $set('academic_badge', 'Akademik') }}</span>
            <h1 class="text-3xl md:text-4xl font-extrabold text-navy-900">{{ $set('academic_title', 'Informasi Akademik') }}</h1>
            <p class="text-slate-500 mt-4">{{ $set('academic_subtitle', 'Semua hal yang perlu kamu tahu seputar kegiatan belajar mengajar di SMK Infokom Bogor.') }}</p>
        </div>

        <!-- CARDS -->
        <div class="grid sm:grid-cols-2 gap-5 mt-14">
            <div data-aos="fade-up" data-aos-delay="0" class="group relative p-6 rounded-2xl bg-white border border-slate-900/15 hover:border-navy-300 hover:shadow-xl hover:shadow-navy-100 hover:-translate-y-1 transition-all duration-300">
                <span class="absolute top-5 right-5 text-3xl font-extrabold text-navy-50 group-hover:text-navy-100 transition">01</span>
                <div class="h-11 w-11 rounded-xl bg-navy-50 grid place-items-center text-xl mb-4 group-hover:bg-navy-700 group-hover:scale-110 transition-all duration-300">
                    <span class="group-hover:hidden">📅</span>
                    <span class="hidden group-hover:inline grayscale-0">📅</span>
                </div>
                <p class="font-semibold text-navy-800 mb-2">Kalender Akademik</p>
                <p class="text-sm text-slate-500 leading-relaxed">Kalender akademik tahun ajaran berjalan dapat diunduh pada bagian Dokumen Akademik di bawah, atau hubungi bagian tata usaha sekolah.</p>
            </div>

            <div data-aos="fade-up" data-aos-delay="90" class="group relative p-6 rounded-2xl bg-white border border-slate-900/15 hover:border-navy-300 hover:shadow-xl hover:shadow-navy-100 hover:-translate-y-1 transition-all duration-300">
                <span class="absolute top-5 right-5 text-3xl font-extrabold text-navy-50 group-hover:text-navy-100 transition">02</span>
                <div class="h-11 w-11 rounded-xl bg-navy-50 grid place-items-center text-xl mb-4 group-hover:bg-navy-700 group-hover:scale-110 transition-all duration-300">🗓️</div>
                <p class="font-semibold text-navy-800 mb-2">Jadwal Pelajaran</p>
                <p class="text-sm text-slate-500 leading-relaxed">Jadwal pelajaran per kelas dapat dilihat oleh siswa yang sudah login melalui Portal Siswa pada menu Jadwal.</p>
            </div>

            <div data-aos="fade-up" data-aos-delay="180" class="group relative p-6 rounded-2xl bg-white border border-slate-900/15 hover:border-navy-300 hover:shadow-xl hover:shadow-navy-100 hover:-translate-y-1 transition-all duration-300">
                <span class="absolute top-5 right-5 text-3xl font-extrabold text-navy-50 group-hover:text-navy-100 transition">03</span>
                <div class="h-11 w-11 rounded-xl bg-navy-50 grid place-items-center text-xl mb-4 group-hover:bg-navy-700 group-hover:scale-110 transition-all duration-300">📘</div>
                <p class="font-semibold text-navy-800 mb-2">Kurikulum</p>
                <p class="text-sm text-slate-500 leading-relaxed">SMK Infokom Bogor menerapkan kurikulum yang selaras dengan kebutuhan industri untuk setiap program keahlian.</p>
            </div>

            <div data-aos="fade-up" data-aos-delay="270" class="group relative p-6 rounded-2xl bg-white border border-slate-900/15 hover:border-navy-300 hover:shadow-xl hover:shadow-navy-100 hover:-translate-y-1 transition-all duration-300">
                <span class="absolute top-5 right-5 text-3xl font-extrabold text-navy-50 group-hover:text-navy-100 transition">04</span>
                <div class="h-11 w-11 rounded-xl bg-navy-50 grid place-items-center text-xl mb-4 group-hover:bg-navy-700 group-hover:scale-110 transition-all duration-300">📰</div>
                <p class="font-semibold text-navy-800 mb-2">Kegiatan Akademik</p>
                <p class="text-sm text-slate-500 leading-relaxed">Informasi kegiatan akademik terbaru dapat dilihat pada halaman <a href="{{ route('agenda.index') }}" class="text-sky-600 font-medium hover:underline">Agenda</a> dan <a href="{{ route('news.index') }}" class="text-sky-600 font-medium hover:underline">Berita</a>.</p>
            </div>
        </div>
    </div>
</section>

<!-- UJIAN/ASESMEN & KENAIKAN KELAS -->
@if($set('academic_exam_info') || $set('academic_promotion_info'))
<section class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 pb-16">
    <div class="grid sm:grid-cols-2 gap-5">
        @if($set('academic_exam_info'))
            <div data-aos="fade-up" class="rounded-2xl bg-white border border-slate-900/15 p-7">
                <span class="text-2xl">📝</span>
                <p class="font-semibold text-navy-800 mt-3 mb-2">Ujian &amp; Asesmen</p>
                <p class="text-sm text-slate-500 leading-relaxed whitespace-pre-line">{{ $set('academic_exam_info') }}</p>
            </div>
        @endif
        @if($set('academic_promotion_info'))
            <div data-aos="fade-up" data-aos-delay="80" class="rounded-2xl bg-white border border-slate-900/15 p-7">
                <span class="text-2xl">🎓</span>
                <p class="font-semibold text-navy-800 mt-3 mb-2">Kenaikan Kelas &amp; Kelulusan</p>
                <p class="text-sm text-slate-500 leading-relaxed whitespace-pre-line">{{ $set('academic_promotion_info') }}</p>
            </div>
        @endif
    </div>
</section>
@endif

<!-- PENGUMUMAN AKADEMIK -->
@if($announcements->count())
<section class="bg-navy-50/50 py-16">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-2xl mx-auto mb-10" data-aos="fade-up">
            <span class="text-sky-600 font-semibold text-sm">Info Terbaru</span>
            <h2 class="text-2xl md:text-3xl font-extrabold text-navy-900 mt-2">Pengumuman Akademik</h2>
        </div>
        <div class="space-y-4">
            @foreach($announcements as $i => $a)
                <div data-aos="fade-up" data-aos-delay="{{ $i * 60 }}" class="hover-lift rounded-2xl bg-white border border-slate-900/15 p-5 flex items-start gap-4">
                    <span class="shrink-0 h-9 w-9 rounded-full bg-navy-50 text-navy-700 grid place-items-center text-sm">📢</span>
                    <div>
                        <p class="font-semibold text-navy-800">{{ $a->title }}</p>
                        <p class="text-sm text-slate-500 mt-1 leading-relaxed">{{ $a->content }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- PRESTASI AKADEMIK -->
@if($achievements->count())
<section class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <div class="text-center max-w-2xl mx-auto mb-10" data-aos="fade-up">
        <span class="text-sky-600 font-semibold text-sm">Prestasi</span>
        <h2 class="text-2xl md:text-3xl font-extrabold text-navy-900 mt-2">Prestasi Akademik</h2>
    </div>
    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-5">
        @foreach($achievements as $i => $ach)
            <div data-aos="fade-up" data-aos-delay="{{ $i * 70 }}" class="hover-lift rounded-2xl bg-white border border-slate-900/15 p-6">
                <span class="text-2xl">🏆</span>
                <p class="font-semibold text-navy-800 mt-3">{{ $ach->title }}</p>
                <p class="text-sm text-slate-500 mt-1">{{ $ach->student_name }}</p>
                <p class="text-xs text-sky-600 font-semibold mt-2">{{ $ach->description }}</p>
            </div>
        @endforeach
    </div>
    <div class="text-center mt-8" data-aos="fade-up">
        <a href="{{ route('achievements.index') }}" class="text-navy-700 font-semibold text-sm hover:underline">Lihat Semua Prestasi &rarr;</a>
    </div>
</section>
@endif

<!-- DOKUMEN AKADEMIK -->
@if($documents->count())
<section class="bg-navy-50/50 py-16">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-2xl mx-auto mb-10" data-aos="fade-up">
            <span class="text-sky-600 font-semibold text-sm">Unduhan</span>
            <h2 class="text-2xl md:text-3xl font-extrabold text-navy-900 mt-2">Dokumen Akademik</h2>
        </div>
        <div class="grid sm:grid-cols-2 gap-4">
            @foreach($documents as $i => $doc)
                <a href="{{ asset('storage/' . $doc->file) }}" target="_blank" data-aos="fade-up" data-aos-delay="{{ $i * 60 }}" class="hover-lift flex items-center gap-4 rounded-2xl bg-white border border-slate-900/15 p-5">
                    <span class="shrink-0 h-11 w-11 rounded-xl bg-navy-50 text-navy-700 grid place-items-center text-lg">📄</span>
                    <div class="min-w-0">
                        <p class="font-semibold text-navy-800 truncate">{{ $doc->title }}</p>
                        @if($doc->category)
                            <p class="text-xs text-slate-400 mt-0.5">{{ $doc->category }}</p>
                        @endif
                    </div>
                    <span class="ml-auto text-navy-400">&darr;</span>
                </a>
            @endforeach
        </div>
    </div>
</section>
@endif


<!-- STATISTIK -->
<section class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-16">

    <div
        class="bg-navy-900 rounded-3xl p-8 md:p-10 grid grid-cols-2 md:grid-cols-4 gap-6 text-center text-white"
        data-aos="fade-up"
    >

        @foreach([
            [
                'label' => 'Program Keahlian',
                'value' => (int) $set(
                    'program_count',
                    \App\Models\Program::where('is_active', true)->count()
                ),
            ],
            [
                'label' => 'Guru & Tenaga Pengajar',
                'value' => (int) $set('jumlah_guru', 0),
            ],
            [
                'label' => 'Total Siswa',
                'value' => (int) $set('siswa_laki', 0) + (int) $set('siswa_perempuan', 0),
            ],
            [
                'label' => 'Rombongan Belajar',
                'value' => (int) $set('rombel', 0),
            ],
        ] as $s)

            <div>
                <p class="text-3xl md:text-4xl font-extrabold">
                    <span data-counter="{{ $s['value'] }}">0</span>
                </p>

                <p class="text-xs md:text-sm text-slate-400 mt-1">
                    {{ $s['label'] }}
                </p>
            </div>

        @endforeach

    </div>

</section>
```

<!-- CTA -->
<section class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 pb-20">
    <div class="grid sm:grid-cols-2 gap-5 text-center" data-aos="fade-up">
        <a href="{{ route('agenda.index') }}" class="ripple-btn group hover-lift p-7 rounded-2xl bg-navy-900 text-white overflow-hidden relative">
            <p class="font-semibold text-lg">Lihat Agenda</p>
            <p class="text-sm text-slate-400 mt-1">Jadwal kegiatan sekolah terbaru</p>
            <span class="inline-block mt-4 text-2xl group-hover:translate-x-1 transition-transform">&rarr;</span>
        </a>
        <a href="{{ route('news.index') }}" class="ripple-btn group hover-lift p-7 rounded-2xl bg-sky-600 text-white overflow-hidden relative">
            <p class="font-semibold text-lg">Lihat Berita</p>
            <p class="text-sm text-sky-100 mt-1">Update terbaru seputar sekolah</p>
            <span class="inline-block mt-4 text-2xl group-hover:translate-x-1 transition-transform">&rarr;</span>
        </a>
    </div>
</section>
@endsection