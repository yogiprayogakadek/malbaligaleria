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
}
