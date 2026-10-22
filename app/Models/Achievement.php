<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Achievement extends Model
{
    protected $fillable = [
        "title", "student_name", "category", "level", "year",
        "description", "photo", "background", "certificate", "link",
    ];
}
