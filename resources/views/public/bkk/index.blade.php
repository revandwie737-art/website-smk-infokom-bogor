@extends('layouts.public')
@section('content')
<div x-data="bkkPage()">

<!-- HERO -->
<section class="relative overflow-hidden bg-navy-900 text-white py-24">
    <div class="blob absolute -top-24 -left-24 w-96 h-96 rounded-full bg-sky-500/20 blur-3xl pointer-events-none"></div>
    <div class="blob-slow absolute bottom-0 right-0 w-80 h-80 rounded-full bg-navy-500/30 blur-3xl pointer-events-none"></div>
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative" data-aos="fade-up">
        <span class="inline-block px-4 py-1.5 rounded-full badge-shimmer text-navy-900 text-xs font-semibold mb-4">BKK &middot; Bursa Kerja Khusus</span>
        <h1 class="text-3xl md:text-5xl font-extrabold leading-tight">Bursa Kerja Khusus SMK Infokom Bogor</h1>
        <p class="text-slate-300 mt-5 text-lg leading-relaxed">
            {{ $set('bkk_intro') ?: 'BKK membantu siswa tingkat akhir dan alumni SMK Infokom Bogor memperoleh informasi dunia kerja, rekrutmen, dan peluang karier yang sesuai dengan kompetensi masing-masing jurusan.' }}
        </p>
        <div class="mt-8 flex flex-wrap justify-center gap-3">
            <a href="#lowongan" class="ripple-btn ripple-dark magnetic-btn px-8 py-3.5 rounded-full bg-white text-navy-800 font-bold hover:bg-slate-100 transition shadow-lg">Lihat Lowongan</a>
            <a href="#kontak" class="ripple-btn px-8 py-3.5 rounded-full border border-white/30 text-white font-semibold hover:bg-white/10 transition">Hubungi BKK</a>
        </div>
    </div>
</section>

<!-- STATISTIK -->
<section class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 -mt-10 relative z-10 pb-16">
    <div class="grid grid-cols-2 md:grid-cols-4 gap-5">
        <div data-aos="fade-up" data-aos-delay="0" class="hover-lift text-center p-6 rounded-2xl bg-white border border-slate-900/15 shadow-xl shadow-slate-200/60">
            <p class="text-3xl font-extrabold text-navy-900"><span data-counter="{{ $jobs->count() }}">0</span></p>
            <p class="text-xs text-slate-500 mt-1.5">Lowongan Tersedia</p>
        </div>
        <div data-aos="fade-up" data-aos-delay="80" class="hover-lift text-center p-6 rounded-2xl bg-white border border-slate-900/15 shadow-xl shadow-slate-200/60">
            <p class="text-3xl font-extrabold text-navy-900"><span data-counter="{{ $partners->count() }}">0</span></p>
            <p class="text-xs text-slate-500 mt-1.5">Perusahaan Mitra</p>
        </div>
        <div data-aos="fade-up" data-aos-delay="160" class="hover-lift text-center p-6 rounded-2xl bg-white border border-slate-900/15 shadow-xl shadow-slate-200/60">
            @if($set('bkk_stat_alumni'))
                <p class="text-3xl font-extrabold text-navy-900"><span data-counter="{{ (int) $set('bkk_stat_alumni') }}">0</span></p>
            @else
                <p class="text-3xl font-extrabold text-slate-300">&mdash;</p>
            @endif
            <p class="text-xs text-slate-500 mt-1.5">Alumni Terserap Kerja</p>
        </div>
        <div data-aos="fade-up" data-aos-delay="240" class="hover-lift text-center p-6 rounded-2xl bg-white border border-slate-900/15 shadow-xl shadow-slate-200/60">
            @if($set('bkk_stat_programs'))
                <p class="text-3xl font-extrabold text-navy-900"><span data-counter="{{ (int) $set('bkk_stat_programs') }}">0</span></p>
            @else
                <p class="text-3xl font-extrabold text-slate-300">&mdash;</p>
            @endif
            <p class="text-xs text-slate-500 mt-1.5">Program Rekrutmen</p>
        </div>
    </div>
</section>

<!-- LOWONGAN KERJA -->
<section id="lowongan" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-20">
    <div class="text-center max-w-2xl mx-auto mb-10" data-aos="fade-up">
        <span class="text-sky-600 font-semibold text-sm">Karier</span>
        <h2 class="text-3xl font-extrabold text-navy-900 mt-2">Lowongan Kerja</h2>
        <p class="text-slate-500 mt-4">Cari lowongan yang sesuai dengan jurusan dan minatmu.</p>
    </div>

    <div class="grid sm:grid-cols-4 gap-3 mb-8" data-aos="fade-up">
        <input x-model="q" type="text" placeholder="Cari posisi / perusahaan..." class="sm:col-span-2 px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-sky-300">
        <select x-model="program" class="px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-sky-300">
            <option value="">Semua Jurusan</option>
            @foreach($programs as $p)
                <option value="{{ $p->code }}">{{ $p->code }}</option>
            @endforeach
        </select>
        <select x-model="type" class="px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-sky-300">
            <option value="">Semua Jenis</option>
            <option value="penuh_waktu">Penuh Waktu</option>
            <option value="paruh_waktu">Paruh Waktu</option>
            <option value="magang">Magang</option>
            <option value="kontrak">Kontrak</option>
        </select>
    </div>

    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-5">
        <template x-for="job in filteredJobs()" :key="job.id">
            <div class="hover-lift rounded-2xl bg-white border border-slate-900/15 p-6 hover:shadow-xl hover:shadow-navy-100 transition-all duration-300">
                <div class="flex items-start justify-between gap-3">
                    <div>
                        <p class="font-bold text-navy-900" x-text="job.position"></p>
                        <p class="text-sm text-slate-500" x-text="job.company_name"></p>
                    </div>
                    <span class="shrink-0 text-[10px] font-semibold px-2.5 py-1 rounded-full bg-sky-50 text-sky-600" x-text="job.job_type_label"></span>
                </div>
                <div class="flex flex-wrap gap-2 mt-4 text-xs text-slate-500">
                    <span x-show="job.location">📍 <span x-text="job.location"></span></span>
                    <span x-show="job.program_code">🎓 <span x-text="job.program_code"></span></span>
                    <span x-show="job.deadline">⏳ Sampai <span x-text="job.deadline"></span></span>
                </div>
                <button @click="selected = job" class="mt-5 w-full text-center px-4 py-2.5 rounded-xl border border-navy-100 text-navy-700 text-sm font-semibold hover:bg-navy-50 transition">Lihat Detail</button>
            </div>
        </template>
        <template x-if="filteredJobs().length === 0">
            <p class="text-slate-400 text-sm col-span-3 text-center py-10">Belum ada lowongan yang sesuai. Coba ubah pencarian/filter, atau cek lagi nanti.</p>
        </template>
    </div>
</section>

<!-- MODAL DETAIL LOWONGAN -->
<div x-show="selected" x-cloak @click.self="selected = null" class="fixed inset-0 bg-navy-900/60 backdrop-blur-sm z-50 grid place-items-center p-4" x-transition.opacity>
    <div x-show="selected" x-transition class="bg-white rounded-2xl max-w-lg w-full p-7 max-h-[85vh] overflow-y-auto" @click.stop>
        <template x-if="selected">
            <div>
                <div class="flex items-start justify-between gap-3 mb-1">
                    <h3 class="text-xl font-extrabold text-navy-900" x-text="selected.position"></h3>
                    <button @click="selected = null" class="text-slate-400 hover:text-slate-600 text-xl leading-none">&times;</button>
                </div>
                <p class="text-slate-500 font-medium" x-text="selected.company_name"></p>
                <div class="flex flex-wrap gap-2 mt-3 text-xs text-slate-500">
                    <span x-show="selected.location" class="px-2.5 py-1 rounded-full bg-slate-50">📍 <span x-text="selected.location"></span></span>
                    <span x-show="selected.program_code" class="px-2.5 py-1 rounded-full bg-slate-50">🎓 <span x-text="selected.program_code"></span></span>
                    <span class="px-2.5 py-1 rounded-full bg-sky-50 text-sky-600" x-text="selected.job_type_label"></span>
                </div>
                <div class="mt-5" x-show="selected.qualifications">
                    <p class="font-semibold text-navy-800 text-sm mb-1.5">Kualifikasi</p>
                    <p class="text-sm text-slate-500 whitespace-pre-line" x-text="selected.qualifications"></p>
                </div>
                <div class="mt-4" x-show="selected.description">
                    <p class="font-semibold text-navy-800 text-sm mb-1.5">Deskripsi</p>
                    <p class="text-sm text-slate-500 whitespace-pre-line" x-text="selected.description"></p>
                </div>
                <div class="mt-4 text-sm text-slate-500" x-show="selected.deadline">Batas pendaftaran: <span class="font-semibold text-navy-700" x-text="selected.deadline"></span></div>
                <a :href="selected && selected.apply_link ? selected.apply_link : '{{ route('contact.index') }}'" target="_blank" rel="noopener" class="mt-6 block text-center px-6 py-3 rounded-full bg-navy-800 text-white font-semibold hover:bg-navy-900 transition">Lamar / Daftar</a>
            </div>
        </template>
    </div>
</div>

<!-- MITRA INDUSTRI -->
@if($partners->count())
<section class="bg-navy-50/50 py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-2xl mx-auto mb-12" data-aos="fade-up">
            <span class="text-sky-600 font-semibold text-sm">Mitra</span>
            <h2 class="text-3xl font-extrabold text-navy-900 mt-2">Mitra Industri BKK</h2>
        </div>
        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-5">
            @foreach($partners as $i => $p)
                <div data-aos="zoom-in" data-aos-delay="{{ $i * 60 }}" class="hover-lift rounded-2xl bg-white border border-slate-900/15 overflow-hidden">
                    <x-media-frame ratio="aspect-video" :src="$p->logo ? asset('storage/' . $p->logo) : null" fit="cover" icon="🏢" :alt="$p->name" />
                    <div class="p-4">
                        <p class="font-semibold text-navy-800 text-sm">{{ $p->name }}</p>
                        @if($p->website)
                            <a href="{{ $p->website }}" target="_blank" rel="noopener" class="text-xs text-sky-600 hover:underline mt-1 inline-block">Kunjungi Situs &rarr;</a>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- ALUMNI -->
<section class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
    <div class="rounded-3xl bg-gradient-to-br from-navy-800 to-navy-900 text-white p-10 md:p-14" data-aos="fade-up">
        <span class="text-sky-300 font-semibold text-sm">Untuk Alumni</span>
        <h2 class="text-2xl md:text-3xl font-extrabold mt-2 mb-4">Peluang Karier untuk Alumni</h2>
        <p class="text-slate-300 leading-relaxed max-w-2xl">BKK tetap membuka akses informasi lowongan, rekrutmen, dan peluang karier bagi alumni SMK Infokom Bogor sesuai kompetensi jurusan masing-masing, termasuk informasi lanjutan setelah lulus.</p>
        <a href="#lowongan" class="inline-block mt-6 px-6 py-3 rounded-full bg-white text-navy-800 font-semibold text-sm hover:bg-slate-100 transition">Lihat Lowongan untuk Alumni</a>
    </div>
</section>

<!-- PERSIAPAN DUNIA KERJA -->
<section class="bg-navy-50/50 py-20">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-2xl mx-auto mb-12" data-aos="fade-up">
            <span class="text-sky-600 font-semibold text-sm">Persiapan</span>
            <h2 class="text-3xl font-extrabold text-navy-900 mt-2">Persiapan Dunia Kerja</h2>
        </div>
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-5">
            @php
                $tips = [
                    ['icon' => '📄', 'title' => 'Cara Membuat CV', 'summary' => 'Susun CV yang ringkas dan relevan.', 'detail' => 'Gunakan format yang rapi dan mudah dibaca, cantumkan data diri, riwayat pendidikan, pengalaman PKL/organisasi, serta keahlian yang relevan dengan posisi yang dilamar. Hindari CV yang terlalu panjang — cukup 1-2 halaman.'],
                    ['icon' => '🗣️', 'title' => 'Tips Interview Kerja', 'summary' => 'Percaya diri dan siap menjawab.', 'detail' => 'Pelajari profil perusahaan sebelum interview, datang tepat waktu, berpakaian rapi, dan jawab pertanyaan dengan jujur serta jelas. Siapkan juga pertanyaan untuk ditanyakan balik ke pewawancara.'],
                    ['icon' => '🎯', 'title' => 'Persiapan Menghadapi Recruitment', 'summary' => 'Kenali tahapan seleksi.', 'detail' => 'Pahami tahapan rekrutmen (seleksi berkas, tes, wawancara), siapkan dokumen pendukung seperti ijazah dan sertifikat, dan latih kemampuan sesuai kompetensi jurusan.'],
                    ['icon' => '🤝', 'title' => 'Etika di Dunia Kerja', 'summary' => 'Bangun sikap profesional.', 'detail' => 'Disiplin waktu, komunikasi yang sopan, tanggung jawab terhadap tugas, serta kemampuan bekerja sama dalam tim adalah kunci utama etika kerja yang baik.'],
                    ['icon' => '🔍', 'title' => 'Tips Mencari Pekerjaan', 'summary' => 'Manfaatkan semua kanal.', 'detail' => 'Manfaatkan BKK sekolah, platform pencarian kerja online, serta relasi dari guru dan alumni. Selalu sesuaikan lamaran dengan kualifikasi yang diminta.'],
                    ['icon' => '🚀', 'title' => 'Persiapan Setelah Lulus SMK', 'summary' => 'Rencanakan langkah berikutnya.', 'detail' => 'Tentukan arah setelah lulus — langsung bekerja, melanjutkan kuliah, atau berwirausaha — dan mulai persiapkan dari sekarang, misalnya lewat PKL, sertifikasi, atau portofolio.'],
                ];
            @endphp
            @foreach($tips as $i => $tip)
                <div x-data="{ open: false }" data-aos="fade-up" data-aos-delay="{{ $i * 70 }}" class="hover-lift rounded-2xl bg-white border border-slate-900/15 p-6 cursor-pointer" @click="open = !open">
                    <div class="h-11 w-11 rounded-xl bg-navy-50 grid place-items-center text-lg mb-3">{{ $tip['icon'] }}</div>
                    <p class="font-semibold text-navy-800">{{ $tip['title'] }}</p>
                    <p class="text-sm text-slate-500 mt-1.5" x-show="!open">{{ $tip['summary'] }}</p>
                    <p class="text-sm text-slate-500 mt-1.5 leading-relaxed" x-show="open" x-transition x-cloak>{{ $tip['detail'] }}</p>
                    <p class="text-xs text-sky-600 font-semibold mt-3" x-text="open ? 'Tutup' : 'Baca selengkapnya'"></p>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- AGENDA BKK -->
@if($agenda->count())
<section class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
    <div class="text-center max-w-2xl mx-auto mb-12" data-aos="fade-up">
        <span class="text-sky-600 font-semibold text-sm">Agenda</span>
        <h2 class="text-3xl font-extrabold text-navy-900 mt-2">Agenda BKK</h2>
        <p class="text-slate-500 mt-4">Job fair, rekrutmen, seminar karier, dan kegiatan BKK lainnya.</p>
    </div>
    <div class="journey-track pl-2">
        <div class="journey-line" style="left: 35px;"><div class="journey-line-fill"></div></div>
        <div class="space-y-4">
            @foreach($agenda as $i => $ev)
                <div data-aos="fade-up" data-aos-delay="{{ $i * 60 }}" class="journey-step relative z-10">
                    <div class="hover-lift flex items-center gap-5 p-5 rounded-2xl bg-white border border-slate-900/15">
                        <div class="journey-node shrink-0 w-16 h-16 rounded-xl bg-navy-800 text-white grid place-items-center text-center">
                            <div>
                                <p class="text-lg font-extrabold leading-none">{{ $ev->event_date->format('d') }}</p>
                                <p class="text-[10px] uppercase mt-1">{{ $ev->event_date->translatedFormat('M') }}</p>
                            </div>
                        </div>
                        <div>
                            <p class="font-semibold text-navy-800">{{ $ev->title }}</p>
                            <p class="text-sm text-slate-500 mt-0.5">{{ $ev->location }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- KONTAK BKK -->
<section id="kontak" class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 pb-24">
    <div class="rounded-3xl bg-white border border-slate-900/15 shadow-xl shadow-slate-200/60 p-8 md:p-12 text-center" data-aos="fade-up">
        <span class="text-sky-600 font-semibold text-sm">Hubungi Kami</span>
        <h2 class="text-2xl md:text-3xl font-extrabold text-navy-900 mt-2 mb-6">Hubungi BKK</h2>
        <div class="grid sm:grid-cols-2 gap-4 text-left max-w-lg mx-auto text-sm text-slate-600 mb-8">
            @if($set('bkk_manager_name'))<div>👤 <span class="font-medium">{{ $set('bkk_manager_name') }}</span></div>@endif
            @if($set('bkk_hours'))<div>🕐 {{ $set('bkk_hours') }}</div>@endif
            @if($set('bkk_email'))<div>✉️ {{ $set('bkk_email') }}</div>@endif
            @if($set('bkk_whatsapp'))<div>📱 {{ $set('bkk_whatsapp') }}</div>@endif
        </div>
        <div class="flex flex-wrap justify-center gap-3">
            @if($set('bkk_whatsapp'))
                <a href="https://wa.me/{{ preg_replace('/\D/', '', $set('bkk_whatsapp')) }}" target="_blank" rel="noopener" class="ripple-btn px-8 py-3.5 rounded-full bg-emerald-500 text-white font-bold hover:bg-emerald-600 transition shadow-lg">WhatsApp BKK</a>
            @endif
            <a href="{{ route('contact.index') }}" class="ripple-btn ripple-dark px-8 py-3.5 rounded-full border border-navy-200 text-navy-700 font-semibold hover:bg-navy-50 transition">Hubungi BKK</a>
        </div>
        @if(!$set('bkk_whatsapp') && !$set('bkk_email') && !$set('bkk_manager_name'))
            <p class="text-sm text-slate-400 mt-4">Kontak BKK belum diisi admin.</p>
        @endif
    </div>
</section>

</div>

@push('scripts')
<script>
function bkkPage() {
    return {
        q: '', program: '', type: '', selected: null,
        jobs: {{ Illuminate\Support\Js::from($jobs->map(fn($j) => [
            'id' => $j->id,
            'position' => $j->position,
            'company_name' => $j->company_name,
            'location' => $j->location,
            'program_code' => $j->program->code ?? null,
            'job_type' => $j->job_type,
            'job_type_label' => $j->job_type_label,
            'qualifications' => $j->qualifications,
            'description' => $j->description,
            'apply_link' => $j->apply_link,
            'deadline' => optional($j->deadline)->translatedFormat('d M Y'),
        ])) }},
        filteredJobs() {
            return this.jobs.filter(j => {
                const matchQ = !this.q || (j.position + ' ' + j.company_name).toLowerCase().includes(this.q.toLowerCase());
                const matchProgram = !this.program || j.program_code === this.program;
                const matchType = !this.type || j.job_type === this.type;
                return matchQ && matchProgram && matchType;
            });
        },
    }
}
</script>
@endpush
@endsection
