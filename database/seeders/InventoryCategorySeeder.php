<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\InventoryCategory;

class InventoryCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'CCTV',
            'Network Devices',
            'Computers',
            'Office Equipment',
            'Other Assets'
        ];

        foreach ($categories as $category) {
            InventoryCategory::firstOrCreate([
                'name' => $category
            ]);
        }
    }
}
