<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassMember extends Model
{
    protected $fillable = ["class_id", "name", "role", "photo", "sort_order"];

    public function schoolClass()
    {
        return $this->belongsTo(SchoolClass::class, "class_id");
    }
}
