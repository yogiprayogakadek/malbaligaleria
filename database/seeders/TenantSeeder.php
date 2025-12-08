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
        $tenants = [
            'H&M',
            'Uniqlo',
            'FootLocker',
            'King Koil',
            'Pizza Hut',
            'Ramen Ya',
            'Solaria',
            'Miniso',
            'Matahari',
            'Gramedia',
            'Hypermart',
            'Az ko',
            'Cinema XXI',
            'Asics',
            'Digimap',
            'Samsung'
        ];

        foreach ($tenants as $tenant) {
            $model = Tenant::firstOrNew([
                'name' => $tenant,
                'uuid' => (string) Str::uuid(),
                'category_id' => rand(1, 4)
            ]);
            $model->save();
        }
    }
}
