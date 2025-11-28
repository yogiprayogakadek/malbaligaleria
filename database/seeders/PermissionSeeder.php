<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::firstOrCreate(['name' => 'view tenants']);
        Permission::firstOrCreate(['name' => 'manage tenants']);

        // assign permission to user
        Role::findByName('admin')->givePermissionTo([
            'manage tenants'
        ]);
    }
}
