<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DailyVisitor extends Model
{
    protected $fillable = [
        'date',
        'visit_count',
    ];

    protected $casts = [
        'date' => 'date',
    ];
}
