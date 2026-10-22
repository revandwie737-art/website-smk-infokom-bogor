@props(['icon' => 'inbox', 'title' => 'Belum ada data', 'description' => null])
<div class="py-14 text-center animate-fade-in">
    <div class="h-14 w-14 rounded-2xl bg-slate-50 text-slate-300 grid place-items-center mx-auto mb-3">
        <i data-lucide="{{ $icon }}" class="w-6 h-6"></i>
    </div>
    <p class="text-sm font-semibold text-slate-500">{{ $title }}</p>
    @if($description)<p class="text-xs text-slate-400 mt-1">{{ $description }}</p>@endif
</div>
