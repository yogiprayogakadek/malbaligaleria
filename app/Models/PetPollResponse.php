<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PetPollResponse extends Model
{
    protected $fillable = [
        'pet_poll_id',
        'tenant_id',
        'allows_pets',
        'note',
        'ip_address',
        'user_agent',
        'responded_at',
    ];

    protected $casts = [
        'allows_pets' => 'boolean',
        'responded_at' => 'datetime',
    ];

    public function poll(): BelongsTo
    {
        return $this->belongsTo(PetPoll::class, 'pet_poll_id');
    }

    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }
}
