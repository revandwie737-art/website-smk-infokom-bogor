@props([
    'name' => 'photo',
    'label' => 'Foto',
    'help' => null,
    'current' => null,
    'ratio' => 'aspect-video',
])

<div x-data="{ preview: @js($current), dragging: false }">
    <label class="block text-sm font-semibold text-slate-700 mb-2">{{ $label }}</label>

    <label @dragover.prevent="dragging = true" @dragleave.prevent="dragging = false"
        @drop.prevent="dragging = false; $event.dataTransfer.files[0] && (preview = URL.createObjectURL($event.dataTransfer.files[0])); $refs.fileInput.files = $event.dataTransfer.files"
        :class="dragging ? 'border-sky-400 bg-sky-50 scale-[1.02] ring-4 ring-sky-100' : 'border-slate-200 bg-slate-50'"
        class="group relative flex {{ $ratio }} w-full max-w-xs cursor-pointer items-center justify-center overflow-hidden rounded-2xl border-2 border-dashed hover:border-sky-300 hover:bg-sky-50/60 transition-all duration-200">
        <template x-if="preview">
            <img :src="preview" class="absolute inset-0 h-full w-full object-cover" alt="">
        </template>
        <template x-if="!preview">
            <div class="flex flex-col items-center gap-2 px-4 text-center text-slate-400">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M4 16.5V18a2 2 0 002 2h12a2 2 0 002-2v-1.5M7.5 9L12 4.5 16.5 9M12 4.5V15" />
                </svg>
                <span class="text-xs font-medium">Klik untuk unggah foto</span>
            </div>
        </template>

        <div x-show="preview" style="display:none" class="absolute inset-0 flex items-center justify-center bg-navy-900/0 opacity-0 transition group-hover:bg-navy-900/40 group-hover:opacity-100">
            <span class="rounded-full bg-white/90 px-3 py-1 text-xs font-semibold text-navy-800">Ganti foto</span>
        </div>

        <input x-ref="fileInput" type="file" name="{{ $name }}" accept="image/*" class="hidden"
            @change="preview = $event.target.files[0] ? URL.createObjectURL($event.target.files[0]) : preview">
    </label>

    @if($help)
        <p class="text-xs text-slate-400 mt-2 max-w-xs leading-relaxed">{{ $help }}</p>
    @endif
</div>
