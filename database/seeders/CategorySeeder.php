<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'IT, Games & Gadgets',
            'Anchor Tenant',
            'Fashion, Beauty & Accessories',
            'Food & Beverages',
            'Island Counter',
            'Household Goods & Furniture',
            'Bookstore',
            'Sport & Swim Apparel',
            'Kids & Play Zone',
            'Salon, Office & Services',
            'Convetion Hall / Museum',
            'Drugs & Pharmacy'
        ];

        foreach ($categories as $category) {
            $randomNumber = mt_rand(0, 0xFFFFFF);
            $hexColor = '#' . sprintf('%06x', $randomNumber);
            $model = Category::firstOrNew([
                'uuid' => (string) Str::uuid(),
                'name' => $category,
                'color_zone' => $hexColor
            ]);

            $model->save();
        }
    }
}
