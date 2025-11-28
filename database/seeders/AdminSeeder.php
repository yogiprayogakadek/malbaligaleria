<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::firstOrCreate([
            'tenant_id' => null,
            'name' => 'Yogi Prayoga',
            'email' => 'yogi@malbaligaleria.com',
            'password' => 'mbg@2025_',
            'phone' => '082237188923',
            'avatar' => null,
            'status' => 'approved',
            'is_active' => true
        ]);

        $user->assignRole('admin');
    }
}
