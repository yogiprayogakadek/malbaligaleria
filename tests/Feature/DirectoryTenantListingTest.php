<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Tenant;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Tests\TestCase;

class DirectoryTenantListingTest extends TestCase
{
    use RefreshDatabase;

    public function test_new_store_expiry_and_floor_id_are_exposed(): void
    {
        $category = Category::create([
            'name' => 'Fashion',
            'color_zone' => 'red',
            'is_active' => true,
        ]);

        $recent = Tenant::create([
            'category_id' => $category->id,
            'type' => 'tenant',
            'name' => 'Recent New Store',
            'map_coords' => ['floor' => 1, 'unit' => 'A1', 'x' => 1, 'y' => 2],
            'isNew' => true,
            'launched_at' => now()->subDays(6),
        ]);

        $expired = Tenant::create([
            'category_id' => $category->id,
            'type' => 'tenant',
            'name' => 'Expired New Store',
            'map_coords' => ['floor' => 2, 'unit' => 'B1', 'x' => 3, 'y' => 4],
            'isNew' => true,
            'launched_at' => now()->subDays(8),
        ]);

        $createdRecently = Tenant::create([
            'category_id' => $category->id,
            'type' => 'tenant',
            'name' => 'New Store Without Launch Date',
            'map_coords' => ['floor' => 1, 'unit' => 'A2', 'x' => 5, 'y' => 6],
            'isNew' => true,
        ]);
        $createdRecently->created_at = now()->subDays(6);
        $createdRecently->saveQuietly();

        $response = $this->getJson('/directory/tenants')->assertOk();
        $tenants = collect($response->json())->keyBy('id');

        $this->assertTrue($tenants[$recent->id]['isNew']);
        $this->assertSame(1, $tenants[$recent->id]['floor_id']);
        $this->assertTrue(Carbon::parse($tenants[$recent->id]['new_store_until'])->isFuture());

        $this->assertSame(2, $tenants[$expired->id]['floor_id']);
        $this->assertTrue(Carbon::parse($tenants[$expired->id]['new_store_until'])->isPast());

        $this->assertTrue(Carbon::parse($tenants[$createdRecently->id]['new_store_until'])->isFuture());
    }
}
