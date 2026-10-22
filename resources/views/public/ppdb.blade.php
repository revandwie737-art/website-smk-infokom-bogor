@extends('layouts.public')
@section('content')
@php
    $set = fn($key, $default = null) => App\Models\SchoolSetting::get($key, $default);
@endphp

<!-- HERO -->
<section class="bg-navy-900 text-white py-24 relative overflow-hidden">
    <div class="blob absolute -top-20 -left-20 w-96 h-96 rounded-full bg-sky-500/20 blur-3xl pointer-events-none"></div>
    <div class="blob-slow absolute bottom-0 right-0 w-80 h-80 rounded-full bg-navy-500/30 blur-3xl pointer-events-none"></div>
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative" data-aos="fade-up">
        <span class="inline-block px-4 py-1.5 rounded-full badge-shimmer text-navy-900 text-xs font-semibold mb-4">Penerimaan Peserta Didik Baru</span>
        <h1 class="text-3xl md:text-5xl font-extrabold leading-tight">Wujudkan Masa Depan Digitalmu di SMK Infokom Bogor</h1>
        <p class="text-slate-300 mt-5 text-lg">Sekolah kejuruan terakreditasi A dengan 4 program keahlian unggulan di bidang teknologi, desain, dan penyiaran.</p>
        <div class="mt-8 flex flex-wrap justify-center gap-3">
            <a href="#form-daftar" class="magnetic-btn px-8 py-3.5 rounded-full bg-white text-navy-800 font-bold hover:bg-slate-100 transition shadow-lg">Daftar Sekarang</a>
            <a href="#alur" class="magnetic-btn px-8 py-3.5 rounded-full border border-white/30 text-white font-semibold hover:bg-white/10 transition">Lihat Alur Pendaftaran</a>
        </div>
        <div class="mt-10 flex justify-center gap-8 text-center">
            <div><p class="text-2xl font-extrabold">{{ $set('akreditasi', 'A') }}</p><p class="text-xs text-slate-400 mt-1">Akreditasi</p></div>
            <div><p class="text-2xl font-extrabold"><span data-counter="4">0</span></p><p class="text-xs text-slate-400 mt-1">Program Keahlian</p></div>
            <div><p class="text-2xl font-extrabold"><span data-counter="{{ (int)$set('jumlah_guru', 0) }}">0</span></p><p class="text-xs text-slate-400 mt-1">Tenaga Pengajar</p></div>
        </div>
    </div>
</section>

<!-- INFO CARDS -->
<section class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 -mt-10 relative z-10 pb-16">
    <div class="grid sm:grid-cols-3 gap-5">
        <div data-aos="fade-up" data-aos-delay="0" class="hover-lift p-6 rounded-2xl bg-white border border-slate-900/15 shadow-xl shadow-slate-200/60">
            <div class="h-11 w-11 rounded-xl bg-navy-50 grid place-items-center text-lg mb-3">📋</div>
            <p class="font-semibold text-navy-800 mb-2">Persyaratan</p>
            <p class="text-sm text-slate-500">Lulus SMP/MTs, mengisi formulir pendaftaran, dan menyerahkan berkas yang diminta (lihat detail di bawah).</p>
        </div>
        <div data-aos="fade-up" data-aos-delay="100" class="hover-lift p-6 rounded-2xl bg-white border border-slate-900/15 shadow-xl shadow-slate-200/60">
            <div class="h-11 w-11 rounded-xl bg-navy-50 grid place-items-center text-lg mb-3">🔄</div>
            <p class="font-semibold text-navy-800 mb-2">Alur Pendaftaran</p>
            <p class="text-sm text-slate-500">Isi formulir online &rarr; verifikasi berkas &rarr; pengumuman &rarr; daftar ulang.</p>
        </div>
        <div data-aos="fade-up" data-aos-delay="200" class="hover-lift p-6 rounded-2xl bg-white border border-slate-900/15 shadow-xl shadow-slate-200/60">
            <div class="h-11 w-11 rounded-xl bg-navy-50 grid place-items-center text-lg mb-3">☎️</div>
            <p class="font-semibold text-navy-800 mb-2">Informasi Lebih Lanjut</p>
            <p class="text-sm text-slate-500">Hubungi {{ $set('phone') }} atau {{ $set('email') }}.</p>
        </div>
    </div>
</section>

<!-- SYARAT PENDAFTARAN -->
<section class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 pb-20">
    <div class="rounded-3xl bg-white border border-slate-900/15 shadow-xl shadow-slate-200/60 p-8 md:p-10" data-aos="fade-up">
        <span class="text-sky-600 font-semibold text-sm">Persyaratan</span>
        <h2 class="text-2xl font-extrabold text-navy-900 mt-2 mb-5">Syarat Pendaftaran</h2>
        <div class="grid md:grid-cols-2 gap-8">
            <div>
                <p class="font-semibold text-navy-800 mb-3">Berkas yang perlu disiapkan</p>
                <ul class="space-y-2.5 text-sm text-slate-600">
                    <li class="flex items-start gap-2.5"><span class="text-emerald-500 mt-0.5">✓</span> Fotokopi Ijazah, SKHU, dan SKB SMP yang telah dilegalisir</li>
                    <li class="flex items-start gap-2.5"><span class="text-emerald-500 mt-0.5">✓</span> Fotokopi Kartu NISN (Nomor Induk Siswa Nasional) &amp; Akta Lahir</li>
                    <li class="flex items-start gap-2.5"><span class="text-emerald-500 mt-0.5">✓</span> Pas foto 3x4 (2 lembar), latar belakang merah</li>
                    <li class="flex items-start gap-2.5"><span class="text-emerald-500 mt-0.5">✓</span> Fotokopi Kartu Keluarga, KIP (bila ada), dan KTP Orang Tua/Wali</li>
                </ul>
            </div>
            <div>
                <p class="font-semibold text-navy-800 mb-3">Cara Mendaftar</p>
                <p class="text-sm text-slate-500 leading-relaxed mb-4">Pendaftaran dapat dilakukan secara offline di sekolah, atau online melalui formulir resmi. Bisa juga langsung isi formulir singkat di bawah halaman ini.</p>
                @if($set('ppdb_official_link'))
                    <a href="{{ $set('ppdb_official_link') }}" target="_blank" rel="noopener" class="inline-flex items-center gap-2 px-6 py-3 rounded-full bg-navy-800 text-white font-semibold text-sm hover:bg-navy-900 transition">
                        Daftar Online Resmi &rarr;
                    </a>
                @endif
            </div>
        </div>
    </div>
</section>

<!-- ALUR PENDAFTARAN — INTERACTIVE JOURNEY -->
<section id="alur" class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 pb-20">
    <div class="text-center mb-12" data-aos="fade-up">
        <span class="text-sky-600 font-semibold text-sm">Langkah demi Langkah</span>
        <h2 class="text-2xl md:text-3xl font-extrabold text-navy-900 mt-2">Alur Pendaftaran</h2>
        <p class="text-slate-500 mt-3">Klik tiap langkah untuk melihat detailnya.</p>
    </div>
    @php
        $defaultSteps = [
            ['title' => 'Isi Formulir Online', 'icon' => '📝', 'desc' => 'Lengkapi formulir pendaftaran pada halaman ini dengan data yang benar, lalu unggah dokumen yang diminta.'],
            ['title' => 'Verifikasi Berkas', 'icon' => '🔍', 'desc' => 'Tim PPDB akan memeriksa kelengkapan dan keabsahan dokumen yang kamu unggah, biasanya dalam 1-3 hari kerja.'],
            ['title' => 'Pengumuman', 'icon' => '📣', 'desc' => 'Hasil seleksi akan diinformasikan melalui kontak (email/WhatsApp) yang kamu daftarkan sesuai jadwal sekolah.'],
            ['title' => 'Daftar Ulang', 'icon' => '✅', 'desc' => 'Calon siswa yang diterima melakukan daftar ulang dan melengkapi berkas asli sesuai jadwal yang ditentukan.'],
        ];
        $customLines = array_values(array_filter(array_map('trim', explode("\n", (string) $set('ppdb_journey_steps')))));
        $stepIcons = ['📝', '🔍', '📣', '✅', '📌', '📋'];
        $steps = count($customLines)
            ? collect($customLines)->map(fn ($title, $i) => [
                'title' => $title, 'icon' => $stepIcons[$i % count($stepIcons)],
                'desc' => 'Tahapan ini merupakan bagian dari alur pendaftaran siswa baru SMK Infokom Bogor.',
            ])->all()
            : $defaultSteps;
    @endphp
    <div class="journey-track pl-2">
        <div class="journey-line" style="left: 27px;"><div class="journey-line-fill"></div></div>
        <div class="space-y-4">
            @foreach($steps as $i => $step)
                <div data-aos="fade-up" data-aos-delay="{{ $i * 90 }}" class="journey-step relative z-10">
                    <div class="hover-lift flex items-start gap-5 p-5 rounded-2xl bg-white border border-slate-900/15 hover:shadow-lg transition-all duration-300">
                        <div class="journey-node shrink-0 w-14 h-14 rounded-full bg-navy-700 text-white grid place-items-center text-xl">{{ $step['icon'] }}</div>
                        <div class="flex-1">
                            <div class="flex items-center justify-between gap-3">
                                <p class="font-semibold text-navy-800">{{ $i + 1 }}. {{ $step['title'] }}</p>
                                <svg class="w-4 h-4 text-slate-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                            </div>
                            <div class="journey-detail">
                                <p class="text-sm text-slate-500 mt-2 leading-relaxed">{{ $step['desc'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- BIAYA (kalau diisi admin) -->
@if($set('ppdb_fee_wave1') || $set('ppdb_fee_wave2') || $set('ppdb_fee_wave3'))
<section class="bg-navy-50 py-16">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-10" data-aos="fade-up">
            <span class="text-sky-600 font-semibold text-sm">Biaya</span>
            <h2 class="text-2xl md:text-3xl font-extrabold text-navy-900 mt-2">Biaya Pendaftaran</h2>
        </div>
        <div class="grid sm:grid-cols-3 gap-5">
            @if($set('ppdb_fee_wave1'))
            <div data-aos="fade-up" class="hover-lift p-7 rounded-2xl bg-white border border-slate-900/15 text-center">
                <p class="text-xs font-semibold text-sky-600 uppercase">Gelombang 1</p>
                <p class="text-3xl font-extrabold text-navy-800 mt-2">Rp {{ $set('ppdb_fee_wave1') }}</p>
            </div>
            @endif
            @if($set('ppdb_fee_wave2'))
            <div data-aos="fade-up" data-aos-delay="100" class="hover-lift p-7 rounded-2xl bg-white border border-slate-900/15 text-center">
                <p class="text-xs font-semibold text-sky-600 uppercase">Gelombang 2</p>
                <p class="text-3xl font-extrabold text-navy-800 mt-2">Rp {{ $set('ppdb_fee_wave2') }}</p>
            </div>
            @endif
            @if($set('ppdb_fee_wave3'))
            <div data-aos="fade-up" data-aos-delay="200" class="hover-lift p-7 rounded-2xl bg-white border border-slate-900/15 text-center">
                <p class="text-xs font-semibold text-sky-600 uppercase">Gelombang 3</p>
                <p class="text-3xl font-extrabold text-navy-800 mt-2">Rp {{ $set('ppdb_fee_wave3') }}</p>
            </div>
            @endif
        </div>
    </div>
</section>
@endif

<!-- FORMULIR OFFLINE (PDF) -->
<section class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-14">
    <div data-aos="fade-up" class="rounded-3xl border-2 border-dashed border-navy-200 bg-navy-50/60 p-7 md:p-9 flex flex-col md:flex-row items-center gap-6 justify-between">
        <div class="flex items-center gap-4">
            <div class="h-14 w-14 rounded-2xl bg-navy-800 text-white grid place-items-center text-2xl shrink-0">📄</div>
            <div>
                <p class="font-bold text-navy-900">Mau daftar secara offline?</p>
                <p class="text-sm text-slate-500 mt-1">Unduh formulir pendaftaran PDF, isi manual, lalu serahkan langsung ke sekolah.</p>
            </div>
        </div>
        <a href="{{ asset('storage/' . ($set('ppdb_form_pdf') ?: 'ppdb/formulir-pendaftaran-ppdb.pdf')) }}" download
            class="ripple-btn magnetic-btn shrink-0 inline-flex items-center gap-2 px-6 py-3.5 rounded-full bg-navy-800 text-white font-semibold text-sm hover:bg-navy-900 transition shadow-lg whitespace-nowrap">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
            Download Formulir PDF
        </a>
    </div>
</section>

<!-- FORM -->
<section id="form-daftar" class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
    <div class="text-center mb-10" data-aos="fade-up">
        <span class="text-sky-600 font-semibold text-sm">Pendaftaran</span>
        <h2 class="text-2xl md:text-3xl font-extrabold text-navy-900 mt-2">Formulir Pendaftaran</h2>
        <p class="text-slate-500 mt-2">Isi data di bawah ini dengan lengkap dan benar.</p>
    </div>

    <div class="rounded-3xl border border-slate-900/15 p-8 hover:shadow-xl transition-all duration-300 bg-white" data-aos="fade-up">
        <form method="POST" action="{{ route('ppdb.store') }}" enctype="multipart/form-data" class="space-y-8">
            @csrf

            {{-- A. Identitas Calon Peserta Didik --}}
            <div>
                <h3 class="text-sm font-bold text-navy-800 uppercase tracking-wide border-b border-slate-100 pb-2 mb-4">A. Identitas Calon Peserta Didik</h3>
                <div class="space-y-5">
                    <div>
                        <label class="block text-sm font-medium text-slate-600 mb-1.5">Nama Lengkap</label>
                        <input type="text" name="full_name" value="{{ old('full_name') }}" required class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
                    </div>
                    <div class="grid sm:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-sm font-medium text-slate-600 mb-1.5">Tempat Lahir</label>
                            <input type="text" name="birth_place" value="{{ old('birth_place') }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-600 mb-1.5">Tanggal Lahir</label>
                            <input type="date" name="birth_date" value="{{ old('birth_date') }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-600 mb-1.5">Jenis Kelamin</label>
                        <div class="flex items-center gap-6 px-1 py-1">
                            <label class="inline-flex items-center gap-2 text-sm text-slate-600">
                                <input type="radio" name="gender" value="L" @checked(old('gender') == 'L') class="text-sky-500 focus:ring-sky-300"> Laki-laki
                            </label>
                            <label class="inline-flex items-center gap-2 text-sm text-slate-600">
                                <input type="radio" name="gender" value="P" @checked(old('gender') == 'P') class="text-sky-500 focus:ring-sky-300"> Perempuan
                            </label>
                        </div>
                    </div>
                    <div class="grid sm:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-sm font-medium text-slate-600 mb-1.5">NISN</label>
                            <input type="text" name="nisn" value="{{ old('nisn') }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-600 mb-1.5">Asal Sekolah (SMP/MTs)</label>
                            <input type="text" name="previous_school" value="{{ old('previous_school') }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
                        </div>
                    </div>
                    <div class="grid sm:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-sm font-medium text-slate-600 mb-1.5">Email</label>
                            <input type="email" name="email" value="{{ old('email') }}" required class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-600 mb-1.5">No. HP / WhatsApp</label>
                            <input type="text" name="phone" value="{{ old('phone') }}" required class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
                        </div>
                    </div>
                </div>
            </div>

            {{-- B. Alamat --}}
            <div>
                <h3 class="text-sm font-bold text-navy-800 uppercase tracking-wide border-b border-slate-100 pb-2 mb-4">B. Alamat / Tempat Tinggal</h3>
                <div class="space-y-5">
                    <div>
                        <label class="block text-sm font-medium text-slate-600 mb-1.5">Alamat (Jalan, No. Rumah)</label>
                        <input type="text" name="address_street" value="{{ old('address_street') }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
                    </div>
                    <div class="grid sm:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-sm font-medium text-slate-600 mb-1.5">RT / RW</label>
                            <input type="text" name="address_rt_rw" value="{{ old('address_rt_rw') }}" placeholder="contoh: 003/005" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-600 mb-1.5">Kelurahan/Desa</label>
                            <input type="text" name="address_village" value="{{ old('address_village') }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
                        </div>
                    </div>
                    <div class="grid sm:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-sm font-medium text-slate-600 mb-1.5">Kecamatan</label>
                            <input type="text" name="address_district" value="{{ old('address_district') }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-600 mb-1.5">Kota/Kabupaten</label>
                            <input type="text" name="address_city" value="{{ old('address_city') }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
                        </div>
                    </div>
                    <div class="sm:w-1/2 sm:pr-2.5">
                        <label class="block text-sm font-medium text-slate-600 mb-1.5">Kode Pos</label>
                        <input type="text" name="address_postal_code" value="{{ old('address_postal_code') }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
                    </div>
                </div>
            </div>

            {{-- C. Data Orang Tua --}}
            <div>
                <h3 class="text-sm font-bold text-navy-800 uppercase tracking-wide border-b border-slate-100 pb-2 mb-4">C. Data Orang Tua</h3>
                <div class="grid sm:grid-cols-2 gap-6">
                    <div class="space-y-4">
                        <p class="text-xs font-semibold text-slate-400 uppercase">Data Ayah</p>
                        <div>
                            <label class="block text-sm font-medium text-slate-600 mb-1.5">Nama Ayah</label>
                            <input type="text" name="father_name" value="{{ old('father_name') }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-600 mb-1.5">Pekerjaan Ayah</label>
                            <input type="text" name="father_job" value="{{ old('father_job') }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-600 mb-1.5">No. HP / WhatsApp Ayah</label>
                            <input type="text" name="father_phone" value="{{ old('father_phone') }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
                        </div>
                    </div>
                    <div class="space-y-4">
                        <p class="text-xs font-semibold text-slate-400 uppercase">Data Ibu</p>
                        <div>
                            <label class="block text-sm font-medium text-slate-600 mb-1.5">Nama Ibu</label>
                            <input type="text" name="mother_name" value="{{ old('mother_name') }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-600 mb-1.5">Pekerjaan Ibu</label>
                            <input type="text" name="mother_job" value="{{ old('mother_job') }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-600 mb-1.5">No. HP / WhatsApp Ibu</label>
                            <input type="text" name="mother_phone" value="{{ old('mother_phone') }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
                        </div>
                    </div>
                </div>
                <p class="text-xs text-slate-400 mt-3">Minimal satu nomor HP/WhatsApp orang tua atau wali diisi sebagai kontak utama sekolah.</p>
            </div>

            {{-- D. Data Wali --}}
            <div x-data="{ showGuardian: {{ old('guardian_name') || old('guardian_relation') || old('guardian_phone') ? 'true' : 'false' }} }">
                <h3 class="text-sm font-bold text-navy-800 uppercase tracking-wide border-b border-slate-100 pb-2 mb-4">D. Data Wali</h3>
                <label class="inline-flex items-center gap-2 text-sm text-slate-600 mb-4">
                    <input type="checkbox" x-model="showGuardian" class="rounded text-sky-500 focus:ring-sky-300"> Pendaftaran ini diwakilkan kepada wali
                </label>
                <div x-show="showGuardian" x-cloak class="space-y-5">
                    <div class="grid sm:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-sm font-medium text-slate-600 mb-1.5">Nama Wali</label>
                            <input type="text" name="guardian_name" value="{{ old('guardian_name') }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-600 mb-1.5">Hubungan dengan Calon Peserta Didik</label>
                            <input type="text" name="guardian_relation" value="{{ old('guardian_relation') }}" placeholder="contoh: kakek, paman, wali resmi" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
                        </div>
                    </div>
                    <div class="grid sm:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-sm font-medium text-slate-600 mb-1.5">Pekerjaan Wali</label>
                            <input type="text" name="guardian_job" value="{{ old('guardian_job') }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-600 mb-1.5">No. HP / WhatsApp Wali</label>
                            <input type="text" name="guardian_phone" value="{{ old('guardian_phone') }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-600 mb-1.5">Alamat Wali (jika berbeda)</label>
                        <input type="text" name="guardian_address" value="{{ old('guardian_address') }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
                    </div>
                </div>
            </div>

            {{-- E. Pilihan Program Keahlian & Gelombang --}}
            <div>
                <h3 class="text-sm font-bold text-navy-800 uppercase tracking-wide border-b border-slate-100 pb-2 mb-4">E. Pilihan Program Keahlian & Gelombang</h3>
                <div class="space-y-5">
                    <div>
                        <label class="block text-sm font-medium text-slate-600 mb-1.5">Pilihan Program Keahlian <span class="text-slate-400 font-normal">(pilih satu)</span></label>
                        <select name="program_id" required class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
                            <option value="">Pilih Program</option>
                            @foreach($programs as $program)
                                <option value="{{ $program->id }}" @selected(old('program_id') == $program->id)>{{ $program->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-600 mb-1.5">Gelombang Pendaftaran</label>
                        <select name="wave" required class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
                            <option value="">Pilih Gelombang</option>
                            <option value="gelombang_1" @selected(old('wave') == 'gelombang_1')>Gelombang 1{{ $set('ppdb_fee_wave1') ? ' — Rp ' . $set('ppdb_fee_wave1') : '' }}</option>
                            <option value="gelombang_2" @selected(old('wave') == 'gelombang_2')>Gelombang 2{{ $set('ppdb_fee_wave2') ? ' — Rp ' . $set('ppdb_fee_wave2') : '' }}</option>
                            <option value="gelombang_3" @selected(old('wave') == 'gelombang_3')>Gelombang 3{{ $set('ppdb_fee_wave3') ? ' — Rp ' . $set('ppdb_fee_wave3') : '' }}</option>
                        </select>
                    </div>
                </div>
            </div>

            {{-- F. Berkas --}}
            <div>
                <h3 class="text-sm font-bold text-navy-800 uppercase tracking-wide border-b border-slate-100 pb-2 mb-4">F. Berkas</h3>
                <div>
                    <label class="block text-sm font-medium text-slate-600 mb-1.5">Unggah Dokumen (KK / Ijazah / Rapor)</label>
                    <input type="file" name="document_file" class="w-full text-sm">
                    <p class="text-xs text-slate-400 mt-1.5">Berkas dapat diunggah menyusul saat verifikasi.</p>
                </div>
            </div>

            <button type="submit" class="w-full py-3.5 rounded-xl bg-navy-700 text-white font-semibold hover:bg-navy-800 transition shadow-lg shadow-navy-200">
                Kirim Pendaftaran
            </button>
        </form>
    </div>
</section>

<!-- FAQ -->
<section class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 pb-24">
    <div class="text-center mb-10" data-aos="fade-up">
        <span class="text-sky-600 font-semibold text-sm">FAQ</span>
        <h2 class="text-2xl md:text-3xl font-extrabold text-navy-900 mt-2">Pertanyaan yang Sering Ditanyakan</h2>
    </div>
    <div class="space-y-3" x-data="{ open: null }">
        @php
            $faqs = [
                ['q' => 'Apakah pendaftaran dikenakan biaya?', 'a' => 'Informasi biaya pendaftaran dapat dilihat pada bagian Biaya di atas, atau hubungi kontak sekolah untuk info terbaru.'],
                ['q' => 'Bagaimana cara memilih program keahlian?', 'a' => 'Kamu bisa membaca detail masing-masing program keahlian pada halaman Program Keahlian sebelum menentukan pilihan di formulir.'],
                ['q' => 'Kapan pengumuman hasil pendaftaran?', 'a' => 'Pengumuman akan disampaikan melalui email/WhatsApp yang kamu daftarkan sesuai jadwal yang ditentukan sekolah.'],
            ];
        @endphp
        @foreach($faqs as $i => $faq)
            <div data-aos="fade-up" data-aos-delay="{{ $i * 80 }}" class="rounded-2xl border border-slate-900/15 overflow-hidden bg-white">
                <button type="button" @click="open = open === {{ $i }} ? null : {{ $i }}" class="w-full flex items-center justify-between px-5 py-4 text-left">
                    <span class="font-medium text-navy-800">{{ $faq['q'] }}</span>
                    <svg class="w-5 h-5 text-slate-400 transition-transform" :class="open === {{ $i }} && 'rotate-180'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </button>
                <div x-show="open === {{ $i }}" x-transition style="display:none" class="px-5 pb-4 text-sm text-slate-500">
                    {{ $faq['a'] }}
                </div>
            </div>
        @endforeach
    </div>
</section>
@endsection