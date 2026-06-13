<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class EventPhoto extends Model
{
    use LogsActivity, SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = [
        'event_id',
        'path',
        'caption',
        'is_primary',
        'sort_order',
    ];
    
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['event_id', 'caption', 'is_primary', 'sort_order'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::forceDeleted(function ($model) {
            if (!empty($model->path)) {
                $relativePath = 'event_images/' . basename($model->path);
                if (\Illuminate\Support\Facades\Storage::disk('public')->exists($relativePath)) {
                    \Illuminate\Support\Facades\Storage::disk('public')->delete($relativePath);
                }
            }
        });
    }
}
