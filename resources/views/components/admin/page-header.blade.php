@props(['title', 'description' => null, 'cta' => null, 'ctaLabel' => null, 'count' => null, 'countLabel' => null])

<div class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-navy-900 to-slate-900 px-6 sm:px-8 py-8 mb-7 text-white">
    <div class="pointer-events-none absolute -top-10 -right-10 h-48 w-48 rounded-full bg-sky-500/20 blur-3xl"></div>
    <div class="pointer-events-none absolute -bottom-16 -left-10 h-48 w-48 rounded-full bg-navy-500/20 blur-3xl"></div>

    <div class="relative flex flex-wrap items-center justify-between gap-5">
        <div>
            <h1 class="text-xl sm:text-2xl font-bold tracking-tight">{{ $title }}</h1>
            @if($description)
                <p class="text-sm text-slate-300 mt-1.5 max-w-xl">{{ $description }}</p>
            @endif
            @if($count !== null)
                <p class="text-xs text-slate-400 mt-3">{{ $count }} {{ $countLabel }}</p>
            @endif
        </div>

        @if($cta)
            <a href="{{ $cta }}" class="hover-lift inline-flex items-center gap-2 shrink-0 rounded-full bg-white px-5 py-2.5 text-sm font-semibold text-navy-900 hover:bg-slate-100 transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M12 4.5v15m7.5-7.5h-15" /></svg>
                {{ $ctaLabel }}
            </a>
        @endif
    </div>
</div>
