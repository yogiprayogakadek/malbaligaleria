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
            'Book',
            'Food',
            'Travel',
            'Uniform'
        ];

        foreach ($categories as $category) {
            $model = Category::firstOrNew([
                'uuid' => (string) Str::uuid(),
                'name' => $category
            ]);

            $model->save();
        }
    }
}
