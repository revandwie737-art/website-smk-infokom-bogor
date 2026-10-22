@props(['eyebrow', 'title', 'description' => null])
<section class="relative overflow-hidden bg-gradient-to-b from-sky-50 via-white to-white pt-32 pb-20 md:pt-40 md:pb-24">
    <div class="absolute inset-0 opacity-[0.35]" style="background-image:radial-gradient(circle, #cbd5e1 1px, transparent 1px); background-size:26px 26px; mask-image: linear-gradient(180deg, black, transparent);"></div>
    <div class="float-a absolute top-10 -right-16 w-72 h-72 rounded-full bg-sky-200/50 blur-3xl pointer-events-none"></div>
    <div class="float-b absolute bottom-0 -left-16 w-64 h-64 rounded-full bg-gold-200/40 blur-3xl pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
        <div class="max-w-2xl">
            <p data-reveal class="text-sky-600 font-medium text-sm mb-3">{{ $eyebrow }}</p>
            <h1 data-reveal data-reveal-delay="1" class="font-display text-4xl md:text-5xl text-navy-900 leading-[1.08]">{{ $title }}</h1>
            @if($description)
                <p data-reveal data-reveal-delay="2" class="text-slate-500 text-lg leading-relaxed mt-6">{{ $description }}</p>
            @endif
        </div>
        @isset($aside)
            <div class="mt-10">{{ $aside }}</div>
        @endisset
    </div>
</section>
