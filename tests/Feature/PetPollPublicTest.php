<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\PetPoll;
use App\Models\Tenant;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PetPollPublicTest extends TestCase
{
    use RefreshDatabase;

    public function test_public_page_renders_poll_copy_from_database(): void
    {
        $poll = PetPoll::create([
            'title' => 'Survei Pet Friendly',
            'question' => 'Apakah tenant Anda mengizinkan pet masuk ke area tenant?',
            'pet_scope' => 'Anjing dan kucing, wajib memakai tali atau carrier.',
            'is_open' => true,
        ]);

        $this->get(route('frontend.pet-poll.show'))
            ->assertOk()
            ->assertSee($poll->title)
            ->assertSee($poll->question)
            ->assertSee($poll->pet_scope)
            ->assertSee('Kirim jawaban');
    }

    public function test_public_page_handles_missing_poll(): void
    {
        $this->get(route('frontend.pet-poll.show'))
            ->assertOk()
            ->assertSee('Survei belum tersedia.');
    }

    public function test_tenant_search_only_returns_active_tenants(): void
    {
        $category = Category::create(['name' => 'Fashion', 'color_zone' => 'red', 'is_active' => true]);
        Tenant::create(['category_id' => $category->id, 'type' => 'tenant', 'name' => 'Bali Collection', 'is_active' => true]);
        Tenant::create(['category_id' => $category->id, 'type' => 'tenant', 'name' => 'Bali Inactive', 'is_active' => false]);
        Tenant::create(['category_id' => $category->id, 'type' => 'island', 'name' => 'Bali Island', 'is_active' => true]);

        $response = $this->getJson(route('frontend.pet-poll.tenants', ['q' => 'Bali']))
            ->assertOk()
            ->assertJsonCount(1)
            ->assertJsonFragment(['name' => 'Bali Collection']);
    }

    public function test_tenant_search_requires_two_characters(): void
    {
        $this->getJson(route('frontend.pet-poll.tenants', ['q' => 'a']))
            ->assertStatus(422);
    }
}
