<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 'title', 'description', 'status', 'due_date', 'assigned_to', 'created_by'
    ];

    protected $keyType = 'string';
    public $incrementing = false;
}

