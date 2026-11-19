<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PetPoll extends Model
{
    protected $fillable = [
        'title',
        'question',
        'pet_scope',
        'sender_email',
        'sender_name',
        'mail_host',
        'mail_port',
        'mail_username',
        'mail_password',
        'mail_encryption',
        'closes_at',
        'is_open',
        'created_by',
    ];

    protected $casts = [
        'closes_at' => 'datetime',
        'is_open' => 'boolean',
        'mail_port' => 'integer',
        'mail_password' => 'encrypted',
    ];

    public function isOpen(): bool
    {
        return $this->is_open && ($this->closes_at === null || $this->closes_at->isFuture());
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function responses(): HasMany
    {
        return $this->hasMany(PetPollResponse::class);
    }
}
