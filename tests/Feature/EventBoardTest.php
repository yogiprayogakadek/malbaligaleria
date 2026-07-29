<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Event;
use App\Models\Setting;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EventBoardTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Seed basic roles
        Role::firstOrCreate(['name' => 'superuser']);
        Role::firstOrCreate(['name' => 'admin']);
        Role::firstOrCreate(['name' => 'hr']);
        Role::firstOrCreate(['name' => 'tenant']);

        // Seed basic permissions
        $permissions = ['view dashboard', 'view settings', 'view events', 'create events', 'edit events', 'delete events'];
        foreach ($permissions as $perm) {
            Permission::firstOrCreate(['name' => $perm]);
        }
    }

    public function test_superuser_can_always_access_event_board(): void
    {
        $superuser = User::factory()->create();
        $superuser->assignRole('superuser');

        $response = $this->actingAs($superuser)->get(route('admin.event-board.index'));

        $response->assertStatus(200);
        $response->assertSee('Event Board');
    }

    public function test_other_roles_cannot_access_event_board_by_default(): void
    {
        $admin = User::factory()->create();
        $admin->assignRole('admin');

        $response = $this->actingAs($admin)->get(route('admin.event-board.index'));
        $response->assertStatus(403);

        $hr = User::factory()->create();
        $hr->assignRole('hr');

        $response = $this->actingAs($hr)->get(route('admin.event-board.index'));
        $response->assertStatus(403);
    }

    public function test_superuser_can_save_visibility_settings_and_grant_access(): void
    {
        $superuser = User::factory()->create();
        $superuser->assignRole('superuser');

        $response = $this->actingAs($superuser)->post(route('admin.event-board.save-settings'), [
            'roles' => ['admin', 'hr']
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
            'message' => 'Visibility settings updated successfully.'
        ]);

        // Check if settings table is updated
        $this->assertDatabaseHas('settings', [
            'pages' => 'dashboard_menu',
            'name' => 'calendar_kanban_visibility',
        ]);

        // Check if admin and hr can now access the board
        $admin = User::factory()->create();
        $admin->assignRole('admin');

        $response = $this->actingAs($admin)->get(route('admin.event-board.index'));
        $response->assertStatus(200);

        // Tenant was not added, so tenant should still get 403
        $tenant = User::factory()->create();
        $tenant->assignRole('tenant');

        $response = $this->actingAs($tenant)->get(route('admin.event-board.index'));
        $response->assertStatus(403);
    }

    public function test_api_list_returns_formatted_events(): void
    {
        $superuser = User::factory()->create();
        $superuser->assignRole('superuser');

        $event = Event::factory()->create([
            'name' => 'Malls Anniversary',
            'type' => 'special',
            'start_date' => '2026-07-29',
            'end_date' => '2026-07-31',
            'start_time' => '10:00:00',
            'end_time' => '22:00:00',
            'is_active' => true,
        ]);

        $response = $this->actingAs($superuser)->get(route('admin.event-board.api.list'));

        $response->assertStatus(200);
        $response->assertJsonFragment([
            'id' => $event->uuid,
            'title' => 'Malls Anniversary',
            'start' => '2026-07-29T10:00:00',
            'end' => '2026-07-31T22:00:00',
            'textColor' => '#ff8f00', // special event text color
        ]);
    }

    public function test_api_update_date_reschedules_event(): void
    {
        $superuser = User::factory()->create();
        $superuser->assignRole('superuser');

        $event = Event::factory()->create([
            'start_date' => '2026-07-29',
            'end_date' => '2026-07-31',
        ]);

        $response = $this->actingAs($superuser)->post(route('admin.event-board.api.update-date', $event->uuid), [
            'start_date' => '2026-08-01T09:00:00',
            'end_date' => '2026-08-03T18:00:00',
        ]);

        $response->assertStatus(200);
        $response->assertJson(['success' => true]);

        $event = $event->fresh();
        $this->assertEquals('2026-08-01', $event->start_date);
        $this->assertEquals('09:00:00', $event->start_time);
        $this->assertEquals('2026-08-03', $event->end_date);
        $this->assertEquals('18:00:00', $event->end_time);
    }

    public function test_api_update_kanban_changes_status_and_type(): void
    {
        $superuser = User::factory()->create();
        $superuser->assignRole('superuser');

        $event = Event::factory()->create([
            'type' => 'regular',
            'is_active' => true,
        ]);

        // Drag to special column
        $response = $this->actingAs($superuser)->post(route('admin.event-board.api.update-kanban', $event->uuid), [
            'column' => 'special'
        ]);

        $response->assertStatus(200);
        $event = $event->fresh();
        $this->assertEquals('special', $event->type);
        $this->assertTrue($event->is_active);

        // Drag to draft column
        $response = $this->actingAs($superuser)->post(route('admin.event-board.api.update-kanban', $event->uuid), [
            'column' => 'draft'
        ]);

        $response->assertStatus(200);
        $event = $event->fresh();
        $this->assertFalse($event->is_active);
    }
}
