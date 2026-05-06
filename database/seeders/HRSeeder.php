<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class HRSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::firstOrCreate(
            ['email' => 'hr@malbaligaleria.com'],
            [
                'name' => 'HR Mal Bali Galeria',
                'password' => 'hr#mbg2026',
                'status' => 'approved',
                'is_active' => true,
                'email_verified_at' => now(),
            ]
        );

        $user->assignRole('hr');
    }
}
