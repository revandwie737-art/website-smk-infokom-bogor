@extends('layouts.admin')
@section('title', 'Magang Jepang')
@section('content')

<x-admin.page-header
    title="Magang Jepang"
    description="Foto-foto ini tampil di halaman Magang Jepang. Maksimal 3 foto aktif ditampilkan ke pengunjung."
    cta="{{ route('admin.magang-jepang.create') }}"
    cta-label="Tambah Foto"
    :count="$activeCount"
    count-label="dari 3 foto aktif"
/>

@if($activeCount >= 3)
    <div class="mb-5 rounded-2xl border border-sky-100 bg-sky-50 px-5 py-3.5 text-sm text-sky-800">
        Sudah ada 3 foto aktif. Nonaktifkan salah satu jika ingin mengaktifkan foto lain.
    </div>
@endif

@if($items->isEmpty())
    <div class="rounded-2xl border border-dashed border-slate-200 bg-white px-6 py-14 text-center">
        <p class="text-slate-500 text-sm">Belum ada foto Magang Jepang.</p>
        <a href="{{ route('admin.magang-jepang.create') }}" class="inline-flex mt-4 px-5 py-2.5 rounded-xl bg-navy-700 text-white text-sm font-semibold hover:bg-navy-800 transition">Tambah Foto Pertama</a>
    </div>
@else
    <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-5">
        @foreach($items as $item)
            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm shadow-slate-100/60 overflow-hidden flex flex-col">
                <div class="relative aspect-[3/4] bg-slate-50">
                    <img src="{{ $item->image_url }}" alt="{{ $item->title }}" class="absolute inset-0 h-full w-full object-cover">
                    <span class="absolute top-3 left-3 rounded-full px-2.5 py-1 text-[11px] font-semibold {{ $item->is_active ? 'bg-emerald-500 text-white' : 'bg-slate-700/80 text-white' }}">
                        {{ $item->is_active ? 'Aktif' : 'Nonaktif' }}
                    </span>
                    <span class="absolute top-3 right-3 rounded-full bg-white/90 px-2.5 py-1 text-[11px] font-semibold text-navy-800">Urutan {{ $item->sort_order }}</span>
                </div>
                <div class="p-4 flex-1 flex flex-col">
                    <p class="font-semibold text-slate-800 text-sm leading-snug">{{ $item->title }}</p>
                    @if($item->source_name)
                        <p class="text-xs text-slate-400 mt-1">Sumber: {{ $item->source_name }}</p>
                    @endif
                    <div class="flex items-center gap-4 mt-auto pt-3 border-t border-slate-100">
                        <a href="{{ route('admin.magang-jepang.edit', $item) }}" class="text-sky-600 text-xs font-medium hover:text-sky-700">Edit</a>
                        <form method="POST" action="{{ route('admin.magang-jepang.toggle', $item) }}">
                            @csrf @method('PATCH')
                            <button class="text-slate-500 text-xs font-medium hover:text-slate-700">{{ $item->is_active ? 'Nonaktifkan' : 'Aktifkan' }}</button>
                        </form>
                        <form method="POST" action="{{ route('admin.magang-jepang.destroy', $item) }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')" class="ml-auto">
                            @csrf @method('DELETE')
                            <button class="text-red-500 text-xs font-medium hover:text-red-600">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif
<div id="konten" class="mt-14 space-y-8">

    {{-- ===================== TEKS HALAMAN ===================== --}}
    <section class="bg-white rounded-2xl border border-slate-100 shadow-sm shadow-slate-100/60 overflow-hidden">
        <div class="px-6 py-5 border-b border-slate-100">
            <h2 class="font-semibold text-slate-800">Teks Halaman</h2>
            <p class="text-xs text-slate-400 mt-1 leading-relaxed">Teks utama halaman Magang Jepang. Gunakan baris kosong untuk memisahkan paragraf. Matikan "Tampilkan" untuk menyembunyikan bagian.</p>
        </div>
        <div class="grid lg:grid-cols-3 divide-y lg:divide-y-0 lg:divide-x divide-slate-100">
            @php($labels = ['intro' => 'Kalimat pembuka di bawah judul halaman', 'alumni' => 'Program Khusus Alumni', 'closing' => 'Penutup'])
            @foreach($texts as $text)
                <form method="POST" action="{{ route('admin.magang-jepang.texts.update', $text) }}" class="p-6 space-y-3">
                    @csrf @method('PUT')
                    <p class="text-xs font-semibold text-slate-600">{{ $labels[$text->slug] ?? $text->slug }}</p>
                    <input type="text" name="title" value="{{ $text->title }}" maxlength="150" placeholder="Judul (opsional)" class="w-full px-3.5 py-2 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-sky-300">
                    <textarea name="body" rows="6" maxlength="4000" placeholder="Isi teks" class="w-full px-3.5 py-2 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-sky-300">{{ $text->body }}</textarea>
                    <div class="flex items-center gap-4">
                        <input type="hidden" name="is_active" value="0">
                        <label class="inline-flex items-center gap-2 text-xs text-slate-600"><input type="checkbox" name="is_active" value="1" @checked($text->is_active) class="rounded border-slate-300"> Tampilkan</label>
                        <button class="ml-auto px-5 py-2 rounded-lg bg-navy-700 text-white text-xs font-semibold hover:bg-navy-800">Simpan</button>
                    </div>
                </form>
            @endforeach
        </div>
    </section>

    <div class="grid xl:grid-cols-2 gap-8 items-start">

    <section class="bg-white rounded-2xl border border-slate-100 shadow-sm shadow-slate-100/60 overflow-hidden self-start">
        <div class="px-6 py-5 border-b border-slate-100">
            <h2 class="font-semibold text-slate-800">Alur Magang ke Jepang</h2>
            <p class="text-xs text-slate-400 mt-1 leading-relaxed">Langkah bernomor yang tampil di bagian "Alur Magang ke Jepang". Isi hanya langkah yang benar-benar terjadi. Label waktu hanya tampil kalau kamu isi sendiri. Kosong = bagian ini tidak tampil di halaman publik.</p>
        </div>

        @forelse($flows as $row)
            <div x-data="{ edit: false }" class="px-6 py-4 border-b border-slate-100">
                <div x-show="!edit" class="flex items-start gap-4">
                    <div class="flex-1 min-w-0">
                        @if($row->label)<p class="text-[11px] text-slate-400">{{ $row->label }}</p>@endif
                        <p class="font-medium text-slate-800 text-sm">{{ $row->title }} @unless($row->is_active)<span class="ml-2 rounded-full bg-slate-100 px-2 py-0.5 text-[10px] font-semibold text-slate-500">Nonaktif</span>@endunless</p>
                        @if($row->description)<p class="text-xs text-slate-500 mt-1 leading-relaxed">{{ $row->description }}</p>@endif
                        <p class="text-[11px] text-slate-300 mt-1">Urutan {{ $row->sort_order }}</p>
                    </div>
                    <div class="flex items-center gap-3 shrink-0">
                        <button type="button" @click="edit = true" class="text-sky-600 text-xs font-medium hover:text-sky-700">Edit</button>
                        <form method="POST" action="{{ route('admin.magang-jepang.flows.destroy', $row) }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                            @csrf @method('DELETE')
                            <button class="text-red-500 text-xs font-medium hover:text-red-600">Hapus</button>
                        </form>
                    </div>
                </div>

                <form x-show="edit" x-cloak method="POST" action="{{ route('admin.magang-jepang.flows.update', $row) }}" class="space-y-3">
                    @csrf @method('PUT')
                    <input type="text" name="label" value="{{ $row->label }}" maxlength="80" placeholder="Label waktu (opsional, isi bebas)" class="w-full px-3.5 py-2 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-sky-300">
                    <input type="text" name="title" value="{{ $row->title }}" required maxlength="150" placeholder="Judul langkah" class="w-full px-3.5 py-2 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-sky-300">
                    <textarea name="description" rows="3" maxlength="1000" placeholder="Penjelasan singkat (opsional)" class="w-full px-3.5 py-2 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-sky-300">{{ $row->description }}</textarea>
                    <div class="flex flex-wrap items-center gap-4">
                        <label class="text-xs text-slate-500">Urutan <input type="number" min="0" name="sort_order" value="{{ $row->sort_order }}" class="ml-1 w-20 px-2.5 py-1.5 rounded-lg border border-slate-200 text-sm"></label>
                        <input type="hidden" name="is_active" value="0">
                        <label class="inline-flex items-center gap-2 text-xs text-slate-600"><input type="checkbox" name="is_active" value="1" @checked($row->is_active) class="rounded border-slate-300"> Tampilkan</label>
                        <div class="ml-auto flex gap-2">
                            <button class="px-4 py-2 rounded-lg bg-navy-700 text-white text-xs font-semibold hover:bg-navy-800">Simpan</button>
                            <button type="button" @click="edit = false" class="px-4 py-2 rounded-lg border border-slate-200 text-slate-600 text-xs font-medium hover:bg-slate-50">Batal</button>
                        </div>
                    </div>
                </form>
            </div>
        @empty
            <p class="px-6 py-8 text-sm text-slate-400 text-center">Belum ada langkah alur. Bagian ini tidak tampil di halaman publik.</p>
        @endforelse

        <form method="POST" action="{{ route('admin.magang-jepang.flows.store') }}" class="px-6 py-5 bg-slate-50/70 space-y-3">
            @csrf
            <p class="text-xs font-semibold text-slate-600">Tambah langkah</p>
            <input type="text" name="label" maxlength="80" placeholder="Label waktu (opsional, isi bebas)" class="w-full px-3.5 py-2 rounded-xl border border-slate-200 text-sm bg-white focus:outline-none focus:ring-2 focus:ring-sky-300">
            <input type="text" name="title" required maxlength="150" placeholder="Judul langkah" class="w-full px-3.5 py-2 rounded-xl border border-slate-200 text-sm bg-white focus:outline-none focus:ring-2 focus:ring-sky-300">
            <textarea name="description" rows="2" maxlength="1000" placeholder="Penjelasan singkat (opsional)" class="w-full px-3.5 py-2 rounded-xl border border-slate-200 text-sm bg-white focus:outline-none focus:ring-2 focus:ring-sky-300"></textarea>
            <div class="flex flex-wrap items-center gap-4">
                <label class="text-xs text-slate-500">Urutan <input type="number" min="0" name="sort_order" value="{{ ($flows->max('sort_order') ?? 0) + 1 }}" class="ml-1 w-20 px-2.5 py-1.5 rounded-lg border border-slate-200 text-sm bg-white"></label>
                <input type="hidden" name="is_active" value="1">
                <button class="ml-auto px-5 py-2 rounded-lg bg-navy-700 text-white text-xs font-semibold hover:bg-navy-800">Tambah</button>
            </div>
        </form>
    </section>
    <section class="bg-white rounded-2xl border border-slate-100 shadow-sm shadow-slate-100/60 overflow-hidden self-start">
        <div class="px-6 py-5 border-b border-slate-100">
            <h2 class="font-semibold text-slate-800">Perjalanan Magang Jepang (catatan tambahan)</h2>
            <p class="text-xs text-slate-400 mt-1 leading-relaxed">Foto di atas otomatis menjadi titik di jalur perjalanan. Tambahkan catatan lain di sini (opsional). Label waktu hanya tampil kalau kamu isi sendiri. Urutan dibandingkan dengan urutan foto.</p>
        </div>

        @forelse($steps as $row)
            <div x-data="{ edit: false }" class="px-6 py-4 border-b border-slate-100">
                <div x-show="!edit" class="flex items-start gap-4">
                    <div class="flex-1 min-w-0">
                        @if($row->label)<p class="text-[11px] text-slate-400">{{ $row->label }}</p>@endif
                        <p class="font-medium text-slate-800 text-sm">{{ $row->title }} @unless($row->is_active)<span class="ml-2 rounded-full bg-slate-100 px-2 py-0.5 text-[10px] font-semibold text-slate-500">Nonaktif</span>@endunless</p>
                        @if($row->description)<p class="text-xs text-slate-500 mt-1 leading-relaxed">{{ $row->description }}</p>@endif
                        <p class="text-[11px] text-slate-300 mt-1">Urutan {{ $row->sort_order }}</p>
                    </div>
                    <div class="flex items-center gap-3 shrink-0">
                        <button type="button" @click="edit = true" class="text-sky-600 text-xs font-medium hover:text-sky-700">Edit</button>
                        <form method="POST" action="{{ route('admin.magang-jepang.steps.destroy', $row) }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                            @csrf @method('DELETE')
                            <button class="text-red-500 text-xs font-medium hover:text-red-600">Hapus</button>
                        </form>
                    </div>
                </div>

                <form x-show="edit" x-cloak method="POST" action="{{ route('admin.magang-jepang.steps.update', $row) }}" class="space-y-3">
                    @csrf @method('PUT')
                    <input type="text" name="label" value="{{ $row->label }}" maxlength="80" placeholder="Label waktu (opsional, isi bebas)" class="w-full px-3.5 py-2 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-sky-300">
                    <input type="text" name="title" value="{{ $row->title }}" required maxlength="150" placeholder="Judul catatan" class="w-full px-3.5 py-2 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-sky-300">
                    <textarea name="description" rows="3" maxlength="1000" placeholder="Penjelasan singkat (opsional)" class="w-full px-3.5 py-2 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-sky-300">{{ $row->description }}</textarea>
                    <div class="flex flex-wrap items-center gap-4">
                        <label class="text-xs text-slate-500">Urutan <input type="number" min="0" name="sort_order" value="{{ $row->sort_order }}" class="ml-1 w-20 px-2.5 py-1.5 rounded-lg border border-slate-200 text-sm"></label>
                        <input type="hidden" name="is_active" value="0">
                        <label class="inline-flex items-center gap-2 text-xs text-slate-600"><input type="checkbox" name="is_active" value="1" @checked($row->is_active) class="rounded border-slate-300"> Tampilkan</label>
                        <div class="ml-auto flex gap-2">
                            <button class="px-4 py-2 rounded-lg bg-navy-700 text-white text-xs font-semibold hover:bg-navy-800">Simpan</button>
                            <button type="button" @click="edit = false" class="px-4 py-2 rounded-lg border border-slate-200 text-slate-600 text-xs font-medium hover:bg-slate-50">Batal</button>
                        </div>
                    </div>
                </form>
            </div>
        @empty
            <p class="px-6 py-8 text-sm text-slate-400 text-center">Belum ada catatan tambahan. Jalur perjalanan tetap tampil dari foto.</p>
        @endforelse

        <form method="POST" action="{{ route('admin.magang-jepang.steps.store') }}" class="px-6 py-5 bg-slate-50/70 space-y-3">
            @csrf
            <p class="text-xs font-semibold text-slate-600">Tambah catatan</p>
            <input type="text" name="label" maxlength="80" placeholder="Label waktu (opsional, isi bebas)" class="w-full px-3.5 py-2 rounded-xl border border-slate-200 text-sm bg-white focus:outline-none focus:ring-2 focus:ring-sky-300">
            <input type="text" name="title" required maxlength="150" placeholder="Judul catatan" class="w-full px-3.5 py-2 rounded-xl border border-slate-200 text-sm bg-white focus:outline-none focus:ring-2 focus:ring-sky-300">
            <textarea name="description" rows="2" maxlength="1000" placeholder="Penjelasan singkat (opsional)" class="w-full px-3.5 py-2 rounded-xl border border-slate-200 text-sm bg-white focus:outline-none focus:ring-2 focus:ring-sky-300"></textarea>
            <div class="flex flex-wrap items-center gap-4">
                <label class="text-xs text-slate-500">Urutan <input type="number" min="0" name="sort_order" value="{{ ($steps->max('sort_order') ?? 0) + 1 }}" class="ml-1 w-20 px-2.5 py-1.5 rounded-lg border border-slate-200 text-sm bg-white"></label>
                <input type="hidden" name="is_active" value="1">
                <button class="ml-auto px-5 py-2 rounded-lg bg-navy-700 text-white text-xs font-semibold hover:bg-navy-800">Tambah</button>
            </div>
        </form>
    </section>

    <section class="bg-white rounded-2xl border border-slate-100 shadow-sm shadow-slate-100/60 overflow-hidden self-start">
        <div class="px-6 py-5 border-b border-slate-100">
            <h2 class="font-semibold text-slate-800">Pengalaman yang Didapat</h2>
            <p class="text-xs text-slate-400 mt-1 leading-relaxed">Kosong = bagian ini tidak tampil di halaman publik. Isi hanya pengalaman nyata dari para alumni.</p>
        </div>

        @forelse($experiences as $row)
            <div x-data="{ edit: false }" class="px-6 py-4 border-b border-slate-100">
                <div x-show="!edit" class="flex items-start gap-4">
                    <div class="flex-1 min-w-0">
                        <p class="font-medium text-slate-800 text-sm">{{ $row->title }} @unless($row->is_active)<span class="ml-2 rounded-full bg-slate-100 px-2 py-0.5 text-[10px] font-semibold text-slate-500">Nonaktif</span>@endunless</p>
                        @if($row->description)<p class="text-xs text-slate-500 mt-1 leading-relaxed">{{ $row->description }}</p>@endif
                        <p class="text-[11px] text-slate-300 mt-1">Urutan {{ $row->sort_order }}</p>
                    </div>
                    <div class="flex items-center gap-3 shrink-0">
                        <button type="button" @click="edit = true" class="text-sky-600 text-xs font-medium hover:text-sky-700">Edit</button>
                        <form method="POST" action="{{ route('admin.magang-jepang.experiences.destroy', $row) }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                            @csrf @method('DELETE')
                            <button class="text-red-500 text-xs font-medium hover:text-red-600">Hapus</button>
                        </form>
                    </div>
                </div>

                <form x-show="edit" x-cloak method="POST" action="{{ route('admin.magang-jepang.experiences.update', $row) }}" class="space-y-3">
                    @csrf @method('PUT')
                    <input type="text" name="title" value="{{ $row->title }}" required maxlength="150" placeholder="Judul pengalaman" class="w-full px-3.5 py-2 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-sky-300">
                    <textarea name="description" rows="3" maxlength="1000" placeholder="Penjelasan singkat (opsional)" class="w-full px-3.5 py-2 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-sky-300">{{ $row->description }}</textarea>
                    <div class="flex flex-wrap items-center gap-4">
                        <label class="text-xs text-slate-500">Urutan <input type="number" min="0" name="sort_order" value="{{ $row->sort_order }}" class="ml-1 w-20 px-2.5 py-1.5 rounded-lg border border-slate-200 text-sm"></label>
                        <input type="hidden" name="is_active" value="0">
                        <label class="inline-flex items-center gap-2 text-xs text-slate-600"><input type="checkbox" name="is_active" value="1" @checked($row->is_active) class="rounded border-slate-300"> Tampilkan</label>
                        <div class="ml-auto flex gap-2">
                            <button class="px-4 py-2 rounded-lg bg-navy-700 text-white text-xs font-semibold hover:bg-navy-800">Simpan</button>
                            <button type="button" @click="edit = false" class="px-4 py-2 rounded-lg border border-slate-200 text-slate-600 text-xs font-medium hover:bg-slate-50">Batal</button>
                        </div>
                    </div>
                </form>
            </div>
        @empty
            <p class="px-6 py-8 text-sm text-slate-400 text-center">Belum ada pengalaman. Bagian ini tidak tampil di halaman publik.</p>
        @endforelse

        <form method="POST" action="{{ route('admin.magang-jepang.experiences.store') }}" class="px-6 py-5 bg-slate-50/70 space-y-3">
            @csrf
            <p class="text-xs font-semibold text-slate-600">Tambah pengalaman</p>
            <input type="text" name="title" required maxlength="150" placeholder="Judul pengalaman" class="w-full px-3.5 py-2 rounded-xl border border-slate-200 text-sm bg-white focus:outline-none focus:ring-2 focus:ring-sky-300">
            <textarea name="description" rows="2" maxlength="1000" placeholder="Penjelasan singkat (opsional)" class="w-full px-3.5 py-2 rounded-xl border border-slate-200 text-sm bg-white focus:outline-none focus:ring-2 focus:ring-sky-300"></textarea>
            <div class="flex flex-wrap items-center gap-4">
                <label class="text-xs text-slate-500">Urutan <input type="number" min="0" name="sort_order" value="{{ ($experiences->max('sort_order') ?? 0) + 1 }}" class="ml-1 w-20 px-2.5 py-1.5 rounded-lg border border-slate-200 text-sm bg-white"></label>
                <input type="hidden" name="is_active" value="1">
                <button class="ml-auto px-5 py-2 rounded-lg bg-navy-700 text-white text-xs font-semibold hover:bg-navy-800">Tambah</button>
            </div>
        </form>
    </section>

    <section class="bg-white rounded-2xl border border-slate-100 shadow-sm shadow-slate-100/60 overflow-hidden self-start">
        <div class="px-6 py-5 border-b border-slate-100">
            <h2 class="font-semibold text-slate-800">Tujuan Program</h2>
            <p class="text-xs text-slate-400 mt-1 leading-relaxed">Kosong atau nonaktif = tidak tampil. Empat draf lama sudah dinonaktifkan; aktifkan atau tulis ulang jika sudah sesuai fakta.</p>
        </div>

        @forelse($goals as $row)
            <div x-data="{ edit: false }" class="px-6 py-4 border-b border-slate-100">
                <div x-show="!edit" class="flex items-start gap-4">
                    <div class="flex-1 min-w-0">
                        <p class="font-medium text-slate-800 text-sm">{{ $row->title }} @unless($row->is_active)<span class="ml-2 rounded-full bg-slate-100 px-2 py-0.5 text-[10px] font-semibold text-slate-500">Nonaktif</span>@endunless</p>
                        @if($row->description)<p class="text-xs text-slate-500 mt-1 leading-relaxed">{{ $row->description }}</p>@endif
                        <p class="text-[11px] text-slate-300 mt-1">Urutan {{ $row->sort_order }}</p>
                    </div>
                    <div class="flex items-center gap-3 shrink-0">
                        <button type="button" @click="edit = true" class="text-sky-600 text-xs font-medium hover:text-sky-700">Edit</button>
                        <form method="POST" action="{{ route('admin.magang-jepang.goals.destroy', $row) }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                            @csrf @method('DELETE')
                            <button class="text-red-500 text-xs font-medium hover:text-red-600">Hapus</button>
                        </form>
                    </div>
                </div>

                <form x-show="edit" x-cloak method="POST" action="{{ route('admin.magang-jepang.goals.update', $row) }}" class="space-y-3">
                    @csrf @method('PUT')
                    <input type="text" name="title" value="{{ $row->title }}" required maxlength="150" placeholder="Judul tujuan" class="w-full px-3.5 py-2 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-sky-300">
                    <textarea name="description" rows="3" maxlength="1000" placeholder="Penjelasan singkat (opsional)" class="w-full px-3.5 py-2 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-sky-300">{{ $row->description }}</textarea>
                    <div class="flex flex-wrap items-center gap-4">
                        <label class="text-xs text-slate-500">Urutan <input type="number" min="0" name="sort_order" value="{{ $row->sort_order }}" class="ml-1 w-20 px-2.5 py-1.5 rounded-lg border border-slate-200 text-sm"></label>
                        <input type="hidden" name="is_active" value="0">
                        <label class="inline-flex items-center gap-2 text-xs text-slate-600"><input type="checkbox" name="is_active" value="1" @checked($row->is_active) class="rounded border-slate-300"> Tampilkan</label>
                        <div class="ml-auto flex gap-2">
                            <button class="px-4 py-2 rounded-lg bg-navy-700 text-white text-xs font-semibold hover:bg-navy-800">Simpan</button>
                            <button type="button" @click="edit = false" class="px-4 py-2 rounded-lg border border-slate-200 text-slate-600 text-xs font-medium hover:bg-slate-50">Batal</button>
                        </div>
                    </div>
                </form>
            </div>
        @empty
            <p class="px-6 py-8 text-sm text-slate-400 text-center">Belum ada tujuan program. Bagian ini tidak tampil di halaman publik.</p>
        @endforelse

        <form method="POST" action="{{ route('admin.magang-jepang.goals.store') }}" class="px-6 py-5 bg-slate-50/70 space-y-3">
            @csrf
            <p class="text-xs font-semibold text-slate-600">Tambah tujuan</p>
            <input type="text" name="title" required maxlength="150" placeholder="Judul tujuan" class="w-full px-3.5 py-2 rounded-xl border border-slate-200 text-sm bg-white focus:outline-none focus:ring-2 focus:ring-sky-300">
            <textarea name="description" rows="2" maxlength="1000" placeholder="Penjelasan singkat (opsional)" class="w-full px-3.5 py-2 rounded-xl border border-slate-200 text-sm bg-white focus:outline-none focus:ring-2 focus:ring-sky-300"></textarea>
            <div class="flex flex-wrap items-center gap-4">
                <label class="text-xs text-slate-500">Urutan <input type="number" min="0" name="sort_order" value="{{ ($goals->max('sort_order') ?? 0) + 1 }}" class="ml-1 w-20 px-2.5 py-1.5 rounded-lg border border-slate-200 text-sm bg-white"></label>
                <input type="hidden" name="is_active" value="1">
                <button class="ml-auto px-5 py-2 rounded-lg bg-navy-700 text-white text-xs font-semibold hover:bg-navy-800">Tambah</button>
            </div>
        </form>
    </section>

    <section class="bg-white rounded-2xl border border-slate-100 shadow-sm shadow-slate-100/60 overflow-hidden self-start">
        <div class="px-6 py-5 border-b border-slate-100">
            <h2 class="font-semibold text-slate-800">Informasi Program</h2>
            <p class="text-xs text-slate-400 mt-1 leading-relaxed">Data singkat label dan isi, contoh: Durasi → isi sesuai data resmi. Kosong = tidak tampil di halaman publik.</p>
        </div>

        @forelse($facts as $row)
            <div x-data="{ edit: false }" class="px-6 py-4 border-b border-slate-100">
                <div x-show="!edit" class="flex items-start gap-4">
                    <div class="flex-1 min-w-0">
                        <p class="text-[11px] text-slate-400">{{ $row->label }} @unless($row->is_active)<span class="ml-2 rounded-full bg-slate-100 px-2 py-0.5 text-[10px] font-semibold text-slate-500">Nonaktif</span>@endunless</p>
                        <p class="font-medium text-slate-800 text-sm mt-0.5">{{ $row->value }}</p>
                    </div>
                    <div class="flex items-center gap-3 shrink-0">
                        <button type="button" @click="edit = true" class="text-sky-600 text-xs font-medium hover:text-sky-700">Edit</button>
                        <form method="POST" action="{{ route('admin.magang-jepang.facts.destroy', $row) }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                            @csrf @method('DELETE')
                            <button class="text-red-500 text-xs font-medium hover:text-red-600">Hapus</button>
                        </form>
                    </div>
                </div>

                <form x-show="edit" x-cloak method="POST" action="{{ route('admin.magang-jepang.facts.update', $row) }}" class="space-y-3">
                    @csrf @method('PUT')
                    <input type="text" name="label" value="{{ $row->label }}" required maxlength="80" placeholder="Label, contoh: Durasi" class="w-full px-3.5 py-2 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-sky-300">
                    <input type="text" name="value" value="{{ $row->value }}" required maxlength="200" placeholder="Isi" class="w-full px-3.5 py-2 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-sky-300">
                    <div class="flex flex-wrap items-center gap-4">
                        <label class="text-xs text-slate-500">Urutan <input type="number" min="0" name="sort_order" value="{{ $row->sort_order }}" class="ml-1 w-20 px-2.5 py-1.5 rounded-lg border border-slate-200 text-sm"></label>
                        <input type="hidden" name="is_active" value="0">
                        <label class="inline-flex items-center gap-2 text-xs text-slate-600"><input type="checkbox" name="is_active" value="1" @checked($row->is_active) class="rounded border-slate-300"> Tampilkan</label>
                        <div class="ml-auto flex gap-2">
                            <button class="px-4 py-2 rounded-lg bg-navy-700 text-white text-xs font-semibold hover:bg-navy-800">Simpan</button>
                            <button type="button" @click="edit = false" class="px-4 py-2 rounded-lg border border-slate-200 text-slate-600 text-xs font-medium hover:bg-slate-50">Batal</button>
                        </div>
                    </div>
                </form>
            </div>
        @empty
            <p class="px-6 py-8 text-sm text-slate-400 text-center">Belum ada informasi program. Bagian ini tidak tampil di halaman publik.</p>
        @endforelse

        <form method="POST" action="{{ route('admin.magang-jepang.facts.store') }}" class="px-6 py-5 bg-slate-50/70 space-y-3">
            @csrf
            <p class="text-xs font-semibold text-slate-600">Tambah informasi</p>
            <input type="text" name="label" required maxlength="80" placeholder="Label, contoh: Durasi" class="w-full px-3.5 py-2 rounded-xl border border-slate-200 text-sm bg-white focus:outline-none focus:ring-2 focus:ring-sky-300">
            <input type="text" name="value" required maxlength="200" placeholder="Isi" class="w-full px-3.5 py-2 rounded-xl border border-slate-200 text-sm bg-white focus:outline-none focus:ring-2 focus:ring-sky-300">
            <div class="flex flex-wrap items-center gap-4">
                <label class="text-xs text-slate-500">Urutan <input type="number" min="0" name="sort_order" value="{{ ($facts->max('sort_order') ?? 0) + 1 }}" class="ml-1 w-20 px-2.5 py-1.5 rounded-lg border border-slate-200 text-sm bg-white"></label>
                <input type="hidden" name="is_active" value="1">
                <button class="ml-auto px-5 py-2 rounded-lg bg-navy-700 text-white text-xs font-semibold hover:bg-navy-800">Tambah</button>
            </div>
        </form>
    </section>
    </div>
</div>
@endsection