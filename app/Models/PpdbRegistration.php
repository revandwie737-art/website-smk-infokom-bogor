<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PpdbRegistration extends Model
{
    protected $table = "ppdb_registrations";

    protected $fillable = [
        "full_name", "birth_place", "birth_date", "gender", "email", "phone", "nisn", "previous_school",
        "program_id", "wave",
        "address", "address_street", "address_rt_rw", "address_village", "address_district", "address_city", "address_postal_code",
        "father_name", "father_job", "father_phone",
        "mother_name", "mother_job", "mother_phone",
        "guardian_name", "guardian_relation", "guardian_job", "guardian_phone", "guardian_address",
        "document_file", "status",
    ];

    protected $casts = [
        "birth_date" => "date",
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
            "gelombang_3" => "Gelombang 3",
            default => null,
        };
    }

    public function getGenderLabelAttribute(): ?string
    {
        return match ($this->gender) {
            "L" => "Laki-laki",
            "P" => "Perempuan",
            default => null,
        };
    }

    public function getFullAddressAttribute(): ?string
    {
        $parts = array_filter([
            $this->address_street,
            $this->address_rt_rw ? "RT/RW " . $this->address_rt_rw : null,
            $this->address_village ? "Kel./Desa " . $this->address_village : null,
            $this->address_district ? "Kec. " . $this->address_district : null,
            $this->address_city,
            $this->address_postal_code,
        ]);
        return $parts ? implode(", ", $parts) : $this->address;
    }
}
