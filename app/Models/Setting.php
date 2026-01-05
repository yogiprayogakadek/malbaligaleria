<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'name',
        'payload',
        'description',
        'is_active'
    ];

    protected $casts = [
        'payload' => 'array',
        'is_active' => 'boolean'
    ];
}
