<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $fillable = ["user_id", "nip", "photo", "position", "phone", "bio", "subjects"];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Mata pelajaran disimpan sebagai teks satu baris per mapel.
     * Accessor ini mengembalikan array supaya mudah ditampilkan sebagai chip/list.
     */
    public function getSubjectsListAttribute(): array
    {
        if (empty($this->subjects)) {
            return [];
        }

        return collect(preg_split('/\r\n|\r|\n|,/', $this->subjects))
            ->map(fn ($s) => trim($s))
            ->filter()
            ->values()
            ->all();
    }
}
