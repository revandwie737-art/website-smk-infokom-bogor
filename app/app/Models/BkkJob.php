<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BkkJob extends Model
{
    protected $fillable = [
        "company_name", "position", "location", "program_id", "qualifications",
        "job_type", "deadline", "description", "apply_link", "is_active",
    ];

    protected function casts(): array
    {
        return ["is_active" => "boolean", "deadline" => "date"];
    }

    public function program()
    {
        return $this->belongsTo(Program::class);
    }

    public function getJobTypeLabelAttribute(): string
    {
        return match ($this->job_type) {
            "penuh_waktu" => "Penuh Waktu",
            "paruh_waktu" => "Paruh Waktu",
            "magang" => "Magang",
            "kontrak" => "Kontrak",
            default => $this->job_type,
        };
    }
}
