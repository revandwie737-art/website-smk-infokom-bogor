<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class JapanInternship extends Model
{
    /** Jumlah maksimal foto aktif yang tampil di halaman publik. */
    public const MAX_ACTIVE = 3;

    protected $fillable = [
        'title',
        'description',
        'image',
        'source_name',
        'source_url',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('sort_order')->orderBy('id');
    }

    /**
     * URL foto. Disajikan lewat route Laravel (magang-jepang.photo), bukan lewat tautan public/storage,
     * supaya tidak bergantung pada symlink. Parameter v = penanda versi agar browser memuat ulang saat foto diganti.
     */
    public function getImageUrlAttribute(): string
    {
        return route('magang-jepang.photo', [
            'japanInternship' => $this->getKey(),
            'v' => $this->updated_at?->timestamp,
        ]);
    }
}