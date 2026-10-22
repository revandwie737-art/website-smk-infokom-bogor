<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $table = "media";
    protected $fillable = ["name", "file_path", "mime_type", "size", "uploaded_by"];

    public function uploader()
    {
        return $this->belongsTo(User::class, "uploaded_by");
    }
}
