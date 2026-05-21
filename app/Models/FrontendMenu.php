<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FrontendMenu extends Model
{
    protected $fillable = [
        'name',
        'url',
        'is_active',
        'roles',
        'order',
    ];

    protected $casts = [
        'roles' => 'array',
        'is_active' => 'boolean',
    ];
}
