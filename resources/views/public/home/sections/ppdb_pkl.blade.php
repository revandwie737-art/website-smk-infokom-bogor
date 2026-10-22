<!-- INTERACTIVE PPDB & PKL JOURNEY -->
<section class="bg-navy-900 py-24 relative overflow-hidden">
    <div class="blob absolute -top-20 -right-20 w-96 h-96 rounded-full bg-sky-500/10 blur-3xl pointer-events-none"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
        <div class="text-center max-w-2xl mx-auto mb-16" data-aos="fade-up">
            <span class="text-sky-300 font-semibold text-sm">Perjalananmu di SMK Infokom Bogor</span>
            <h2 class="text-3xl md:text-4xl font-extrabold text-white mt-2">{{ $set('home_pkl_title', 'Dari Mendaftar Sampai Terjun ke Industri') }}</h2>
        </div>
        <div class="grid lg:grid-cols-2 gap-10">
            <!-- PPDB journey mini -->
            <div class="bg-white/5 border border-white/10 rounded-3xl p-7 md:p-9" data-aos="fade-up">
                <span class="text-xs font-semibold px-3 py-1 rounded-full bg-sky-500/20 text-sky-300">PPDB</span>
                <h3 class="text-xl md:text-2xl font-bold text-white mt-4 mb-6">Alur Pendaftaran Siswa Baru</h3>
                <div class="journey-track">
                    <div class="journey-line"><div class="journey-line-fill"></div></div>
                    <div class="space-y-6">
                        @php
                            $ppdbSteps = array_values(array_filter(array_map('trim', explode("\n", (string) $set('ppdb_journey_steps')))))
                                ?: ['Isi Formulir Online','Verifikasi Berkas','Pengumuman Kelulusan','Daftar Ulang'];
                        @endphp
                        @foreach($ppdbSteps as $i => $step)
                            <div class="journey-step flex items-start gap-4 relative z-10">
                                <div class="journey-node shrink-0 w-8 h-8 rounded-full bg-white/20 text-white grid place-items-center text-xs font-bold">{{ $i + 1 }}</div>
                                <p class="text-slate-200 text-sm md:text-base pt-1">{{ $step }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
                <a href="{{ route('ppdb.index') }}" class="ripple-btn magnetic-btn inline-flex items-center gap-2 mt-8 px-6 py-3 rounded-full bg-white text-navy-800 font-semibold text-sm hover:bg-slate-100 transition">
                    Mulai Daftar PPDB &rarr;
                </a>
            </div>
            <!-- PKL journey mini -->
            <div class="bg-white/5 border border-white/10 rounded-3xl p-7 md:p-9" data-aos="fade-up" data-aos-delay="120">
                <span class="text-xs font-semibold px-3 py-1 rounded-full bg-emerald-500/20 text-emerald-300">PKL</span>
                <h3 class="text-xl md:text-2xl font-bold text-white mt-4 mb-6">Perjalanan Praktik Kerja Lapangan</h3>
                <div class="journey-track">
                    <div class="journey-line"><div class="journey-line-fill"></div></div>
                    <div class="space-y-6">
                        @php
                            $pklSteps2 = array_values(array_filter(array_map('trim', explode("\n", (string) $set('pkl_journey_steps')))))
                                ?: ['Pembekalan Siswa','Penempatan di Mitra DUDI','Pelaksanaan & Monitoring','Evaluasi & Sertifikat'];
                        @endphp
                        @foreach($pklSteps2 as $i => $step)
                            <div class="journey-step flex items-start gap-4 relative z-10">
                                <div class="journey-node shrink-0 w-8 h-8 rounded-full bg-white/20 text-white grid place-items-center text-xs font-bold">{{ $i + 1 }}</div>
                                <p class="text-slate-200 text-sm md:text-base pt-1">{{ $step }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
                <a href="{{ route('pkl.index') }}" class="ripple-btn magnetic-btn inline-flex items-center gap-2 mt-8 px-6 py-3 rounded-full bg-white text-navy-800 font-semibold text-sm hover:bg-slate-100 transition">
                    Jelajahi Program PKL &rarr;
                </a>
            </div>
        </div>
    </div>
</section>