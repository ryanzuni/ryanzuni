<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ActivityLog extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'id', 'user_id', 'action', 'description', 'logged_at'
    ];

    protected static function booted()
    {
        static::creating(function ($model) {
            $model->id = Str::uuid();
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

