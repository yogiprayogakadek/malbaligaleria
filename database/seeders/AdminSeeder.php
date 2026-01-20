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
        $users = [
            [
                'tenant_id' => null,
                'name' => 'Yogi Prayoga',
                'email' => 'yogi@malbaligaleria.com',
                'password' => 'mbg@2025_',
                'phone' => '082237188923',
                'avatar' => null,
                'status' => 'approved',
                'is_active' => true,
                'email_verified_at' => '2025-11-28 02:48:51',
            ],
            [
                'tenant_id' => null,
                'name' => 'Wahyu',
                'email' => 'wahyu@malbaligaleria.com',
                'password' => 'wahyu#mbg2025',
                'phone' => '082237188923',
                'avatar' => null,
                'status' => 'approved',
                'is_active' => true,
                'email_verified_at' => '2025-11-28 02:48:51',
            ],
            [
                'tenant_id' => null,
                'name' => 'Riri',
                'email' => 'riri@malbaligaleria.com',
                'password' => 'riri#mbg2025',
                'phone' => '082237188923',
                'avatar' => null,
                'status' => 'approved',
                'is_active' => true,
                'email_verified_at' => '2025-11-28 02:48:51',
            ]
        ];

        foreach ($users as $user) {
            $u = User::firstOrCreate($user);
            $u->assignRole('admin');
        }

        // $user = User::firstOrCreate([
        //     'tenant_id' => null,
        //     'name' => 'Yogi Prayoga',
        //     'email' => 'yogi@malbaligaleria.com',
        //     'password' => 'mbg@2025_',
        //     'phone' => '082237188923',
        //     'avatar' => null,
        //     'status' => 'approved',
        //     'is_active' => true,
        //     'email_verified_at' => '2025-11-28 02:48:51',
        // ]);

        // $user->assignRole('admin');
    }
}
