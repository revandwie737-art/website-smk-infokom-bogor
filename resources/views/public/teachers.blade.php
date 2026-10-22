@extends('layouts.public')
@section('content')

@php
    $set = fn ($key, $default = null) => \App\Models\SchoolSetting::get($key, $default);

    $teacherList = $teachers instanceof \Illuminate\Pagination\AbstractPaginator
        ? $teachers->getCollection()
        : collect($teachers);
    $teacherList = $teacherList->values();

    $makeInitials = function ($name) {
        $parts = collect(preg_split('/\s+/', trim((string) $name)))
            ->filter(fn ($w) => $w !== '' && !str_contains($w, '.'))
            ->values();
        $letters = $parts->take(2)->map(fn ($w) => mb_strtoupper(mb_substr($w, 0, 1)))->implode('');
        return $letters !== '' ? $letters : '•';
    };

    $teacherData = $teacherList->map(function ($t) use ($makeInitials) {
        $name = $t->user->name ?? '';
        return [
            'name'     => $name,
            'position' => $t->position,
            'photo'    => $t->photo ? asset('storage/' . $t->photo) : null,
            'subjects' => collect($t->subjects_list)->filter()->values()->all(),
            'initials' => $makeInitials($name),
        ];
    })->values();

    $allSubjects = $teacherData->flatMap(fn ($t) => $t['subjects'])->unique()->sort()->values();
@endphp

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,500;0,600;1,500&display=swap" rel="stylesheet">

<style>
    .lux-serif { font-family: 'Cormorant Garamond', 'Playfair Display', Georgia, serif; }
    .gold-text { background: linear-gradient(100deg, #9a7318 0%, #d9b258 45%, #9a7318 100%); -webkit-background-clip: text; background-clip: text; color: transparent; }
    .gold-rule { height: 1px; background: linear-gradient(90deg, transparent, #c9a24b, transparent); }

    /* Kartu guru */
    .lcard { position: relative; background: #fff; border-radius: 1.25rem; padding: .5rem;
        box-shadow: 0 1px 0 rgba(23,37,84,.04), 0 18px 40px -28px rgba(23,37,84,.35);
        transition: transform .6s cubic-bezier(.16,1,.3,1), box-shadow .6s ease; outline: none; }
    .lcard::before { content: ''; position: absolute; inset: 0; border-radius: inherit; padding: 1px; pointer-events: none;
        background: linear-gradient(160deg, rgba(201,162,75,.55), rgba(23,37,84,.08) 40%, rgba(201,162,75,.45));
        -webkit-mask: linear-gradient(#000 0 0) content-box, linear-gradient(#000 0 0); -webkit-mask-composite: xor; mask-composite: exclude; }
    .lcard:hover, .lcard:focus-visible { transform: translateY(-6px); box-shadow: 0 2px 0 rgba(201,162,75,.4), 0 40px 70px -30px rgba(23,37,84,.5); }
    .lcard:focus-visible { box-shadow: 0 0 0 2px #c9a24b, 0 40px 70px -30px rgba(23,37,84,.5); }
    .lstage { position: relative; aspect-ratio: 4 / 4.6; border-radius: .9rem; overflow: hidden;
        background: radial-gradient(120% 80% at 50% 0%, #ffffff 0%, #eef2fb 45%, #dfe6f5 100%); }
    .lstage::after { content: ''; position: absolute; inset: auto 0 0 0; height: 32%; pointer-events: none;
        background: linear-gradient(to top, rgba(255,255,255,.95), rgba(255,255,255,0)); }
    .lstage img { position: absolute; inset: 0; width: 100%; height: 100%; object-fit: contain; object-position: center bottom;
        transition: transform 1s cubic-bezier(.16,1,.3,1); }
    .lcard:hover .lstage img, .lcard:focus-visible .lstage img { transform: scale(1.05); }
    .lcard .lline { position: absolute; left: 1.25rem; right: 1.25rem; bottom: 0; height: 2px; transform: scaleX(0); transform-origin: left;
        background: linear-gradient(90deg, #c9a24b, #f3d98f, #c9a24b); transition: transform .8s cubic-bezier(.16,1,.3,1); }
    .lcard:hover .lline, .lcard:focus-visible .lline { transform: scaleX(1); }
    .lcard .larrow { transition: transform .5s cubic-bezier(.16,1,.3,1); }
    .lcard:hover .larrow { transform: translateX(5px); }

    /* Modal */
    .lmodal { background: linear-gradient(#fff, #fff) padding-box, linear-gradient(140deg, #e8c46e, rgba(232,196,110,.15) 40%, #c9a24b) border-box; border: 1.5px solid transparent; }

    @media (prefers-reduced-motion: reduce) {
        .lcard, .lstage img, .lcard .lline, .lcard .larrow { transition: none !important; }
        .lcard:hover { transform: none; }
    }
</style>

{{-- ====================== STRUKTUR ORGANISASI ====================== --}}
<section class="relative overflow-hidden bg-gradient-to-b from-navy-50 via-white to-white py-24">
    <div class="blob absolute -top-16 -right-16 w-72 h-72 rounded-full bg-indigo-200/40 blur-3xl pointer-events-none"></div>
    <div class="blob-slow absolute bottom-0 -left-10 w-64 h-64 rounded-full bg-blue-100/40 blur-3xl pointer-events-none"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
        <div class="text-center max-w-2xl mx-auto mb-16" data-aos="fade-up">
            <span class="inline-block px-4 py-1.5 rounded-full badge-shimmer text-navy-700 text-xs font-semibold mb-5">{{ $set('teachers_badge', 'Tenaga Pengajar') }}</span>
            <h1 class="lux-serif text-4xl md:text-5xl font-semibold text-navy-900 tracking-tight">{{ $set('teachers_title', 'Data Guru SMK Infokom Bogor') }}</h1>
            <div class="gold-rule w-32 mx-auto mt-6"></div>
            <p class="text-slate-500 mt-5 leading-relaxed">{{ $set('teachers_subtitle', 'Para pengajar berdedikasi yang membimbing siswa-siswi kami meraih kompetensi terbaik.') }}</p>
        </div>

        <div class="mb-2">
            <div class="text-center max-w-2xl mx-auto mb-12" data-aos="fade-up">
                <h2 class="lux-serif text-3xl md:text-4xl font-semibold text-navy-900">Struktur Organisasi Sekolah</h2>
            </div>

            <!-- Kepala Sekolah -->
            <div class="flex justify-center" data-aos="zoom-in">
                <div class="relative rounded-2xl px-10 py-6 text-center text-white max-w-sm shadow-2xl shadow-navy-900/30 ring-1 ring-[#e8c46e]/60"
                     style="background: radial-gradient(120% 140% at 50% 0%, #1e3a8a 0%, #172554 55%, #0f1a3d 100%);">
                    <p class="text-xs tracking-wide text-[#e8c46e] font-semibold mb-1.5">Kepala Sekolah</p>
                    <p class="lux-serif text-2xl font-semibold leading-snug">{{ $set('principal_name', 'Kepala Sekolah') }}</p>
                </div>
            </div>
            <div class="w-px h-10 mx-auto bg-gradient-to-b from-[#c9a24b] to-slate-200"></div>

            <!-- Wakil Kepala Sekolah -->
            <div class="flex flex-wrap justify-center gap-4" data-aos="fade-up">
                @foreach(($waka ?? []) as $w)
                    <div class="bg-white rounded-xl px-5 py-4 text-center w-52 ring-1 ring-[#c9a24b]/50 shadow-lg shadow-navy-900/5">
                        <p class="text-[11px] text-[#9a7318] font-semibold mb-1">Waka {{ $w['role'] }}</p>
                        <p class="lux-serif text-lg font-semibold text-navy-900 leading-snug">{{ $w['name'] }}</p>
                    </div>
                @endforeach
            </div>
            <div class="w-px h-10 mx-auto bg-gradient-to-b from-[#c9a24b] to-slate-200"></div>

            <!-- Unsur Inti -->
            <div class="flex flex-wrap justify-center gap-4" data-aos="fade-up">
                @foreach(($inti ?? []) as $w)
                    <div class="bg-navy-50/70 rounded-xl px-5 py-4 text-center w-56 ring-1 ring-navy-100">
                        <p class="text-[11px] text-navy-600 font-semibold mb-1">{{ $w['role'] }}</p>
                        <p class="lux-serif text-lg font-semibold text-navy-900 leading-snug">{{ $w['name'] }}</p>
                    </div>
                @endforeach
            </div>
            <div class="w-px h-10 mx-auto bg-gradient-to-b from-[#c9a24b] to-slate-200"></div>

            <!-- Kepala Program Keahlian -->
            <div class="flex flex-wrap justify-center gap-4 mb-12" data-aos="fade-up">
                @foreach(($kaprog ?? []) as $w)
                    <div class="bg-white rounded-xl px-5 py-4 text-center w-56 ring-1 ring-slate-900/10 shadow-sm">
                        <p class="text-[11px] text-emerald-700 font-semibold mb-1">{{ $w['role'] }}</p>
                        <p class="lux-serif text-lg font-semibold text-navy-900 leading-snug">{{ $w['name'] }}</p>
                    </div>
                @endforeach
            </div>

            <!-- Staf & Guru lain -->
            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-5" data-aos="fade-up">
                @foreach(($groups ?? []) as $g)
                    <div class="bg-white/80 rounded-2xl p-6 ring-1 ring-slate-900/10">
                        <p class="lux-serif text-xl font-semibold text-navy-900 pb-3 mb-3 border-b border-[#e8c46e]/50">{{ $g['title'] }}</p>
                        <ul class="space-y-1.5">
                            @foreach($g['members'] as $m)
                                <li class="text-[13px] text-slate-500 leading-relaxed">{{ $m }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

{{-- ====================== PROFIL GURU (direktori) ====================== --}}
<section class="relative overflow-x-clip pb-28 pt-10"
    style="background: linear-gradient(to bottom, #ffffff 0%, #f6f8fd 40%, #f3f0e8 100%);"
    x-data="teacherDir()" x-effect="document.body.style.overflow = sel !== null ? 'hidden' : ''">
    <div class="blob absolute top-24 -left-20 w-80 h-80 rounded-full bg-sky-200/40 blur-3xl pointer-events-none"></div>
    <div class="blob-slow absolute bottom-10 -right-16 w-80 h-80 rounded-full bg-[#e8c46e]/20 blur-3xl pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
        <!-- Header -->
        <div class="text-center max-w-2xl mx-auto pt-12 mb-12" data-aos="fade-up">
            <h2 class="lux-serif text-5xl md:text-6xl font-semibold text-navy-900 tracking-tight">Profil <span class="italic gold-text">Guru</span></h2>
            <div class="gold-rule w-40 mx-auto mt-7"></div>
            <p class="text-slate-500 mt-6 leading-relaxed">Kenali para pendidik yang mendampingi siswa di setiap program keahlian.</p>
        </div>

        <!-- Cari & filter -->
        <div class="sticky top-14 md:top-16 z-30 py-3 mb-8">
            <div class="mx-auto max-w-3xl flex flex-col sm:flex-row items-stretch gap-1 sm:gap-2 p-1.5 rounded-3xl sm:rounded-full bg-white/90 backdrop-blur-xl ring-1 ring-[#c9a24b]/40 shadow-xl shadow-navy-900/10 focus-within:ring-2 focus-within:ring-[#c9a24b] transition">
                <label class="relative flex-1">
                    <span class="sr-only">Cari guru</span>
                    <svg class="absolute left-5 top-1/2 -translate-y-1/2 w-4 h-4 text-[#9a7318]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M11 19a8 8 0 100-16 8 8 0 000 16z"/></svg>
                    <input type="search" x-model="q" placeholder="Cari nama, mata pelajaran, atau jabatan"
                        class="w-full h-12 pl-12 pr-4 rounded-full bg-transparent text-sm text-navy-900 placeholder:text-slate-400 focus:outline-none">
                </label>
                <span class="hidden sm:block w-px my-2.5 bg-[#e8c46e]/60"></span>
                <label class="relative">
                    <span class="sr-only">Filter mata pelajaran</span>
                    <select x-model="subj" class="w-full sm:w-64 h-12 rounded-full bg-transparent pl-5 pr-10 text-sm text-slate-600 appearance-none focus:outline-none cursor-pointer">
                        <option value="">Semua mata pelajaran</option>
                        @foreach($allSubjects as $s)
                            <option value="{{ $s }}">{{ $s }}</option>
                        @endforeach
                    </select>
                    <svg class="pointer-events-none absolute right-5 top-1/2 -translate-y-1/2 w-3.5 h-3.5 text-[#9a7318]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </label>
            </div>
            <p class="text-center text-xs text-slate-500 mt-3">
                Menampilkan <span class="font-semibold text-navy-800" x-text="count"></span> dari {{ $teacherData->count() }} guru
                <button type="button" x-show="q || subj" x-cloak @click="reset()" class="ml-2 font-semibold text-navy-700 underline underline-offset-4 decoration-[#c9a24b] hover:text-navy-900">Reset</button>
            </p>
        </div>

        <!-- Grid kartu -->
        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-x-6 gap-y-8">
            @foreach($teacherList as $i => $teacher)
                @php $d = $teacherData[$i]; $subs = $d['subjects']; @endphp
                <div x-show="match({{ $i }})" x-transition.opacity.duration.300ms>
                    <div data-aos="fade-up" data-aos-delay="{{ ($i % 4) * 80 }}" class="h-full">
                        <article tabindex="0" role="button" aria-label="Lihat profil {{ $d['name'] }}"
                            @click="open({{ $i }})" @keydown.enter.prevent="open({{ $i }})" @keydown.space.prevent="open({{ $i }})"
                            class="lcard group h-full flex flex-col cursor-pointer">
                            <div class="lstage">
                                @if($d['photo'])
                                    <img src="{{ $d['photo'] }}" alt="{{ $d['name'] }}" loading="lazy">
                                @else
                                    <div class="absolute inset-0 grid place-items-center">
                                        <span class="lux-serif text-7xl text-navy-300">{{ $d['initials'] }}</span>
                                    </div>
                                @endif
                            </div>
                            <div class="px-4 pt-5 pb-5 flex-1 flex flex-col text-center">
                                <p class="lux-serif text-[22px] font-semibold text-navy-900 leading-tight">{{ $d['name'] }}</p>
                                @if($d['position'])
                                    <p class="text-xs text-[#9a7318] font-semibold mt-1.5">{{ $d['position'] }}</p>
                                @endif
                                <div class="gold-rule w-12 mx-auto my-4"></div>
                                @if(count($subs))
                                    <p class="text-[13px] text-slate-600 leading-relaxed">
                                        {{ implode(', ', array_slice($subs, 0, 2)) }}
                                        @if(count($subs) > 2)
                                            <span class="text-[#9a7318] font-medium">dan {{ count($subs) - 2 }} lainnya</span>
                                        @endif
                                    </p>
                                @else
                                    <p class="text-[13px] text-slate-400">Mata pelajaran belum diisi</p>
                                @endif
                                <span class="mt-auto pt-5 inline-flex items-center justify-center gap-2 text-xs font-semibold text-navy-800">
                                    Lihat profil
                                    <svg class="larrow w-3.5 h-3.5 text-[#9a7318]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M13 6l6 6-6 6"/></svg>
                                </span>
                            </div>
                            <span class="lline"></span>
                        </article>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Kosong -->
        <div x-show="count === 0" x-cloak class="max-w-md mx-auto text-center py-16">
            <div class="mx-auto h-16 w-16 rounded-full bg-white ring-1 ring-[#c9a24b]/50 grid place-items-center text-[#9a7318]">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M21 21l-4.35-4.35M11 19a8 8 0 100-16 8 8 0 000 16z"/></svg>
            </div>
            <p class="lux-serif text-2xl font-semibold text-navy-900 mt-5">Tidak ada guru yang cocok</p>
            <p class="text-sm text-slate-500 mt-2">Coba kata kunci lain atau ubah filter mata pelajaran.</p>
            <button type="button" @click="reset()" class="mt-6 inline-flex items-center px-6 py-3 rounded-full bg-navy-900 text-white text-sm font-semibold ring-1 ring-[#e8c46e]/60 hover:bg-navy-800 transition">Tampilkan semua guru</button>
        </div>

        @if($teacherList->isEmpty())
            <p class="text-slate-400 text-sm text-center">Data guru belum tersedia.</p>
        @endif
    </div>

    <!-- Panel profil lengkap -->
    <div x-show="sel !== null" x-cloak
        x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
        @keydown.escape.window="close()" @keydown.arrow-right.window="sel !== null && step(1)" @keydown.arrow-left.window="sel !== null && step(-1)"
        class="fixed inset-0 z-[90] flex items-center justify-center p-4" role="dialog" aria-modal="true" aria-label="Profil guru">
        <div class="absolute inset-0 bg-navy-950/75 backdrop-blur-md" @click="close()"></div>

        <div x-show="sel !== null"
            x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0 translate-y-6 scale-95" x-transition:enter-end="opacity-100 translate-y-0 scale-100"
            x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
            class="lmodal relative w-full max-w-3xl max-h-[92vh] overflow-y-auto rounded-3xl shadow-2xl shadow-navy-950/50">
            <template x-if="cur">
                <div class="grid md:grid-cols-2">
                    <div class="relative aspect-square md:aspect-auto md:min-h-[28rem]" style="background: radial-gradient(120% 80% at 50% 0%, #ffffff 0%, #eef2fb 50%, #dfe6f5 100%);">
                        <template x-if="cur.photo"><img :src="cur.photo" :alt="cur.name" class="absolute inset-0 w-full h-full object-contain object-bottom"></template>
                        <template x-if="!cur.photo"><div class="absolute inset-0 grid place-items-center"><span class="lux-serif text-8xl text-navy-300" x-text="cur.initials"></span></div></template>
                    </div>
                    <div class="p-8 md:p-11 flex flex-col bg-white">
                        <p class="text-xs text-slate-400 tabular-nums">Guru <span x-text="pos + 1"></span> dari <span x-text="visible().length"></span></p>
                        <h3 class="lux-serif text-3xl md:text-4xl font-semibold text-navy-900 leading-tight mt-3" x-text="cur.name"></h3>
                        <p class="text-sm text-[#9a7318] font-semibold mt-2" x-show="cur.position" x-text="cur.position"></p>
                        <div class="gold-rule w-20 my-6" style="background: linear-gradient(90deg,#c9a24b,transparent)"></div>
                        <p class="text-xs font-semibold text-slate-500 mb-3">Mata pelajaran</p>
                        <div class="flex flex-wrap gap-2" x-show="cur.subjects.length">
                            <template x-for="s in cur.subjects" :key="s"><span class="text-xs px-3.5 py-1.5 rounded-full bg-[#fbf6e6] text-[#7a5c10] ring-1 ring-[#e8c46e]/60" x-text="s"></span></template>
                        </div>
                        <p class="text-sm text-slate-400" x-show="!cur.subjects.length">Belum ada data mata pelajaran.</p>

                        <div class="mt-auto pt-9 flex items-center gap-2">
                            <button type="button" @click="step(-1)" aria-label="Guru sebelumnya" class="h-11 w-11 rounded-full ring-1 ring-slate-900/15 grid place-items-center text-navy-800 hover:bg-[#fbf6e6] hover:ring-[#c9a24b] transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5l-7 7 7 7"/></svg>
                            </button>
                            <button type="button" @click="step(1)" aria-label="Guru berikutnya" class="h-11 w-11 rounded-full ring-1 ring-slate-900/15 grid place-items-center text-navy-800 hover:bg-[#fbf6e6] hover:ring-[#c9a24b] transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                            </button>
                            <button type="button" data-tclose @click="close()" class="ml-auto h-11 px-7 rounded-full bg-navy-900 text-white text-sm font-semibold ring-1 ring-[#e8c46e]/60 hover:bg-navy-800 transition">Tutup</button>
                        </div>
                    </div>
                </div>
            </template>
            <button type="button" @click="close()" aria-label="Tutup" class="absolute top-4 right-4 z-10 h-10 w-10 rounded-full bg-white/90 ring-1 ring-[#c9a24b]/50 grid place-items-center text-navy-800 hover:bg-white hover:rotate-90 transition duration-300">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
    </div>
</section>

@push('scripts')
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('teacherDir', () => ({
            teachers: {{ \Illuminate\Support\Js::from($teacherData) }}.map(t => ({
                ...t,
                hay: [t.name, t.position || '', ...t.subjects].join(' ').toLowerCase(),
            })),
            q: '',
            subj: '',
            sel: null,
            match(i) {
                const t = this.teachers[i];
                const q = this.q.toLowerCase().trim();
                return (!this.subj || t.subjects.includes(this.subj)) && (!q || t.hay.includes(q));
            },
            visible() {
                return this.teachers.map((_, i) => i).filter(i => this.match(i));
            },
            get count() { return this.visible().length; },
            get cur() { return this.sel !== null ? this.teachers[this.sel] : null; },
            get pos() { return Math.max(0, this.visible().indexOf(this.sel)); },
            reset() { this.q = ''; this.subj = ''; },
            open(i) {
                this.sel = i;
                setTimeout(() => { const b = this.$root.querySelector('[data-tclose]'); if (b) b.focus({ preventScroll: true }); }, 60);
            },
            close() { this.sel = null; },
            step(d) {
                const v = this.visible();
                if (!v.length) return;
                const p = v.indexOf(this.sel);
                this.sel = v[(p + d + v.length) % v.length];
            },
        }));
    });
</script>
@endpush
@endsection