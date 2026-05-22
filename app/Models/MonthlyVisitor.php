<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MonthlyVisitor extends Model
{
    protected $fillable = [
        'year',
        'month',
        'visit_count',
    ];
}
