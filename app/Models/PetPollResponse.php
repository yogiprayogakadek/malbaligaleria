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
        'email',
        'edit_token',
        'ip_address',
        'user_agent',
        'responded_at',
    ];

    protected $casts = [
        'allows_pets' => 'boolean',
        'responded_at' => 'datetime',
    ];

    public function getEditUrlAttribute(): ?string
    {
        return $this->edit_token ? route('frontend.pet-poll.edit', ['token' => $this->edit_token]) : null;
    }

    public function poll(): BelongsTo
    {
        return $this->belongsTo(PetPoll::class, 'pet_poll_id');
    }

    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }
}
