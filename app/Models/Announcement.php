<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Announcement extends Model
{
    use LogsActivity;

    protected $fillable = [
        'title',
        'message',
        'image',
        'type',
        'start_date',
        'end_date',
        'is_active',
        'link',
        'target_page',
        'frequency'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['title', 'message', 'image', 'type', 'start_date', 'end_date', 'is_active', 'link', 'target_page', 'frequency'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }
}
