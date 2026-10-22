<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    protected $fillable = ["title", "content", "priority", "is_active", "expires_at"];
    protected function casts(): array { return ["is_active" => "boolean", "expires_at" => "date"]; }

    public function scopeActive($query)
    {
        return $query->where("is_active", true)->where(function ($q) {
            $q->whereNull("expires_at")->orWhere("expires_at", ">=", now()->toDateString());
        });
    }
}
