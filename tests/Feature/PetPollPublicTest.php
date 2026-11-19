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
}
