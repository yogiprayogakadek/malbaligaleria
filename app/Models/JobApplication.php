<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class JobApplication extends Model
{
    protected $fillable = [
        'uuid',
        'job_vacancy_id',
        'name',
        'email',
        'phone',
        'address',
        'cover_letter',
        'cv_path',
        'status',
        'notes',
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

    public function vacancy()
    {
        return $this->belongsTo(JobVacancy::class, 'job_vacancy_id');
    }

    public function getStatusLabelAttribute(): string
    {
        return match($this->status) {
            'new'       => 'New',
            'reviewed'  => 'Reviewed',
            'interview' => 'Interview',
            'accepted'  => 'Accepted',
            'rejected'  => 'Rejected',
            'on_hold'   => 'On Hold',
            default     => ucfirst($this->status),
        };
    }

    public function getStatusBadgeAttribute(): string
    {
        return match($this->status) {
            'new'       => 'bg-info',
            'reviewed'  => 'bg-warning',
            'interview' => 'bg-primary',
            'accepted'  => 'bg-success',
            'rejected'  => 'bg-danger',
            'on_hold'   => 'bg-secondary',
            default     => 'bg-secondary',
        };
    }

    public function reviews()
    {
        return $this->hasMany(JobApplicationReview::class, 'job_application_id')->latest();
    }

    public function getAverageRatingAttribute(): ?float
    {
        $avg = $this->reviews()->whereNotNull('rating')->avg('rating');
        return $avg ? round($avg, 1) : null;
    }
}
