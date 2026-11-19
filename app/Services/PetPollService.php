<?php

namespace App\Services;

use App\Mail\PetPollEditLinkMail;
use App\Models\PetPoll;
use App\Models\PetPollResponse;
use App\Models\Tenant;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class PetPollService
{
    public function current(): ?PetPoll
    {
        return PetPoll::query()->latest('id')->first();
    }

    public function findByToken(string $token): ?PetPollResponse
    {
        return PetPollResponse::query()
            ->with(['poll', 'tenant.category'])
            ->where('edit_token', $token)
            ->first();
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
        $existing = PetPollResponse::query()
            ->where('pet_poll_id', $poll->id)
            ->where('tenant_id', $data['tenant_id'])
            ->first();

        if ($existing) {
            $token = $data['token'] ?? null;
            if (!$token || $existing->edit_token !== $token) {
                throw ValidationException::withMessages([
                    'tenant_id' => 'Tenant ini sudah pernah mengirim jawaban. Untuk mengubah jawaban, gunakan tautan edit resmi yang telah diberikan.',
                ]);
            }

            $existing->update([
                'allows_pets' => (bool) $data['allows_pets'],
                'note' => $data['note'] ?? $existing->note,
                'email' => $data['email'] ?? $existing->email,
                'ip_address' => $ip,
                'user_agent' => $userAgent,
                'responded_at' => now(),
            ]);

            $response = $existing;
        } else {
            $response = PetPollResponse::create([
                'pet_poll_id' => $poll->id,
                'tenant_id' => $data['tenant_id'],
                'allows_pets' => (bool) $data['allows_pets'],
                'note' => $data['note'] ?? null,
                'email' => $data['email'] ?? null,
                'edit_token' => Str::random(48),
                'ip_address' => $ip,
                'user_agent' => $userAgent,
                'responded_at' => now(),
            ]);
        }

        if (!empty($response->email)) {
            $this->sendEditLinkEmail($response);
        }

        return $response;
    }

    public function sendEditLinkEmail(PetPollResponse $response): void
    {
        try {
            Mail::to($response->email)->send(new PetPollEditLinkMail($response));
        } catch (\Throwable $e) {
            Log::warning('Pet poll confirmation email failed: ' . $e->getMessage(), [
                'response_id' => $response->id,
                'email' => $response->email,
            ]);
        }
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

    public function createDefault(?int $userId = null): PetPoll
    {
        return PetPoll::create([
            'title' => 'Survei Pet Friendly',
            'question' => 'Apakah tenant Anda mengizinkan pet masuk ke area tenant?',
            'pet_scope' => 'Anjing dan kucing, wajib memakai tali atau carrier.',
            'closes_at' => null,
            'is_open' => true,
            'created_by' => $userId,
        ]);
    }

    public function hasResponses(PetPoll $poll): bool
    {
        return PetPollResponse::query()->where('pet_poll_id', $poll->id)->exists();
    }

    public function resetResponses(PetPoll $poll): int
    {
        return PetPollResponse::query()->where('pet_poll_id', $poll->id)->delete();
    }
}
