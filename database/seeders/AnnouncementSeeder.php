<?php

namespace Database\Seeders;

use App\Models\Announcement;
use Illuminate\Database\Seeder;

class AnnouncementSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            [
                'title' => 'Selamat Datang di Website SMK Infokom Bogor',
                'content' => 'Website ini masih menggunakan sebagian data demo. Admin dapat mengelola seluruh konten melalui dashboard admin di /admin/login.',
                'priority' => 'normal',
            ],
            [
                'title' => '[Contoh] Jadwal Pendaftaran PPDB Telah Dibuka',
                'content' => 'Ini adalah data pengumuman contoh (demo). Silakan edit atau hapus melalui dashboard admin dan gantikan dengan pengumuman PPDB yang sesungguhnya.',
                'priority' => 'high',
            ],
            [
                'title' => '[Contoh] Libur Nasional, Kegiatan Belajar Diliburkan',
                'content' => 'Ini adalah data pengumuman contoh (demo). Silakan edit atau hapus melalui dashboard admin.',
                'priority' => 'low',
            ],
        ];

        foreach ($items as $item) {
            Announcement::updateOrCreate(
                ['title' => $item['title']],
                array_merge($item, ['is_active' => true])
            );
        }
    }
}
