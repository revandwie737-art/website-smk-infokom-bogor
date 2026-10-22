<?php

namespace Database\Seeders;

use App\Models\Schedule;
use App\Models\SchoolClass;
use App\Models\Subject;
use Illuminate\Database\Seeder;

class ScheduleSeeder extends Seeder
{
    /**
     * Jadwal pelajaran kelas XII RPL 2, sesuai data yang diberikan user.
     * Mata pelajaran yang belum ada di tabel subjects akan dibuat otomatis.
     * teacher_id sengaja dikosongkan (null) karena user belum menentukan
     * guru pengampu tiap mapel untuk kelas ini — admin bisa isi manual
     * lewat menu Jadwal kalau sudah ada datanya.
     */
    public function run(): void
    {
        $class = SchoolClass::where('name', 'XII RPL 2')->first();
        if (! $class) {
            return;
        }

        $schedule = [
            'senin' => [
                ['06:30', '08:30', 'Upacara'],
                ['08:30', '10:00', 'Matematika'],
                ['10:00', '10:30', 'Istirahat'],
                ['10:30', '12:00', 'Bahasa Indonesia'],
                ['12:00', '12:30', 'Istirahat'],
                ['12:30', '15:30', 'PWM'],
            ],
            'selasa' => [
                ['06:30', '07:00', 'Karakter'],
                ['07:00', '08:30', 'Pemrograman GIM'],
                ['08:30', '10:00', 'Bahasa Inggris'],
                ['10:00', '10:30', 'Istirahat'],
                ['10:30', '12:00', 'Bahasa Jepang'],
                ['12:00', '12:30', 'Istirahat'],
                ['12:30', '15:30', 'Robotik'],
            ],
            'rabu' => [
                ['06:30', '07:00', 'Karakter'],
                ['07:00', '08:30', 'PBO'],
                ['08:30', '10:00', 'Matematika'],
                ['10:00', '10:30', 'Istirahat'],
                ['10:30', '12:00', 'Prakarya'],
                ['12:00', '12:30', 'Istirahat'],
                ['12:30', '15:30', 'PWM'],
            ],
            'kamis' => [
                ['06:30', '07:00', 'Karakter'],
                ['07:00', '08:30', 'Pendidikan Pancasila'],
                ['08:30', '10:00', 'Bahasa Indonesia'],
                ['10:00', '10:30', 'Istirahat'],
                ['10:30', '12:00', 'Bahasa Inggris'],
                ['12:00', '12:30', 'Istirahat'],
                ['12:30', '15:30', 'PBO'],
            ],
            'jumat' => [
                ['06:30', '07:00', 'Karakter'],
                ['07:00', '08:20', 'Prakarya'],
                ['08:20', '09:40', 'PABP'],
                ['09:40', '10:00', 'Istirahat'],
                ['10:00', '10:40', 'PABP'],
                ['10:40', '11:20', 'Pemrograman GIM'],
                ['11:20', '13:00', 'Istirahat'],
                ['13:00', '14:30', 'Pemrograman GIM'],
            ],
        ];

        // Hapus jadwal lama kelas ini biar tidak dobel kalau seeder dijalankan ulang
        Schedule::where('class_id', $class->id)->delete();

        foreach ($schedule as $day => $sessions) {
            foreach ($sessions as [$start, $end, $subjectName]) {
                $subject = Subject::firstOrCreate(['name' => $subjectName]);

                Schedule::create([
                    'class_id' => $class->id,
                    'subject_id' => $subject->id,
                    'teacher_id' => null,
                    'day' => $day,
                    'start_time' => $start,
                    'end_time' => $end,
                ]);
            }
        }
    }
}
