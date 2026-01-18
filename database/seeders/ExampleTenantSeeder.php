<?php

namespace Database\Seeders;

use App\Models\Tenant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TenantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();
        
        // Get valid categories
        $categoryIds = \App\Models\Category::pluck('id')->toArray();
        if (empty($categoryIds)) {
            $this->command->info('No categories found. Skipping TenantSeeder.');
            return;
        }

        // Try to get a real logo/photo to reuse
        $existingTenant = Tenant::whereNotNull('logo')->first();
        $sampleLogo = $existingTenant ? $existingTenant->logo : 'tenants/default_logo.png';
        
        $existingPhoto = \App\Models\TenantPhoto::first();
        $samplePhotoPath = $existingPhoto ? $existingPhoto->path : 'tenants/default_photo.jpg';

        $this->command->info('Seeding 100 Tenants...');

        for ($i = 0; $i < 100; $i++) {
            $floor = rand(1, 2);
            $isFloor1 = $floor === 1;
            
            // Set dimensions based on verified floor map sizes
            $mapWidth = $isFloor1 ? 1216 : 1024;
            $mapHeight = $isFloor1 ? 880 : 1024;

            $tenant = Tenant::create([
                'uuid' => (string) Str::uuid(),
                'category_id' => $faker->randomElement($categoryIds),
                'name' => $faker->company,
                'phone' => $faker->phoneNumber,
                'email' => $faker->companyEmail,
                'website' => $faker->url,
                'description' => $faker->paragraph,
                'logo' => $sampleLogo,
                'is_active' => true,
                'launched_at' => $faker->dateTimeBetween('-1 year', '+1 month'),
                'isNew' => $faker->boolean(20), // 20% chance of being new
                'map_original_size' => [
                    'width' => $mapWidth,
                    'height' => $mapHeight,
                ],
                'map_coords' => [
                    'floor' => $floor,
                    'unit' => $faker->bothify('Unit-##'),
                    'x' => $faker->numberBetween(50, $mapWidth - 50),
                    'y' => $faker->numberBetween(50, $mapHeight - 50),
                ],
            ]);

            // Create Primary Photo
            \App\Models\TenantPhoto::create([
                'tenant_id' => $tenant->id,
                'path' => $samplePhotoPath,
                'caption' => 'Primary Photo',
                'is_primary' => true,
            ]);

            // Create 1-2 Album Photos
            $numPhotos = rand(1, 2);
            for ($j = 0; $j < $numPhotos; $j++) {
                \App\Models\TenantPhoto::create([
                    'tenant_id' => $tenant->id,
                    'path' => $samplePhotoPath,
                    'caption' => 'Album Photo ' . ($j + 1),
                    'is_primary' => false,
                ]);
            }
        }
        
        $this->command->info('Tenant seeding completed.');
    }
}
