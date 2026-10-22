@extends('layouts.public')
@section('content')
@php
    $set = fn($key, $default = null) => App\Models\SchoolSetting::get($key, $default);
@endphp

<!-- HERO -->
<section class="relative overflow-hidden bg-gradient-to-b from-sky-50 via-white to-white pt-32 pb-16">
    <div class="float-a absolute -top-20 -left-20 w-96 h-96 rounded-full bg-sky-200/50 blur-3xl pointer-events-none"></div>
    <div class="float-b absolute bottom-0 right-0 w-80 h-80 rounded-full bg-gold-200/40 blur-3xl pointer-events-none"></div>
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative" data-reveal>
        <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white ring-1 ring-navy-100 text-navy-700 text-xs font-semibold mb-5 shadow-sm">Penerimaan Peserta Didik Baru</span>
        <h1 class="font-display text-4xl md:text-5xl text-navy-900 leading-tight">Wujudkan Masa Depan Digitalmu di SMK Infokom Bogor</h1>
        <p class="text-slate-500 mt-6 text-lg leading-relaxed">Sekolah kejuruan terakreditasi {{ $set('akreditasi', 'A') }} dengan program keahlian unggulan di bidang teknologi, desain, dan penyiaran.</p>
        <div class="mt-9 flex flex-wrap justify-center gap-3">
            <a href="#form-daftar" data-cursor-hover class="magnetic px-8 py-3.5 rounded-full bg-navy-900 text-white font-semibold hover:bg-navy-800 transition shadow-lg shadow-navy-900/15">Daftar Sekarang</a>
            <a href="#alur" data-cursor-hover class="px-8 py-3.5 rounded-full border border-navy-200 text-navy-700 font-semibold hover:bg-navy-50 transition">Lihat Alur Pendaftaran</a>
        </div>
        <div class="mt-12 flex justify-center gap-10 text-center">
            <div><p class="font-display text-3xl text-navy-900">{{ $set('akreditasi', 'A') }}</p><p class="text-xs text-slate-400 mt-1.5">Akreditasi</p></div>
            <div><p class="font-display text-3xl text-navy-900"><span data-counter="4">0</span></p><p class="text-xs text-slate-400 mt-1.5">Program Keahlian</p></div>
            <div><p class="font-display text-3xl text-navy-900"><span data-counter="{{ (int)$set('jumlah_guru', 0) }}">0</span></p><p class="text-xs text-slate-400 mt-1.5">Tenaga Pengajar</p></div>
        </div>
    </div>
</section>

<!-- INFO CARDS -->
<section class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 -mt-6 relative z-10 pb-16">
    <div class="grid sm:grid-cols-3 gap-5">
        @php
            $infoCards = [
                ['icon' => 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z', 'title' => 'Persyaratan', 'desc' => 'Lulus SMP/MTs, mengisi formulir pendaftaran, dan menyerahkan berkas yang diminta (lihat detail di bawah).'],
                ['icon' => 'M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15', 'title' => 'Alur Pendaftaran', 'desc' => 'Isi formulir online → verifikasi berkas → pengumuman → daftar ulang.'],
                ['icon' => 'M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z', 'title' => 'Informasi Lebih Lanjut', 'desc' => 'Hubungi ' . $set('phone') . ' atau ' . $set('email') . '.'],
            ];
        @endphp
        @foreach($infoCards as $i => $card)
            <div data-reveal data-reveal-delay="{{ $i }}" class="p-7 rounded-[1.5rem] bg-white border border-slate-200 shadow-sm hover:shadow-xl hover:shadow-navy-900/[0.06] hover:-translate-y-1 transition-all duration-300">
                <div class="h-11 w-11 rounded-xl bg-navy-50 text-navy-700 grid place-items-center mb-4"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7" d="{{ $card['icon'] }}"/></svg></div>
                <p class="font-semibold text-navy-900 mb-2">{{ $card['title'] }}</p>
                <p class="text-sm text-slate-500 leading-relaxed">{{ $card['desc'] }}</p>
            </div>
        @endforeach
    </div>
</section>

<!-- SYARAT PENDAFTARAN -->
<section class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 pb-20">
    <div data-reveal class="rounded-[1.75rem] bg-white border border-slate-200 p-8 md:p-10">
        <p class="text-sky-600 font-medium text-sm mb-3">Persyaratan</p>
        <h2 class="font-display text-2xl text-navy-900 mb-6">Syarat Pendaftaran</h2>
        <div class="grid md:grid-cols-2 gap-8">
            <div>
                <p class="font-semibold text-navy-900 mb-3">Berkas yang perlu disiapkan</p>
                <ul class="space-y-2.5 text-sm text-slate-600">
                    <li class="flex items-start gap-2.5"><span class="text-emerald-500 mt-0.5">✓</span> Fotokopi Ijazah, SKHU, dan SKB SMP yang telah dilegalisir</li>
                    <li class="flex items-start gap-2.5"><span class="text-emerald-500 mt-0.5">✓</span> Fotokopi Kartu NISN (Nomor Induk Siswa Nasional) &amp; Akta Lahir</li>
                    <li class="flex items-start gap-2.5"><span class="text-emerald-500 mt-0.5">✓</span> Pas foto 3x4 (2 lembar), latar belakang merah</li>
                    <li class="flex items-start gap-2.5"><span class="text-emerald-500 mt-0.5">✓</span> Fotokopi Kartu Keluarga, KIP (bila ada), dan KTP Orang Tua/Wali</li>
                </ul>
            </div>
            <div>
                <p class="font-semibold text-navy-900 mb-3">Cara Mendaftar</p>
                <p class="text-sm text-slate-500 leading-relaxed mb-5">Pendaftaran dapat dilakukan secara offline di sekolah, atau online melalui formulir resmi. Bisa juga langsung isi formulir singkat di bawah halaman ini.</p>
                @if($set('ppdb_official_link'))
                    <a href="{{ $set('ppdb_official_link') }}" target="_blank" rel="noopener" data-cursor-hover class="inline-flex items-center gap-2 px-6 py-3 rounded-full bg-navy-900 text-white font-semibold text-sm hover:bg-navy-800 transition">
                        Daftar Online Resmi
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </a>
                @endif
            </div>
        </div>
    </div>
</section>

<!-- ALUR PENDAFTARAN (TIMELINE) -->
<section id="alur" class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 pb-20">
    <div class="text-center mb-12" data-reveal>
        <p class="text-sky-600 font-medium text-sm mb-3">Langkah demi Langkah</p>
        <h2 class="font-display text-2xl md:text-3xl text-navy-900">Alur Pendaftaran</h2>
    </div>
    @php
        $steps = [
            ['title' => 'Isi Formulir Online', 'desc' => 'Lengkapi formulir pendaftaran pada halaman ini dengan data yang benar.'],
            ['title' => 'Verifikasi Berkas', 'desc' => 'Tim PPDB akan memeriksa kelengkapan dokumen yang kamu unggah.'],
            ['title' => 'Pengumuman', 'desc' => 'Hasil seleksi akan diinformasikan melalui kontak yang kamu daftarkan.'],
            ['title' => 'Daftar Ulang', 'desc' => 'Calon siswa yang diterima melakukan daftar ulang sesuai jadwal sekolah.'],
        ];
    @endphp
    <div class="relative">
        <div class="absolute left-6 top-2 bottom-2 w-px bg-navy-100 hidden sm:block"></div>
        <div class="space-y-5">
            @foreach($steps as $i => $step)
                <div data-reveal="left" data-reveal-delay="{{ $i }}" class="relative flex gap-5 p-5 rounded-[1.5rem] bg-white border border-slate-200 hover:shadow-lg hover:shadow-navy-900/[0.05] transition-all duration-300">
                    <div class="shrink-0 w-12 h-12 rounded-full bg-navy-900 text-white grid place-items-center font-semibold relative z-10">{{ $i + 1 }}</div>
                    <div>
                        <p class="font-semibold text-navy-900">{{ $step['title'] }}</p>
                        <p class="text-sm text-slate-500 mt-1">{{ $step['desc'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

@if($set('ppdb_fee_wave1') || $set('ppdb_fee_wave2'))
<section class="bg-slate-50 py-20">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-10" data-reveal>
            <p class="text-sky-600 font-medium text-sm mb-3">Biaya</p>
            <h2 class="font-display text-2xl md:text-3xl text-navy-900">Biaya Pendaftaran</h2>
        </div>
        <div class="grid sm:grid-cols-2 gap-5">
            @if($set('ppdb_fee_wave1'))
            <div data-reveal="left" class="p-7 rounded-[1.5rem] bg-white border border-slate-200 text-center">
                <p class="text-xs font-semibold text-sky-600 uppercase tracking-wide">Gelombang 1</p>
                <p class="font-display text-3xl text-navy-900 mt-2">Rp {{ $set('ppdb_fee_wave1') }}</p>
            </div>
            @endif
            @if($set('ppdb_fee_wave2'))
            <div data-reveal="right" class="p-7 rounded-[1.5rem] bg-white border border-slate-200 text-center">
                <p class="text-xs font-semibold text-sky-600 uppercase tracking-wide">Gelombang 2</p>
                <p class="font-display text-3xl text-navy-900 mt-2">Rp {{ $set('ppdb_fee_wave2') }}</p>
            </div>
            @endif
        </div>
    </div>
</section>
@endif

<!-- FORM -->
<section id="form-daftar" class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
    <div class="text-center mb-10" data-reveal>
        <p class="text-sky-600 font-medium text-sm mb-3">Pendaftaran</p>
        <h2 class="font-display text-2xl md:text-3xl text-navy-900">Formulir Pendaftaran</h2>
        <p class="text-slate-500 mt-2.5">Isi data di bawah ini dengan lengkap dan benar.</p>
    </div>

    <div data-reveal class="rounded-[1.75rem] border border-slate-200 p-8 bg-white shadow-sm">
        <form method="POST" action="{{ route('ppdb.store') }}" enctype="multipart/form-data" class="space-y-5">
            @csrf
            <div>
                <label class="block text-sm font-medium text-slate-600 mb-1.5">Nama Lengkap</label>
                <input type="text" name="full_name" value="{{ old('full_name') }}" required class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
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
            <div class="grid sm:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-medium text-slate-600 mb-1.5">NISN (opsional)</label>
                    <input type="text" name="nisn" value="{{ old('nisn') }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-600 mb-1.5">Asal Sekolah</label>
                    <input type="text" name="previous_school" value="{{ old('previous_school') }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-600 mb-1.5">Pilihan Program Keahlian</label>
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
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-600 mb-1.5">Alamat</label>
                <textarea name="address" rows="3" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">{{ old('address') }}</textarea>
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-600 mb-1.5">Unggah Dokumen (KK / Ijazah / Rapor - opsional)</label>
                <input type="file" name="document_file" class="w-full text-sm file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:bg-slate-100 file:text-slate-600 file:font-medium hover:file:bg-slate-200 transition">
            </div>
            <button type="submit" data-cursor-hover class="magnetic w-full py-3.5 rounded-xl bg-navy-900 text-white font-semibold hover:bg-navy-800 transition shadow-lg shadow-navy-900/15">
                Kirim Pendaftaran
            </button>
        </form>
    </div>
</section>

<!-- FAQ -->
<section class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 pb-28">
    <div class="text-center mb-10" data-reveal>
        <p class="text-sky-600 font-medium text-sm mb-3">FAQ</p>
        <h2 class="font-display text-2xl md:text-3xl text-navy-900">Pertanyaan yang Sering Ditanyakan</h2>
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
            <div data-reveal data-reveal-delay="{{ $i }}" class="rounded-2xl border border-slate-200 overflow-hidden bg-white">
                <button type="button" @click="open = open === {{ $i }} ? null : {{ $i }}" data-cursor-hover class="w-full flex items-center justify-between px-5 py-4 text-left">
                    <span class="font-medium text-navy-900">{{ $faq['q'] }}</span>
                    <svg class="w-5 h-5 text-slate-400 transition-transform" :class="open === {{ $i }} && 'rotate-180'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </button>
                <div x-show="open === {{ $i }}" x-collapse class="px-5 pb-4 text-sm text-slate-500">
                    {{ $faq['a'] }}
                </div>
            </div>
        @endforeach
    </div>
</section>
@endsection
