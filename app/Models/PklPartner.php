<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PklPartner extends Model
{
    protected $fillable = [
        "name", "field", "address", "description", "logo", "website", "is_active", "sort_order",
    ];

    protected function casts(): array
    {
        return ["is_active" => "boolean"];
    }
}
