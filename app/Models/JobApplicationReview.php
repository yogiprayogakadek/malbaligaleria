<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobApplicationReview extends Model
{
    protected $fillable = [
        'job_application_id',
        'user_id',
        'rating',
        'notes',
    ];

    public function application()
    {
        return $this->belongsTo(JobApplication::class, 'job_application_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
