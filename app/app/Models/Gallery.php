<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Gallery extends Model
{
    protected $fillable = ["title", "slug", "cover", "background", "category", "event_date", "sort_order"];

    protected function casts(): array { return ["event_date" => "date"]; }

    protected static function booted()
    {
        static::saving(function ($gallery) {
            if (empty($gallery->slug)) {
                $gallery->slug = Str::slug($gallery->title) . "-" . Str::random(5);
            }
        });
    }

    public function images()
    {
        return $this->hasMany(GalleryImage::class)->orderBy("sort_order");
    }
}
