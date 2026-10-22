<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $fillable = ["title", "youtube_url", "thumbnail", "description", "sort_order"];

    public function getEmbedUrlAttribute(): string
    {
        $url = $this->youtube_url;
        if (str_contains($url, "watch?v=")) {
            $id = explode("watch?v=", $url)[1] ?? "";
            $id = explode("&", $id)[0];
        } elseif (str_contains($url, "youtu.be/")) {
            $id = explode("youtu.be/", $url)[1] ?? "";
        } else {
            $id = $url;
        }
        return "https://www.youtube.com/embed/" . $id;
    }
}
