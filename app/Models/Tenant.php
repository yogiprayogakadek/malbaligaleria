<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Tenant extends Model
{
    use SoftDeletes, LogsActivity;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'uuid',
        'category_id',
        'type',
        'name',
        'phone',
        'email',
        'map_coords',
        'path_coords',
        'map_original_size',
        'logo',
        'description',
        'website',
        'is_active',
        'isNew',
        'launched_at',
    ];
    
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name', 'category_id', 'type', 'is_active', 'email', 'phone'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }

    protected $casts = [
        'map_coords' => 'array',
        'path_coords' => 'array',
        'map_original_size' => 'array',
        'launched_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->uuid)) {
                $model->uuid = (string) Str::uuid();
            }
        });

        static::deleted(function ($model) {
            $model->promos()->delete();
        });

        static::restored(function ($model) {
            $model->promos()->withTrashed()->restore();
        });

        static::forceDeleted(function ($model) {
            if (!empty($model->logo)) {
                $relativePath = 'tenant_images/' . basename($model->logo);
                if (\Illuminate\Support\Facades\Storage::disk('public')->exists($relativePath)) {
                    \Illuminate\Support\Facades\Storage::disk('public')->delete($relativePath);
                }
            }

            foreach ($model->photos as $photo) {
                $relativePath = 'tenant_images/' . basename($photo->path);
                if (\Illuminate\Support\Facades\Storage::disk('public')->exists($relativePath)) {
                    \Illuminate\Support\Facades\Storage::disk('public')->delete($relativePath);
                }
            }

            foreach ($model->promos()->withTrashed()->get() as $promo) {
                $promo->forceDelete();
            }
        });
    }

    public function promos()
    {
        return $this->hasMany(Promo::class);
    }

    public function photos()
    {
        return $this->hasMany(TenantPhoto::class);
    }

    public function primaryPhoto()
    {
        return $this->hasOne(TenantPhoto::class)->where('is_primary', true);
    }

    public function albumPhoto()
    {
        return $this->hasMany(TenantPhoto::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // public function getRouteKeyName()
    // {
    //     return 'uuid';
    // }
}
