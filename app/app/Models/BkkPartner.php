<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BkkPartner extends Model
{
    protected $fillable = ["name", "logo", "description", "website", "sort_order"];
}
