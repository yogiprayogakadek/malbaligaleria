<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            [
                'pages' => 'home',
                'name' => 'default',
                'payload' => json_encode([
                    'site_title' => 'Mal Bali Galeria',
                    'hero_background' => 'assets/images/default/background.webp',
                    'hero_title' => 'The FIRST Premium Shopping Mall & Life Style Destination in Bali',
                    'hero_subtitle' => 'The Best Way to Predict The Future is to Create It and That Future is here...',
                ]),
                'description' => 'default setting for home page',
                'type' => 'default',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'pages' => 'mal directory',
                'name' => 'default',
                'payload' => json_encode([
                    'site_title' => 'Mal Bali Galeria | Tenants Directory',
                    'page_title' => 'Tenant Directory',
                    'page_subtitle' => 'Discover our collection of premium brands and stores'
                ]),
                'description' => 'default setting for directory',
                'type' => 'default',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'pages' => 'event',
                'name' => 'default',
                'payload' => json_encode([
                    'site_title' => 'Mal Bali Galeria | Event',
                    'page_title' => 'Current Events',
                    'page_subtitle' => 'Discover our collection of premium brands and stores'
                ]),
                'description' => 'default setting for event',
                'type' => 'default',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'pages' => 'promo',
                'name' => 'default',
                'payload' => json_encode([
                    'site_title' => 'Mal Bali Galeria | Tenants Directory',
                    'page_title' => 'Current Promotions',
                    'page_subtitle' => 'Discover amazing deals and offers from our tenants'
                ]),
                'description' => 'default setting for promo',
                'type' => 'default',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'pages' => 'others',
                'name' => 'default',
                'payload' => json_encode([
                    'company_address' => 'Simpang Dewa Ruci<br>Jl. Bypass Ngurah Rai, Kuta, Badung, Bali, Indonesia 80361',
                    'contact_email' => 'info@malbaligaleria.co.id',
                    'contact_phone' => '(0361) 755277',
                    'social_facebook' => '',
                    'social_instagram' => 'malbaligaleria',
                    'logo' => 'assets/images/default/logo.png',
                ]),
                'description' => 'default setting for others',
                'type' => 'default',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ];

        Setting::insert($settings);
    }
}
