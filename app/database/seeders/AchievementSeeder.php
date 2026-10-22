<?php

namespace Database\Seeders;

use App\Models\Achievement;
use Illuminate\Database\Seeder;

class AchievementSeeder extends Seeder
{
    /**
     * Data prestasi resmi sesuai brosur PPDB SMK Infokom Kota Bogor.
     * Menggantikan data contoh/demo sebelumnya.
     */
    public function run(): void
    {
        $items = [
            ['title' => 'Piala Kemerdekaan Futsal BGR 2025', 'student_name' => 'Tim Futsal', 'category' => 'olahraga', 'level' => 'kabupaten_kota', 'year' => 2025, 'description' => 'Juara 3'],
            ['title' => 'SB Futsalnation 2025', 'student_name' => 'Tim Futsal', 'category' => 'olahraga', 'level' => 'kabupaten_kota', 'year' => 2025, 'description' => 'Juara 3'],
            ['title' => 'Binaniaga Championship 2025', 'student_name' => 'Tim Futsal', 'category' => 'olahraga', 'level' => 'kabupaten_kota', 'year' => 2025, 'description' => 'Juara 3'],

            ['title' => 'LKBB Braja Musti 2024', 'student_name' => 'Tim PASKIBRA', 'category' => 'lainnya', 'level' => 'kabupaten_kota', 'year' => 2024, 'description' => 'Juara Harapan Potensial 2'],
            ['title' => 'LKBB BIMA Season 1 Jawa Barat', 'student_name' => 'Tim PASKIBRA', 'category' => 'lainnya', 'level' => 'provinsi', 'year' => 2024, 'description' => 'Juara Purwa 5'],
            ['title' => 'LKBB BIMA SAKTI 2025', 'student_name' => 'Tim PASKIBRA', 'category' => 'lainnya', 'level' => 'kabupaten_kota', 'year' => 2025, 'description' => 'Juara 1'],

            ['title' => 'Kejurprov U-18 Subang — Bola Tangan (Handball)', 'student_name' => 'Bintang Rafiif Adzani', 'category' => 'olahraga', 'level' => 'provinsi', 'year' => 2024, 'description' => 'Juara 1 (Medali Emas), Divisi 1 Provinsi Jawa Barat'],
            ['title' => 'Kejuaraan Handball Najamudin Cup 7 Tahun 2025', 'student_name' => 'Tim Handball', 'category' => 'olahraga', 'level' => 'kabupaten_kota', 'year' => 2025, 'description' => 'Juara 3'],

            ['title' => 'Young Scientists Competition — Kategori Kimia', 'student_name' => 'Amanda Tagrida Viona', 'category' => 'akademik', 'level' => 'nasional', 'year' => 2024, 'description' => 'Juara 3 (Medali Perunggu)'],
            ['title' => 'Karya Ilmiah Internet of Things (IoT) — Universitas Ibn Khaldun', 'student_name' => 'Amanda Tagrida Viona', 'category' => 'akademik', 'level' => 'kabupaten_kota', 'year' => 2024, 'description' => 'Juara 1 (Medali Emas), Kota Bogor'],
            ['title' => 'LKN Science Olympiad — Kategori Bahasa Indonesia', 'student_name' => 'Amanda Tagrida Viona', 'category' => 'akademik', 'level' => 'nasional', 'year' => 2024, 'description' => 'Juara 1 (Medali Emas)'],
            ['title' => 'LKN Science Olympiad — Kategori Ekonomi', 'student_name' => 'Amanda Tagrida Viona', 'category' => 'akademik', 'level' => 'nasional', 'year' => 2024, 'description' => 'Juara 3 (Medali Perunggu)'],
            ['title' => 'Olimpiade LKI — Kategori Biologi', 'student_name' => 'Amanda Tagrida Viona', 'category' => 'akademik', 'level' => 'nasional', 'year' => 2024, 'description' => 'Juara 2 (Medali Perak)'],
            ['title' => 'Karya Ilmiah Internet of Things (IoT) — Universitas Ibn Khaldun (Tim)', 'student_name' => 'Amanda Tagrida Viona, Aqilla Tyza Febyana, Alisa Putri Mulya', 'category' => 'akademik', 'level' => 'kabupaten_kota', 'year' => 2024, 'description' => 'Juara 1 (Medali Emas), Kota Bogor'],

            ['title' => 'Lomba Kanji — YUKANA Festival 2025', 'student_name' => 'Tim JIC (Mohamad Arjuna Ali)', 'category' => 'akademik', 'level' => 'kabupaten_kota', 'year' => 2025, 'description' => 'Juara 1'],

            ['title' => 'OLIMFEST 2025 — Olimpiade Biologi Tingkat SMA', 'student_name' => 'Bungas Shesa Perindu', 'category' => 'akademik', 'level' => 'nasional', 'year' => 2025, 'description' => 'Medali Emas'],
            ['title' => 'ISO (Indonesian Science Olympiad) 2025 — Olimpiade Biologi', 'student_name' => 'Bungas Shesa Perindu', 'category' => 'akademik', 'level' => 'nasional', 'year' => 2025, 'description' => 'Medali Emas'],
            ['title' => 'OSSAN 2026 — Bidang Biologi', 'student_name' => 'Bungas Shesa Perindu', 'category' => 'akademik', 'level' => 'nasional', 'year' => 2026, 'description' => 'Medali Perak'],
            ['title' => 'OSSAN 2026 — Bidang Informatika', 'student_name' => 'Bungas Shesa Perindu', 'category' => 'akademik', 'level' => 'nasional', 'year' => 2026, 'description' => 'Medali Perak'],

            ['title' => 'POTENSI — Bidang Sosiologi Tingkat SMA', 'student_name' => 'Deanova Aprianza Gesyaputra', 'category' => 'akademik', 'level' => 'nasional', 'year' => 2026, 'description' => 'Medali Emas'],
            ['title' => 'POTENSI — Bidang Bahasa Indonesia Tingkat SMA', 'student_name' => 'Deanova Aprianza Gesyaputra', 'category' => 'akademik', 'level' => 'nasional', 'year' => 2026, 'description' => 'Medali Emas'],
            ['title' => '4th OSBANAS 2025 — Olimpiade Sosiologi Tingkat SMA', 'student_name' => 'Deanova Aprianza Gesyaputra', 'category' => 'akademik', 'level' => 'nasional', 'year' => 2026, 'description' => 'Medali Perunggu'],

            ['title' => 'POSBANAS — Bahasa Jepang Tingkat SMA/SMK', 'student_name' => 'Aulia Azzahra Hartiani', 'category' => 'akademik', 'level' => 'nasional', 'year' => 2026, 'description' => 'Medali Emas'],

            ['title' => 'e-Sport (Mobile Legend) Festival Dwi Warna (FDW) 2026 RENASCORA', 'student_name' => 'Rafisha Wahyu Assila, Mario Ramdani, Gibran Bijaksa S., Julian Iqbal, Alif Saputra Ramadhan', 'category' => 'teknologi', 'level' => 'kabupaten_kota', 'year' => 2026, 'description' => 'Juara 1, Tingkat Kota & Kabupaten'],

            ['title' => 'O2SN Tingkat SMK Kota Bogor — Cabang Bulu Tangkis', 'student_name' => 'Rahma Ashari', 'category' => 'olahraga', 'level' => 'kabupaten_kota', 'year' => 2026, 'description' => 'Juara 2'],
        ];

        foreach ($items as $item) {
            Achievement::updateOrCreate(
                ['title' => $item['title'], 'student_name' => $item['student_name']],
                $item
            );
        }

        // Bersihkan sisa data contoh/demo lama
        Achievement::where('title', 'like', '[Contoh Data]%')->delete();
    }
}
