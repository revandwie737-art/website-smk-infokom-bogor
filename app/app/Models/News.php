<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class News extends Model
{
    protected $table = "news";

    protected $fillable = [
        "title", "slug", "thumbnail", "content", "excerpt", "category_id",
        "author_id", "status", "published_at", "views", "seo_title", "seo_description",
        "instagram_url",
    ];

    protected function casts(): array
    {
        return ["published_at" => "datetime"];
    }

    protected static function booted()
    {
        static::saving(function ($news) {
            if (empty($news->slug)) {
                $news->slug = Str::slug($news->title) . "-" . Str::random(5);
            }
        });
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, "author_id");
    }

    public function scopePublished($query)
    {
        return $query->where("status", "published")->where(function ($q) {
            $q->whereNull("published_at")->orWhere("published_at", "<=", now());
        });
    }
}
