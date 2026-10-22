@extends('layouts.public')
@section('content')

<x-public.page-hero eyebrow="Tenaga Pengajar" title="Guru yang membimbing dengan pengalaman nyata." description="Arahkan kursor ke kartu untuk melihat mata pelajaran yang diampu.">
    @php
        $subjectCount = $teachers->flatMap(fn ($t) => $t->subjects_list)->filter()->unique()->count();
    @endphp
    <x-slot name="aside">
        <div data-reveal data-reveal-delay="3" class="inline-flex items-stretch divide-x divide-navy-900/[0.06] rounded-2xl bg-white/70 backdrop-blur-xl ring-1 ring-navy-900/[0.06] shadow-sm shadow-navy-900/[0.04] overflow-hidden">
            <div class="px-6 py-4">
                <p class="font-display text-3xl text-navy-900 leading-none"><span data-counter="{{ $teachers->count() }}">0</span></p>
                <p class="text-[11px] uppercase tracking-wider text-slate-400 mt-1.5">Tenaga Pengajar</p>
            </div>
            <div class="px-6 py-4">
                <p class="font-display text-3xl text-navy-900 leading-none"><span data-counter="{{ $subjectCount }}">0</span></p>
                <p class="text-[11px] uppercase tracking-wider text-slate-400 mt-1.5">Mata Pelajaran</p>
            </div>
        </div>
    </x-slot>
</x-public.page-hero>

<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-6 pb-28">
    <div class="grid sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-7">
        @forelse($teachers as $i => $teacher)
            <div data-reveal="scale" data-reveal-delay="{{ min($i % 6, 6) }}" class="teacher-card group">
                <div class="tilt-inner relative rounded-[1.75rem] shadow-sm shadow-navy-900/5 transition-shadow duration-500 will-change-transform group-hover:shadow-2xl group-hover:shadow-navy-900/25">
                    <div class="relative h-[26rem] rounded-[1.75rem] overflow-hidden ring-1 ring-navy-900/[0.06]">

                        <!-- photo / monogram -->
                        <div class="absolute inset-0">
                            @if($teacher->photo)
                                <img src="{{ asset('storage/' . $teacher->photo) }}"
                                     class="w-full h-full object-cover transition-transform duration-[1400ms] ease-[cubic-bezier(.16,1,.3,1)] group-hover:scale-[1.09]"
                                     alt="{{ $teacher->user->name }}" loading="lazy">
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-navy-700 via-navy-800 to-navy-950 grid place-items-center transition-transform duration-[1400ms] ease-[cubic-bezier(.16,1,.3,1)] group-hover:scale-[1.06]">
                                    <span class="font-display text-6xl text-gold-300/90">{{ mb_strtoupper(mb_substr($teacher->user->name, 0, 1)) }}</span>
                                </div>
                            @endif
                        </div>

                        <!-- cursor-follow spotlight -->
                        <div class="spotlight pointer-events-none absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity duration-500"
                             style="background: radial-gradient(260px circle at var(--mx,50%) var(--my,50%), rgba(255,255,255,.20), transparent 60%);"></div>

                        <!-- base scrim + identity (always visible) -->
                        <div class="absolute inset-x-0 bottom-0 p-5 pt-20 bg-gradient-to-t from-navy-950 via-navy-950/75 to-transparent">
                            <p class="font-display text-white text-lg leading-snug">{{ $teacher->user->name }}</p>
                            <span class="block h-[2px] w-8 bg-gold-400 mt-2 transition-all duration-500 ease-out group-hover:w-14"></span>
                            @if($teacher->position)
                                <p class="text-gold-300/90 text-[11px] font-semibold uppercase tracking-wider mt-2">{{ $teacher->position }}</p>
                            @endif
                        </div>

                        <!-- hover detail sheet -->
                        <div class="absolute inset-x-0 bottom-0 max-h-[78%] overflow-y-auto translate-y-full group-hover:translate-y-0 transition-transform duration-500 ease-[cubic-bezier(.16,1,.3,1)] bg-navy-950/95 backdrop-blur-md border-t border-gold-400/30 p-5">
                            <p class="font-display text-white text-base leading-snug">{{ $teacher->user->name }}</p>
                            @if($teacher->position)
                                <p class="text-gold-300/80 text-[11px] font-semibold uppercase tracking-wider mt-1 mb-3">{{ $teacher->position }}</p>
                            @else
                                <div class="mb-3"></div>
                            @endif

                            @if($teacher->bio)
                                <p class="text-slate-300 text-[12.5px] leading-relaxed italic mb-3">&ldquo;{{ \Illuminate\Support\Str::limit($teacher->bio, 110) }}&rdquo;</p>
                            @endif

                            @if(count($teacher->subjects_list))
                                <p class="text-[10.5px] font-semibold uppercase tracking-wider text-slate-400 mb-2">Mengajar</p>
                                <div class="flex flex-wrap gap-1.5">
                                    @foreach($teacher->subjects_list as $subject)
                                        <span class="text-[11px] px-2.5 py-1 rounded-full bg-gold-400/10 text-gold-200 ring-1 ring-gold-400/25">{{ $subject }}</span>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-[12px] text-slate-500">Informasi mata pelajaran belum tersedia.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full py-16 text-center">
                <p class="font-display text-xl text-navy-900">Data guru belum tersedia.</p>
                <p class="text-sm text-slate-400 mt-1.5">Profil tenaga pengajar akan tampil di sini setelah ditambahkan.</p>
            </div>
        @endforelse
    </div>
</section>

@push('scripts')
<script>
    (function () {
        const canHover = window.matchMedia('(hover: hover)').matches;
        const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
        if (!canHover || reduceMotion) return;

        document.querySelectorAll('.teacher-card').forEach((card) => {
            const inner = card.querySelector('.tilt-inner');
            inner.style.transition = 'transform .5s cubic-bezier(.16,1,.3,1)';

            card.addEventListener('mousemove', (e) => {
                const r = card.getBoundingClientRect();
                const px = (e.clientX - r.left) / r.width;
                const py = (e.clientY - r.top) / r.height;

                inner.style.transform = `perspective(1000px) rotateX(${((0.5 - py) * 8).toFixed(2)}deg) rotateY(${((px - 0.5) * 10).toFixed(2)}deg)`;
                inner.style.setProperty('--mx', (px * 100).toFixed(1) + '%');
                inner.style.setProperty('--my', (py * 100).toFixed(1) + '%');
            });

            card.addEventListener('mouseleave', () => {
                inner.style.transform = 'perspective(1000px) rotateX(0deg) rotateY(0deg)';
            });
        });
    })();
</script>
@endpush
@endsection