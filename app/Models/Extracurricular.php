<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Extracurricular extends Model
{
    protected $fillable = ["name", "logo", "background", "coach", "schedule", "description", "is_active"];
    protected function casts(): array { return ["is_active" => "boolean"]; }
}
