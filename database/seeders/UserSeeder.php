<?php

namespace Database\Seeders;

use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // ADMIN DEMO — ganti password ini setelah instalasi, jangan dipakai di production
        $admin = User::updateOrCreate(
            ['email' => 'admin@smkinfokom.sch.id'],
            [
                'name' => 'Administrator',
                'password' => Hash::make('admin12345'),
                'role' => 'admin',
                'status' => 'active',
            ]
        );

        // TEACHER DEMO
        $teacherUser = User::updateOrCreate(
            ['email' => 'guru@smkinfokom.sch.id'],
            [
                'name' => 'Budi Santoso, S.Kom',
                'password' => Hash::make('guru12345'),
                'role' => 'teacher',
                'status' => 'active',
            ]
        );

        Teacher::updateOrCreate(
            ['user_id' => $teacherUser->id],
            ['nip' => '198501012010011001', 'position' => 'Guru Produktif RPL', 'phone' => '081200000000']
        );

        // STUDENT DEMO
        $studentUser = User::updateOrCreate(
            ['email' => 'siswa@smkinfokom.sch.id'],
            [
                'name' => 'Revan Dwi Erlangga',
                'password' => Hash::make('siswa12345'),
                'role' => 'student',
                'status' => 'active',
            ]
        );

        Student::updateOrCreate(
            ['user_id' => $studentUser->id],
            [
                'nisn' => '0051234567',
                'phone' => '081211112222',
                'birth_date' => '2009-05-10',
                'address' => 'Bogor, Jawa Barat',
            ]
        );
    }
}
