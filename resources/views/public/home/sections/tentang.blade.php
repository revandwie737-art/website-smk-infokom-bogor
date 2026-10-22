<!-- TENTANG — SCROLL STORYTELLING -->
<section id="tentang" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
    <div class="text-center max-w-2xl mx-auto mb-14" data-aos="fade-up">
        <span class="text-sky-600 font-semibold text-sm">{{ $set('home_about_eyebrow', 'Tentang Kami') }}</span>
        <h2 class="text-3xl md:text-4xl font-extrabold text-navy-900 mt-2">{{ $set('home_about_title', 'Tentang SMK Infokom Bogor') }}</h2>
    </div>
    <div data-story class="grid lg:grid-cols-2 gap-16 items-start">
        <!-- Sticky visual -->
        <div class="lg:sticky lg:top-28">
            <div class="hover-lift rounded-3xl overflow-hidden bg-slate-100 aspect-[4/5] max-h-[560px] flex items-center justify-center relative ring-1 ring-slate-900/10 shadow-xl">
                @if($set('about_image'))
                    <img data-parallax="0.05" src="{{ asset('storage/' . $set('about_image')) }}" class="w-full h-full object-cover scale-110" alt="Siswa SMK Infokom Bogor">
                @else
                    <div class="w-full h-full grid place-items-center text-slate-400 text-sm">Foto kegiatan sekolah</div>
                @endif
                <div class="absolute inset-0 bg-gradient-to-t from-navy-900/30 via-transparent to-transparent"></div>
            </div>
            <div class="flex items-center gap-2 mt-6 justify-center lg:justify-start">
                <span class="story-dot is-active"></span>
                <span class="story-dot"></span>
                <span class="story-dot"></span>
            </div>
        </div>

        <!-- Scrolling chapters -->
        <div class="flex flex-col gap-24 lg:py-10">
            <div class="story-chapter is-active">
                <span class="text-xs font-semibold tracking-widest uppercase text-sky-600">Bab 1 &middot; Cerita Kami</span>
                <h3 class="text-2xl md:text-3xl font-extrabold text-navy-900 mt-3 mb-4">{{ $set('home_about_ch1_title', 'Siapa Kami') }}</h3>
                <p class="text-slate-500 leading-relaxed">{{ $set('about_text') }}</p>
            </div>
            <div class="story-chapter">
                <span class="text-xs font-semibold tracking-widest uppercase text-sky-600">Bab 2 &middot; Arah Tujuan</span>
                <h3 class="text-2xl md:text-3xl font-extrabold text-navy-900 mt-3 mb-4">{{ $set('home_about_ch2_title', 'Visi Kami') }}</h3>
                <div class="p-6 rounded-2xl bg-navy-50">
                    <p class="text-slate-600 leading-relaxed">{{ $set('vision') }}</p>
                </div>
            </div>
            <div class="story-chapter">
                <span class="text-xs font-semibold tracking-widest uppercase text-sky-600">Bab 3 &middot; Langkah Kami</span>
                <h3 class="text-2xl md:text-3xl font-extrabold text-navy-900 mt-3 mb-4">{{ $set('home_about_ch3_title', 'Misi Kami') }}</h3>
                <div class="p-6 rounded-2xl bg-sky-50">
                    <p class="text-slate-600 leading-relaxed whitespace-pre-line">{{ $set('mission') }}</p>
                </div>
            </div>
        </div>
    </div>
</section>