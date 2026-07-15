<?php

namespace Tests\Feature;

use App\Models\Announcement;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Tests\TestCase;

class AnnouncementMultiDateTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        // Set timezone as required by the composer logic
        date_default_timezone_set('Asia/Makassar');
    }

    public function test_announcement_with_matching_active_dates_is_loaded()
    {
        $today = Carbon::now('Asia/Makassar')->toDateString();

        $announcement = Announcement::create([
            'title' => 'Test Announcement Today',
            'message' => 'Active today',
            'type' => 'info',
            'active_dates' => [['start' => $today, 'end' => $today]],
            'is_active' => true,
            'target_page' => ['all'],
            'frequency' => 'always',
        ]);

        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertViewHas('globalAnnouncement');

        $globalAnnouncement = $response->original->getData()['globalAnnouncement'];
        $this->assertEquals($announcement->title, $globalAnnouncement['title']);
        $this->assertTrue($globalAnnouncement['active']);
    }

    public function test_announcement_with_non_matching_active_dates_is_not_loaded()
    {
        Announcement::create([
            'title' => 'Test Announcement Future',
            'message' => 'Not active today',
            'type' => 'info',
            'active_dates' => [['start' => '2026-12-30', 'end' => '2026-12-31']],
            'is_active' => true,
            'target_page' => ['all'],
            'frequency' => 'always',
        ]);

        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertViewHas('globalAnnouncement');

        $globalAnnouncement = $response->original->getData()['globalAnnouncement'];
        $this->assertFalse($globalAnnouncement['active']);
    }

    public function test_announcement_target_page_matching()
    {
        $today = Carbon::now('Asia/Makassar')->toDateString();

        // Create announcement target directory and promo pages
        Announcement::create([
            'title' => 'Directory Target',
            'message' => 'Target Directory',
            'type' => 'info',
            'active_dates' => [['start' => $today, 'end' => $today]],
            'is_active' => true,
            'target_page' => ['directory', 'promo'],
            'frequency' => 'always',
        ]);

        // Access home page (should not match directory or promo targets)
        $response1 = $this->get('/');
        $response1->assertStatus(200);
        $globalAnnouncement1 = $response1->original->getData()['globalAnnouncement'];
        $this->assertFalse($globalAnnouncement1['active']);

        // Access directory page (should match directory target)
        $response2 = $this->get('/directory');
        $response2->assertStatus(200);
        $globalAnnouncement2 = $response2->original->getData()['globalAnnouncement'];
        $this->assertTrue($globalAnnouncement2['active']);
        $this->assertEquals('Directory Target', $globalAnnouncement2['title']);
    }

    public function test_announcement_daily_display_hours()
    {
        $today = Carbon::now('Asia/Makassar')->toDateString();
        $now = Carbon::now('Asia/Makassar');

        // Create an announcement that is active today, but outside of active daily hours
        // Let's set hours 1-2 hours in the future
        $futureStart = $now->copy()->addHours(1)->format('H:i');
        $futureEnd = $now->copy()->addHours(2)->format('H:i');

        Announcement::create([
            'title' => 'Hours Out of Range',
            'message' => 'Active hours are in the future',
            'type' => 'info',
            'active_dates' => [['start' => $today, 'end' => $today]],
            'start_time' => $futureStart,
            'end_time' => $futureEnd,
            'is_active' => true,
            'target_page' => ['all'],
            'frequency' => 'always',
        ]);

        $response1 = $this->get('/');
        $globalAnnouncement1 = $response1->original->getData()['globalAnnouncement'];
        $this->assertFalse($globalAnnouncement1['active']);

        // Create an announcement that is active today, and inside active daily hours
        // Let's set hours 1 hour in the past to 1 hour in the future
        $pastStart = $now->copy()->subHours(1)->format('H:i');
        $futureEnd2 = $now->copy()->addHours(1)->format('H:i');

        // Clear existing announcements to avoid matching conflict
        Announcement::query()->delete();

        Announcement::create([
            'title' => 'Hours In Range',
            'message' => 'Active hours are current',
            'type' => 'info',
            'active_dates' => [['start' => $today, 'end' => $today]],
            'start_time' => $pastStart,
            'end_time' => $futureEnd2,
            'is_active' => true,
            'target_page' => ['all'],
            'frequency' => 'always',
        ]);

        $response2 = $this->get('/');
        $globalAnnouncement2 = $response2->original->getData()['globalAnnouncement'];
        $this->assertTrue($globalAnnouncement2['active']);
        $this->assertEquals('Hours In Range', $globalAnnouncement2['title']);
    }

    public function test_announcement_multiple_images_attribute_serialization_and_accessor()
    {
        // 1. Test single string path (backward compatibility)
        $ann1 = Announcement::create([
            'title' => 'Single Image Announcement',
            'type' => 'info',
            'image' => 'announcement_images/dummy1.jpg',
            'target_page' => ['all'],
            'frequency' => 'always',
        ]);
        $this->assertEquals(['announcement_images/dummy1.jpg'], $ann1->images);

        // 2. Test JSON encoded array of paths
        $ann2 = Announcement::create([
            'title' => 'Multiple Image Announcement',
            'type' => 'info',
            'image' => json_encode(['announcement_images/dummy1.jpg', 'announcement_images/dummy2.jpg']),
            'target_page' => ['all'],
            'frequency' => 'always',
        ]);
        $this->assertEquals(['announcement_images/dummy1.jpg', 'announcement_images/dummy2.jpg'], $ann2->images);

        // 3. Test empty image
        $ann3 = Announcement::create([
            'title' => 'No Image Announcement',
            'type' => 'info',
            'image' => null,
            'target_page' => ['all'],
            'frequency' => 'always',
        ]);
        $this->assertEquals([], $ann3->images);
    }
}
