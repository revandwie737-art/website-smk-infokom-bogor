<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SchoolClass extends Model
{
    protected $table = "classes";

    protected $fillable = ["name", "program_id", "grade", "homeroom_teacher_id"];

    public function program()
    {
        return $this->belongsTo(Program::class);
    }

    public function students()
    {
        return $this->hasMany(Student::class, "class_id");
    }

    public function homeroomTeacher()
    {
        return $this->belongsTo(Teacher::class, "homeroom_teacher_id");
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class, "class_id");
    }
}
