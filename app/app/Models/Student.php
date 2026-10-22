<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = ["user_id", "class_id", "nisn", "photo", "phone", "birth_date", "address"];

    protected function casts(): array
    {
        return ["birth_date" => "date"];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function schoolClass()
    {
        return $this->belongsTo(SchoolClass::class, "class_id");
    }

    public function grades()
    {
        return $this->hasMany(Grade::class);
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    public function submissions()
    {
        return $this->hasMany(AssignmentSubmission::class);
    }

    public function attendancePercentage(): float
    {
        $total = $this->attendances()->count();
        if ($total === 0) return 0;
        $hadir = $this->attendances()->where("status", "hadir")->count();
        return round(($hadir / $total) * 100, 1);
    }
}
