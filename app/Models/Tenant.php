<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Tenant extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'uuid',
        'category_id',
        'name',
        'phone',
        'email',
        'map_coords',
        'map_original_size',
        'logo',
        'description',
        'is_active',
        'website',
    ];

    protected $casts = [
        'map_coords' => 'array',
        'map_original_size' => 'array',
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
