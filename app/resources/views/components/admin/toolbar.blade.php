@props(['searchName' => 'q', 'placeholder' => 'Cari...', 'createRoute' => null, 'createLabel' => 'Tambah', 'showSearch' => true])
<div class="flex flex-wrap items-center justify-between gap-3 mb-6 animate-fade-in-up">
    @if($showSearch)
        <form method="GET" class="flex gap-2 flex-1 max-w-sm min-w-[220px]">
            <div class="relative flex-1">
                <i data-lucide="search" class="w-4 h-4 absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400"></i>
                <input type="text" name="{{ $searchName }}" value="{{ request($searchName) }}" placeholder="{{ $placeholder }}"
                    class="w-full pl-9 pr-3 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-sky-300 focus:border-sky-300 transition">
            </div>
            <button class="px-4 py-2.5 rounded-xl bg-slate-100 text-slate-600 text-sm font-medium hover:bg-slate-200 transition inline-flex items-center gap-1.5">
                <i data-lucide="search" class="w-3.5 h-3.5"></i> Cari
            </button>
        </form>
    @else
        <div></div>
    @endif

    @if($createRoute)
        <a href="{{ $createRoute }}" class="group inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-gradient-to-r from-navy-700 to-navy-900 text-white text-sm font-semibold shadow-sm hover:shadow-lg hover:shadow-navy-900/20 transition shrink-0">
            <i data-lucide="plus" class="w-4 h-4 transition-transform duration-300 group-hover:rotate-90"></i> {{ $createLabel }}
        </a>
    @endif
</div>
