@extends('layouts.admin')
@section('title', 'Tata Letak Beranda')
@section('content')

<x-admin.page-header
    title="Tata Letak Beranda"
    description="Atur urutan bagian, tampilkan atau sembunyikan, dan ukuran tiap bagian di halaman depan. Perubahan berlaku setelah disimpan."
/>

<form method="POST" action="{{ route('admin.home-layout.update') }}"
      x-data="{
          rows: {{ \Illuminate\Support\Js::from($rows) }},
          move(i, d) { const j = i + d; if (j < 0 || j >= this.rows.length) return; const r = this.rows.splice(i, 1)[0]; this.rows.splice(j, 0, r); },
          shown() { return this.rows.filter(r => r.is_visible).length; }
      }">
    @csrf @method('PUT')

    <div class="mb-4 flex flex-wrap items-center gap-3 text-xs text-slate-500">
        <span>Bagian tampil: <b class="text-slate-700" x-text="shown()"></b> dari <b class="text-slate-700" x-text="rows.length"></b></span>
        <span class="text-slate-300">|</span>
        <span>Gunakan tombol panah untuk mengubah urutan. Urutan di sini = urutan di halaman depan.</span>
    </div>

    <div class="space-y-3">
        <template x-for="(row, i) in rows" :key="row.key">
            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm shadow-slate-100/60 p-4 sm:p-5" :class="!row.is_visible && 'opacity-60'">
                <input type="hidden" :name="`sections[${i}][key]`" :value="row.key">

                <div class="flex flex-wrap items-center gap-3">
                    <div class="flex flex-col">
                        <button type="button" @click="move(i, -1)" :disabled="i === 0" class="h-6 w-8 grid place-items-center rounded text-slate-400 hover:bg-slate-100 hover:text-slate-700 disabled:opacity-30" aria-label="Naik">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"/></svg>
                        </button>
                        <button type="button" @click="move(i, 1)" :disabled="i === rows.length - 1" class="h-6 w-8 grid place-items-center rounded text-slate-400 hover:bg-slate-100 hover:text-slate-700 disabled:opacity-30" aria-label="Turun">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </button>
                    </div>

                    <span class="h-8 w-8 rounded-full bg-navy-50 text-navy-700 text-xs font-semibold grid place-items-center" x-text="i + 1"></span>
                    <p class="font-semibold text-slate-800 text-sm flex-1 min-w-[10rem]" x-text="row.label"></p>

                    <input type="hidden" :name="`sections[${i}][is_visible]`" value="0">
                    <label class="inline-flex items-center gap-2 text-sm text-slate-600 cursor-pointer">
                        <input type="checkbox" :name="`sections[${i}][is_visible]`" value="1" x-model="row.is_visible" class="h-4 w-4 rounded border-slate-300">
                        Tampilkan
                    </label>
                </div>

                <div class="mt-4 grid sm:grid-cols-2 lg:grid-cols-4 gap-3" x-show="row.is_visible">
                    <label class="block text-xs text-slate-500">Jarak atas
                        <select :name="`sections[${i}][space_top]`" x-model="row.space_top" class="mt-1 w-full px-3 py-2 rounded-xl border border-slate-200 text-sm bg-white">
                            <option value="">Bawaan</option><option value="none">Tanpa jarak</option><option value="sm">Kecil</option><option value="md">Sedang</option><option value="lg">Besar</option><option value="xl">Sangat besar</option>
                        </select>
                    </label>
                    <label class="block text-xs text-slate-500">Jarak bawah
                        <select :name="`sections[${i}][space_bottom]`" x-model="row.space_bottom" class="mt-1 w-full px-3 py-2 rounded-xl border border-slate-200 text-sm bg-white">
                            <option value="">Bawaan</option><option value="none">Tanpa jarak</option><option value="sm">Kecil</option><option value="md">Sedang</option><option value="lg">Besar</option><option value="xl">Sangat besar</option>
                        </select>
                    </label>
                    <label class="block text-xs text-slate-500">Lebar isi
                        <select :name="`sections[${i}][content_width]`" x-model="row.content_width" class="mt-1 w-full px-3 py-2 rounded-xl border border-slate-200 text-sm bg-white">
                            <option value="">Bawaan</option><option value="narrow">Sempit</option><option value="wide">Lebar</option><option value="full">Penuh layar</option>
                        </select>
                    </label>
                    <label class="block text-xs text-slate-500">Ukuran judul
                        <select :name="`sections[${i}][title_scale]`" x-model="row.title_scale" class="mt-1 w-full px-3 py-2 rounded-xl border border-slate-200 text-sm bg-white">
                            <option value="">100% (bawaan)</option><option value="0.9">90%</option><option value="1.1">110%</option><option value="1.25">125%</option><option value="1.5">150%</option>
                        </select>
                    </label>
                </div>
            </div>
        </template>
    </div>

    <p class="mt-4 text-xs text-slate-400 leading-relaxed">
        Jarak atas dan bawah adalah ruang kosong di luar bagian. Lebar isi berlaku pada bagian yang memakai kolom isi standar, dan ukuran judul mengubah judul bagian (h2).
        Isi teks tiap bagian tetap diatur di Pengaturan Website.
    </p>

    <div class="mt-6 flex flex-wrap gap-3">
        <button type="submit" class="px-8 py-3 rounded-xl bg-navy-700 text-white font-semibold hover:bg-navy-800 transition">Simpan Tata Letak</button>
        <a href="{{ route('home') }}" target="_blank" rel="noopener" class="px-6 py-3 rounded-xl border border-slate-200 text-slate-600 font-medium hover:bg-slate-50 transition">Lihat Beranda</a>
    </div>
</form>

<form method="POST" action="{{ route('admin.home-layout.reset') }}" class="mt-3" onsubmit="return confirm('Kembalikan urutan dan ukuran semua bagian ke bawaan?')">
    @csrf
    <button class="text-xs font-medium text-red-500 hover:text-red-600">Kembalikan ke bawaan</button>
</form>
@endsection