<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Gallery extends Model
{
    use LogsActivity, SoftDeletes;

    protected $dates = ['deleted_at'];

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

    protected static function boot()
    {
        parent::boot();

        static::forceDeleted(function ($model) {
            if (!empty($model->path)) {
                if (\Illuminate\Support\Facades\Storage::disk('public')->exists($model->path)) {
                    \Illuminate\Support\Facades\Storage::disk('public')->delete($model->path);
                }
            }
        });
    }
}
