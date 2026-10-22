<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('home_sections', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();           // nama file bagian: resources/views/public/home/sections/{key}.blade.php
            $table->string('label');
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_visible')->default(true);
            $table->string('space_top', 10)->nullable();     // none|sm|md|lg|xl (kosong = bawaan)
            $table->string('space_bottom', 10)->nullable();
            $table->string('content_width', 10)->nullable(); // narrow|wide|full (kosong = bawaan)
            $table->string('title_scale', 6)->nullable();    // 0.9|1.1|1.25|1.5 (kosong = 100%)
            $table->timestamps();
        });

        // Urutan awal = urutan beranda saat ini, semua tampil.
        $now = now();
        $defaults = [
            ['hero', 'Hero (sampul utama)'],
            ['stats', 'Statistik'],
            ['tentang', 'Tentang Kami'],
            ['sambutan', 'Sambutan Kepala Sekolah'],
            ['program', 'Program Keahlian'],
            ['pengumuman', 'Pengumuman'],
            ['fasilitas', 'Fasilitas'],
            ['berita', 'Berita Terbaru'],
            ['prestasi', 'Prestasi'],
            ['galeri', 'Galeri'],
            ['ppdb_pkl', 'Alur PPDB dan PKL'],
            ['kerjasama', 'Kerjasama dan Mitra'],
            ['penutup', 'Ajakan Penutup'],
        ];
        foreach ($defaults as $i => [$key, $label]) {
            DB::table('home_sections')->insert([
                'key' => $key, 'label' => $label, 'sort_order' => $i + 1,
                'is_visible' => true, 'created_at' => $now, 'updated_at' => $now,
            ]);
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('home_sections');
    }
};