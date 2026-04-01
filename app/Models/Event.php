<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Event extends Model
{
    use SoftDeletes, LogsActivity;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'uuid',
        'name',
        'start_date',
        'end_date',
        'start_time',
        'end_time',
        'description',
        'location',
        'organizer',
        'is_paid',
        'price',
        'target_audience',
        'highlights',
        'is_active',
        'type',
        'is_regular',
        'recurring_label',
        'specific_dates',
    ];
    
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name', 'start_date', 'end_date', 'location', 'type', 'is_active', 'is_regular', 'is_exhibition'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }

    protected $casts = [
        'type'           => 'string',
        'is_regular'     => 'boolean',
        'is_exhibition'  => 'boolean',
        'recurring_days' => 'array',
        'is_paid'        => 'boolean',
        'is_active'      => 'boolean',
        'specific_dates' => 'array',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->uuid)) {
                $model->uuid = (string) Str::uuid();
            }
        });
    }

    public function photos()
    {
        return $this->hasMany(EventPhoto::class)->orderBy('sort_order');
    }

    public function primaryPhoto()
    {
        return $this->hasOne(EventPhoto::class)->where('is_primary', true);
    }
}
