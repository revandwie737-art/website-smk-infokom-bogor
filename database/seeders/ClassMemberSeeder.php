<?php

namespace Database\Seeders;

use App\Models\Program;
use App\Models\SchoolClass;
use App\Models\ClassMember;
use App\Models\Student;
use Illuminate\Database\Seeder;

class ClassMemberSeeder extends Seeder
{
    /**
     * Roster kelas XII RPL 2, sesuai data yang diberikan user (nama & peran).
     * Ini BUKAN akun login (tidak ada NISN/email asli yang diberikan untuk
     * anggota-anggota ini) — hanya data tampilan daftar teman sekelas yang
     * hanya terlihat di Portal Siswa & dashboard admin.
     */
    public function run(): void
    {
        $rpl = Program::where('code', 'RPL')->first();
        if (! $rpl) {
            return;
        }

        $class = SchoolClass::firstOrCreate(
            ['name' => 'XII RPL 2'],
            ['program_id' => $rpl->id, 'grade' => 'XII']
        );

        $roster = [
            ['name' => 'Abiyan', 'role' => 'Anggota'],
            ['name' => 'Amanda', 'role' => 'Sekretaris'],
            ['name' => 'Ayesha', 'role' => 'Wakil Ketua Kelas'],
            ['name' => 'Chantika', 'role' => 'Sekretaris'],
            ['name' => 'Elsa', 'role' => 'Anggota'],
            ['name' => 'Fajar', 'role' => 'Anggota'],
            ['name' => 'Gadis', 'role' => 'Anggota'],
            ['name' => 'Hafifa', 'role' => 'Bendahara'],
            ['name' => 'Ibra', 'role' => 'Anggota'],
            ['name' => 'Irsyad', 'role' => 'Anggota'],
            ['name' => 'Kafka', 'role' => 'Anggota'],
            ['name' => 'Klara', 'role' => 'Anggota'],
            ['name' => 'Mario', 'role' => 'Anggota'],
            ['name' => 'Mithur', 'role' => 'Anggota'],
            ['name' => 'Rafa', 'role' => 'Anggota'],
            ['name' => 'Prasya', 'role' => 'Anggota'],
            ['name' => 'Fatih', 'role' => 'Ketua Kelas'],
            ['name' => 'Defran', 'role' => 'Anggota'],
            ['name' => 'Mulki', 'role' => 'Anggota'],
            ['name' => 'Rafa', 'role' => 'Anggota'],
            ['name' => 'Moble', 'role' => 'Anggota'],
            ['name' => 'Rafi', 'role' => 'Anggota'],
            ['name' => 'Rakas', 'role' => 'Anggota'],
            ['name' => 'Raya', 'role' => 'Anggota'],
            ['name' => 'Revan', 'role' => 'Anggota'],
            ['name' => 'BadutZY', 'role' => 'Developer'],
            ['name' => 'San Parker', 'role' => 'Anggota'],
            ['name' => 'Sultan', 'role' => 'Anggota'],
        ];

        foreach ($roster as $i => $member) {
            ClassMember::updateOrCreate(
                ['class_id' => $class->id, 'name' => $member['name'], 'sort_order' => $i + 1],
                ['role' => $member['role']]
            );
        }

        // Akun demo siswa (Revan Dwi Erlangga) diarahkan ke kelas ini juga,
        // supaya menu Jadwal/Teman Sekelas/Nilai/Kehadiran di portal siswa
        // tidak kosong saat dipakai untuk testing.
        Student::whereHas('user', fn ($q) => $q->where('email', 'siswa@smkinfokom.sch.id'))
            ->update(['class_id' => $class->id]);
    }
}
