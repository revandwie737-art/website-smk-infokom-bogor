<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SchoolSetting extends Model
{
    protected $fillable = ["key", "value"];

    public static function get(string $key, $default = null)
    {
        return cache()->rememberForever("setting_{$key}", function () use ($key, $default) {
            $row = static::where("key", $key)->first();
            return $row ? $row->value : $default;
        });
    }

    public static function set(string $key, $value): void
    {
        static::updateOrCreate(["key" => $key], ["value" => $value]);
        cache()->forget("setting_{$key}");
    }

    protected static function booted()
    {
        static::saved(fn ($setting) => cache()->forget("setting_{$setting->key}"));
        static::deleted(fn ($setting) => cache()->forget("setting_{$setting->key}"));
    }
}
