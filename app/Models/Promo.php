<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Promo extends Model
{
    use SoftDeletes, LogsActivity;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'uuid',
        'name',
        'tenant_id',
        'start_date',
        'end_date',
        'description',
        'is_active',
        'banner'
    ];
    
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name', 'tenant_id', 'start_date', 'end_date', 'is_active'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->uuid)) {
                $model->uuid = (string) Str::uuid();
            }
        });

        static::forceDeleted(function ($model) {
            foreach ($model->banners as $b) {
                if (!empty($b)) {
                    $relativePath = 'promo_images/' . basename($b);
                    if (\Illuminate\Support\Facades\Storage::disk('public')->exists($relativePath)) {
                        \Illuminate\Support\Facades\Storage::disk('public')->delete($relativePath);
                    }
                }
            }
        });
    }

    public function getBannersAttribute()
    {
        $val = $this->banner;
        if (empty($val)) {
            return [];
        }
        if (is_array($val)) {
            return $val;
        }
        if (str_starts_with($val, '[') && str_ends_with($val, ']')) {
            $decoded = json_decode($val, true);
            if (is_array($decoded)) {
                return $decoded;
            }
        }
        return [$val];
    }

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }
}
