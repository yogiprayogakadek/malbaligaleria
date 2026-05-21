<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\FrontendMenu;

class FrontendMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $menus = [
            [
                'name' => 'Home',
                'url' => '/',
                'is_active' => true,
                'roles' => null,
                'order' => 1,
            ],
            [
                'name' => 'About',
                'url' => '/#about',
                'is_active' => true,
                'roles' => null,
                'order' => 2,
            ],
            [
                'name' => 'Events',
                'url' => '/#events',
                'is_active' => true,
                'roles' => null,
                'order' => 3,
            ],
            [
                'name' => 'Promo',
                'url' => '/promotion',
                'is_active' => true,
                'roles' => null,
                'order' => 4,
            ],
            [
                'name' => 'New Store',
                'url' => '/new-store',
                'is_active' => true,
                'roles' => null,
                'order' => 5,
            ],
            [
                'name' => 'Tenant List',
                'url' => '/directory',
                'is_active' => true,
                'roles' => null,
                'order' => 6,
            ],
            [
                'name' => 'Gallery',
                'url' => '/gallery',
                'is_active' => true,
                'roles' => null,
                'order' => 7,
            ],
            [
                'name' => 'Careers',
                'url' => '/career',
                'is_active' => true,
                'roles' => null,
                'order' => 8,
            ],
            [
                'name' => 'Contact',
                'url' => '/#contact',
                'is_active' => true,
                'roles' => null,
                'order' => 9,
            ],
            [
                'name' => 'Dashboard',
                'url' => '/admin',
                'is_active' => true,
                'roles' => ['admin', 'superuser'],
                'order' => 10,
            ],
        ];

        foreach ($menus as $menu) {
            FrontendMenu::firstOrCreate(
                ['name' => $menu['name']],
                $menu
            );
        }
    }
}
