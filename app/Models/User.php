<?php

namespace App\Models;
use Illuminate\Support\Str;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $keyType = 'string'; // Pastikan ini diatur untuk UUID
    public $incrementing = false; // Non-incrementing karena menggunakan UUID

    protected $fillable = [
        'id',
        'name',
        'email',
        'password',
        'role',
        'status',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected static function booted()
{
    static::creating(function ($model) {
        $model->id = (string) Str::uuid();
    });
}
}

