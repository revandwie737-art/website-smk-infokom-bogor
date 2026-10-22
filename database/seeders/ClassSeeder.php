<?php

namespace Database\Seeders;

use App\Models\Program;
use App\Models\SchoolClass;
use Illuminate\Database\Seeder;

class ClassSeeder extends Seeder
{
    public function run(): void
    {
        $programs = Program::all();
        foreach ($programs as $program) {
            foreach (['X', 'XI', 'XII'] as $grade) {
                SchoolClass::updateOrCreate(
                    ['name' => "{$grade} {$program->code} 1"],
                    ['program_id' => $program->id, 'grade' => $grade]
                );
            }
        }
    }
}
