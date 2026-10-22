@extends('layouts.admin')
@section('title', 'Pengaturan Website')
@section('content')

<form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data" class="space-y-6" x-data="{ tab: 'umum' }">
    @csrf

    <div class="flex flex-wrap gap-2 bg-white rounded-2xl border border-slate-100 p-2">
        @foreach(['umum' => 'Umum', 'hero' => 'Hero', 'tentang' => 'Tentang & Kepala Sekolah', 'statistik' => 'Statistik Sekolah', 'halaman' => 'Judul Halaman', 'akademik' => 'Akademik', 'pkl' => 'PKL', 'bkk' => 'BKK', 'kontak' => 'Kontak & Sosmed', 'ppdb' => 'Biaya PPDB', 'seo' => 'SEO', 'section' => 'Tampilan Section'] as $key => $label)
            <button type="button" @click="tab = '{{ $key }}'" :class="tab === '{{ $key }}' ? 'bg-navy-700 text-white' : 'text-slate-500 hover:bg-slate-50'"
                class="px-4 py-2 rounded-xl text-sm font-medium transition">{{ $label }}</button>
        @endforeach
    </div>

    <div x-show="tab === 'umum'" class="bg-white rounded-2xl border border-slate-100 p-6 space-y-5">
        <div>
            <label class="block text-sm font-medium text-slate-600 mb-1.5">Nama Situs</label>
            <input type="text" name="site_name" value="{{ old('site_name', $settings['site_name'] ?? '') }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
        </div>
        <div>
            <label class="block text-sm font-medium text-slate-600 mb-1.5">Deskripsi Situs</label>
            <textarea name="site_description" rows="2" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">{{ old('site_description', $settings['site_description'] ?? '') }}</textarea>
        </div>
        <div class="grid sm:grid-cols-2 gap-5">
            <div>
                <label class="block text-sm font-medium text-slate-600 mb-1.5">Logo</label>
                @if(!empty($settings['site_logo'])) <img src="{{ asset('storage/' . $settings['site_logo']) }}" class="h-12 mb-2"> @endif
                <input type="file" name="site_logo" class="w-full text-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-600 mb-1.5">Favicon</label>
                @if(!empty($settings['site_favicon'])) <img src="{{ asset('storage/' . $settings['site_favicon']) }}" class="h-12 mb-2"> @endif
                <input type="file" name="site_favicon" class="w-full text-sm">
            </div>
        </div>
        <div>
            <label class="block text-sm font-medium text-slate-600 mb-1.5">Teks Copyright Footer</label>
            <input type="text" name="footer_copyright" value="{{ old('footer_copyright', $settings['footer_copyright'] ?? '') }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
        </div>
    </div>

    <div x-show="tab === 'hero'" style="display:none" class="bg-white rounded-2xl border border-slate-100 p-6 space-y-5">
        <div>
            <label class="block text-sm font-medium text-slate-600 mb-1.5">Judul Hero</label>
            <input type="text" name="hero_title" value="{{ old('hero_title', $settings['hero_title'] ?? '') }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
        </div>
        <div>
            <label class="block text-sm font-medium text-slate-600 mb-1.5">Subjudul Hero</label>
            <textarea name="hero_subtitle" rows="3" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">{{ old('hero_subtitle', $settings['hero_subtitle'] ?? '') }}</textarea>
        </div>
        <div>
            <label class="block text-sm font-medium text-slate-600 mb-1.5">Foto Hero (Beranda)</label>
            @if(!empty($settings['hero_image'])) <img src="{{ asset('storage/' . $settings['hero_image']) }}" class="h-32 rounded-xl mb-2 object-contain"> @endif
            <input type="file" name="hero_image" class="w-full text-sm">
        </div>
    </div>

    <div x-show="tab === 'tentang'" style="display:none" class="bg-white rounded-2xl border border-slate-100 p-6 space-y-5">
        <div>
            <label class="block text-sm font-medium text-slate-600 mb-1.5">Tentang Sekolah</label>
            <textarea name="about_text" rows="4" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">{{ old('about_text', $settings['about_text'] ?? '') }}</textarea>
        </div>
        <div class="grid sm:grid-cols-2 gap-5">
            <div>
                <label class="block text-sm font-medium text-slate-600 mb-1.5">Visi</label>
                <textarea name="vision" rows="3" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">{{ old('vision', $settings['vision'] ?? '') }}</textarea>
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-600 mb-1.5">Misi</label>
                <textarea name="mission" rows="3" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">{{ old('mission', $settings['mission'] ?? '') }}</textarea>
            </div>
        </div>
        <div>
            <label class="block text-sm font-medium text-slate-600 mb-1.5">Gambar Siswa (Tentang Kami)</label>
            @if(!empty($settings['about_image'])) <img src="{{ asset('storage/' . $settings['about_image']) }}" class="h-32 rounded-xl mb-2 object-contain"> @endif
            <input type="file" name="about_image" class="w-full text-sm">
            <p class="text-xs text-slate-400 mt-1">Kosongkan jika tidak ingin mengganti gambar.</p>
        </div>
        <hr class="border-slate-100">
        <p class="font-semibold text-slate-700">Sambutan Kepala Sekolah</p>
        <div class="grid sm:grid-cols-2 gap-5">
            <div>
                <label class="block text-sm font-medium text-slate-600 mb-1.5">Nama Kepala Sekolah</label>
                <input type="text" name="principal_name" value="{{ old('principal_name', $settings['principal_name'] ?? '') }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-600 mb-1.5">Jabatan</label>
                <input type="text" name="principal_position" value="{{ old('principal_position', $settings['principal_position'] ?? '') }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
            </div>
        </div>
        <div>
            <label class="block text-sm font-medium text-slate-600 mb-1.5">Foto Kepala Sekolah</label>
            @if(!empty($settings['principal_photo'])) <img src="{{ asset('storage/' . $settings['principal_photo']) }}" class="h-24 rounded-xl mb-2"> @endif
            <input type="file" name="principal_photo" class="w-full text-sm">
        </div>
        <div>
            <label class="block text-sm font-medium text-slate-600 mb-1.5">Isi Sambutan</label>
            <textarea name="principal_message" rows="4" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">{{ old('principal_message', $settings['principal_message'] ?? '') }}</textarea>
        </div>
    </div>

    <div x-show="tab === 'kontak'" style="display:none" class="bg-white rounded-2xl border border-slate-100 p-6 space-y-5">
        <div class="grid sm:grid-cols-2 gap-5">
            <div>
                <label class="block text-sm font-medium text-slate-600 mb-1.5">Telepon</label>
                <input type="text" name="phone" value="{{ old('phone', $settings['phone'] ?? '') }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-600 mb-1.5">Email</label>
                <input type="email" name="email" value="{{ old('email', $settings['email'] ?? '') }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
            </div>
        </div>
        <div>
            <label class="block text-sm font-medium text-slate-600 mb-1.5">Jam Operasional</label>
            <input type="text" name="jam_operasional" value="{{ old('jam_operasional', $settings['jam_operasional'] ?? '') }}" placeholder="cth: Senin - Jumat : 07.00 - 17.00 WIB" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
        </div>
        <div>
            <label class="block text-sm font-medium text-slate-600 mb-1.5">Alamat</label>
            <textarea name="address" rows="2" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">{{ old('address', $settings['address'] ?? '') }}</textarea>
        </div>
        <div class="grid sm:grid-cols-2 gap-5">
            <div>
                <label class="block text-sm font-medium text-slate-600 mb-1.5">Facebook</label>
                <input type="text" name="facebook" value="{{ old('facebook', $settings['facebook'] ?? '') }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-600 mb-1.5">Instagram</label>
                <input type="text" name="instagram" value="{{ old('instagram', $settings['instagram'] ?? '') }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-600 mb-1.5">YouTube</label>
                <input type="text" name="youtube" value="{{ old('youtube', $settings['youtube'] ?? '') }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-600 mb-1.5">WhatsApp (Humas)</label>
                <input type="text" name="whatsapp" value="{{ old('whatsapp', $settings['whatsapp'] ?? '') }}" placeholder="cth: 0878-7307-1400 (Humas SMK Infokom)" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
            </div>
        </div>
        <div>
            <label class="block text-sm font-medium text-slate-600 mb-1.5">Google Maps URL</label>
            <input type="text" name="google_maps_url" value="{{ old('google_maps_url', $settings['google_maps_url'] ?? '') }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
        </div>
    </div>

    <div x-show="tab === 'statistik'" style="display:none" class="bg-white rounded-2xl border border-slate-100 p-6 space-y-5">
        <p class="text-sm text-slate-400">Angka-angka ini tampil di section statistik beranda, halaman Akademik, dan PPDB. Isi sesuai data resmi sekolah — jangan mengarang angka.</p>
        <div class="grid sm:grid-cols-2 gap-5">
            <div>
                <label class="block text-sm font-medium text-slate-600 mb-1.5">Akreditasi</label>
                <input type="text" name="akreditasi" value="{{ old('akreditasi', $settings['akreditasi'] ?? '') }}" placeholder="cth: A" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-600 mb-1.5">Jumlah Guru</label>
                <input type="number" name="jumlah_guru" value="{{ old('jumlah_guru', $settings['jumlah_guru'] ?? '') }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-600 mb-1.5">Siswa Laki-laki</label>
                <input type="number" name="siswa_laki" value="{{ old('siswa_laki', $settings['siswa_laki'] ?? '') }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-600 mb-1.5">Siswa Perempuan</label>
                <input type="number" name="siswa_perempuan" value="{{ old('siswa_perempuan', $settings['siswa_perempuan'] ?? '') }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-600 mb-1.5">Rombongan Belajar</label>
                <input type="number" name="rombel" value="{{ old('rombel', $settings['rombel'] ?? '') }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-600 mb-1.5">Ruang Kelas</label>
                <input type="number" name="ruang_kelas" value="{{ old('ruang_kelas', $settings['ruang_kelas'] ?? '') }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-600 mb-1.5">Laboratorium</label>
                <input type="number" name="laboratorium" value="{{ old('laboratorium', $settings['laboratorium'] ?? '') }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-600 mb-1.5">Perpustakaan</label>
                <input type="number" name="perpustakaan" value="{{ old('perpustakaan', $settings['perpustakaan'] ?? '') }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
            </div>
        </div>
    </div>

    <div x-show="tab === 'halaman'" style="display:none" class="bg-white rounded-2xl border border-slate-100 p-6 space-y-8">
        <p class="text-sm text-slate-400">Label kecil, judul besar, dan subjudul yang tampil di bagian atas tiap halaman publik. Kosongkan untuk memakai teks bawaan.</p>
        <div class="pt-4 border-t border-slate-100 first:pt-0 first:border-0">
            <p class="font-semibold text-navy-800 text-sm mb-3">Halaman Fasilitas</p>
            <div class="grid sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-slate-600 mb-1.5">Label Kecil</label>
                    <input type="text" name="facilities_badge" value="{{ old('facilities_badge', $settings['facilities_badge'] ?? '') }}" placeholder="Fasilitas" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-600 mb-1.5">Judul</label>
                    <input type="text" name="facilities_title" value="{{ old('facilities_title', $settings['facilities_title'] ?? '') }}" placeholder="Fasilitas SMK Infokom Bogor" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
                </div>
            </div>
            <div class="mt-4">
                <label class="block text-sm font-medium text-slate-600 mb-1.5">Subjudul</label>
                <textarea name="facilities_subtitle" rows="2" placeholder="Sarana dan prasarana yang mendukung proses belajar mengajar." class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">{{ old('facilities_subtitle', $settings['facilities_subtitle'] ?? '') }}</textarea>
            </div>
        </div>
        <div class="pt-4 border-t border-slate-100 first:pt-0 first:border-0">
            <p class="font-semibold text-navy-800 text-sm mb-3">Halaman Program Keahlian</p>
            <div class="grid sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-slate-600 mb-1.5">Label Kecil</label>
                    <input type="text" name="programs_badge" value="{{ old('programs_badge', $settings['programs_badge'] ?? '') }}" placeholder="Program Keahlian" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-600 mb-1.5">Judul</label>
                    <input type="text" name="programs_title" value="{{ old('programs_title', $settings['programs_title'] ?? '') }}" placeholder="Program Keahlian SMK Infokom Bogor" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
                </div>
            </div>
            <div class="mt-4">
                <label class="block text-sm font-medium text-slate-600 mb-1.5">Subjudul</label>
                <textarea name="programs_subtitle" rows="2" placeholder="Empat program keahlian yang dirancang sesuai kebutuhan industri kreatif dan teknologi." class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">{{ old('programs_subtitle', $settings['programs_subtitle'] ?? '') }}</textarea>
            </div>
        </div>
        <div class="pt-4 border-t border-slate-100 first:pt-0 first:border-0">
            <p class="font-semibold text-navy-800 text-sm mb-3">Halaman Galeri</p>
            <div class="grid sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-slate-600 mb-1.5">Label Kecil</label>
                    <input type="text" name="gallery_badge" value="{{ old('gallery_badge', $settings['gallery_badge'] ?? '') }}" placeholder="Galeri" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-600 mb-1.5">Judul</label>
                    <input type="text" name="gallery_title" value="{{ old('gallery_title', $settings['gallery_title'] ?? '') }}" placeholder="Galeri Kegiatan Sekolah" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
                </div>
            </div>
        </div>
        <div class="pt-4 border-t border-slate-100 first:pt-0 first:border-0">
            <p class="font-semibold text-navy-800 text-sm mb-3">Halaman Akademik</p>
            <div class="grid sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-slate-600 mb-1.5">Label Kecil</label>
                    <input type="text" name="academic_badge" value="{{ old('academic_badge', $settings['academic_badge'] ?? '') }}" placeholder="Akademik" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-600 mb-1.5">Judul</label>
                    <input type="text" name="academic_title" value="{{ old('academic_title', $settings['academic_title'] ?? '') }}" placeholder="Informasi Akademik" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
                </div>
            </div>
            <div class="mt-4">
                <label class="block text-sm font-medium text-slate-600 mb-1.5">Subjudul</label>
                <textarea name="academic_subtitle" rows="2" placeholder="Semua hal yang perlu kamu tahu seputar kegiatan belajar mengajar di SMK Infokom Bogor." class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">{{ old('academic_subtitle', $settings['academic_subtitle'] ?? '') }}</textarea>
            </div>
        </div>
        <div class="pt-4 border-t border-slate-100 first:pt-0 first:border-0">
            <p class="font-semibold text-navy-800 text-sm mb-3">Halaman Prestasi</p>
            <div class="grid sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-slate-600 mb-1.5">Label Kecil</label>
                    <input type="text" name="achievements_badge" value="{{ old('achievements_badge', $settings['achievements_badge'] ?? '') }}" placeholder="Prestasi" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-600 mb-1.5">Judul</label>
                    <input type="text" name="achievements_title" value="{{ old('achievements_title', $settings['achievements_title'] ?? '') }}" placeholder="Prestasi Siswa SMK Infokom Bogor" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
                </div>
            </div>
            <div class="mt-4">
                <label class="block text-sm font-medium text-slate-600 mb-1.5">Subjudul</label>
                <textarea name="achievements_subtitle" rows="2" placeholder="Deretan pencapaian membanggakan siswa-siswi kami di berbagai bidang dan tingkat kompetisi." class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">{{ old('achievements_subtitle', $settings['achievements_subtitle'] ?? '') }}</textarea>
            </div>
        </div>
        <div class="pt-4 border-t border-slate-100 first:pt-0 first:border-0">
            <p class="font-semibold text-navy-800 text-sm mb-3">Halaman Agenda</p>
            <div class="grid sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-slate-600 mb-1.5">Label Kecil</label>
                    <input type="text" name="agenda_badge" value="{{ old('agenda_badge', $settings['agenda_badge'] ?? '') }}" placeholder="Agenda" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-600 mb-1.5">Judul</label>
                    <input type="text" name="agenda_title" value="{{ old('agenda_title', $settings['agenda_title'] ?? '') }}" placeholder="Agenda Sekolah" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
                </div>
            </div>
            <div class="mt-4">
                <label class="block text-sm font-medium text-slate-600 mb-1.5">Subjudul</label>
                <textarea name="agenda_subtitle" rows="2" placeholder="Jangan sampai ketinggalan kegiatan dan acara penting di SMK Infokom Bogor." class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">{{ old('agenda_subtitle', $settings['agenda_subtitle'] ?? '') }}</textarea>
            </div>
        </div>
        <div class="pt-4 border-t border-slate-100 first:pt-0 first:border-0">
            <p class="font-semibold text-navy-800 text-sm mb-3">Halaman Ekstrakurikuler</p>
            <div class="grid sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-slate-600 mb-1.5">Label Kecil</label>
                    <input type="text" name="extracurricular_badge" value="{{ old('extracurricular_badge', $settings['extracurricular_badge'] ?? '') }}" placeholder="Ekstrakurikuler" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-600 mb-1.5">Judul</label>
                    <input type="text" name="extracurricular_title" value="{{ old('extracurricular_title', $settings['extracurricular_title'] ?? '') }}" placeholder="Ekstrakurikuler SMK Infokom Bogor" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
                </div>
            </div>
            <div class="mt-4">
                <label class="block text-sm font-medium text-slate-600 mb-1.5">Subjudul</label>
                <textarea name="extracurricular_subtitle" rows="2" placeholder="Kembangkan minat dan bakatmu lewat berbagai kegiatan ekstrakurikuler." class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">{{ old('extracurricular_subtitle', $settings['extracurricular_subtitle'] ?? '') }}</textarea>
            </div>
        </div>
        <div class="pt-4 border-t border-slate-100 first:pt-0 first:border-0">
            <p class="font-semibold text-navy-800 text-sm mb-3">Halaman Tenaga Pengajar & Struktur Organisasi</p>
            <div class="grid sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-slate-600 mb-1.5">Label Kecil</label>
                    <input type="text" name="teachers_badge" value="{{ old('teachers_badge', $settings['teachers_badge'] ?? '') }}" placeholder="Tenaga Pengajar" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-600 mb-1.5">Judul</label>
                    <input type="text" name="teachers_title" value="{{ old('teachers_title', $settings['teachers_title'] ?? '') }}" placeholder="Data Guru SMK Infokom Bogor" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
                </div>
            </div>
            <div class="mt-4">
                <label class="block text-sm font-medium text-slate-600 mb-1.5">Subjudul</label>
                <textarea name="teachers_subtitle" rows="2" placeholder="Para pengajar berdedikasi yang membimbing siswa-siswi kami meraih kompetensi terbaik." class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">{{ old('teachers_subtitle', $settings['teachers_subtitle'] ?? '') }}</textarea>
            </div>
        </div>
        <div class="pt-4 border-t border-slate-100 first:pt-0 first:border-0">
            <p class="font-semibold text-navy-800 text-sm mb-3">Halaman Video</p>
            <div class="grid sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-slate-600 mb-1.5">Label Kecil</label>
                    <input type="text" name="videos_badge" value="{{ old('videos_badge', $settings['videos_badge'] ?? '') }}" placeholder="Video" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-600 mb-1.5">Judul</label>
                    <input type="text" name="videos_title" value="{{ old('videos_title', $settings['videos_title'] ?? '') }}" placeholder="Video Kegiatan Sekolah" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
                </div>
            </div>
            <div class="mt-4">
                <label class="block text-sm font-medium text-slate-600 mb-1.5">Subjudul</label>
                <textarea name="videos_subtitle" rows="2" placeholder="Tonton berbagai momen dan aktivitas seru di SMK Infokom Bogor." class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">{{ old('videos_subtitle', $settings['videos_subtitle'] ?? '') }}</textarea>
            </div>
        </div>
    </div>

    <div x-show="tab === 'akademik'" style="display:none" class="bg-white rounded-2xl border border-slate-100 p-6 space-y-5">
        <div>
            <label class="block text-sm font-medium text-slate-600 mb-1.5">Info Ujian / Asesmen</label>
            <textarea name="academic_exam_info" rows="4" placeholder="cth: Penilaian di SMK Infokom Bogor terdiri dari Sumatif, Asesmen Tengah Semester, dan Asesmen Akhir Semester..." class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">{{ old('academic_exam_info', $settings['academic_exam_info'] ?? '') }}</textarea>
        </div>
        <div>
            <label class="block text-sm font-medium text-slate-600 mb-1.5">Info Kenaikan Kelas / Kelulusan</label>
            <textarea name="academic_promotion_info" rows="4" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">{{ old('academic_promotion_info', $settings['academic_promotion_info'] ?? '') }}</textarea>
        </div>
    </div>

    <div x-show="tab === 'pkl'" style="display:none" class="bg-white rounded-2xl border border-slate-100 p-6 space-y-5">
        <p class="text-sm text-slate-400">Konten ini tampil di halaman publik PKL. Data mitra dikelola terpisah di menu <strong>Mitra PKL</strong>.</p>
        <div>
            <label class="block text-sm font-medium text-slate-600 mb-1.5">Tentang PKL</label>
            <textarea name="pkl_about" rows="4" placeholder="Penjelasan singkat tentang program PKL di sekolah." class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">{{ old('pkl_about', $settings['pkl_about'] ?? '') }}</textarea>
        </div>
        <div>
            <label class="block text-sm font-medium text-slate-600 mb-1.5">Tujuan PKL</label>
            <textarea name="pkl_purpose" rows="4" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">{{ old('pkl_purpose', $settings['pkl_purpose'] ?? '') }}</textarea>
        </div>
        <div>
            <label class="block text-sm font-medium text-slate-600 mb-1.5">Manfaat PKL bagi Siswa</label>
            <textarea name="pkl_benefits" rows="4" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">{{ old('pkl_benefits', $settings['pkl_benefits'] ?? '') }}</textarea>
        </div>
        <div>
            <label class="block text-sm font-medium text-slate-600 mb-1.5">Foto Hero Halaman PKL</label>
            @if(!empty($settings['pkl_hero_image'])) <img src="{{ asset('storage/' . $settings['pkl_hero_image']) }}" class="h-32 rounded-xl mb-2 object-cover"> @endif
            <input type="file" name="pkl_hero_image" class="w-full text-sm">
        </div>
        <div>
            <label class="block text-sm font-medium text-slate-600 mb-1.5">Langkah Alur PKL (satu langkah per baris)</label>
            <textarea name="pkl_journey_steps" rows="4" placeholder="Pembekalan Siswa&#10;Penempatan di Mitra DUDI&#10;Pelaksanaan & Monitoring&#10;Evaluasi & Sertifikat" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">{{ old('pkl_journey_steps', $settings['pkl_journey_steps'] ?? '') }}</textarea>
            <p class="text-xs text-slate-400 mt-1">Ditampilkan di kartu "Perjalanan PKL" pada beranda. Kosongkan untuk memakai teks bawaan.</p>
        </div>
    </div>

    <div x-show="tab === 'bkk'" style="display:none" class="bg-white rounded-2xl border border-slate-100 p-6 space-y-5">
        <p class="text-sm text-slate-400">Statistik alumni terserap kerja &amp; program rekrutmen diisi manual di sini (tidak dihitung otomatis) — kosongkan kalau belum ada datanya, supaya tidak tampil angka yang salah.</p>
        <div class="grid sm:grid-cols-2 gap-5">
            <div>
                <label class="block text-sm font-medium text-slate-600 mb-1.5">Alumni Terserap Kerja</label>
                <input type="text" name="bkk_stat_alumni" value="{{ old('bkk_stat_alumni', $settings['bkk_stat_alumni'] ?? '') }}" placeholder="cth: 120" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-600 mb-1.5">Program Rekrutmen (jumlah)</label>
                <input type="text" name="bkk_stat_programs" value="{{ old('bkk_stat_programs', $settings['bkk_stat_programs'] ?? '') }}" placeholder="cth: 8" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
            </div>
        </div>
        <div>
            <label class="block text-sm font-medium text-slate-600 mb-1.5">Deskripsi Singkat BKK (hero)</label>
            <textarea name="bkk_intro" rows="3" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">{{ old('bkk_intro', $settings['bkk_intro'] ?? '') }}</textarea>
        </div>
        <p class="text-sm font-semibold text-slate-600 pt-2">Kontak BKK</p>
        <div class="grid sm:grid-cols-2 gap-5">
            <div>
                <label class="block text-sm font-medium text-slate-600 mb-1.5">Nama Pengelola BKK</label>
                <input type="text" name="bkk_manager_name" value="{{ old('bkk_manager_name', $settings['bkk_manager_name'] ?? '') }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-600 mb-1.5">Nomor WhatsApp</label>
                <input type="text" name="bkk_whatsapp" value="{{ old('bkk_whatsapp', $settings['bkk_whatsapp'] ?? '') }}" placeholder="628xxxxxxxxxx" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-600 mb-1.5">Email BKK</label>
                <input type="email" name="bkk_email" value="{{ old('bkk_email', $settings['bkk_email'] ?? '') }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-600 mb-1.5">Jam Layanan</label>
                <input type="text" name="bkk_hours" value="{{ old('bkk_hours', $settings['bkk_hours'] ?? '') }}" placeholder="cth: Senin–Jumat, 08.00–15.00" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
            </div>
        </div>
    </div>

    <div x-show="tab === 'ppdb'" style="display:none" class="bg-white rounded-2xl border border-slate-100 p-6 space-y-5">
        <p class="text-sm text-slate-400">Kosongkan jika belum ditentukan — website tidak akan menampilkan angka biaya sampai diisi di sini.</p>
        <div class="grid sm:grid-cols-3 gap-5">
            <div>
                <label class="block text-sm font-medium text-slate-600 mb-1.5">Total Biaya Gelombang 1 (Rp)</label>
                <input type="text" name="ppdb_fee_wave1" value="{{ old('ppdb_fee_wave1', $settings['ppdb_fee_wave1'] ?? '') }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-600 mb-1.5">Total Biaya Gelombang 2 (Rp)</label>
                <input type="text" name="ppdb_fee_wave2" value="{{ old('ppdb_fee_wave2', $settings['ppdb_fee_wave2'] ?? '') }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-600 mb-1.5">Total Biaya Gelombang 3 (Rp)</label>
                <input type="text" name="ppdb_fee_wave3" value="{{ old('ppdb_fee_wave3', $settings['ppdb_fee_wave3'] ?? '') }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
            </div>
        </div>
        <div>
            <label class="block text-sm font-medium text-slate-600 mb-1.5">Link Pendaftaran Online Resmi</label>
            <input type="url" name="ppdb_official_link" value="{{ old('ppdb_official_link', $settings['ppdb_official_link'] ?? '') }}" placeholder="https://..." class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
        </div>
        <div>
            <label class="block text-sm font-medium text-slate-600 mb-1.5">Formulir Pendaftaran (PDF, untuk jalur offline)</label>
            @if(!empty($settings['ppdb_form_pdf']))
                <p class="text-xs text-emerald-600 mb-1.5">File saat ini: <a href="{{ asset('storage/' . $settings['ppdb_form_pdf']) }}" target="_blank" class="underline">lihat PDF</a></p>
            @endif
            <input type="file" name="ppdb_form_pdf" accept="application/pdf" class="w-full text-sm">
            <p class="text-xs text-slate-400 mt-1">Kosongkan jika ingin memakai formulir PDF bawaan sistem.</p>
        </div>
        <div>
            <label class="block text-sm font-medium text-slate-600 mb-1.5">Langkah Alur Pendaftaran (satu langkah per baris)</label>
            <textarea name="ppdb_journey_steps" rows="4" placeholder="Isi Formulir Online&#10;Verifikasi Berkas&#10;Pengumuman Kelulusan&#10;Daftar Ulang" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">{{ old('ppdb_journey_steps', $settings['ppdb_journey_steps'] ?? '') }}</textarea>
            <p class="text-xs text-slate-400 mt-1">Ditampilkan di kartu "Alur Pendaftaran" pada beranda & halaman PPDB. Kosongkan untuk memakai teks bawaan.</p>
        </div>
    </div>

    <div x-show="tab === 'seo'" style="display:none" class="bg-white rounded-2xl border border-slate-100 p-6 space-y-5">
        <div>
            <label class="block text-sm font-medium text-slate-600 mb-1.5">SEO Title</label>
            <input type="text" name="seo_title" value="{{ old('seo_title', $settings['seo_title'] ?? '') }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
        </div>
        <div>
            <label class="block text-sm font-medium text-slate-600 mb-1.5">SEO Description</label>
            <textarea name="seo_description" rows="3" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">{{ old('seo_description', $settings['seo_description'] ?? '') }}</textarea>
        </div>
    </div>

    <div x-show="tab === 'section'" style="display:none" class="bg-white rounded-2xl border border-slate-100 p-6 space-y-3">
        @foreach(['show_hero' => 'Tampilkan Hero', 'show_news' => 'Tampilkan Berita', 'show_achievements' => 'Tampilkan Prestasi', 'show_gallery' => 'Tampilkan Galeri', 'show_announcement' => 'Tampilkan Pengumuman'] as $key => $label)
            <label class="flex items-center gap-3">
                <input type="hidden" name="{{ $key }}" value="0">
                <input type="checkbox" name="{{ $key }}" value="1" @checked(($settings[$key] ?? '1') == '1') class="rounded border-slate-300">
                <span class="text-sm text-slate-600">{{ $label }}</span>
            </label>
        @endforeach
    </div>

    <button type="submit" class="px-8 py-3 rounded-xl bg-navy-700 text-white font-semibold hover:bg-navy-800 transition">
        Simpan Pengaturan
    </button>
</form>
@endsection