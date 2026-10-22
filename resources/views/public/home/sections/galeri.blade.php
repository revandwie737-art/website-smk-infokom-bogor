<!-- GALERI — MOODBOARD COLLAGE -->
@if($galleries->count())
<section class="relative max-w-full mx-auto px-4 sm:px-6 lg:px-8 py-24 md:py-28 overflow-hidden bg-slate-900" style="background-image: linear-gradient(rgba(15,17,21,.72), rgba(15,17,21,.82)), url('{{ asset('images/backgrounds/paper-grid.png') }}'); background-size: auto 100%; background-repeat: repeat-x; background-position: center;">
    <div class="max-w-7xl mx-auto">
    <div class="text-center max-w-2xl mx-auto mb-4" data-aos="fade-up">
        <span class="text-sky-300 font-semibold text-sm">{{ $set('home_gallery_eyebrow', 'Galeri') }}</span>
        <h2 class="text-3xl font-extrabold text-white mt-2">{{ $set('home_gallery_title', 'Momen di SMK Infokom Bogor') }}</h2>
        <p class="text-slate-300 mt-4">{{ $set('home_gallery_subtitle', 'Klik foto untuk melihat lebih besar.') }}</p>
    </div>
    @php
        // Photo-hole coordinates (percent) measured from the frame asset, with a small inward inset.
        $frameTypes = [
            'newspaper' => ['file' => 'frame-newspaper.png', 'left' => 20.5, 'top' => 17.3, 'w' => 60.1, 'h' => 63.3, 'width' => 360],
        ];
        $order = ['newspaper'];
        $rotations = [-6, 4, -8, 6, -4, 7];
        $liftPx = [0, 26, 10, 32, 4, 20];
    @endphp
    <div class="flex flex-wrap justify-center items-start gap-x-6 md:gap-x-8 gap-y-16 pt-16 pb-10">
        @foreach($galleries as $i => $g)
            @php
                $type = $order[$i % count($order)];
                $f = $frameTypes[$type];
                $rot = $rotations[$i % count($rotations)];
                $lift = $liftPx[$i % count($liftPx)];
            @endphp
            <button type="button" data-aos="zoom-in" data-aos-delay="{{ $i * 80 }}"
                data-lightbox-src="{{ $g->cover ? asset('storage/' . $g->cover) : '' }}"
                data-lightbox-caption="{{ $g->title }}"
                class="group relative shrink-0 transition-transform duration-500 hover:!rotate-0 hover:scale-105 hover:z-30"
                style="width: {{ $f['width'] }}px; transform: rotate({{ $rot }}deg) translateY({{ $lift }}px); z-index: {{ 10 + $i }};">
                <img src="{{ asset('images/frames/' . $f['file']) }}" class="w-full h-auto drop-shadow-xl pointer-events-none select-none" alt="">
                <div class="tilt-3d absolute overflow-hidden bg-navy-50" data-tilt-strength="10" data-tilt-scale="1.06" style="left:{{ $f['left'] }}%; top:{{ $f['top'] }}%; width:{{ $f['w'] }}%; height:{{ $f['h'] }}%;">
                    @if($g->cover)
                        <img src="{{ asset('storage/' . $g->cover) }}" class="w-full h-full object-cover" alt="{{ $g->title }}">
                    @else
                        <div class="w-full h-full grid place-items-center text-navy-200 text-xl bg-navy-50">🖼️</div>
                    @endif
                </div>
            </button>
        @endforeach
    </div>
    <div class="text-center mt-10" data-aos="fade-up">
        <a href="{{ route('gallery.index') }}" class="text-sky-300 font-semibold text-sm hover:text-white hover:underline transition">Lihat Semua Galeri &rarr;</a>
    </div>
    </div>
</section>
@endif