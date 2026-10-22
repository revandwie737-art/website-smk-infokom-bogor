@props(['href', 'icon' => 'pencil', 'color' => 'sky', 'label' => null, 'target' => null])
<a href="{{ $href }}" @if($target) target="{{ $target }}" @endif title="{{ $label }}"
    class="inline-flex items-center justify-center h-8 w-8 rounded-lg bg-{{ $color }}-50 text-{{ $color }}-600 hover:bg-{{ $color }}-100 transition">
    <i data-lucide="{{ $icon }}" class="w-[15px] h-[15px]"></i>
</a>
