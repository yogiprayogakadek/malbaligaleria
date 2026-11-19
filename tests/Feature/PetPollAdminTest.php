<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\PetPoll;
use App\Models\PetPollResponse;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
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
        $this->assertStringContainsString('Tenant,Kategori,PIC,Jawaban,Email,Catatan', $content);
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

    public function test_sidebar_displays_pet_poll_menu_item(): void
    {
        $this->actingAs($this->admin)
            ->get(route('admin.pet-poll.index'))
            ->assertOk()
            ->assertSee('Pet Poll');

        $this->actingAs($this->superuser)
            ->get(route('admin.pet-poll.index'))
            ->assertOk()
            ->assertSee('Pet Poll');
    }

    public function test_admin_can_update_sender_email_and_sender_name(): void
    {
        $poll = PetPoll::create([
            'title' => 'Survei Pet Friendly',
            'question' => 'Pertanyaan?',
            'pet_scope' => 'Cakupan.',
            'is_open' => true,
        ]);

        $this->actingAs($this->admin)->put(route('admin.pet-poll.settings.update'), [
            'title' => 'Survei Pet Friendly',
            'question' => 'Pertanyaan?',
            'pet_scope' => 'Cakupan.',
            'sender_email' => 'cs@malbaligaleria.com',
            'sender_name' => 'CS MBG',
            'closes_at' => null,
        ])->assertRedirect(route('admin.pet-poll.settings'));

        $poll->refresh();
        $this->assertSame('cs@malbaligaleria.com', $poll->sender_email);
        $this->assertSame('CS MBG', $poll->sender_name);
    }

    public function test_admin_can_reset_poll_responses(): void
    {
        [$poll, $allowed, $denied] = $this->makePollWithAnswers();

        $this->assertSame(2, PetPollResponse::where('pet_poll_id', $poll->id)->count());

        $this->actingAs($this->admin)
            ->post(route('admin.pet-poll.reset'))
            ->assertRedirect(route('admin.pet-poll.index'))
            ->assertSessionHas('success');

        $this->assertSame(0, PetPollResponse::where('pet_poll_id', $poll->id)->count());
    }

    public function test_admin_can_save_smtp_settings_and_password_is_encrypted(): void
    {
        $poll = $this->makePoll();

        $this->actingAs($this->admin)->put(route('admin.pet-poll.settings.update'), [
            'title' => $poll->title,
            'question' => $poll->question,
            'pet_scope' => $poll->pet_scope,
            'sender_email' => 'notif@mbg.com',
            'sender_name' => 'Notifikasi MBG',
            'mail_host' => 'smtp.mailtrap.io',
            'mail_port' => 2525,
            'mail_username' => 'smtp-user',
            'mail_password' => 'super-secret',
            'mail_encryption' => 'tls',
            'closes_at' => null,
        ])->assertRedirect(route('admin.pet-poll.settings'));

        $poll->refresh();
        $this->assertSame('smtp.mailtrap.io', $poll->mail_host);
        $this->assertSame(2525, $poll->mail_port);
        $this->assertSame('smtp-user', $poll->mail_username);
        $this->assertSame('super-secret', $poll->mail_password);
        $this->assertSame('tls', $poll->mail_encryption);

        $raw = \DB::table('pet_polls')->where('id', $poll->id)->value('mail_password');
        $this->assertNotSame('super-secret', $raw);
    }

    public function test_blank_password_keeps_existing_smtp_password(): void
    {
        $poll = $this->makePoll();
        $poll->update(['mail_password' => 'existing-secret']);

        $this->actingAs($this->admin)->put(route('admin.pet-poll.settings.update'), [
            'title' => $poll->title,
            'question' => $poll->question,
            'pet_scope' => $poll->pet_scope,
            'mail_host' => 'smtp.mbg.com',
            'mail_port' => 587,
            'mail_username' => 'user',
            'mail_password' => '',
            'mail_encryption' => 'tls',
            'closes_at' => null,
        ])->assertRedirect(route('admin.pet-poll.settings'));

        $this->assertSame('existing-secret', $poll->fresh()->mail_password);
    }

    public function test_admin_can_send_test_email_using_poll_smtp_settings(): void
    {
        Mail::fake();

        $poll = $this->makePoll();
        $poll->update([
            'sender_email' => 'notif@mbg.com',
            'sender_name' => 'Notifikasi MBG',
            'mail_host' => 'smtp.mbg.com',
            'mail_port' => 587,
            'mail_username' => 'user',
            'mail_password' => 'secret',
            'mail_encryption' => 'tls',
        ]);

        $this->actingAs($this->admin)
            ->post(route('admin.pet-poll.test-mail'), ['test_recipient' => 'qa@mbg.com'])
            ->assertRedirect(route('admin.pet-poll.settings'))
            ->assertSessionHas('success');

        Mail::assertSent(\App\Mail\PetPollTestMail::class, function ($mail) {
            return $mail->hasTo('qa@mbg.com');
        });

        $this->assertSame('smtp.mbg.com', config('mail.mailers.pet_poll.host'));
        $this->assertSame('smtp', config('mail.mailers.pet_poll.scheme'));
        $this->assertSame('notif@mbg.com', config('mail.from.address'));
    }

    public function test_test_email_requires_valid_recipient(): void
    {
        $this->makePoll();

        $this->actingAs($this->admin)
            ->post(route('admin.pet-poll.test-mail'), ['test_recipient' => 'not-an-email'])
            ->assertSessionHasErrors('test_recipient');
    }

    public function test_settings_page_shows_smtp_fields_without_exposing_password(): void
    {
        $poll = $this->makePoll();
        $poll->update([
            'mail_host' => 'smtp.mbg.com',
            'mail_password' => 'super-secret',
        ]);

        $this->actingAs($this->admin)
            ->get(route('admin.pet-poll.settings'))
            ->assertOk()
            ->assertSee('SMTP Host')
            ->assertSee('Username SMTP')
            ->assertSee('Password SMTP')
            ->assertSee('Kirim Email Uji')
            ->assertDontSee('super-secret');
    }

    protected function makePoll(): PetPoll
    {
        return PetPoll::create([
            'title' => 'Survei Pet Friendly',
            'question' => 'Pertanyaan?',
            'pet_scope' => 'Cakupan.',
            'is_open' => true,
        ]);
    }
}
