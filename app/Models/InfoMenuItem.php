<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InfoMenuItem extends Model
{
    protected $fillable = ["icon", "label", "description", "url", "sort_order", "is_active"];

    protected $casts = [
        "is_active" => "boolean",
    ];

    public static function forMenu()
    {
        return static::where("is_active", true)->orderBy("sort_order")->get();
    }
}