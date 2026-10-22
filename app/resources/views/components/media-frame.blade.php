@props([
    'src' => null,
    'background' => null,
    'ratio' => 'aspect-video',
    'icon' => '🖼️',
    'alt' => '',
    'fit' => 'contain',
    'imgClass' => 'group-hover:scale-105 transition duration-500',
])

<div {{ $attributes->merge(['class' => "relative $ratio overflow-hidden bg-gradient-to-br from-navy-50 to-sky-50"]) }}>
    @if($src)
        {{-- Photo fills the frame edge-to-edge, no blur backdrop, no letterbox bars --}}
        <img src="{{ $src }}" alt="{{ $alt }}" loading="lazy" class="absolute inset-0 w-full h-full object-{{ $fit }} {{ $imgClass }}">
    @else
        <div class="absolute inset-0 grid place-items-center text-navy-200 text-3xl">{{ $icon }}</div>
    @endif
</div>
