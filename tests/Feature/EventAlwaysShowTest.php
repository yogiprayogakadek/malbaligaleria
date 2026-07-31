<?php

namespace Tests\Feature;

use App\Models\Event;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class EventAlwaysShowTest extends TestCase
{
    use RefreshDatabase;

    protected $adminUser;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutMiddleware();
        date_default_timezone_set('Asia/Makassar');

        // Setup role/user for admin testing
        Role::firstOrCreate(['name' => 'superuser']);
        $this->adminUser = User::create([
            'name' => 'Admin User',
            'email' => 'admin@test.com',
            'password' => bcrypt('password'),
            'status' => 'approved',
            'is_active' => true,
            'email_verified_at' => now(),
        ]);
        $this->adminUser->assignRole('superuser');
    }

    /**
     * Test always_show = false and future start date regular event is not displayed.
     */
    public function test_future_regular_event_without_always_show_is_hidden()
    {
        $futureDate = Carbon::now('Asia/Makassar')->addMonth(1)->toDateString();

        Event::create([
            'name' => 'Future Hidden Event',
            'type' => 'special',
            'start_date' => $futureDate,
            'end_date' => $futureDate,
            'start_time' => '10:00:00',
            'end_time' => '22:00:00',
            'description' => 'Test event',
            'location' => 'Main Atrium',
            'is_paid' => false,
            'is_active' => true,
            'always_show' => false,
        ]);

        $eventRepository = app(\App\Repositories\EventRepository::class);
        $events = $eventRepository->getRegularEvents(['*'], []);

        $this->assertCount(0, $events);
    }

    /**
     * Test always_show = false and future start date in SAME month regular event is not displayed.
     */
    public function test_future_regular_event_in_same_month_without_always_show_is_hidden()
    {
        $futureDateSameMonth = Carbon::now('Asia/Makassar')->addDays(5)->toDateString();

        Event::create([
            'name' => 'Future Hidden Event Same Month',
            'type' => 'special',
            'start_date' => $futureDateSameMonth,
            'end_date' => $futureDateSameMonth,
            'start_time' => '10:00:00',
            'end_time' => '22:00:00',
            'description' => 'Test event',
            'location' => 'Main Atrium',
            'is_paid' => false,
            'is_active' => true,
            'always_show' => false,
        ]);

        $eventRepository = app(\App\Repositories\EventRepository::class);
        $events = $eventRepository->getRegularEvents(['*'], []);

        $this->assertCount(0, $events);
    }

    /**
     * Test always_show = true and future start date regular event is displayed.
     */
    public function test_future_regular_event_with_always_show_is_visible()
    {
        $futureDate = Carbon::now('Asia/Makassar')->addDays(10)->toDateString();

        $event = Event::create([
            'name' => 'Future Visible Event',
            'type' => 'special',
            'start_date' => $futureDate,
            'end_date' => $futureDate,
            'start_time' => '10:00:00',
            'end_time' => '22:00:00',
            'description' => 'Test event',
            'location' => 'Main Atrium',
            'is_paid' => false,
            'is_active' => true,
            'always_show' => true,
        ]);

        $eventRepository = app(\App\Repositories\EventRepository::class);
        $events = $eventRepository->getRegularEvents(['*'], []);

        $this->assertCount(1, $events);
        $this->assertEquals($event->name, $events->first()->name);
    }

    /**
     * Test always_show = false and past end date exhibition event is not displayed.
     */
    public function test_past_exhibition_event_without_always_show_is_hidden()
    {
        $pastDate = Carbon::now('Asia/Makassar')->subDays(5)->toDateString();

        Event::create([
            'name' => 'Past Exhibition Hidden',
            'type' => 'exhibition',
            'start_date' => $pastDate,
            'end_date' => $pastDate,
            'start_time' => '10:00:00',
            'end_time' => '22:00:00',
            'description' => 'Test exhibition',
            'location' => 'Main Atrium',
            'is_paid' => false,
            'is_active' => true,
            'always_show' => false,
        ]);

        $eventRepository = app(\App\Repositories\EventRepository::class);
        $events = $eventRepository->getExhibitionEvents(['*'], []);

        $this->assertCount(0, $events);
    }

    /**
     * Test always_show = true and past end date exhibition event is hidden.
     */
    public function test_past_exhibition_event_is_hidden_even_with_always_show()
    {
        $pastDate = Carbon::now('Asia/Makassar')->subDays(5)->toDateString();

        Event::create([
            'name' => 'Past Exhibition Visible',
            'type' => 'exhibition',
            'start_date' => $pastDate,
            'end_date' => $pastDate,
            'start_time' => '10:00:00',
            'end_time' => '22:00:00',
            'description' => 'Test exhibition',
            'location' => 'Main Atrium',
            'is_paid' => false,
            'is_active' => true,
            'always_show' => true,
        ]);

        $eventRepository = app(\App\Repositories\EventRepository::class);
        $events = $eventRepository->getExhibitionEvents(['*'], []);

        $this->assertCount(0, $events);
    }

    /**
     * Test always_show = true and past end date regular event is hidden.
     */
    public function test_past_regular_event_is_hidden_even_with_always_show()
    {
        $pastDate = Carbon::now('Asia/Makassar')->subDays(5)->toDateString();

        Event::create([
            'name' => 'Past Regular Event',
            'type' => 'special',
            'start_date' => $pastDate,
            'end_date' => $pastDate,
            'start_time' => '10:00:00',
            'end_time' => '22:00:00',
            'description' => 'Test event',
            'location' => 'Main Atrium',
            'is_paid' => false,
            'is_active' => true,
            'always_show' => true,
        ]);

        $eventRepository = app(\App\Repositories\EventRepository::class);
        $events = $eventRepository->getRegularEvents(['*'], []);

        $this->assertCount(0, $events);
    }

    /**
     * Test backend store validation and saving.
     */
    public function test_admin_can_store_event_with_always_show()
    {
        $response = $this->actingAs($this->adminUser)
            ->post(route('admin.event.store'), [
                'name' => 'New Event Stored',
                'type' => 'special',
                'start_date' => '2026-06-05',
                'end_date' => '2026-06-10',
                'start_time' => '10:00',
                'end_time' => '22:00',
                'description' => 'A stored event',
                'location' => 'Lobby',
                'is_paid' => '0',
                'always_show' => '1',
            ]);

        $response->assertRedirect(route('admin.event.index'));
        $this->assertDatabaseHas('events', [
            'name' => 'New Event Stored',
            'always_show' => true,
        ]);
    }

    /**
     * Test backend update validation and saving.
     */
    public function test_admin_can_update_event_with_always_show()
    {
        $event = Event::create([
            'name' => 'Old Event',
            'type' => 'special',
            'start_date' => '2026-06-05',
            'end_date' => '2026-06-10',
            'start_time' => '10:00:00',
            'end_time' => '22:00:00',
            'description' => 'Old desc',
            'location' => 'Lobby',
            'is_paid' => false,
            'is_active' => true,
            'always_show' => false,
        ]);

        $response = $this->actingAs($this->adminUser)
            ->put(route('admin.event.update', $event->uuid), [
                'name' => 'Updated Event Name',
                'type' => 'special',
                'start_date' => '2026-06-05',
                'end_date' => '2026-06-10',
                'start_time' => '10:00',
                'end_time' => '22:00',
                'description' => 'Updated desc',
                'location' => 'Lobby',
                'is_paid' => '0',
                'is_active' => '1',
                'always_show' => '1',
            ]);

        $response->assertRedirect(route('admin.event.index'));
        $this->assertDatabaseHas('events', [
            'uuid' => $event->uuid,
            'name' => 'Updated Event Name',
            'always_show' => true,
        ]);
    }
}
