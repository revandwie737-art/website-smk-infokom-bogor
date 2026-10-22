<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    protected $fillable = ["class_id", "subject_id", "teacher_id", "title", "description", "file", "deadline"];
    protected function casts(): array { return ["deadline" => "datetime"]; }

    public function schoolClass()
    {
        return $this->belongsTo(SchoolClass::class, "class_id");
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function submissions()
    {
        return $this->hasMany(AssignmentSubmission::class);
    }
}
