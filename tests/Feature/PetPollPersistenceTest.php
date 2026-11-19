<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\PetPoll;
use App\Models\PetPollResponse;
use App\Models\Tenant;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PetPollPersistenceTest extends TestCase
{
    use RefreshDatabase;

    public function test_poll_open_state_follows_flag_and_deadline(): void
    {
        $poll = PetPoll::create([
            'title' => 'Survei Pet Friendly',
            'question' => 'Apakah tenant Anda mengizinkan pet masuk ke area tenant?',
            'pet_scope' => 'Anjing dan kucing, wajib memakai tali atau carrier.',
            'is_open' => true,
        ]);

        $this->assertTrue($poll->isOpen());

        $poll->update(['closes_at' => now()->subMinute()]);
        $this->assertFalse($poll->fresh()->isOpen());

        $poll->update(['closes_at' => null, 'is_open' => false]);
        $this->assertFalse($poll->fresh()->isOpen());
    }

    public function test_one_response_per_tenant_per_poll(): void
    {
        $poll = PetPoll::create([
            'title' => 'Survei Pet Friendly',
            'question' => 'Pertanyaan',
            'pet_scope' => 'Cakupan',
            'is_open' => true,
        ]);

        $category = Category::create([
            'name' => 'Fashion',
            'color_zone' => 'red',
            'is_active' => true,
        ]);

        $tenant = Tenant::create([
            'category_id' => $category->id,
            'type' => 'tenant',
            'name' => 'Bali Collection',
            'is_active' => true,
        ]);

        PetPollResponse::create([
            'pet_poll_id' => $poll->id,
            'tenant_id' => $tenant->id,
            'allows_pets' => true,
            'responded_at' => now(),
        ]);

        $this->expectException(QueryException::class);
        PetPollResponse::create([
            'pet_poll_id' => $poll->id,
            'tenant_id' => $tenant->id,
            'allows_pets' => false,
            'responded_at' => now(),
        ]);
    }
}
