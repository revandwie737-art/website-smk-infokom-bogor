@props(['color' => 'slate', 'label'])
<span class="inline-flex items-center gap-1.5 text-xs font-semibold px-2.5 py-1 rounded-full bg-{{ $color }}-50 text-{{ $color }}-600 ring-1 ring-inset ring-{{ $color }}-100">
    <span class="h-1.5 w-1.5 rounded-full bg-{{ $color }}-500"></span>{{ $label }}
</span>
