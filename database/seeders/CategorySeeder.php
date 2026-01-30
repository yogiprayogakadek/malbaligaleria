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

        $colorZone = [
            '#FFF000',
            '#0273B6',
            '#B04B87',
            '#5BA997',
            '#009B4C',
            '#B9CCBC',
            '#FBD7A3',
            '#A79CCB',
            '#925D23',
            '#F4B3B3',
            '#EEEEEF',
            '#DAB96B'

        ];

        foreach ($categories as $key => $category) {
            // $randomNumber = mt_rand(0, 0xFFFFFF);
            // $hexColor = '#' . sprintf('%06x', $randomNumber);
            $model = Category::firstOrNew([
                'uuid' => (string) Str::uuid(),
                'name' => $category,
                'color_zone' => $colorZone[$key]
            ]);

            $model->save();
        }
    }
}
