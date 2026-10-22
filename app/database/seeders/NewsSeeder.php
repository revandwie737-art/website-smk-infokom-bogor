<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\News;
use App\Models\User;
use Illuminate\Database\Seeder;

class NewsSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::where('role', 'admin')->first();
        $category = Category::first();

        $items = [
            [
                'title' => '[Contoh Berita] Penerimaan Peserta Didik Baru Segera Dibuka',
                'excerpt' => 'Ini adalah data demo. Silakan edit atau hapus melalui dashboard admin.',
                'content' => '<p>Ini adalah konten berita contoh (data demo) yang dapat diedit atau dihapus melalui menu Berita pada dashboard admin. Gunakan berita ini sebagai referensi format penulisan.</p>',
            ],
            [
                'title' => '[Contoh Berita] Kegiatan Belajar Mengajar Semester Baru',
                'excerpt' => 'Ini adalah data demo. Silakan edit atau hapus melalui dashboard admin.',
                'content' => '<p>Ini adalah konten berita contoh (data demo) tentang kegiatan belajar mengajar. Admin dapat mengganti judul, gambar, dan isi berita ini sesuai kebutuhan sekolah.</p>',
            ],
            [
                'title' => '[Contoh Berita] Siswa PKL Diterima di Beberapa Perusahaan Mitra',
                'excerpt' => 'Ini adalah data demo. Ganti dengan informasi PKL/magang sesungguhnya melalui dashboard admin.',
                'content' => '<p>Ini adalah konten berita contoh (data demo) tentang Praktik Kerja Lapangan (PKL) dan magang siswa di perusahaan mitra. Admin dapat mengganti nama perusahaan, jumlah siswa, dan detail lain sesuai data sesungguhnya melalui menu Berita.</p>',
            ],
            [
                'title' => '[Contoh Berita] Workshop Pengembangan Kompetensi Siswa',
                'excerpt' => 'Ini adalah data demo. Silakan edit atau hapus melalui dashboard admin.',
                'content' => '<p>Ini adalah konten berita contoh (data demo) tentang kegiatan workshop atau pelatihan tambahan bagi siswa. Admin dapat mengganti isi berita ini sesuai kegiatan yang sesungguhnya berlangsung di sekolah.</p>',
            ],
            [
                'title' => '[Contoh Berita] Kunjungan Industri ke Perusahaan Teknologi',
                'excerpt' => 'Ini adalah data demo. Silakan edit atau hapus melalui dashboard admin.',
                'content' => '<p>Ini adalah konten berita contoh (data demo) tentang kegiatan kunjungan industri siswa. Admin dapat mengganti isi berita ini dengan laporan kunjungan yang sesungguhnya.</p>',
            ],
        ];

        foreach ($items as $item) {
            News::updateOrCreate(
                ['title' => $item['title']],
                array_merge($item, [
                    'category_id' => $category?->id,
                    'author_id' => $admin?->id,
                    'status' => 'published',
                    'published_at' => now()->subDays(rand(1, 20)),
                ])
            );
        }
    }
}
