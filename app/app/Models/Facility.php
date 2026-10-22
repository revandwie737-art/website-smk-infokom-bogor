<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    protected $fillable = ["name", "photo", "background", "description", "quantity", "sort_order"];
}
