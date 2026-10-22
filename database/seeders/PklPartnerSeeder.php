<?php

namespace Database\Seeders;

use App\Models\PklPartner;
use Illuminate\Database\Seeder;

class PklPartnerSeeder extends Seeder
{
    public function run(): void
    {
        $partners = [
            [
                'name' => 'PT Telekomunikasi Indonesia (Telkom)',
                'field' => 'Jaringan & Telekomunikasi',
                'address' => 'Kota Bogor, Jawa Barat',
                'description' => 'Mitra industri di bidang infrastruktur jaringan dan layanan telekomunikasi.',
                'sort_order' => 1,
            ],
            [
                'name' => 'Diskominfo Kota Bogor',
                'field' => 'Rekayasa Perangkat Lunak',
                'address' => 'Kota Bogor, Jawa Barat',
                'description' => 'Instansi pemerintah yang menerima siswa PKL untuk pengembangan aplikasi dan sistem informasi.',
                'sort_order' => 2,
            ],
            [
                'name' => 'CV Kreasi Digital Nusantara',
                'field' => 'Multimedia',
                'address' => 'Kota Bogor, Jawa Barat',
                'description' => 'Perusahaan rintisan di bidang desain grafis, video, dan konten digital.',
                'sort_order' => 3,
            ],
        ];

        foreach ($partners as $partner) {
            PklPartner::updateOrCreate(['name' => $partner['name']], $partner);
        }
    }
}
