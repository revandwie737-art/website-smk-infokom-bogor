<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    public function run(): void
    {
        $events = [
            ['title' => '[Contoh] Rapat Orang Tua Siswa', 'location' => 'Aula SMK Infokom Bogor', 'days' => 14],
            ['title' => '[Contoh] Ujian Tengah Semester', 'location' => 'Ruang Kelas Masing-Masing', 'days' => 21],
            ['title' => '[Contoh] Class Meeting', 'location' => 'Lapangan Sekolah', 'days' => 30],
            ['title' => '[Contoh] Pembagian Rapor', 'location' => 'Aula SMK Infokom Bogor', 'days' => 45],
            ['title' => '[Contoh] Libur Semester', 'location' => '-', 'days' => 50],
        ];

        foreach ($events as $event) {
            Event::updateOrCreate(
                ['title' => $event['title']],
                [
                    'event_date' => now()->addDays($event['days'])->toDateString(),
                    'location' => $event['location'],
                    'description' => 'Ini adalah data agenda contoh (demo). Silakan edit atau hapus melalui dashboard admin.',
                ]
            );
        }
    }
}
