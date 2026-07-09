<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class JobVacancy extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'uuid',
        'title',
        'department',
        'type',
        'location',
        'description',
        'requirements',
        'responsibilities',
        'salary_range',
        'flyer_path',
        'deadline',
        'closing_date',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'deadline'  => 'date',
        'closing_date' => 'date',
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

    public function applications()
    {
        return $this->hasMany(JobApplication::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function getTypeLabelAttribute(): string
    {
        return match($this->type) {
            'full-time'   => 'Full Time',
            'part-time'   => 'Part Time',
            'contract'    => 'Contract',
            'internship'  => 'Internship',
            default       => ucfirst($this->type),
        };
    }

    public function isExpired(): bool
    {
        if ($this->closing_date) {
            return $this->closing_date->isPast() && !$this->closing_date->isToday();
        }
        if ($this->deadline) {
            return $this->deadline->isPast() && !$this->deadline->isToday();
        }
        return false;
    }
}
