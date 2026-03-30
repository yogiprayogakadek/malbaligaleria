<?php
 
namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SuperUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::firstOrCreate([
            'email' => 'supermbg@malbaligaleria.com',
        ], [
            'name' => 'Super User MBG',
            'password' => Hash::make('12345678'),
            'status' => 'approved',
            'is_active' => true,
            'email_verified_at' => now(),
        ]);

        $user->assignRole('superuser');
    }
}
