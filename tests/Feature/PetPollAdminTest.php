<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\PetPoll;
use App\Models\PetPollResponse;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class PetPollAdminTest extends TestCase
{
    use RefreshDatabase;

    protected User $admin;
    protected User $superuser;

    protected function setUp(): void
    {
        parent::setUp();

        Role::firstOrCreate(['name' => 'superuser']);
        Role::firstOrCreate(['name' => 'admin']);
        Role::firstOrCreate(['name' => 'tenant']);
        Role::firstOrCreate(['name' => 'hr']);

        $permissions = [
            'view dashboard',
            'view category tenants', 'create category tenants', 'edit category tenants', 'delete category tenants',
            'view tenants', 'create tenants', 'edit tenants', 'delete tenants',
            'view events', 'create events', 'edit events', 'delete events',
            'view gallery', 'create gallery', 'edit gallery', 'delete gallery',
            'view promo', 'create promo', 'edit promo', 'delete promo',
            'view careers', 'create careers', 'edit careers', 'delete careers',
            'view settings', 'create settings', 'edit settings', 'delete settings',
            'view announcements', 'create announcements', 'edit announcements', 'delete announcements',
        ];

        foreach ($permissions as $perm) {
            Permission::firstOrCreate(['name' => $perm]);
        }

        $this->admin = User::factory()->create();
        $this->admin->assignRole('admin');

        $this->superuser = User::factory()->create();
        $this->superuser->assignRole('superuser');
    }

    protected function makePollWithAnswers(): array
    {
        $poll = PetPoll::create([
            'title' => 'Survei Pet Friendly',
            'question' => 'Apakah tenant Anda mengizinkan pet masuk?',
            'pet_scope' => 'Anjing dan kucing, wajib tali atau carrier.',
            'is_open' => true,
        ]);

        $category = Category::create(['name' => 'Fashion', 'color_zone' => 'red', 'is_active' => true]);

        $allowed = Tenant::create(['category_id' => $category->id, 'type' => 'tenant', 'name' => 'Zara MBG', 'is_active' => true]);
        $denied = Tenant::create(['category_id' => $category->id, 'type' => 'tenant', 'name' => 'Food Garden', 'is_active' => true]);
        $unanswered = Tenant::create(['category_id' => $category->id, 'type' => 'tenant', 'name' => 'Optik MBG', 'is_active' => true]);

        PetPollResponse::create([
            'pet_poll_id' => $poll->id,
            'tenant_id' => $allowed->id,
            'allows_pets' => true,
            'note' => 'Hanya kucing',
            'responded_at' => now()->subHour(),
        ]);

        PetPollResponse::create([
            'pet_poll_id' => $poll->id,
            'tenant_id' => $denied->id,
            'allows_pets' => false,
            'note' => null,
            'responded_at' => now(),
        ]);

        return [$poll, $allowed, $denied, $unanswered];
    }

    public function test_guest_is_redirected_and_tenant_is_forbidden(): void
    {
        $this->get(route('admin.pet-poll.index'))->assertRedirect();

        $tenantUser = User::factory()->create();
        $tenantUser->assignRole('tenant');
        $this->actingAs($tenantUser)->get(route('admin.pet-poll.index'))->assertForbidden();
    }

    public function test_admin_sees_stats_and_can_filter_answers(): void
    {
        [$poll, $allowed, $denied, $unanswered] = $this->makePollWithAnswers();

        $this->actingAs($this->admin)
            ->get(route('admin.pet-poll.index'))
            ->assertOk()
            ->assertSee('Survei Pet Friendly')
            ->assertSee($allowed->name)
            ->assertSee($denied->name);

        $this->actingAs($this->admin)
            ->get(route('admin.pet-poll.index', ['filter' => 'allowed']))
            ->assertOk()
            ->assertSee($allowed->name)
            ->assertDontSee($denied->name);

        $this->actingAs($this->admin)
            ->get(route('admin.pet-poll.index', ['filter' => 'unanswered']))
            ->assertOk()
            ->assertSee($unanswered->name)
            ->assertDontSee($allowed->name);
    }

    public function test_csv_export_contains_response_rows(): void
    {
        [$poll, $allowed] = $this->makePollWithAnswers();

        $response = $this->actingAs($this->admin)->get(route('admin.pet-poll.export'));

        $response->assertOk();
        $content = $response->streamedContent();
        $this->assertStringContainsString('Tenant,Kategori,Jawaban,Catatan', $content);
        $this->assertStringContainsString('Waktu (WITA)', $content);
        $this->assertStringContainsString($allowed->name, $content);
    }

    public function test_admin_can_create_default_poll(): void
    {
        $this->actingAs($this->admin)->post(route('admin.pet-poll.store'))->assertRedirect();

        $this->assertDatabaseCount('pet_polls', 1);
        $this->assertSame('Survei Pet Friendly', PetPoll::first()->title);
    }

    public function test_settings_can_be_updated_before_any_response(): void
    {
        $poll = PetPoll::create([
            'title' => 'Survei Pet Friendly',
            'question' => 'Pertanyaan lama?',
            'pet_scope' => 'Cakupan lama.',
            'is_open' => true,
        ]);

        $this->actingAs($this->admin)->put(route('admin.pet-poll.settings.update'), [
            'title' => 'Survei Pet Friendly Update',
            'question' => 'Pertanyaan baru?',
            'pet_scope' => 'Semua hewan peliharaan dengan carrier.',
            'closes_at' => '2026-12-31T23:59',
        ])->assertRedirect();

        $poll->refresh();
        $this->assertSame('Pertanyaan baru?', $poll->question);
        $this->assertSame('Survei Pet Friendly Update', $poll->title);
    }

    public function test_question_and_scope_are_locked_after_first_response(): void
    {
        [$poll, $allowed] = $this->makePollWithAnswers();

        $this->actingAs($this->admin)->put(route('admin.pet-poll.settings.update'), [
            'title' => 'Judul Baru Berubah',
            'question' => 'Pertanyaan berubah?',
            'pet_scope' => 'Cakupan berubah?',
            'closes_at' => null,
        ])->assertSessionHasErrors('question');

        $poll->refresh();
        $this->assertSame('Judul Baru Berubah', $poll->title);
        $this->assertNotSame('Pertanyaan berubah?', $poll->question);
    }

    public function test_admin_can_toggle_poll_status(): void
    {
        $poll = PetPoll::create([
            'title' => 'Survei Pet Friendly',
            'question' => 'Pertanyaan?',
            'pet_scope' => 'Cakupan.',
            'is_open' => true,
        ]);

        $this->actingAs($this->admin)->post(route('admin.pet-poll.status'))->assertRedirect();
        $this->assertFalse($poll->fresh()->is_open);

        $this->actingAs($this->admin)->post(route('admin.pet-poll.status'))->assertRedirect();
        $this->assertTrue($poll->fresh()->is_open);
    }
}
