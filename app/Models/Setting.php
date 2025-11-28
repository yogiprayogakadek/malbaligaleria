<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'name',
        'payload',
        'description'
    ];

    protected $casts = [
        'payload' => 'array'
    ];
}
