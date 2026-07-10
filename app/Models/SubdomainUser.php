<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubdomainUser extends Model
{
    protected $fillable = [
        'user_id',
        'subdomain',
        'is_active',
        'expires_at',
        'note',
        'granted_by',
    ];

    protected $casts = [
        'is_active'  => 'boolean',
        'expires_at' => 'datetime',
    ];

    // ── Relations ──────────────────────────────────────────────────────────

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function grantedBy()
    {
        return $this->belongsTo(User::class, 'granted_by');
    }

    // ── Scopes ─────────────────────────────────────────────────────────────

    /**
     * Active & not expired.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true)
            ->where(function ($q) {
                $q->whereNull('expires_at')
                  ->orWhere('expires_at', '>', now());
            });
    }
}
