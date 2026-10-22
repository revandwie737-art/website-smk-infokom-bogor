<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Program extends Model
{
    protected $fillable = [
        "name", "code", "slug", "photo", "lab_photo", "logo", "background", "description", "competencies",
        "prospects", "facilities", "subjects", "sort_order", "is_active",
    ];

    protected function casts(): array
    {
        return ["is_active" => "boolean"];
    }

    protected static function booted()
    {
        static::saving(function ($program) {
            if (empty($program->slug)) {
                $program->slug = Str::slug($program->name);
            }
        });
    }

    public function news()
    {
        return $this->hasMany(News::class);
    }

    public function classes()
    {
        return $this->hasMany(SchoolClass::class, "program_id");
    }
}