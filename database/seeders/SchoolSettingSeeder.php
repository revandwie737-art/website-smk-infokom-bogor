<?php

namespace Database\Seeders;

use App\Models\SchoolSetting;
use Illuminate\Database\Seeder;

class SchoolSettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            'site_name' => 'SMK Infokom Bogor',
            'site_description' => 'Sekolah Menengah Kejuruan Swasta Infokom Bogor - Membangun Generasi Digital yang Kreatif, Kompeten, dan Berkarakter',
            'hero_title' => 'Membangun Generasi Digital yang Kreatif, Kompeten, dan Berkarakter',
            'hero_subtitle' => 'SMK Infokom Bogor mencetak lulusan siap kerja, siap kuliah, dan siap berwirausaha di bidang teknologi, desain, dan penyiaran.',
            'about_text' => 'SMK Infokom Bogor adalah sekolah menengah kejuruan swasta terakreditasi A yang berdiri sejak tahun 2005 di bawah naungan Yayasan Telekomunikasi Nasional. Kami fokus mencetak lulusan yang kompeten di bidang teknologi informasi, desain komunikasi visual, dan produksi siaran televisi.',
            'vision' => 'Menjadi SMK unggulan yang menghasilkan lulusan kompeten, berkarakter, dan berdaya saing global di bidang teknologi informasi dan komunikasi.',
            'mission' => "1. Menyelenggarakan pendidikan kejuruan yang berkualitas dan relevan dengan kebutuhan industri.\n2. Membentuk karakter siswa yang disiplin, jujur, dan bertanggung jawab.\n3. Mengembangkan kompetensi siswa melalui praktik langsung dan kerja sama industri.\n4. Menciptakan lingkungan belajar yang kreatif, inovatif, dan berbasis teknologi.",
            'principal_name' => 'Ir. Hj. Liliek Rahmaningsih, M.MPd',
            'principal_position' => 'Kepala Sekolah',
            'principal_photo' => 'settings/principal.png',
            'principal_message' => 'Selamat datang di SMK Infokom Bogor. Kami berkomitmen membimbing setiap siswa untuk mengembangkan potensi terbaiknya, baik dari sisi akademik maupun karakter, agar siap menghadapi dunia kerja dan tantangan masa depan.',
            'phone' => '(0251) 8348108',
            'email' => 'smk.infokom@gmail.com',
            'address' => 'Jl. Letjen Ibrahim Adjie No. 178, Sindang Barang, Kecamatan Kota Bogor Barat, Kota Bogor, Jawa Barat',
            'jam_operasional' => 'Senin - Jumat : 07.00 - 17.00 WIB',
            'google_maps_url' => 'https://www.google.com/maps?q=-6.5973,106.7793',
            'facebook' => '',
            'instagram' => '',
            'youtube' => '',
            'whatsapp' => '',
            'ppdb_fee_wave1' => '',
            'ppdb_fee_wave2' => '',
            'ppdb_official_link' => 'https://bit.ly/GF-PPDB-ONLINE-SMK-INFOKOM-26-27',
            'footer_copyright' => '© ' . date('Y') . ' SMK Infokom Bogor. Seluruh hak cipta dilindungi.',
            'seo_title' => 'SMK Infokom Bogor - Sekolah Menengah Kejuruan Terakreditasi A',
            'seo_description' => 'SMK Infokom Bogor, NPSN 20238531, terakreditasi A. Program keahlian DKV, PSPT, TKJ, dan RPL.',
            'show_hero' => '1',
            'show_news' => '1',
            'show_achievements' => '1',
            'show_gallery' => '1',
            'show_announcement' => '1',
            // Data resmi (tidak dapat diedit lewat form settings, disimpan agar konsisten)
            'npsn' => '20238531',
            'jenjang' => 'SMK',
            'status_sekolah' => 'Swasta',
            'akreditasi' => 'A',
            'naungan' => 'Yayasan Telekomunikasi Nasional',
            'sk_operasional' => '421.5/86-Disdik Tahun 2005',
            'tanggal_sk' => '18 Juli 2005',
            'luas_tanah' => '1.650 m²',
            'latitude' => '-6.5973',
            'longitude' => '106.7793',
            'jumlah_guru' => '30',
            'siswa_laki' => '638',
            'siswa_perempuan' => '269',
            'rombel' => '29',
            'ruang_kelas' => '27',
            'laboratorium' => '2',
            'perpustakaan' => '1',
        ];

        foreach ($settings as $key => $value) {
            SchoolSetting::updateOrCreate(['key' => $key], ['value' => $value]);
        }
    }
}
