<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Facility extends Model
{
    protected $fillable = ["name", "photo", "background", "description", "quantity", "sort_order", "extra_photos"];

    protected $casts = ["extra_photos" => "array"];

    // Galeri foto tambahan hanya untuk fasilitas Laboratorium.
    public function supportsGallery(): bool
    {
        return Str::contains(Str::lower((string) $this->name), "laboratorium");
    }
}