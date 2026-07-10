<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IpWhitelist extends Model
{
    protected $fillable = [
        'subdomain',
        'ip_address',
        'label',
        'is_active',
        'created_by',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // ── Relations ──────────────────────────────────────────────────────────

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // ── Scopes ─────────────────────────────────────────────────────────────

    public function scopeActiveFor($query, string $subdomain)
    {
        return $query->where('subdomain', $subdomain)->where('is_active', true);
    }

    // ── Helpers ────────────────────────────────────────────────────────────

    /**
     * Check if a given IP is allowed for a subdomain.
     * Returns true if whitelist is empty (open access) or IP is in the list.
     */
    public static function isAllowed(string $subdomain, string $ip): bool
    {
        $activeList = static::where('subdomain', $subdomain)
            ->where('is_active', true)
            ->pluck('ip_address');

        if ($activeList->isEmpty()) {
            return true; // No restriction set — open access
        }

        return $activeList->contains($ip);
    }
}
