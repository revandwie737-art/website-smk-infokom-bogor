<?php

namespace Database\Seeders;

use App\Models\Extracurricular;
use Illuminate\Database\Seeder;

class ExtracurricularSeeder extends Seeder
{
    /** Daftar ekstrakurikuler resmi sesuai brosur PPDB. Jadwal sengaja dikosongkan (tidak dikarang) — isi lewat dashboard admin. */
    public function run(): void
    {
        $items = [
            'PASKIBRA', 'PRAMUKA', 'PMR',
            'Japan Indonesia Community (JIC)', 'Cerdas TKA', 'Tahsin/Tahfidz Qur\'an',
            'Futsal', 'Handball', 'Basketball', 'Bulu Tangkis',
            'Paduan Suara', 'Hadroh', 'Musik/Band',
        ];

        foreach ($items as $name) {
            Extracurricular::updateOrCreate(['name' => $name], ['is_active' => true]);
        }

        // Bersihkan sisa data contoh/demo lama
        Extracurricular::where('name', 'like', '[Contoh]%')->delete();
    }
}
