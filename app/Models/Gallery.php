<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Gallery extends Model
{
    use LogsActivity;

    protected $fillable = [
        'path',
        'title',
        'is_active',
        'sort_order'
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['path', 'title', 'is_active', 'sort_order'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }
}
