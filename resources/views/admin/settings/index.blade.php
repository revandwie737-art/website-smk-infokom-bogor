@extends('layouts.admin')
@section('title', 'Pengaturan Website')
@section('content')

@php
    // t: text|textarea|number|email|url|image|pdf|h (judul kelompok)|note (catatan)
    // n: nama field, l: label, p: placeholder, h: teks bantuan, r: baris textarea, half: setengah lebar
    $tabs = [
        'umum' => ['g' => 'Umum', 'l' => 'Umum', 'd' => 'Identitas dasar situs.', 'f' => [
            ['t'=>'text','n'=>'site_name','l'=>'Nama Situs'],
            ['t'=>'textarea','n'=>'site_description','l'=>'Deskripsi Situs','r'=>2],
            ['t'=>'image','n'=>'site_logo','l'=>'Logo','half'=>true],
            ['t'=>'image','n'=>'site_favicon','l'=>'Favicon','half'=>true],
            ['t'=>'text','n'=>'footer_copyright','l'=>'Teks Copyright Footer'],
        ]],
        'hero' => ['g' => 'Beranda', 'l' => 'Hero', 'd' => 'Bagian paling atas halaman Beranda.', 'f' => [
            ['t'=>'text','n'=>'hero_title','l'=>'Judul Hero','h'=>'Kata setelah "yang" otomatis tampil dengan gaya miring emas.'],
            ['t'=>'textarea','n'=>'hero_subtitle','l'=>'Subjudul Hero','r'=>3],
            ['t'=>'image','n'=>'hero_image','l'=>'Foto Hero (Beranda)'],
        ]],
        'tentang' => ['g' => 'Beranda', 'l' => 'Tentang & Kepala Sekolah', 'd' => 'Profil sekolah, visi misi, dan sambutan.', 'f' => [
            ['t'=>'textarea','n'=>'about_text','l'=>'Tentang Sekolah','r'=>4],
            ['t'=>'textarea','n'=>'vision','l'=>'Visi','r'=>3,'half'=>true],
            ['t'=>'textarea','n'=>'mission','l'=>'Misi','r'=>3,'half'=>true],
            ['t'=>'image','n'=>'about_image','l'=>'Gambar Siswa (Tentang Kami)','h'=>'Kosongkan jika tidak ingin mengganti gambar.'],
            ['t'=>'h','l'=>'Sambutan Kepala Sekolah'],
            ['t'=>'text','n'=>'principal_name','l'=>'Nama Kepala Sekolah','half'=>true],
            ['t'=>'text','n'=>'principal_position','l'=>'Jabatan','half'=>true],
            ['t'=>'image','n'=>'principal_photo','l'=>'Foto Kepala Sekolah'],
            ['t'=>'textarea','n'=>'principal_message','l'=>'Isi Sambutan','r'=>5],
        ]],
        'statistik' => ['g' => 'Beranda', 'l' => 'Statistik Sekolah', 'd' => 'Tampil di Beranda, Akademik, dan PPDB.', 'f' => [
            ['t'=>'note','l'=>'Isi sesuai data resmi sekolah, jangan mengarang angka.'],
            ['t'=>'text','n'=>'akreditasi','l'=>'Akreditasi','p'=>'cth: A','half'=>true],
            ['t'=>'number','n'=>'jumlah_guru','l'=>'Jumlah Guru','half'=>true],
            ['t'=>'number','n'=>'siswa_laki','l'=>'Siswa Laki-laki','half'=>true],
            ['t'=>'number','n'=>'siswa_perempuan','l'=>'Siswa Perempuan','half'=>true],
            ['t'=>'number','n'=>'rombel','l'=>'Rombongan Belajar','half'=>true],
            ['t'=>'number','n'=>'ruang_kelas','l'=>'Ruang Kelas','half'=>true],
            ['t'=>'number','n'=>'laboratorium','l'=>'Laboratorium','half'=>true],
            ['t'=>'number','n'=>'perpustakaan','l'=>'Perpustakaan','half'=>true],
        ]],
        'teks' => ['g' => 'Beranda', 'l' => 'Teks Section Beranda', 'd' => 'Judul dan subjudul tiap section di Beranda.', 'f' => [
            ['t'=>'note','l'=>'Kosongkan untuk memakai teks bawaan. Daftar program, prestasi, berita, fasilitas, galeri, dan mitra diatur lewat menu masing-masing.'],
            ['t'=>'h','l'=>'Tentang Kami'],
            ['t'=>'text','n'=>'home_about_eyebrow','l'=>'Label kecil','p'=>'Tentang Kami','half'=>true],
            ['t'=>'text','n'=>'home_about_title','l'=>'Judul section','p'=>'Tentang SMK Infokom Bogor','half'=>true],
            ['t'=>'text','n'=>'home_about_ch1_title','l'=>'Judul bab 1','p'=>'Siapa Kami','half'=>true],
            ['t'=>'text','n'=>'home_about_ch2_title','l'=>'Judul bab 2','p'=>'Visi Kami','half'=>true],
            ['t'=>'text','n'=>'home_about_ch3_title','l'=>'Judul bab 3','p'=>'Misi Kami','half'=>true],
            ['t'=>'h','l'=>'Program Keahlian'],
            ['t'=>'text','n'=>'home_programs_eyebrow','l'=>'Label kecil','p'=>'Program Keahlian','half'=>true],
            ['t'=>'text','n'=>'home_programs_title','l'=>'Judul section','p'=>'Pilih Jalur Keahlianmu','half'=>true],
            ['t'=>'h','l'=>'Fasilitas'],
            ['t'=>'text','n'=>'home_facilities_eyebrow','l'=>'Label kecil','p'=>'Fasilitas','half'=>true],
            ['t'=>'text','n'=>'home_facilities_title','l'=>'Judul section','p'=>'Fasilitas Penunjang Belajar','half'=>true],
            ['t'=>'text','n'=>'home_facilities_subtitle','l'=>'Subjudul','p'=>'Sentuh atau arahkan kursor ke kartu untuk melihat detail fasilitas.'],
            ['t'=>'h','l'=>'Berita'],
            ['t'=>'text','n'=>'home_news_eyebrow','l'=>'Label kecil','p'=>'Berita','half'=>true],
            ['t'=>'text','n'=>'home_news_title','l'=>'Judul section','p'=>'Berita Terbaru','half'=>true],
            ['t'=>'text','n'=>'home_news_subtitle','l'=>'Subjudul','p'=>'Kabar dan cerita terkini dari lingkungan SMK Infokom Bogor.'],
            ['t'=>'h','l'=>'Prestasi'],
            ['t'=>'text','n'=>'home_achievements_eyebrow','l'=>'Label kecil','p'=>'Prestasi','half'=>true],
            ['t'=>'text','n'=>'home_achievements_title','l'=>'Judul section','p'=>'Prestasi Siswa Kami','half'=>true],
            ['t'=>'h','l'=>'Galeri'],
            ['t'=>'text','n'=>'home_gallery_eyebrow','l'=>'Label kecil','p'=>'Galeri','half'=>true],
            ['t'=>'text','n'=>'home_gallery_title','l'=>'Judul section','p'=>'Momen di SMK Infokom Bogor','half'=>true],
            ['t'=>'text','n'=>'home_gallery_subtitle','l'=>'Subjudul','p'=>'Klik foto untuk melihat lebih besar.'],
            ['t'=>'h','l'=>'Alur PPDB & PKL'],
            ['t'=>'text','n'=>'home_pkl_title','l'=>'Judul section','p'=>'Dari Mendaftar Sampai Terjun ke Industri'],
            ['t'=>'h','l'=>'Mitra Universitas & Industri'],
            ['t'=>'text','n'=>'home_partners_eyebrow','l'=>'Label kecil','p'=>'Kerjasama','half'=>true],
            ['t'=>'text','n'=>'home_partners_title','l'=>'Judul section','p'=>'Mitra Universitas & Industri','half'=>true],
            ['t'=>'textarea','n'=>'home_partners_subtitle','l'=>'Subjudul','r'=>2,'p'=>'SMK Infokom Bogor bekerja sama dengan berbagai universitas dan perusahaan untuk mendukung karier siswa.'],
            ['t'=>'h','l'=>'Ajakan Bergabung (CTA)'],
            ['t'=>'text','n'=>'home_cta_title','l'=>'Judul','p'=>'Bergabunglah Bersama Kami','half'=>true],
            ['t'=>'text','n'=>'home_cta_button_text','l'=>'Teks tombol','p'=>'Daftar PPDB Sekarang','half'=>true],
            ['t'=>'textarea','n'=>'home_cta_subtitle','l'=>'Subjudul','r'=>2,'p'=>'Pendaftaran Peserta Didik Baru SMK Infokom Bogor tahun ajaran ini telah dibuka.'],
        ]],
        'section' => ['g' => 'Beranda', 'l' => 'Tampilan Section', 'd' => 'Tampilkan atau sembunyikan section di Beranda.', 'f' => []],

        'guru' => ['g' => 'Halaman', 'l' => 'Halaman Guru', 'd' => 'Teks bagian atas halaman /guru.', 'f' => [
            ['t'=>'text','n'=>'teachers_badge','l'=>'Label kecil','p'=>'Tenaga Pengajar','half'=>true],
            ['t'=>'text','n'=>'teachers_title','l'=>'Judul halaman','p'=>'Data Guru SMK Infokom Bogor','half'=>true],
            ['t'=>'textarea','n'=>'teachers_subtitle','l'=>'Subjudul','r'=>2,'p'=>'Para pengajar berdedikasi yang membimbing siswa-siswi kami meraih kompetensi terbaik.'],
        ]],
        'akademik' => ['g' => 'Halaman', 'l' => 'Akademik', 'd' => 'Informasi di halaman /akademik.', 'f' => [
            ['t'=>'textarea','n'=>'academic_exam_info','l'=>'Info Ujian / Asesmen','r'=>4,'p'=>'cth: Penilaian di SMK Infokom Bogor terdiri dari Sumatif, Asesmen Tengah Semester, dan Asesmen Akhir Semester...'],
            ['t'=>'textarea','n'=>'academic_promotion_info','l'=>'Info Kenaikan Kelas / Kelulusan','r'=>4],
        ]],
        'pkl' => ['g' => 'Halaman', 'l' => 'PKL', 'd' => 'Konten halaman /pkl. Data mitra dikelola di menu Mitra PKL.', 'f' => [
            ['t'=>'text','n'=>'pkl_eyebrow','l'=>'Label kecil','p'=>'PKL','half'=>true],
            ['t'=>'text','n'=>'pkl_title','l'=>'Judul halaman','p'=>'Praktik Kerja Lapangan','half'=>true],
            ['t'=>'textarea','n'=>'pkl_about','l'=>'Tentang PKL','r'=>4,'p'=>'Penjelasan singkat tentang program PKL di sekolah.'],
            ['t'=>'textarea','n'=>'pkl_purpose','l'=>'Tujuan PKL','r'=>4],
            ['t'=>'textarea','n'=>'pkl_benefits','l'=>'Manfaat PKL bagi Siswa','r'=>4],
            ['t'=>'image','n'=>'pkl_hero_image','l'=>'Foto Hero Halaman PKL'],
            ['t'=>'textarea','n'=>'pkl_journey_steps','l'=>'Langkah Alur PKL (satu langkah per baris)','r'=>4,'p'=>"Pembekalan Siswa\nPenempatan di Mitra DUDI\nPelaksanaan & Monitoring\nEvaluasi & Sertifikat",'h'=>'Tampil di kartu "Perjalanan PKL" pada Beranda. Kosongkan untuk teks bawaan.'],
        ]],
        'bkk' => ['g' => 'Halaman', 'l' => 'BKK', 'd' => 'Halaman Bursa Kerja Khusus.', 'f' => [
            ['t'=>'note','l'=>'Statistik diisi manual (tidak dihitung otomatis). Kosongkan jika belum ada datanya agar tidak tampil angka yang salah.'],
            ['t'=>'text','n'=>'bkk_stat_alumni','l'=>'Alumni Terserap Kerja','p'=>'cth: 120','half'=>true],
            ['t'=>'text','n'=>'bkk_stat_programs','l'=>'Program Rekrutmen (jumlah)','p'=>'cth: 8','half'=>true],
            ['t'=>'textarea','n'=>'bkk_intro','l'=>'Deskripsi Singkat BKK (hero)','r'=>3],
            ['t'=>'h','l'=>'Kontak BKK'],
            ['t'=>'text','n'=>'bkk_manager_name','l'=>'Nama Pengelola BKK','half'=>true],
            ['t'=>'text','n'=>'bkk_whatsapp','l'=>'Nomor WhatsApp','p'=>'628xxxxxxxxxx','half'=>true],
            ['t'=>'email','n'=>'bkk_email','l'=>'Email BKK','half'=>true],
            ['t'=>'text','n'=>'bkk_hours','l'=>'Jam Layanan','p'=>'cth: Senin–Jumat, 08.00–15.00','half'=>true],
        ]],
        'ppdb' => ['g' => 'Halaman', 'l' => 'Biaya & Alur PPDB', 'd' => 'Halaman /ppdb dan kartu alur di Beranda.', 'f' => [
            ['t'=>'note','l'=>'Kosongkan jika belum ditentukan. Angka biaya tidak akan tampil sampai diisi.'],
            ['t'=>'text','n'=>'ppdb_fee_wave1','l'=>'Total Biaya Gelombang 1 (Rp)','half'=>true],
            ['t'=>'text','n'=>'ppdb_fee_wave2','l'=>'Total Biaya Gelombang 2 (Rp)','half'=>true],
            ['t'=>'text','n'=>'ppdb_fee_wave3','l'=>'Total Biaya Gelombang 3 (Rp)','half'=>true],
            ['t'=>'url','n'=>'ppdb_official_link','l'=>'Link Pendaftaran Online Resmi','p'=>'https://...'],
            ['t'=>'pdf','n'=>'ppdb_form_pdf','l'=>'Formulir Pendaftaran (PDF, jalur offline)','h'=>'Kosongkan jika ingin memakai formulir PDF bawaan sistem.'],
            ['t'=>'textarea','n'=>'ppdb_journey_steps','l'=>'Langkah Alur Pendaftaran (satu langkah per baris)','r'=>4,'p'=>"Isi Formulir Online\nVerifikasi Berkas\nPengumuman Kelulusan\nDaftar Ulang",'h'=>'Tampil di kartu "Alur Pendaftaran" pada Beranda dan halaman PPDB. Kosongkan untuk teks bawaan.'],
        ]],
        'galfas' => ['g' => 'Halaman', 'l' => 'Galeri & Fasilitas', 'd' => 'Teks bagian atas halaman /galeri dan /fasilitas.', 'f' => [
            ['t'=>'h','l'=>'Halaman Galeri (/galeri)'],
            ['t'=>'text','n'=>'gallery_page_eyebrow','l'=>'Label kecil','p'=>'Galeri','half'=>true],
            ['t'=>'text','n'=>'gallery_page_title','l'=>'Judul halaman','p'=>'Galeri Kegiatan Sekolah','half'=>true],
            ['t'=>'h','l'=>'Halaman Fasilitas (/fasilitas)'],
            ['t'=>'text','n'=>'facilities_page_eyebrow','l'=>'Label kecil','p'=>'Fasilitas','half'=>true],
            ['t'=>'text','n'=>'facilities_page_title','l'=>'Judul halaman','p'=>'Fasilitas SMK Infokom Bogor','half'=>true],
            ['t'=>'text','n'=>'facilities_page_subtitle','l'=>'Subjudul','p'=>'Sarana dan prasarana yang mendukung proses belajar mengajar.'],
        ]],
        'kunjungan' => ['g' => 'Halaman', 'l' => 'Kunjungan Industri', 'd' => 'Teks bagian atas halaman /kunjungan-industri. Daftar kegiatan dan foto dikelola di menu Kunjungan Industri.', 'f' => [
            ['t'=>'text','n'=>'industrial_visit_eyebrow','l'=>'Label kecil','p'=>'Kunjungan Industri','half'=>true],
            ['t'=>'text','n'=>'industrial_visit_title','l'=>'Judul halaman','p'=>'Belajar Langsung dari Dunia Industri','half'=>true],
            ['t'=>'textarea','n'=>'industrial_visit_subtitle','l'=>'Deskripsi singkat','r'=>3,'p'=>'Siswa SMK Infokom Bogor mengenal dunia kerja secara langsung melalui kunjungan ke perusahaan, lembaga, dan kampus mitra.'],
        ]],
        'kontak' => ['g' => 'Halaman', 'l' => 'Kontak & Sosmed', 'd' => 'Halaman /kontak dan footer.', 'f' => [
            ['t'=>'text','n'=>'phone','l'=>'Telepon','half'=>true],
            ['t'=>'email','n'=>'email','l'=>'Email','half'=>true],
            ['t'=>'text','n'=>'jam_operasional','l'=>'Jam Operasional','p'=>'cth: Senin - Jumat : 07.00 - 17.00 WIB'],
            ['t'=>'textarea','n'=>'address','l'=>'Alamat','r'=>2],
            ['t'=>'text','n'=>'facebook','l'=>'Facebook','half'=>true],
            ['t'=>'text','n'=>'instagram','l'=>'Instagram','half'=>true],
            ['t'=>'text','n'=>'youtube','l'=>'YouTube','half'=>true],
            ['t'=>'text','n'=>'whatsapp','l'=>'WhatsApp (Humas)','p'=>'cth: 0878-7307-1400 (Humas SMK Infokom)','half'=>true],
            ['t'=>'text','n'=>'google_maps_url','l'=>'Google Maps URL'],
        ]],

        'seo' => ['g' => 'Lainnya', 'l' => 'SEO', 'd' => 'Tampilan situs di hasil pencarian Google.', 'f' => [
            ['t'=>'text','n'=>'seo_title','l'=>'SEO Title'],
            ['t'=>'textarea','n'=>'seo_description','l'=>'SEO Description','r'=>3],
        ]],
    ];
    $groups = collect($tabs)->groupBy('g', true); // true = pertahankan key (hero, tentang, dst), kalau tidak akan jadi 0,1,2
    $toggles = ['show_hero' => 'Tampilkan Hero', 'show_news' => 'Tampilkan Berita', 'show_achievements' => 'Tampilkan Prestasi', 'show_gallery' => 'Tampilkan Galeri', 'show_announcement' => 'Tampilkan Pengumuman'];
@endphp

<style>
    .st-in { width: 100%; padding: .65rem 1rem; border-radius: .75rem; border: 1px solid #e2e8f0; background: #fff; font-size: 14px; color: #0f172a; }
    .st-in::placeholder { color: #94a3b8; }
    .st-tab { display: flex; align-items: center; gap: .6rem; width: 100%; text-align: left; padding: .55rem .8rem; border-radius: .6rem; font-size: 13px; font-weight: 500; color: #475569; position: relative; cursor: pointer; }
    .st-tab:hover { background: #f1f5f9; color: #0f172a; }
    .st-tab.on { background: linear-gradient(90deg, rgba(232,196,110,.22), rgba(232,196,110,.05)); color: #172554; font-weight: 700; }
    .st-tab.on::before { content: ''; position: absolute; left: 0; top: 22%; bottom: 22%; width: 3px; border-radius: 3px; background: linear-gradient(#f3d98f, #c9a24b); }
    /* Tab dikontrol JavaScript (lihat script di bawah): hanya panel ber-class "is-on" yang tampil */
    .st-panel { display: none; scroll-margin-top: 6rem; }
    .st-panel.is-on { display: block; }
</style>

<form id="settings-form" method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data" onsubmit="this.action = this.action.split('#')[0] + (location.hash || '')">
    @csrf

    <div class="grid lg:grid-cols-[16rem_1fr] gap-6 items-start">

        <!-- Navigasi tab -->
        <div class="lg:sticky lg:top-24">
            <select id="tab-select" class="lg:hidden st-in mb-2 font-semibold" aria-label="Pilih bagian pengaturan">
                @foreach($groups as $g => $items)
                    <optgroup label="{{ $g }}">
                        @foreach($items as $k => $tb)
                            <option value="{{ $k }}">{{ $tb['l'] }}</option>
                        @endforeach
                    </optgroup>
                @endforeach
            </select>

            <nav class="hidden lg:block bg-white rounded-2xl border border-slate-100 p-3 space-y-4" aria-label="Bagian pengaturan">
                @foreach($groups as $g => $items)
                    <div>
                        <p class="px-3 pb-1.5 text-[10px] font-bold tracking-[.18em] uppercase text-[#9a7318]">{{ $g }}</p>
                        <div class="space-y-0.5">
                            @foreach($items as $k => $tb)
                                <a href="#tab-{{ $k }}" data-k="{{ $k }}" class="st-tab {{ $loop->parent->first && $loop->first ? 'on' : '' }}">{{ $tb['l'] }}</a>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </nav>
        </div>

        <!-- Konten tab -->
        <div class="min-w-0">
            @foreach($tabs as $key => $tab)
                <section id="tab-{{ $key }}" class="st-panel {{ $loop->first ? 'is-on' : '' }} bg-white rounded-2xl border border-slate-100 p-6 sm:p-8">
                    <div class="pb-5 mb-6 border-b border-[#e8c46e]/50">
                        <h2 class="serif text-2xl font-semibold text-navy-900">{{ $tab['l'] }}</h2>
                        <p class="text-sm text-slate-500 mt-1">{{ $tab['d'] }}</p>
                    </div>

                    @if($key === 'section')
                        <div class="space-y-3">
                            @foreach($toggles as $tk => $tl)
                                <label class="flex items-center justify-between gap-4 rounded-xl border border-slate-200 px-4 py-3 cursor-pointer hover:border-[#c9a24b]">
                                    <span class="text-sm font-medium text-slate-700">{{ $tl }}</span>
                                    <input type="hidden" name="{{ $tk }}" value="0">
                                    <input type="checkbox" name="{{ $tk }}" value="1" @checked(($settings[$tk] ?? '1') == '1') class="h-5 w-5 rounded border-slate-300">
                                </label>
                            @endforeach
                        </div>
                    @else
                        <div class="grid sm:grid-cols-2 gap-x-5 gap-y-5">
                            @foreach($tab['f'] as $f)
                                @php $t = $f['t']; $n = $f['n'] ?? null; @endphp

                                @if($t === 'h')
                                    <p class="sm:col-span-2 serif text-lg font-semibold text-navy-900 pt-4 mt-1 border-t border-slate-100 first:border-0 first:pt-0 first:mt-0">{{ $f['l'] }}</p>
                                @elseif($t === 'note')
                                    <p class="sm:col-span-2 rounded-xl bg-[#fbf6e6] ring-1 ring-[#e8c46e]/50 px-4 py-3 text-[13px] text-[#7a5c10] leading-relaxed">{{ $f['l'] }}</p>
                                @else
                                    <div class="{{ ($f['half'] ?? false) ? '' : 'sm:col-span-2' }}">
                                        <label for="f_{{ $n }}" class="block text-sm font-medium text-slate-600 mb-1.5">{{ $f['l'] }}</label>

                                        @if($t === 'textarea')
                                            <textarea id="f_{{ $n }}" name="{{ $n }}" rows="{{ $f['r'] ?? 3 }}" placeholder="{{ $f['p'] ?? '' }}" class="st-in">{{ old($n, $settings[$n] ?? '') }}</textarea>
                                        @elseif($t === 'image' || $t === 'pdf')
                                            @if(!empty($settings[$n]))
                                                @if($t === 'pdf')
                                                    <p class="text-xs text-emerald-600 mb-2">File saat ini: <a href="{{ asset('storage/' . $settings[$n]) }}" target="_blank" class="underline font-semibold">lihat PDF</a></p>
                                                @else
                                                    <img src="{{ asset('storage/' . $settings[$n]) }}" alt="" class="h-28 max-w-full rounded-xl mb-3 ring-1 ring-slate-200 bg-slate-50 object-contain">
                                                @endif
                                            @endif
                                            <input id="f_{{ $n }}" type="file" name="{{ $n }}" @if($t === 'pdf') accept="application/pdf" @else accept="image/*" @endif
                                                class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:bg-navy-50 file:text-navy-700 file:font-semibold hover:file:bg-navy-100">
                                        @else
                                            <input id="f_{{ $n }}" type="{{ $t }}" name="{{ $n }}" value="{{ old($n, $settings[$n] ?? '') }}" placeholder="{{ $f['p'] ?? '' }}" class="st-in">
                                        @endif

                                        @if(!empty($f['h']))
                                            <p class="text-xs text-slate-400 mt-1.5">{{ $f['h'] }}</p>
                                        @endif
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    @endif
                </section>
            @endforeach

            <!-- Bar simpan -->
            <div class="sticky bottom-4 mt-6 z-10">
                <div class="flex items-center justify-between gap-4 rounded-2xl bg-white/90 backdrop-blur-xl px-5 py-3 ring-1 ring-[#c9a24b]/50 shadow-xl shadow-navy-900/10">
                    <p class="text-xs sm:text-sm text-slate-500">Semua bagian disimpan sekaligus.</p>
                    <button type="submit" class="inline-flex items-center gap-2 px-7 py-2.5 rounded-full bg-navy-900 text-white text-sm font-semibold ring-1 ring-[#e8c46e]/70 hover:bg-navy-800">
                        <svg class="w-4 h-4 text-[#e8c46e]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        Simpan Pengaturan
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
    // Tab Pengaturan Website: JavaScript murni, tanpa library dan tanpa CSS :target/:has().
    (function () {
        var panels = document.querySelectorAll('.st-panel');
        var links = document.querySelectorAll('.st-tab');
        var sel = document.getElementById('tab-select');

        function show(key) {
            if (!document.getElementById('tab-' + key)) key = 'umum';
            panels.forEach(function (p) { p.classList.toggle('is-on', p.id === 'tab-' + key); });
            links.forEach(function (a) { a.classList.toggle('on', a.getAttribute('data-k') === key); });
            if (sel) sel.value = key;
        }

        function keyFromHash() {
            var h = location.hash || '';
            return h.indexOf('#tab-') === 0 ? h.slice(5) : 'umum';
        }

        links.forEach(function (a) {
            a.addEventListener('click', function (e) {
                e.preventDefault();
                var key = a.getAttribute('data-k');
                history.replaceState(null, '', '#tab-' + key);
                show(key);
            });
        });

        if (sel) {
            sel.addEventListener('change', function () {
                history.replaceState(null, '', '#tab-' + sel.value);
                show(sel.value);
            });
        }

        window.addEventListener('hashchange', function () { show(keyFromHash()); });
        show(keyFromHash());
    })();
</script>
@endsection