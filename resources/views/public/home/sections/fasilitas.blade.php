<!-- INTERACTIVE FACILITIES — SCATTERED COLLAGE + TIDY TOGGLE -->
@if($facilities->count())
<section class="bg-slate-50 py-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-2xl mx-auto mb-10" data-aos="fade-up">
            <span class="text-sky-600 font-semibold text-sm">{{ $set('home_facilities_eyebrow', 'Fasilitas') }}</span>
            <h2 class="text-3xl md:text-4xl font-extrabold text-navy-900 mt-2">{{ $set('home_facilities_title', 'Fasilitas Penunjang Belajar') }}</h2>
            <p class="text-slate-500 mt-4">{{ $set('home_facilities_subtitle', 'Sentuh atau arahkan kursor ke kartu untuk melihat detail fasilitas.') }}</p>
        </div>

        @php
            // Hand-placed "scattered collage" coordinates (percent of container) for up to 6 cards.
            $scatterPos = [
                ['top' => '0%',  'left' => '20%', 'w' => '34%', 'rot' => '-4deg', 'z' => 3],
                ['top' => '6%',  'left' => '0%',  'w' => '32%', 'rot' => '5deg',  'z' => 2],
                ['top' => '2%',  'left' => '54%', 'w' => '34%', 'rot' => '-3deg', 'z' => 4],
                ['top' => '38%', 'left' => '62%', 'w' => '32%', 'rot' => '4deg',  'z' => 5],
                ['top' => '44%', 'left' => '8%',  'w' => '34%', 'rot' => '-5deg', 'z' => 1],
                ['top' => '66%', 'left' => '36%', 'w' => '30%', 'rot' => '3deg',  'z' => 6],
            ];
            // Neat 3-column tidy grid positions
            $tidyPos = [];
            foreach ($facilities as $i => $f) {
                $col = $i % 3; $row = intdiv($i, 3);
                $tidyPos[] = ['top' => ($row * 54) . '%', 'left' => ($col * 34) . '%', 'w' => '32%', 'rot' => '0deg', 'z' => 1];
            }
        @endphp

        <div x-data="{ tidy: false }" class="relative">
            <div class="relative mx-auto max-w-4xl md:max-w-none h-[900px] sm:h-[620px] md:h-[560px]">
                @foreach($facilities as $i => $facility)
                    @php $sp = $scatterPos[$i % count($scatterPos)]; $tp = $tidyPos[$i]; @endphp
                    <div data-aos="zoom-in" data-aos-delay="{{ $i * 70 }}"
                        class="absolute flip-card aspect-[16/10] transition-all duration-700 ease-in-out"
                        :style="tidy
                            ? 'top:{{ $tp['top'] }}; left:{{ $tp['left'] }}; width:{{ $tp['w'] }}; transform: rotate(0deg); z-index:1;'
                            : 'top:{{ $sp['top'] }}; left:{{ $sp['left'] }}; width:{{ $sp['w'] }}; transform: rotate({{ $sp['rot'] }}); z-index:{{ $sp['z'] }};'">
                        <div class="flip-inner rounded-2xl shadow-lg border-2 border-slate-900">
                            <div class="flip-face bg-navy-900">
                                @if($facility->photo)
                                    <img src="{{ asset('storage/' . $facility->photo) }}" class="w-full h-full object-cover opacity-80" alt="{{ $facility->name }}">
                                @else
                                    <div class="w-full h-full grid place-items-center text-5xl bg-gradient-to-br from-navy-700 to-sky-700">🏫</div>
                                @endif
                                <div class="absolute inset-0 bg-gradient-to-t from-navy-900 via-navy-900/20 to-transparent"></div>
                                <div class="absolute inset-0 p-5 flex flex-col justify-end">
                                    <p class="font-bold text-white text-lg leading-tight">{{ $facility->name }}</p>
                                    @if($facility->quantity)
                                        <p class="text-xs text-sky-300 font-semibold mt-1">{{ $facility->quantity }} unit</p>
                                    @endif
                                </div>
                            </div>
                            <div class="flip-face flip-back bg-black p-6 flex flex-col justify-center text-center">
                                <p class="font-bold text-white text-lg mb-2">{{ $facility->name }}</p>
                                <p class="text-slate-300 text-sm leading-relaxed">{{ $facility->description ?: 'Fasilitas ini mendukung kegiatan belajar mengajar siswa SMK Infokom Bogor.' }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="text-center mt-8">
                <button @click="tidy = !tidy" type="button" class="ripple-btn ripple-dark inline-flex items-center gap-2 px-6 py-3 rounded-full border-2 border-slate-900 bg-white text-navy-800 font-semibold text-sm hover:bg-slate-50 transition">
                    <svg class="w-4 h-4 transition-transform duration-500" :class="tidy && 'rotate-180'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                    <span x-text="tidy ? 'Acak Ulang Tampilan' : 'Rapikan Tampilan'"></span>
                </button>
            </div>
        </div>

        <div class="text-center mt-10" data-aos="fade-up">
            <a href="{{ route('facilities.index') }}" class="ripple-btn inline-flex items-center gap-2 px-6 py-3 rounded-full border border-slate-900/15 bg-white text-navy-800 font-semibold text-sm hover:bg-slate-100 transition">
                Lihat Semua Fasilitas &rarr;
            </a>
        </div>
    </div>
</section>
@endif