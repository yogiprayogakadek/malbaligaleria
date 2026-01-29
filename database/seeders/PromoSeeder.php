<?php

namespace Database\Seeders;

use App\Models\Promo;
use App\Models\Tenant;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PromoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get random tenants for promos
        $tenants = Tenant::inRandomOrder()->limit(15)->get();

        if ($tenants->isEmpty()) {
            $this->command->warn('No tenants found. Please run TenantSeeder first.');
            return;
        }

        $promos = [
            [
                'tenant_id' => $tenants[0]->id ?? 1,
                'name' => 'Grand Opening Special - 50% Off',
                'start_date' => '2026-02-01',
                'end_date' => '2026-02-28',
                'description' => 'Celebrate our grand opening with 50% off on all items! Limited time only.',
                'banner' => 'promo_grand_opening.jpg',
                'is_active' => true,
            ],
            [
                'tenant_id' => $tenants[1]->id ?? 2,
                'name' => 'Buy 1 Get 1 Free',
                'start_date' => '2026-02-10',
                'end_date' => '2026-02-20',
                'description' => 'Buy one item and get another one absolutely free! Valid on selected items.',
                'banner' => 'promo_buy1get1.jpg',
                'is_active' => true,
            ],
            [
                'tenant_id' => $tenants[2]->id ?? 3,
                'name' => 'Valentine\'s Day Discount',
                'start_date' => '2026-02-10',
                'end_date' => '2026-02-14',
                'description' => 'Show your love with special Valentine\'s Day discounts up to 30% off on selected items.',
                'banner' => 'promo_valentine.jpg',
                'is_active' => true,
            ],
            [
                'tenant_id' => $tenants[3]->id ?? 4,
                'name' => 'Spring Collection Launch',
                'start_date' => '2026-03-01',
                'end_date' => '2026-03-31',
                'description' => 'Discover our new spring collection with 20% off on all new arrivals.',
                'banner' => 'promo_spring.jpg',
                'is_active' => true,
            ],
            [
                'tenant_id' => $tenants[4]->id ?? 5,
                'name' => 'Flash Sale - 3 Hours Only',
                'start_date' => '2026-03-15',
                'end_date' => '2026-03-15',
                'description' => 'Lightning deals! Up to 70% off for 3 hours only. Don\'t miss out!',
                'banner' => 'promo_flash_sale.jpg',
                'is_active' => true,
            ],
            [
                'tenant_id' => $tenants[5]->id ?? 6,
                'name' => 'Member Exclusive - Extra 15% Off',
                'start_date' => '2026-04-01',
                'end_date' => '2026-04-30',
                'description' => 'Members get an extra 15% discount on top of existing promotions. Join now!',
                'banner' => 'promo_member.jpg',
                'is_active' => true,
            ],
            [
                'tenant_id' => $tenants[6]->id ?? 7,
                'name' => 'Summer Clearance Sale',
                'start_date' => '2026-06-01',
                'end_date' => '2026-06-30',
                'description' => 'Clear out summer stock with massive discounts up to 60% off!',
                'banner' => 'promo_summer_clearance.jpg',
                'is_active' => true,
            ],
            [
                'tenant_id' => $tenants[7]->id ?? 8,
                'name' => 'Back to School Promo',
                'start_date' => '2026-07-15',
                'end_date' => '2026-08-15',
                'description' => 'Get ready for school with 25% off on all school essentials and supplies.',
                'banner' => 'promo_back_to_school.jpg',
                'is_active' => true,
            ],
            [
                'tenant_id' => $tenants[8]->id ?? 9,
                'name' => 'Weekend Special - Free Gift',
                'start_date' => '2026-08-01',
                'end_date' => '2026-08-31',
                'description' => 'Shop this weekend and receive a free gift with every purchase over $100.',
                'banner' => 'promo_weekend.jpg',
                'is_active' => true,
            ],
            [
                'tenant_id' => $tenants[9]->id ?? 10,
                'name' => 'Mid-Year Mega Sale',
                'start_date' => '2026-07-01',
                'end_date' => '2026-07-15',
                'description' => 'Our biggest sale of the year! Up to 80% off on selected items.',
                'banner' => 'promo_mega_sale.jpg',
                'is_active' => true,
            ],
            [
                'tenant_id' => $tenants[10]->id ?? 11,
                'name' => 'Black Friday Early Access',
                'start_date' => '2026-11-20',
                'end_date' => '2026-11-29',
                'description' => 'Get early access to Black Friday deals! Exclusive discounts for early birds.',
                'banner' => 'promo_black_friday.jpg',
                'is_active' => true,
            ],
            [
                'tenant_id' => $tenants[11]->id ?? 12,
                'name' => 'Cyber Monday Deals',
                'start_date' => '2026-11-30',
                'end_date' => '2026-11-30',
                'description' => 'Online exclusive deals for Cyber Monday! Shop from home and save big.',
                'banner' => 'promo_cyber_monday.jpg',
                'is_active' => true,
            ],
            [
                'tenant_id' => $tenants[12]->id ?? 13,
                'name' => 'Christmas Gift Guide Sale',
                'start_date' => '2026-12-01',
                'end_date' => '2026-12-24',
                'description' => 'Find the perfect Christmas gifts with special holiday discounts up to 40% off.',
                'banner' => 'promo_christmas.jpg',
                'is_active' => true,
            ],
            [
                'tenant_id' => $tenants[13]->id ?? 14,
                'name' => 'Year End Clearance',
                'start_date' => '2026-12-26',
                'end_date' => '2026-12-31',
                'description' => 'End the year with amazing deals! Clearance sale up to 75% off.',
                'banner' => 'promo_year_end.jpg',
                'is_active' => true,
            ],
            [
                'tenant_id' => $tenants[14]->id ?? 15,
                'name' => 'New Year New You - Fitness Sale',
                'start_date' => '2027-01-01',
                'end_date' => '2027-01-15',
                'description' => 'Start the new year right with 30% off on all fitness and wellness products.',
                'banner' => 'promo_new_year.jpg',
                'is_active' => true,
            ],
        ];

        foreach ($promos as $promo) {
            $promo['uuid'] = Str::uuid();
            Promo::create($promo);
        }
    }
}
