<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    protected $fillable = ["user_id", "action"];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function log(string $action): void
    {
        static::create([
            "user_id" => auth()->id(),
            "action" => $action,
        ]);
    }
}
