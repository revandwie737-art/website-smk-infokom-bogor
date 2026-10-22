<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    protected $fillable = [
        "student_id", "subject_id", "academic_year_id", "tugas", "uts", "uas", "nilai_akhir",
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    protected static function booted()
    {
        static::saving(function ($grade) {
            if ($grade->tugas !== null && $grade->uts !== null && $grade->uas !== null) {
                $grade->nilai_akhir = round(($grade->tugas * 0.3) + ($grade->uts * 0.3) + ($grade->uas * 0.4), 2);
            }
        });
    }
}
