<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PpdbRegistration extends Model
{
    protected $table = "ppdb_registrations";

    protected $fillable = [
        "full_name", "email", "phone", "nisn", "previous_school",
        "program_id", "wave", "address", "document_file", "status",
    ];

    public function program()
    {
        return $this->belongsTo(Program::class);
    }

    public function getWaveLabelAttribute(): ?string
    {
        return match ($this->wave) {
            "gelombang_1" => "Gelombang 1",
            "gelombang_2" => "Gelombang 2",
            default => null,
        };
    }
}
