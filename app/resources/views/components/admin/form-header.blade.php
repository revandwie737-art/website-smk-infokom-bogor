@props(['title', 'backRoute', 'description' => null])
<div class="flex items-center gap-3 mb-6 animate-fade-in-up">
    <a href="{{ $backRoute }}" class="h-10 w-10 rounded-xl bg-white border border-slate-200 grid place-items-center text-slate-500 hover:bg-slate-50 hover:text-navy-700 hover:-translate-x-0.5 transition shrink-0">
        <i data-lucide="arrow-left" class="w-4 h-4"></i>
    </a>
    <div>
        <h2 class="text-lg font-bold text-slate-800 leading-tight">{{ $title }}</h2>
        @if($description)<p class="text-xs text-slate-400 mt-0.5">{{ $description }}</p>@endif
    </div>
</div>
