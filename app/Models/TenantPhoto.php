<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TenantPhoto extends Model
{
    protected $fillable = [
        'tenant_id',
        'path',
        'caption',
        'is_primary'
    ];

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }
}
