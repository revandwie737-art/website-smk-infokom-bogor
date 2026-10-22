@props(['title', 'description' => null, 'icon' => null])

<div class="hover-lift bg-white rounded-2xl border border-slate-100 shadow-sm shadow-slate-100/60 p-6 sm:p-7 space-y-5">
    <div class="flex items-start gap-3">
        @if($icon)
            <div class="h-9 w-9 shrink-0 rounded-xl bg-navy-50 text-navy-700 grid place-items-center text-base">{{ $icon }}</div>
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
