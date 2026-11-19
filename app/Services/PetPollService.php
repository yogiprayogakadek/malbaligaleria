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

    public function submit(PetPoll $poll, array $data, ?string $ip, ?string $userAgent): PetPollResponse
    {
        return PetPollResponse::updateOrCreate(
            [
                'pet_poll_id' => $poll->id,
                'tenant_id' => $data['tenant_id'],
            ],
            [
                'allows_pets' => (bool) $data['allows_pets'],
                'note' => $data['note'] ?? null,
                'ip_address' => $ip,
                'user_agent' => $userAgent,
                'responded_at' => now(),
            ]
        );
    }

    public function stats(PetPoll $poll): array
    {
        $totalTenants = Tenant::query()->where('is_active', true)->where('type', 'tenant')->count();
        $answered = PetPollResponse::query()->where('pet_poll_id', $poll->id)->count();
        $allowed = PetPollResponse::query()->where('pet_poll_id', $poll->id)->where('allows_pets', true)->count();
        $denied = PetPollResponse::query()->where('pet_poll_id', $poll->id)->where('allows_pets', false)->count();
        $unanswered = max(0, $totalTenants - $answered);

        return [
            'total' => $totalTenants,
            'answered' => $answered,
            'allowed' => $allowed,
            'denied' => $denied,
            'unanswered' => $unanswered,
            'percentage' => $totalTenants > 0 ? (int) round(($answered / $totalTenants) * 100) : 0,
        ];
    }

    public function responseQuery(PetPoll $poll, string $filter = 'all', ?string $search = null): Builder
    {
        $query = PetPollResponse::query()
            ->with(['tenant.category'])
            ->where('pet_poll_id', $poll->id);

        if ($filter === 'allowed') {
            $query->where('allows_pets', true);
        } elseif ($filter === 'denied') {
            $query->where('allows_pets', false);
        }

        if (!empty($search)) {
            $query->whereHas('tenant', function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%');
            });
        }

        return $query->latest('responded_at');
    }

    public function unansweredTenantQuery(PetPoll $poll, ?string $search = null): Builder
    {
        $answeredIds = PetPollResponse::query()
            ->where('pet_poll_id', $poll->id)
            ->pluck('tenant_id');

        $query = Tenant::query()
            ->with('category:id,name')
            ->where('is_active', true)
            ->where('type', 'tenant')
            ->whereNotIn('id', $answeredIds);

        if (!empty($search)) {
            $query->where('name', 'like', '%' . $search . '%');
        }

        return $query->orderBy('name');
    }
}
