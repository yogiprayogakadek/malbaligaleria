<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\PetPoll;
use App\Models\PetPollResponse;
use App\Models\Tenant;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
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
            ->assertDontSee('pollNote')
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

    protected function makePollAndTenant(): array
    {
        $poll = PetPoll::create([
            'title' => 'Survei Pet Friendly',
            'question' => 'Apakah tenant Anda mengizinkan pet masuk ke area tenant?',
            'pet_scope' => 'Anjing dan kucing, wajib memakai tali atau carrier.',
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

        return [$poll, $tenant];
    }

    public function test_submit_stores_response_and_shows_confirmation(): void
    {
        [$poll, $tenant] = $this->makePollAndTenant();

        $response = $this->post(route('frontend.pet-poll.submit'), [
            'tenant_id' => $tenant->id,
            'pic_name' => 'I Made Adi',
            'allows_pets' => 1,
            'note' => 'Hanya kucing, wajib carrier.',
        ]);

        $response->assertRedirect(route('frontend.pet-poll.show'));

        $this->assertDatabaseHas('pet_poll_responses', [
            'pet_poll_id' => $poll->id,
            'tenant_id' => $tenant->id,
            'pic_name' => 'I Made Adi',
            'allows_pets' => 1,
        ]);

        $this->get(route('frontend.pet-poll.show'))
            ->assertOk()
            ->assertSee('Jawaban tersimpan')
            ->assertSee($tenant->name);
    }

    public function test_submit_generates_edit_token_and_sends_email_if_provided(): void
    {
        Mail::fake();
        [$poll, $tenant] = $this->makePollAndTenant();

        $response = $this->post(route('frontend.pet-poll.submit'), [
            'tenant_id' => $tenant->id,
            'pic_name' => 'I Made Adi',
            'allows_pets' => 1,
            'email' => 'manager@balicollection.com',
        ]);

        $response->assertRedirect(route('frontend.pet-poll.show'));

        $pollResponse = PetPollResponse::first();
        $this->assertNotNull($pollResponse->edit_token);
        $this->assertSame('manager@balicollection.com', $pollResponse->email);

        Mail::assertSent(\App\Mail\PetPollEditLinkMail::class, function ($mail) use ($tenant) {
            return $mail->hasTo('manager@balicollection.com') && $mail->response->tenant_id === $tenant->id;
        });
    }

    public function test_resubmit_without_token_is_rejected_if_already_answered(): void
    {
        [$poll, $tenant] = $this->makePollAndTenant();

        $this->post(route('frontend.pet-poll.submit'), ['tenant_id' => $tenant->id, 'pic_name' => 'Adi', 'allows_pets' => 1]);

        // Attempting to submit again from public form without token
        $this->post(route('frontend.pet-poll.submit'), ['tenant_id' => $tenant->id, 'pic_name' => 'Adi', 'allows_pets' => 0])
            ->assertSessionHasErrors('tenant_id');

        $this->assertSame(1, PetPollResponse::where('pet_poll_id', $poll->id)->count());
        $this->assertTrue((bool) PetPollResponse::first()->allows_pets);
    }

    public function test_resubmit_with_valid_token_updates_response(): void
    {
        [$poll, $tenant] = $this->makePollAndTenant();

        $this->post(route('frontend.pet-poll.submit'), ['tenant_id' => $tenant->id, 'pic_name' => 'Adi', 'allows_pets' => 1]);
        $existing = PetPollResponse::first();

        $this->post(route('frontend.pet-poll.submit'), [
            'tenant_id' => $tenant->id,
            'pic_name' => 'Adi Baru',
            'allows_pets' => 0,
            'token' => $existing->edit_token,
        ])->assertRedirect(route('frontend.pet-poll.show'));

        $this->assertSame(1, PetPollResponse::where('pet_poll_id', $poll->id)->count());
        $updated = PetPollResponse::first()->fresh();
        $this->assertFalse((bool) $updated->allows_pets);
        $this->assertSame('Adi Baru', $updated->pic_name);
    }

    public function test_token_edit_route_renders_prefilled_form_for_tenant(): void
    {
        [$poll, $tenant] = $this->makePollAndTenant();

        $this->post(route('frontend.pet-poll.submit'), [
            'tenant_id' => $tenant->id,
            'pic_name' => 'I Made Adi',
            'allows_pets' => 1,
            'email' => 'pic@store.com',
        ]);
        $existing = PetPollResponse::first();

        $this->get(route('frontend.pet-poll.edit', ['token' => $existing->edit_token]))
            ->assertOk()
            ->assertSee($tenant->name)
            ->assertSee('Anda sedang memperbarui keputusan resmi')
            ->assertSee($existing->edit_token)
            ->assertSee('I Made Adi')
            ->assertSee('pic@store.com');
    }

    public function test_invalid_edit_token_aborts_404(): void
    {
        $this->get(route('frontend.pet-poll.edit', ['token' => 'invalid-token-12345']))
            ->assertNotFound();
    }

    public function test_closed_poll_rejects_submission(): void
    {
        [$poll, $tenant] = $this->makePollAndTenant();
        $poll->update(['closes_at' => now()->subMinute()]);

        $this->post(route('frontend.pet-poll.submit'), ['tenant_id' => $tenant->id, 'pic_name' => 'Adi', 'allows_pets' => 1])
            ->assertSessionHas('error');

        $this->assertSame(0, \App\Models\PetPollResponse::count());
    }

    public function test_inactive_or_non_tenant_cannot_be_submitted(): void
    {
        [$poll] = $this->makePollAndTenant();
        $category = Category::first();
        $island = Tenant::create([
            'category_id' => $category->id,
            'type' => 'island',
            'name' => 'Island',
            'is_active' => true,
        ]);

        $this->post(route('frontend.pet-poll.submit'), ['tenant_id' => $island->id, 'pic_name' => 'Adi', 'allows_pets' => 1])
            ->assertSessionHasErrors('tenant_id');
    }

    public function test_pic_name_is_required(): void
    {
        [$poll, $tenant] = $this->makePollAndTenant();

        $this->post(route('frontend.pet-poll.submit'), ['tenant_id' => $tenant->id, 'allows_pets' => 1])
            ->assertSessionHasErrors('pic_name');

        $this->assertSame(0, PetPollResponse::count());
    }

    public function test_mailable_uses_custom_sender_address_when_configured(): void
    {
        [$poll, $tenant] = $this->makePollAndTenant();
        $poll->update([
            'sender_email' => 'custom-sender@mbg.com',
            'sender_name' => 'Custom MBG Team',
        ]);

        $response = PetPollResponse::create([
            'pet_poll_id' => $poll->id,
            'tenant_id' => $tenant->id,
            'allows_pets' => true,
            'email' => 'tenant@store.com',
            'edit_token' => 'abc-token',
            'responded_at' => now(),
        ]);

        $mailable = new \App\Mail\PetPollEditLinkMail($response);
        $envelope = $mailable->envelope();

        $this->assertNotNull($envelope->from);
        $this->assertSame('custom-sender@mbg.com', $envelope->from->address);
        $this->assertSame('Custom MBG Team', $envelope->from->name);
    }
}
