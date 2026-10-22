<!-- PROGRAM KEAHLIAN -->
<style>
    /* Huruf judul: Playfair Display (lebih tebal dan tegas dari Cormorant). Font dimuat di layouts/public. */
    .pk-serif { font-family: 'Playfair Display', Georgia, serif; font-weight: 700; letter-spacing: -.01em; }
    .pk-card {
        position: relative; border: 1.5px solid transparent;
        background: linear-gradient(#fff, #fff) padding-box,
                    linear-gradient(135deg, #e8c46e 0%, rgba(232,196,110,.22) 45%, #c9a24b 100%) border-box;
        box-shadow: 0 1px 0 rgba(23,37,84,.04), 0 22px 44px -30px rgba(23,37,84,.4);
        transition: transform .6s cubic-bezier(.16,1,.3,1), box-shadow .6s ease;
    }
    .pk-card:hover, .pk-card:focus-visible {
        transform: translateY(-5px);
        box-shadow: 0 2px 0 rgba(201,162,75,.35), 0 40px 70px -32px rgba(23,37,84,.5);
    }
    .pk-card:focus-visible { outline: 2px solid #c9a24b; outline-offset: 3px; }
    .pk-card::after {
        content: ''; position: absolute; left: 1.5rem; right: 1.5rem; bottom: 0; height: 2px;
        background: linear-gradient(90deg, #c9a24b, #f3d98f, #c9a24b);
        transform: scaleX(0); transform-origin: left; transition: transform .8s cubic-bezier(.16,1,.3,1);
    }
    .pk-card:hover::after, .pk-card:focus-visible::after { transform: scaleX(1); }
    .pk-logo {
        background: radial-gradient(120% 100% at 30% 0%, #ffffff 0%, #f3f6fc 60%, #e6ecf8 100%);
        box-shadow: 0 0 0 1px rgba(201,162,75,.55), 0 10px 22px -12px rgba(23,37,84,.35);
    }
    .pk-link { position: relative; }
    .pk-link::after {
        content: ''; position: absolute; left: 0; right: 0; bottom: -3px; height: 1px;
        background: linear-gradient(90deg, #c9a24b, #f3d98f); transform: scaleX(.3); transform-origin: left;
        transition: transform .6s cubic-bezier(.16,1,.3,1);
    }
    .pk-card:hover .pk-link::after { transform: scaleX(1); }
    @media (prefers-reduced-motion: reduce) {
        .pk-card, .pk-card::after, .pk-link::after { transition: none !important; }
        .pk-card:hover { transform: none; }
    }
</style>
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
    <div class="text-center max-w-2xl mx-auto mb-14" data-aos="fade-up">
        <span class="text-[#9a7318] font-semibold text-sm">{{ $set('home_programs_eyebrow', 'Program Keahlian') }}</span>
        <h2 class="pk-serif text-3xl md:text-[2.6rem] font-bold text-navy-900 mt-2 tracking-tight">{{ $set('home_programs_title', 'Pilih Jalur Keahlianmu') }}</h2>
        <div class="mx-auto mt-5 h-px w-32 bg-gradient-to-r from-transparent via-[#c9a24b] to-transparent"></div>
        <p class="text-slate-500 mt-5 leading-relaxed">Empat program keahlian, satu tujuan: siap kerja dan siap berkarya.</p>
    </div>
    <div class="flex flex-col gap-5 max-w-4xl mx-auto md:max-w-none">
        @foreach($programs as $i => $program)
            @php $isRight = $i % 2 === 0; @endphp
            <a href="{{ route('programs.show', $program->slug) }}" data-aos="{{ $isRight ? 'fade-left' : 'fade-right' }}" data-aos-delay="{{ $i * 90 }}"
                class="pk-card group flex items-center gap-5 md:gap-6 overflow-hidden rounded-2xl bg-white p-5 md:p-6 w-full md:w-[78%] lg:w-[68%] {{ $isRight ? 'md:ml-auto' : 'md:mr-auto' }}">
                @if($program->logo)
                    <div class="pk-logo h-16 w-16 md:h-20 md:w-20 shrink-0 rounded-2xl grid place-items-center overflow-hidden p-2.5 group-hover:scale-105 transition-transform duration-500">
                        <img src="{{ asset('storage/' . $program->logo) }}" class="w-full h-full object-contain" alt="">
                    </div>
                @else
                    <div class="h-16 w-16 md:h-20 md:w-20 shrink-0 rounded-2xl bg-navy-900 text-[#e8c46e] ring-1 ring-[#c9a24b]/60 grid place-items-center font-bold">{{ $program->code }}</div>
                @endif
                <div class="min-w-0">
                    <p class="pk-serif font-bold text-navy-900 text-lg md:text-xl leading-tight">{{ $program->name }}</p>
                    <p class="text-slate-500 text-xs md:text-sm mt-2 leading-relaxed line-clamp-2">
                        {{ $program->description }}
                    </p>
                    <span class="pk-link inline-flex items-center gap-1.5 text-navy-800 text-xs md:text-sm font-semibold mt-3 group-hover:gap-2.5 transition-all duration-300">
                        Lihat Detail <span class="text-[#9a7318]">&rarr;</span>
                    </span>
                </div>
            </a>
        @endforeach
    </div>
</section>