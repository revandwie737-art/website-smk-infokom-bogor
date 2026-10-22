<?php

namespace Database\Seeders;

use App\Models\Teacher;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class TeacherSeeder extends Seeder
{
    /**
     * Data guru terverifikasi dari sekolah. JANGAN menambah nama atau mata
     * pelajaran di luar data ini — guru tambahan diisi lewat dashboard admin.
     */
    public function run(): void
    {
        $teachers = [
            ['name' => 'Dara Purwanita', 'photo' => 'dara-purwanita.png', 'subjects' => ['Bahasa Inggris']],
            ['name' => 'Dra. Diana Octaria', 'photo' => 'diana-octaria.png', 'subjects' => ['Fisika', 'Kimia']],
            ['name' => 'Eva Farida Rahayu', 'photo' => 'eva-farida-rahayu.png', 'subjects' => ['Bahasa Indonesia']],
            ['name' => 'Heny Handayani', 'photo' => 'heny-handayani.png', 'subjects' => ['Seni Budaya']],
            ['name' => 'Mila Yaelasari', 'photo' => 'mila-yaelasari.png', 'subjects' => ['Matematika']],
            ['name' => 'Dra. Popon Puspitasari', 'photo' => 'popon-puspitasari.png', 'subjects' => ['Pendidikan Agama dan Budi Pekerti']],
            ['name' => 'Putri Riandini', 'photo' => 'putri-riandini.png', 'subjects' => ['Matematika', 'Kimia']],
            ['name' => 'Vera Yuni Astuti, S.P.', 'photo' => 'vera-yuni-astuti.png', 'subjects' => ['Tinjauan Seni', 'Dasar-Dasar Kreativitas', 'Komunikasi Massa', 'Produk Kreatif dan Kewirausahaan', 'Tata Artistik', 'Kimia']],
            ['name' => 'Yeni Yuliawati', 'photo' => 'yeni-yuliawati.png', 'subjects' => ['Bahasa Indonesia']],
            ['name' => 'Aditya Nugraha, S.T.', 'photo' => 'aditya-nugraha.png', 'subjects' => ['Administrasi Infrastruktur Jaringan', 'Administrasi Sistem Jaringan', 'Teknologi Layanan Jaringan']],
            ['name' => 'Agus Tiyono', 'photo' => 'agus-tiyono.png', 'subjects' => ['Pendidikan Pancasila dan Kewarganegaraan']],
            ['name' => 'Dea Rijalul Fikri', 'photo' => 'dea-rijalul-fikri.png', 'subjects' => ['Teknik Pengolahan Audio Video', 'Teknik Animasi 2D dan 3D']],
            ['name' => 'Erli Suherli', 'photo' => 'erli-suherli.png', 'subjects' => ['Dasar Seni Audio Visual', 'Produk Audio Visual', 'Manajemen Produk/Naskah/Penyutradaraan', 'Kamera/Pencahayaan/Tata Suara', 'Editing Audio & Video', 'Tata Artistik']],
            ['name' => 'Erwin Hasiholan Gultom', 'photo' => 'erwin-hasiholan-gultom.png', 'subjects' => ['Basis Data', 'Pemrograman Web & Perangkat Bergerak', 'Pemrograman Berorientasi Objek']],
            ['name' => 'Muhammad Fauzan Arifin', 'photo' => 'muhammad-fauzan-arifin.png', 'subjects' => ['Simulasi dan Komunikasi Digital', 'Sistem Komputer']],
            ['name' => 'Ibnu Fajar', 'photo' => 'ibnu-fajar.png', 'subjects' => ['Basis Data', 'Teknik Pengolahan Audio Video', 'Editing Audio dan Video']],
            ['name' => 'Akhmad Khotib', 'photo' => 'akhmad-khotib.png', 'subjects' => ['Pendidikan Agama dan Budi Pekerti']],
            ['name' => 'Reza Prafitriansyah', 'photo' => 'reza-prafitriansyah.png', 'subjects' => ['Dasar Desain Grafis']],
            ['name' => 'Ridwan Halla', 'photo' => 'ridwan-halla.png', 'subjects' => ['Administrasi Sistem Jaringan', 'Teknologi Layanan Jaringan', 'Desain Grafis Percetakan']],
            ['name' => 'Cahyadi Roji, S.T.', 'photo' => 'cahyadi-roji.png', 'subjects' => ['Komputer dan Jaringan Dasar', 'Pemrograman Dasar', 'Teknologi Jaringan Berbasis Luas (WAN)']],
            ['name' => 'Yadi Setiadi', 'photo' => 'yadi-setiadi.png', 'subjects' => ['Produk Kreatif dan Kewirausahaan']],
        ];

        foreach ($teachers as $t) {
            $email = Str::slug($t['name']) . '@smkinfokom.sch.id';

            $user = User::updateOrCreate(
                ['email' => $email],
                [
                    'name' => $t['name'],
                    'password' => Hash::make('guru12345'),
                    'role' => 'teacher',
                    'status' => 'active',
                ]
            );

            Teacher::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'photo' => 'teachers/' . $t['photo'],
                    'subjects' => implode("\n", $t['subjects']),
                ]
            );
        }
    }
}
