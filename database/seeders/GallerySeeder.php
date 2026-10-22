<?php

namespace Database\Seeders;

use App\Models\Gallery;
use Illuminate\Database\Seeder;

class GallerySeeder extends Seeder
{
    public function run(): void
    {
        $albums = [
            ['title' => '[Contoh Album] Kegiatan Belajar Mengajar', 'category' => 'Kegiatan'],
            ['title' => '[Contoh Album] Upacara Bendera', 'category' => 'Kegiatan'],
            ['title' => '[Contoh Album] Praktik di Laboratorium', 'category' => 'Akademik'],
            ['title' => '[Contoh Album] Lomba Antar Kelas', 'category' => 'Prestasi'],
            ['title' => '[Contoh Album] Wisuda Angkatan', 'category' => 'Acara Sekolah'],
        ];

        foreach ($albums as $album) {
            Gallery::updateOrCreate(
                ['title' => $album['title']],
                array_merge($album, ['event_date' => now()->subDays(rand(1, 60))->toDateString()])
            );
        }
    }
}
