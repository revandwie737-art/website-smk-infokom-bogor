<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $fillable = ["title", "file", "category", "is_public"];
    protected function casts(): array { return ["is_public" => "boolean"]; }
}
