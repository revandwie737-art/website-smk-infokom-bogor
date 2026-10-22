<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IndustrialVisitPhoto extends Model
{
    protected $fillable = ['industrial_visit_id', 'image', 'caption', 'sort_order'];

    public function visit()
    {
        return $this->belongsTo(IndustrialVisit::class, 'industrial_visit_id');
    }
}