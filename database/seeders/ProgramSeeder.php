<?php

namespace Database\Seeders;

use App\Models\Program;
use Illuminate\Database\Seeder;

class ProgramSeeder extends Seeder
{
    public function run(): void
    {
        $programs = [
            [
                'name' => 'Desain Komunikasi Visual',
                'code' => 'DKV',
                'slug' => 'dkv',
                'sort_order' => 1,
                'description' => 'Program keahlian yang membekali siswa dengan kemampuan desain grafis, ilustrasi, fotografi, dan multimedia untuk kebutuhan industri kreatif.',
            ],
            [
                'name' => 'Produksi dan Siaran Program Televisi',
                'code' => 'PSPT',
                'slug' => 'pspt',
                'sort_order' => 2,
                'description' => 'Program keahlian yang membekali siswa dalam produksi konten audio visual, penyiaran, videografi, dan editing untuk industri broadcasting.',
            ],
            [
                'name' => 'Teknik Komputer dan Jaringan',
                'code' => 'TKJ',
                'slug' => 'tkj',
                'sort_order' => 3,
                'description' => 'Program keahlian yang membekali siswa dengan kemampuan instalasi, konfigurasi, dan pemeliharaan jaringan komputer serta infrastruktur IT.',
            ],
            [
                'name' => 'Rekayasa Perangkat Lunak',
                'code' => 'RPL',
                'slug' => 'rpl',
                'sort_order' => 4,
                'description' => 'Program keahlian yang membekali siswa dengan kemampuan pemrograman, pengembangan aplikasi web dan mobile, serta basis data.',
            ],
        ];

        foreach ($programs as $program) {
            Program::updateOrCreate(['code' => $program['code']], $program);
        }

        // Lingkup Kerja / prospek karier per jurusan, sesuai brosur PPDB resmi
        $prospects = [
            'TKJ' => "Wireless Networking\nNetwork Administrator\nServer Administrator\nComputer Integrator\nConnection Integrator",
            'RPL' => "Desktop Programmer\nMobile Programmer\nWeb Programmer\nAnalis Teknologi (Mobile, Desktop, Web, Enterprise)",
            'DKV' => "Illustrator\nAnimator\nDesainer Grafis\nDesainer Permainan (Game Designer)\nContent Creator",
            'PSPT' => "Biro Advertising\nRumah Produksi (Production House)\nContent Creator Social Media\nLembaga Penyiaran TV/Radio",
        ];
        foreach ($prospects as $code => $text) {
            Program::where('code', $code)->update(['prospects' => $text]);
        }
    }
}
