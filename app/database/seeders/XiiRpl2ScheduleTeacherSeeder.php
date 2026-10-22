<?php

namespace Database\Seeders;

use App\Models\Schedule;
use App\Models\SchoolClass;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class XiiRpl2ScheduleTeacherSeeder extends Seeder
{
    /**
     * Mengisi guru pengampu (teacher_id) jadwal kelas XII RPL 2, sesuai data
     * yang diberikan user. TeacherSeeder utama (21 guru) TIDAK diubah — 3 guru
     * baru di bawah ini murni untuk mapel kelas ini dan ditambahkan terpisah
     * (bisa dikelola lagi lewat menu admin Guru kalau perlu diperbarui).
     */
    public function run(): void
    {
        $class = SchoolClass::where('name', 'XII RPL 2')->first();
        if (! $class) {
            return;
        }

        // Guru baru yang belum ada di TeacherSeeder utama
        $newTeachers = [
            ['name' => 'Richo Santana, S.Kom', 'subjects' => ['Pemrograman Web dan Mobile']],
            ['name' => 'Dra. Liesye Yulianti', 'subjects' => ['Bahasa Inggris']],
            ['name' => 'R. Radiani Srirestuti Dewi, S.S., Gr.', 'subjects' => ['Bahasa Jepang']],
        ];

        foreach ($newTeachers as $t) {
            $email = Str::slug($t['name']) . '@smkinfokom.sch.id';

            $user = User::updateOrCreate(
                ['email' => $email],
                ['name' => $t['name'], 'password' => Hash::make('guru12345'), 'role' => 'teacher', 'status' => 'active']
            );

            Teacher::updateOrCreate(
                ['user_id' => $user->id],
                ['subjects' => implode("\n", $t['subjects'])]
            );
        }

        // Pemetaan mapel (nama persis seperti di ScheduleSeeder) -> nama guru pengampu
        $map = [
            'Matematika' => 'Mila Yaelasari',
            'Bahasa Indonesia' => 'Yeni Yuliawati',
            'PWM' => 'Richo Santana, S.Kom',
            'Pemrograman GIM' => 'Erwin Hasiholan Gultom',
            'Bahasa Inggris' => 'Dra. Liesye Yulianti',
            'Bahasa Jepang' => 'R. Radiani Srirestuti Dewi, S.S., Gr.',
            'Robotik' => 'Ridwan Halla',
            'PBO' => 'Erwin Hasiholan Gultom',
            'Prakarya' => 'Vera Yuni Astuti, S.P.',
            'Pendidikan Pancasila' => 'Agus Tiyono',
            'PABP' => 'Dra. Popon Puspitasari',
        ];

        foreach ($map as $subjectName => $teacherName) {
            $subject = Subject::where('name', $subjectName)->first();
            $teacherUser = User::where('name', $teacherName)->first();
            if (! $subject || ! $teacherUser) {
                continue;
            }
            $teacher = Teacher::where('user_id', $teacherUser->id)->first();
            if (! $teacher) {
                continue;
            }

            Schedule::where('class_id', $class->id)
                ->where('subject_id', $subject->id)
                ->update(['teacher_id' => $teacher->id]);
        }
    }
}
