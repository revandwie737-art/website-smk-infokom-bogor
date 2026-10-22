<?php

namespace Database\Seeders;

use App\Models\Facility;
use Illuminate\Database\Seeder;

class FacilitySeeder extends Seeder
{
    /** Data fasilitas resmi sesuai brosur PPDB. */
    public function run(): void
    {
        $facilities = [
            ['name' => 'Ruang Kelas', 'quantity' => 1, 'description' => 'Sarana ruang belajar yang nyaman.', 'sort_order' => 1],
            ['name' => 'Ruang OSIS dan Organisasi', 'quantity' => 1, 'sort_order' => 2],
            ['name' => 'Perpustakaan', 'quantity' => 1, 'sort_order' => 3],
            ['name' => 'Mushola', 'quantity' => 1, 'sort_order' => 4],
            ['name' => 'Ruang UKS', 'quantity' => 1, 'sort_order' => 5],
            ['name' => 'Lapangan Olahraga', 'quantity' => 1, 'sort_order' => 6],
            ['name' => 'Studio Musik', 'quantity' => 1, 'sort_order' => 7],
            ['name' => 'Studio Podcast', 'quantity' => 1, 'sort_order' => 8],
            ['name' => 'Studio Televisi', 'quantity' => 1, 'sort_order' => 9],
            ['name' => 'Laboratorium Komputer', 'quantity' => 4, 'description' => 'Laboratorium untuk program TKJ, RPL, DKV, dan PSPT.', 'sort_order' => 10],
            ['name' => 'Ruang Produksi & Show Case Teaching Factory', 'quantity' => 1, 'sort_order' => 11],
        ];

        foreach ($facilities as $facility) {
            Facility::updateOrCreate(['name' => $facility['name']], $facility);
        }

        // Hapus fasilitas lab lama yang generik supaya tidak duplikat dengan yang baru
        Facility::where('name', 'Laboratorium')->delete();
    }
}
