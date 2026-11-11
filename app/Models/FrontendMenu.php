<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FrontendMenu extends Model
{
    protected $fillable = [
        'name',
        'url',
        'is_active',
        'roles',
        'order',
    ];

    protected $casts = [
        'roles' => 'array',
        'is_active' => 'boolean',
    ];

    /**
     * Resolve the menu destination. External URLs are used as-is.
     */
    public function getLinkAttribute(): string
    {
        return preg_match('#^https?://#i', $this->url) ? $this->url : url($this->url);
    }
}
