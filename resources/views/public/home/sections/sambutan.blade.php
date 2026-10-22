<!-- SAMBUTAN KEPALA SEKOLAH -->
<section class="relative bg-navy-900 text-white overflow-hidden">
    <div class="pointer-events-none absolute inset-0" style="background: radial-gradient(ellipse 60% 50% at 15% 20%, rgba(56,189,248,.10), transparent 60%), radial-gradient(ellipse 50% 40% at 90% 85%, rgba(217,180,110,.08), transparent 60%);"></div>
    <div class="pointer-events-none absolute inset-0 opacity-[0.05]" style="background-image: radial-gradient(circle, #ffffff 1px, transparent 1px); background-size: 22px 22px;"></div>

    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-14 md:py-16 grid lg:grid-cols-5 gap-10 lg:gap-12 items-center relative">

        <div class="lg:col-span-2" data-aos="fade-right">
            <div class="relative max-w-[260px] mx-auto lg:mx-0">
                <div class="absolute -inset-2.5 rounded-[1.5rem] border border-amber-300/25"></div>
                <div class="absolute -bottom-4 -right-4 w-16 h-16 rounded-xl bg-gradient-to-br from-amber-300/20 to-transparent border border-amber-300/20"></div>
                <div class="relative aspect-[4/5] rounded-2xl overflow-hidden ring-1 ring-white/10 shadow-xl shadow-black/40 bg-navy-800">
                    @if($set('principal_photo'))
                        <img src="{{ asset('storage/' . $set('principal_photo')) }}" class="w-full h-full object-cover object-top" alt="{{ $set('principal_name') }}">
                    @else
                        <div class="w-full h-full grid place-items-center text-white/30 text-sm">Foto Kepala Sekolah</div>
                    @endif
                    <div class="absolute inset-0 bg-gradient-to-t from-navy-950/70 via-transparent to-transparent"></div>
                </div>
            </div>
        </div>

        <div class="lg:col-span-3 relative" data-aos="fade-up">
            <span class="font-serif italic text-6xl md:text-7xl text-amber-300/20 absolute -top-6 -left-1 select-none leading-none">&ldquo;</span>

            <div class="relative">
                <div class="flex items-center gap-3 mb-4">
                    <span class="h-px w-8 bg-amber-300/60"></span>
                    <span class="text-amber-300 font-semibold text-[11px] tracking-[0.2em] uppercase">Sambutan Kepala Sekolah</span>
                </div>

                @php
                    $msg = trim((string) $set('principal_message'));
                    $sentences = array_values(array_filter(preg_split('/(?<=[.!?])\s+/', $msg)));
                    $half = (int) ceil(count($sentences) / 2);
                    $para1 = trim(implode(' ', array_slice($sentences, 0, $half)));
                @endphp
                <p class="font-serif text-base md:text-lg leading-relaxed text-slate-100/95">
                    {{ $para1 }}
                </p>

                <div class="mt-6 flex items-center gap-4">
                    <span class="h-px w-10 bg-amber-300/60 shrink-0"></span>
                    <div>
                        <p class="font-serif text-lg text-white">{{ $set('principal_name') }}</p>
                        <p class="text-xs text-slate-400 uppercase tracking-wide mt-0.5">{{ $set('principal_position', 'Kepala Sekolah') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>