<!-- KERJASAMA -->
@if($partners->count())
<section class="bg-navy-50/50 py-20 overflow-hidden">
    <style>
        @keyframes marquee-scroll { from { transform: translateX(0); } to { transform: translateX(-50%); } }
        .marquee-track { animation: marquee-scroll linear infinite; }
        .marquee-track:hover { animation-play-state: paused; }
        .marquee-mask { -webkit-mask-image: linear-gradient(90deg, transparent, #000 8%, #000 92%, transparent); mask-image: linear-gradient(90deg, transparent, #000 8%, #000 92%, transparent); }
    </style>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-2xl mx-auto mb-12" data-aos="fade-up">
            <span class="text-sky-600 font-semibold text-sm">{{ $set('home_partners_eyebrow', 'Kerjasama') }}</span>
            <h2 class="text-3xl font-extrabold text-navy-900 mt-2">{{ $set('home_partners_title', 'Mitra Universitas & Industri') }}</h2>
            <p class="text-slate-500 mt-4">{{ $set('home_partners_subtitle', 'SMK Infokom Bogor bekerja sama dengan berbagai universitas dan perusahaan untuk mendukung karier siswa.') }}</p>
        </div>
        @foreach(['universitas' => 'Universitas', 'industri' => 'Industri'] as $type => $label)
            @php
                $group = $partners->where('type', $type)->values();
                $reps = $group->count() ? max(4, (int) ceil(14 / $group->count())) : 0;
                if ($reps % 2 !== 0) { $reps++; }
            @endphp
            @if($group->count())
            <p class="text-xs font-semibold uppercase tracking-wide text-navy-400 text-center mb-5 mt-10 first:mt-0">{{ $label }}</p>
            <div class="marquee-mask overflow-hidden py-3">
                <div class="marquee-track flex items-center justify-center gap-6 md:gap-8 w-max" style="animation-duration: {{ $group->count() * $reps * 2.2 }}s">
                    @for($rep = 0; $rep < $reps; $rep++)
                        @foreach($group as $p)
                            <div class="partner-badge h-32 w-32 md:h-40 md:w-40 shrink-0 rounded-full bg-white border border-slate-900/10 grid place-items-center p-5 shadow-sm" title="{{ $p->name }}">
                                @if($p->logo)
                                    <img src="{{ asset('storage/' . $p->logo) }}" alt="{{ $p->name }}" class="max-h-full max-w-full object-contain rounded-full">
                                @else
                                    <span class="text-[10px] font-semibold text-navy-600 text-center leading-tight">{{ $p->name }}</span>
                                @endif
                            </div>
                        @endforeach
                    @endfor
                </div>
            </div>
            @endif
        @endforeach
    </div>
</section>
@endif