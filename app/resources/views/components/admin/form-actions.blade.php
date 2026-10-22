@props(['cancelRoute', 'cancelLabel' => 'Batal', 'submitLabel' => 'Simpan'])
<div class="flex gap-3 pt-2">
    <button type="submit" class="inline-flex items-center gap-2 px-8 py-3 rounded-xl bg-gradient-to-r from-navy-700 to-navy-900 text-white font-semibold hover:shadow-lg hover:shadow-navy-900/20 transition">
        <i data-lucide="check" class="w-4 h-4"></i> {{ $submitLabel }}
    </button>
    <a href="{{ $cancelRoute }}" class="inline-flex items-center gap-2 px-8 py-3 rounded-xl border border-slate-200 text-slate-600 font-medium hover:bg-slate-50 transition">
        <i data-lucide="x" class="w-4 h-4"></i> {{ $cancelLabel }}
    </a>
</div>
