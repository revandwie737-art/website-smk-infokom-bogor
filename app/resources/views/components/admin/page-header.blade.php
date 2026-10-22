@props(['title', 'description' => null, 'cta' => null, 'ctaLabel' => null, 'count' => null, 'countLabel' => null])

<div class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-navy-900 via-navy-800 to-slate-900 px-6 sm:px-8 py-8 mb-7 text-white animate-fade-in-up">
    <div class="pointer-events-none absolute -top-10 -right-10 h-56 w-56 rounded-full bg-sky-500/25 blur-3xl animate-float"></div>
    <div class="pointer-events-none absolute -bottom-16 -left-10 h-56 w-56 rounded-full bg-navy-400/20 blur-3xl animate-float-slow"></div>
    <div class="pointer-events-none absolute inset-0 opacity-[0.04]" style="background-image:radial-gradient(circle, #fff 1px, transparent 1px); background-size:22px 22px;"></div>

    <div class="relative flex flex-wrap items-center justify-between gap-5">
        <div>
            <h1 class="text-xl sm:text-2xl font-extrabold tracking-tight">{{ $title }}</h1>
            @if($description)
                <p class="text-sm text-slate-300 mt-1.5 max-w-xl">{{ $description }}</p>
            @endif
            @if($count !== null)
                <p class="inline-flex items-center gap-1.5 text-xs text-slate-300 mt-3 bg-white/10 rounded-full px-3 py-1.5">
                    <span class="h-1.5 w-1.5 rounded-full bg-sky-400 animate-pulse"></span>
                    <span class="font-semibold text-white">{{ $count }}</span> {{ $countLabel }}
                </p>
            @endif
        </div>

        @if($cta)
            <a href="{{ $cta }}" class="group inline-flex items-center gap-2 shrink-0 rounded-full bg-white px-5 py-2.5 text-sm font-semibold text-navy-900 hover:bg-slate-100 shadow-lg shadow-black/10 transition">
                <svg class="w-4 h-4 transition-transform duration-300 group-hover:rotate-90" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M12 4.5v15m7.5-7.5h-15" /></svg>
                {{ $ctaLabel }}
            </a>
        @endif
    </div>
</div>
