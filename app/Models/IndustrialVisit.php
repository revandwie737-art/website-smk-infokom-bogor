<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class IndustrialVisit extends Model
{
    protected $fillable = ['title', 'slug', 'company', 'visit_date', 'description', 'cover', 'is_published'];

    protected function casts(): array
    {
        return ['visit_date' => 'date', 'is_published' => 'boolean'];
    }

    protected static function booted()
    {
        static::saving(function ($visit) {
            if (empty($visit->slug)) {
                $visit->slug = Str::slug($visit->title) . '-' . Str::random(5);
            }
        });
    }

    public function photos()
    {
        return $this->hasMany(IndustrialVisitPhoto::class)->orderBy('sort_order')->orderBy('id');
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    /** URL cover; kalau cover kosong, pakai foto pertama dari galeri. */
    public function getCoverUrlAttribute(): ?string
    {
        if ($this->cover) {
            return asset('storage/' . $this->cover);
        }
        $first = $this->relationLoaded('photos') ? $this->photos->first() : $this->photos()->first();

        return $first ? asset('storage/' . $first->image) : null;
    }
}