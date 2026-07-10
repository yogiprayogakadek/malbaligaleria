<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class InventoryItem extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'uuid',
        'category_id',
        'parent_id',
        'name',
        'brand',
        'model',
        'serial_number',
        'location',
        'status',
        'quantity',
        'specs',
        'notes',
        'image_path',
    ];

    protected $casts = [
        'specs' => 'array',
        'quantity' => 'integer',
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

    public function category()
    {
        return $this->belongsTo(InventoryCategory::class, 'category_id');
    }

    public function parent()
    {
        return $this->belongsTo(InventoryItem::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(InventoryItem::class, 'parent_id');
    }

    public function histories()
    {
        return $this->hasMany(InventoryHistory::class, 'inventory_item_id');
    }
}
