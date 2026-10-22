<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Teacher;

class TeacherController extends Controller
{
    protected array $allowedNameKeywords = [
        'Liliek Rahmaningsih',
        'Mila Yaelasari',
        'Dea Rijalul Fikri',
        'Radiani Srirestuti',
        'Heny Handayani',
        'Agus Tiyono',
        'Aditya Nugraha',
        'Cahyadi Rozi',
        'Cahyadi Roji',
        'Puji Marhaen Waluyo',
        'Putri Riandini',
        'Ridwan Hala',
        'Ibnu Arif',
        'Erli Suherli',
        'Ahmad Hotib',
        'Akhmad Khotib',
        'Abdul Azis',
        'Vera Yuni Astuti',
        'Fauzan Arifin',
        'Popon Puspitasari',
        'Richo Santana',
        'Dian Hardianti',
        'Yeni Yuliawati',
        'Rita Widyastuti',
        'Farida Rahayu',
        'Jayadi',
        'Yadi Setiadi',
        'Siti Nuraeni',
        'Prafitriansyah',
        'Diana Octaria',
        'Ahmadia Pratama',
        'Hasiholan Gultom',
        'Widyatama Nuranisa',
        'Dara Purwanita',
    ];

    public function index()
    {
        $teachers = Teacher::with('user')
            ->whereHas('user', function ($q) {
                $q->where('role', 'teacher');

                $q->where(function ($q2) {
                    foreach ($this->allowedNameKeywords as $keyword) {
                        $q2->orWhere('name', 'like', "%{$keyword}%");
                    }
                });
            })
            ->get()
            ->sortBy(fn ($t) => $t->user->name)
            ->values();

        // Wakil Kepala Sekolah
        $waka = [
            ['role' => 'Wakasek Bidang Kurikulum', 'name' => 'Mila Yaelasari, M.Pd.'],
            ['role' => 'Wakasek Bidang Kesiswaan', 'name' => 'Dea Rijalul Fikri, S.Kom.,Gr.'],
            ['role' => 'Wakasek Bidang Hubungan Industri dan Masyarakat', 'name' => 'R. Radiani Srirestuti Dewi, SS.,Gr.'],
            ['role' => 'Wakasek Bidang Pengembangan SDM', 'name' => 'Heny Handayani, S.Pd.'],
            ['role' => 'Wakasek Bidang Sarana dan Prasarana', 'name' => 'Agus Tiyono, M.Pd.'],
        ];

        // Struktur inti
        $inti = [
            ['role' => 'Ketua Manajemen Mutu', 'name' => 'Aditya Nugraha, ST.'],
            ['role' => 'Kepala Tata Usaha', 'name' => 'Cahyadi Rozi, ST.'],
            ['role' => 'Kepala Perpustakaan', 'name' => 'Drs. Puji Marhaen Waluyo'],
            ['role' => 'Kepala Bendahara', 'name' => 'Putri Riandini, S.Hut., M.Pd.,Gr.'],
        ];

        // Kepala Program Keahlian
        $kaprog = [
            ['role' => 'Kaprog TKJ', 'name' => 'Aditya Nugraha, ST.'],
            ['role' => 'Kaprog RPL', 'name' => 'Ridwan Hala, S.Kom.,Gr.'],
            ['role' => 'Kaprog DKV', 'name' => 'Muhammad Ibnu Arif, S.IKom.'],
            ['role' => 'Kaprog PSPT', 'name' => 'Erli Suherli, A.Md.Kom.'],
        ];

        // Staf & guru lain
        $groups = [
            [
                'title' => 'Pembina OSIS',
                'members' => [
                    'Ahmad Hotib, S.Pd.I',
                    'Abdul Azis, M.Pd.',
                ],
            ],
            [
                'title' => 'Staf Kurikulum',
                'members' => [
                    'Vera Yuni Astuti, SP., M.IKom.,Gr.',
                    'M. Fauzan Arifin, S.IKom.,Gr.',
                ],
            ],
            [
                'title' => 'Guru Bimbingan & Konseling',
                'members' => [
                    'Dra. Popon Puspitasari',
                    'Richo Santana, S.Kom.',
                    'Dian Hardianti, S.Kom.,Gr.',
                ],
            ],
            [
                'title' => 'Staf Teller (Bendahara)',
                'members' => [
                    'Yeni Yuliawati, S.Pd.,Gr.',
                    'Rita Widyastuti',
                    'Eva Farida Rahayu, S.Pd.,Gr.',
                ],
            ],
            [
                'title' => 'Staf Tata Usaha',
                'members' => [
                    'Jayadi, S.Pd.,Gr.',
                    'Yadi Setiadi, S.Sos.,Gr.',
                    'Siti Nuraeni',
                ],
            ],
            [
                'title' => 'Staf Perpustakaan',
                'members' => [
                    'Reza Prafitriansyah, S.Kom.,Gr.',
                ],
            ],
            [
                'title' => 'Guru Lainnya',
                'members' => [
                    'Dra. Diana Octaria',
                    'Nabila Ahmadia Pratama, S.Pd.',
                    'Erwin Hasiholan Gultom, S.Kom.',
                    'Widyatama Nuranisa, SM.',
                    'Dara Purwanita, S.Pd.,Gr.',
                ],
            ],
        ];

        return view('public.teachers', compact(
            'teachers',
            'waka',
            'inti',
            'kaprog',
            'groups'
        ));
    }
}