<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StructureMember extends Model
{
    protected $fillable = ["section", "group_label", "name", "role", "sort_order"];

    public const SECTIONS = [
        "waka" => "Wakil Kepala Sekolah",
        "inti" => "Unsur Inti",
        "kaprog" => "Kepala Program Keahlian",
        "staff" => "Staf / Guru Lain (kelompok bebas)",
    ];
}