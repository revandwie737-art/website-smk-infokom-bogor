@props(['title', 'description' => null, 'icon' => null])

<div class="bg-white rounded-2xl border border-slate-100 shadow-sm shadow-slate-100/60 p-6 sm:p-7 space-y-5 animate-fade-in-up">
    <div class="flex items-start gap-3">
        @if($icon)
            <div class="h-9 w-9 shrink-0 rounded-xl bg-gradient-to-br from-navy-50 to-sky-50 text-navy-700 grid place-items-center text-base ring-1 ring-navy-100/60">{{ $icon }}</div>
        @endif
        <div>
            <p class="font-semibold text-slate-800">{{ $title }}</p>
            @if($description)
                <p class="text-xs text-slate-400 mt-0.5">{{ $description }}</p>
            @endif
        </div>
    </div>
    <div class="space-y-5">
        {{ $slot }}
    </div>
</div>
