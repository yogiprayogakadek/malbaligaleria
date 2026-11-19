<?php

namespace App\Services;

use App\Models\PetPoll;
use App\Models\PetPollResponse;
use App\Models\Tenant;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Carbon;

class PetPollService
{
    public function current(): ?PetPoll
    {
        return PetPoll::query()->latest('id')->first();
    }

    public function searchTenants(string $query): Collection
    {
        return Tenant::query()
            ->with('category:id,name')
            ->where('is_active', true)
            ->where('type', 'tenant')
            ->where('name', 'like', '%' . $query . '%')
            ->orderBy('name')
            ->limit(20)
            ->get(['id', 'name', 'category_id']);
    }
}
