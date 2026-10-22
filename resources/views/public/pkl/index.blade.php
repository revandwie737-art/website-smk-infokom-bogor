@extends('layouts.public')
@section('content')
@php
    $set = fn($key, $default = null) => \App\Models\SchoolSetting::get($key, $default);
@endphp

<!-- HERO -->
<section class="relative overflow-hidden bg-gradient-to-b from-navy-50 via-white to-white py-20">
    <div class="blob absolute -top-16 -left-16 w-72 h-72 rounded-full bg-sky-200/40 blur-3xl pointer-events-none"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative grid lg:grid-cols-2 gap-12 items-center">
        <div data-aos="fade-up">
            <span class="inline-block px-4 py-1.5 rounded-full badge-shimmer text-navy-700 text-xs font-semibold mb-4">PKL</span>
            <h1 class="text-3xl md:text-4xl font-extrabold text-navy-900">Praktik Kerja Lapangan</h1>
            <p class="text-slate-500 mt-4 leading-relaxed">
                {{ $content['about'] ?: 'Praktik Kerja Lapangan (PKL) adalah program wajib bagi siswa SMK Infokom Bogor untuk menerapkan langsung ilmu dan keterampilan yang dipelajari di sekolah ke dunia industri dan dunia kerja (DUDI) yang sesungguhnya.' }}
            </p>
        </div>
        <div class="relative" data-aos="zoom-in">
            <div class="rounded-3xl overflow-hidden border border-slate-900/15 shadow-xl shadow-navy-100 aspect-video bg-gradient-to-br from-navy-50 to-sky-50">
                @if($content['hero_image'])
                    <img src="{{ asset('storage/' . $content['hero_image']) }}" class="w-full h-full object-cover" alt="Praktik Kerja Lapangan">
                @else
                    <div class="w-full h-full grid place-items-center text-navy-200 text-5xl">🧑‍💼</div>
                @endif
            </div>
        </div>
    </div>
</section>

<!-- TUJUAN & MANFAAT -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
    <div class="grid md:grid-cols-2 gap-8">
        <div data-aos="fade-up" class="rounded-3xl bg-white border border-slate-900/15 p-8">
            <span class="text-2xl">🎯</span>
            <h2 class="text-xl font-bold text-navy-900 mt-3 mb-3">Tujuan PKL</h2>
            <p class="text-slate-500 leading-relaxed whitespace-pre-line">{{ $content['purpose'] ?: 'Mempersiapkan siswa agar memiliki pengalaman kerja nyata, meningkatkan kompetensi sesuai bidang keahlian, serta membangun etos kerja profesional sebelum memasuki dunia industri.' }}</p>
        </div>
        <div data-aos="fade-up" data-aos-delay="80" class="rounded-3xl bg-white border border-slate-900/15 p-8">
            <span class="text-2xl">✨</span>
            <h2 class="text-xl font-bold text-navy-900 mt-3 mb-3">Manfaat PKL bagi Siswa</h2>
            <p class="text-slate-500 leading-relaxed whitespace-pre-line">{{ $content['benefits'] ?: 'Menambah wawasan dunia kerja, melatih tanggung jawab dan kedisiplinan, memperluas relasi profesional, serta menjadi bekal untuk berkarier maupun melanjutkan pendidikan.' }}</p>
        </div>
    </div>
</section>

<!-- INTERACTIVE PKL JOURNEY -->
<section class="bg-navy-900 py-20 relative overflow-hidden">
    <div class="blob absolute -top-16 -right-16 w-72 h-72 rounded-full bg-emerald-500/10 blur-3xl pointer-events-none"></div>
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative">
        <div class="text-center mb-12" data-aos="fade-up">
            <span class="text-emerald-300 font-semibold text-sm">Perjalanan PKL</span>
            <h2 class="text-2xl md:text-3xl font-extrabold text-white mt-2">Bagaimana Alur PKL Berjalan?</h2>
            <p class="text-slate-400 mt-3">Klik tiap langkah untuk melihat detailnya.</p>
        </div>
        @php
            $defaultPklSteps = [
                ['title' => 'Pembekalan Siswa', 'icon' => '🎓', 'desc' => 'Siswa mendapat pembekalan materi, etika kerja, dan pengarahan sebelum diterjunkan ke dunia industri.'],
                ['title' => 'Penempatan di Mitra DUDI', 'icon' => '🏢', 'desc' => 'Siswa ditempatkan di perusahaan/instansi mitra sesuai bidang keahlian dan kuota yang tersedia.'],
                ['title' => 'Pelaksanaan & Monitoring', 'icon' => '🛠️', 'desc' => 'Siswa menjalani praktik kerja langsung, dipantau berkala oleh guru pembimbing dan pembimbing industri.'],
                ['title' => 'Evaluasi & Sertifikat', 'icon' => '🏆', 'desc' => 'Penilaian akhir dari mitra DUDI dan sekolah, dilanjutkan penerbitan sertifikat PKL.'],
            ];
            $customPklLines = array_values(array_filter(array_map('trim', explode("\n", (string) $set('pkl_journey_steps')))));
            $pklStepIcons = ['🎓', '🏢', '🛠️', '🏆', '📌', '📋'];
            $pklSteps = count($customPklLines)
                ? collect($customPklLines)->map(fn ($title, $i) => [
                    'title' => $title, 'icon' => $pklStepIcons[$i % count($pklStepIcons)],
                    'desc' => 'Tahapan ini merupakan bagian dari alur PKL siswa SMK Infokom Bogor.',
                ])->all()
                : $defaultPklSteps;
        @endphp
        <div class="journey-track pl-2">
            <div class="journey-line" style="background: rgba(255,255,255,.15); left: 27px;"><div class="journey-line-fill"></div></div>
            <div class="space-y-4">
                @foreach($pklSteps as $i => $step)
                    <div data-aos="fade-up" data-aos-delay="{{ $i * 90 }}" class="journey-step relative z-10">
                        <div class="flex items-start gap-5 p-5 rounded-2xl bg-white/5 border border-white/10 hover:bg-white/10 transition-all duration-300">
                            <div class="journey-node shrink-0 w-14 h-14 rounded-full bg-white/10 text-white grid place-items-center text-xl">{{ $step['icon'] }}</div>
                            <div class="flex-1">
                                <div class="flex items-center justify-between gap-3">
                                    <p class="font-semibold text-white">{{ $i + 1 }}. {{ $step['title'] }}</p>
                                    <svg class="w-4 h-4 text-slate-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                                </div>
                                <div class="journey-detail">
                                    <p class="text-sm text-slate-300 mt-2 leading-relaxed">{{ $step['desc'] }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

<!-- BIDANG / PROGRAM TERSEDIA -->
@if($fields->count())
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-20">
    <div class="text-center max-w-2xl mx-auto mb-10" data-aos="fade-up">
        <span class="text-sky-600 font-semibold text-sm">Program</span>
        <h2 class="text-3xl font-extrabold text-navy-900 mt-2">Bidang PKL yang Tersedia</h2>
    </div>
    <div class="flex flex-wrap justify-center gap-3" data-aos="fade-up">
        @foreach($fields as $field)
            <span class="px-5 py-2.5 rounded-full bg-navy-50 text-navy-700 font-semibold text-sm border border-navy-100">{{ $field }}</span>
        @endforeach
    </div>
</section>
@endif

<!-- MITRA PKL -->
<section class="bg-navy-50/50 py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-2xl mx-auto mb-14" data-aos="fade-up">
            <span class="text-sky-600 font-semibold text-sm">Mitra</span>
            <h2 class="text-3xl font-extrabold text-navy-900 mt-2">Perusahaan &amp; Instansi Mitra PKL</h2>
            <p class="text-slate-500 mt-4">Tempat siswa SMK Infokom Bogor menjalani Praktik Kerja Lapangan.</p>
        </div>

        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($partners as $i => $partner)
                <div data-aos="fade-up" data-aos-delay="{{ $i * 70 }}" class="hover-lift rounded-2xl bg-white border border-slate-900/15 overflow-hidden hover:shadow-xl hover:shadow-navy-100 transition-all duration-300">
                    <x-media-frame
                        ratio="aspect-video"
                        :src="$partner->logo ? asset('storage/' . $partner->logo) : null"
                        icon="🏢"
                        :alt="$partner->name"
                    />
                    <div class="p-6">
                        <p class="font-semibold text-navy-800">{{ $partner->name }}</p>
                        @if($partner->field)
                            <p class="text-xs text-sky-600 font-semibold mt-1">{{ $partner->field }}</p>
                        @endif
                        @if($partner->address)
                            <p class="text-sm text-slate-500 mt-2 flex items-start gap-1.5">
                                <span>📍</span><span>{{ $partner->address }}</span>
                            </p>
                        @endif
                        @if($partner->description)
                            <p class="text-sm text-slate-500 mt-2 line-clamp-3">{{ $partner->description }}</p>
                        @endif
                        @if($partner->website)
                            <a href="{{ $partner->website }}" target="_blank" rel="noopener" class="inline-block mt-3 text-xs font-semibold text-navy-700 hover:underline">Kunjungi Situs &rarr;</a>
                        @endif
                    </div>
                </div>
            @empty
                <p class="text-slate-400 text-sm col-span-3">Data mitra PKL belum tersedia.</p>
            @endforelse
        </div>
    </div>
</section>

<!-- DOKUMENTASI -->
@if($galleries->count())
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
    <div class="text-center max-w-2xl mx-auto mb-14" data-aos="fade-up">
        <span class="text-sky-600 font-semibold text-sm">Dokumentasi</span>
        <h2 class="text-3xl font-extrabold text-navy-900 mt-2">Momen Kegiatan PKL</h2>
    </div>
    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
        @foreach($galleries as $i => $g)
            <a href="{{ route('gallery.show', $g->slug) }}" data-aos="zoom-in" data-aos-delay="{{ $i * 60 }}" class="group block rounded-2xl overflow-hidden">
                <x-media-frame
                    ratio="aspect-square"
                    :src="$g->cover ? asset('storage/' . $g->cover) : null"
                    fit="cover"
                    icon="🖼️"
                    :alt="$g->title"
                />
            </a>
        @endforeach
    </div>
</section>
@endif

<!-- BERITA PKL -->
@if($news->count())
<section class="bg-navy-50/50 py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between mb-10" data-aos="fade-up">
            <div>
                <span class="text-sky-600 font-semibold text-sm">Informasi Terbaru</span>
                <h2 class="text-3xl font-extrabold text-navy-900 mt-2">Berita Seputar PKL</h2>
            </div>
            <a href="{{ route('news.index', ['category' => 'pkl']) }}" class="text-navy-700 font-semibold text-sm hover:underline hidden sm:block">Lihat Semua &rarr;</a>
        </div>
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($news as $i => $item)
                <a href="{{ route('news.show', $item->slug) }}" data-aos="fade-up" data-aos-delay="{{ $i * 100 }}" class="group hover-lift block rounded-2xl overflow-hidden border border-slate-900/15 bg-white hover:shadow-xl hover:shadow-navy-100 transition-all duration-300">
                    <div class="tilt-3d aspect-[4/5] bg-navy-50 overflow-hidden" data-tilt-strength="7" data-tilt-scale="1.04">
                        @if($item->thumbnail)
                            <img src="{{ asset('storage/' . $item->thumbnail) }}" class="w-full h-full object-cover object-top" alt="{{ $item->title }}">
                        @else
                            <div class="w-full h-full grid place-items-center text-navy-200 text-3xl">📰</div>
                        @endif
                    </div>
                    <div class="p-5">
                        <p class="text-xs text-slate-400 mb-1.5">{{ $item->published_at?->translatedFormat('d F Y') }}</p>
                        <p class="font-semibold text-navy-800 line-clamp-2 group-hover:text-navy-600 transition">{{ $item->title }}</p>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- CTA -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-24 pt-4">
    <div data-aos="fade-up" class="rounded-3xl bg-gradient-to-br from-navy-800 to-navy-900 text-white p-10 md:p-16 text-center overflow-hidden relative">
        <h2 class="text-3xl md:text-4xl font-extrabold mb-4">Ingin Bermitra untuk PKL?</h2>
        <p class="text-slate-300 max-w-xl mx-auto mb-8">Perusahaan atau instansi yang ingin bekerja sama sebagai tempat Praktik Kerja Lapangan siswa dapat menghubungi kami.</p>
        <a href="{{ route('contact.index') }}" class="magnetic-btn inline-block px-8 py-3.5 rounded-full bg-white text-navy-800 font-bold hover:bg-slate-100 transition">
            Hubungi Kami
        </a>
    </div>
</section>
@endsection