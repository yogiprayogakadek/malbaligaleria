<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Tenant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TenantSeeder2ndFloor extends Seeder
{
    public function run(): void
    {
        $tenants = [
            [
                'category_id' => 'Sport & Swim Apparel',
                'type' => 'Tenant',
                'name' => 'skechers', //NEW
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '2A 15-17b'
                ]),
            ],
            [
                'category_id' => 'Fashion, Beauty & Accessories',
                'type' => 'Tenant',
                'name' => 'crocs',
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '2A 17a'
                ]),
            ],
            [
                'category_id' => 'Anchor Tenant',
                'type' => 'Tenant',
                'name' => 'uniqlo', //NEW
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '-'
                ]),
            ],
            [
                'category_id' => 'Fashion, Beauty & Accessories',
                'type' => 'Tenant',
                'name' => 'manzone', //NEW
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '2A-21'
                ]),
            ],
            [
                'category_id' => 'Fashion, Beauty & Accessories',
                'type' => 'Tenant',
                'name' => 'fit flop',
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '2A-22'
                ]),
            ],
            [
                'category_id' => 'Fashion, Beauty & Accessories',
                'type' => 'Tenant',
                'name' => 'celcius',
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '2A-23'
                ]),
            ],
            [
                'category_id' => 'Fashion, Beauty & Accessories',
                'type' => 'Tenant',
                'name' => 'advance',
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '2A-25'
                ]),
            ],
            [
                'category_id' => 'Fashion, Beauty & Accessories',
                'type' => 'Tenant',
                'name' => 'dr. specs',
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '2A-26'
                ]),
            ],
            [
                'category_id' => 'Fashion, Beauty & Accessories',
                'type' => 'Tenant',
                'name' => "bag's city",
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '2A-27'
                ]),
            ],
            [
                'category_id' => 'Fashion, Beauty & Accessories',
                'type' => 'Tenant',
                'name' => 'color box',
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '2A 28-29'
                ]),
            ],
            [
                'category_id' => 'Fashion, Beauty & Accessories',
                'type' => 'Tenant',
                'name' => 'optik tunggal', //NEW
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '2A-30'
                ]),
            ],
            [
                'category_id' => 'Fashion, Beauty & Accessories',
                'type' => 'Tenant',
                'name' => 'optik melawai', //NEW
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '2A-31'
                ]),
            ],
            [
                'category_id' => 'Anchor Tenant',
                'type' => 'Tenant',
                'name' => 'hypermart',
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '-'
                ]),
            ],
            [
                'category_id' => 'Anchor Tenant',
                'type' => 'Tenant',
                'name' => 'matahari ',
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '-'
                ]),
            ],
            [
                'category_id' => 'Household Goods & Furniture',
                'type' => 'Tenant',
                'name' => 'simmons', //NEW
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '2C-91'
                ]),
            ],
            [
                'category_id' => 'Household Goods & Furniture',
                'type' => 'Tenant',
                'name' => 'serta', //NEW
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '2C 88-89'
                ]),
            ],
            [
                'category_id' => 'Household Goods & Furniture',
                'type' => 'Tenant',
                'name' => 'lady americana',
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '2C-87'
                ]),
            ],
            [
                'category_id' => 'Drugs & Pharmacy',
                'type' => 'Tenant',
                'name' => 'guardian pharmacy',
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '2C 85-86'
                ]),
            ],
            [
                'category_id' => 'IT, Games & Gadgets',
                'type' => 'Tenant',
                'name' => 'top star accessories', //NEW
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '2C-83'
                ]),
            ],
            [
                'category_id' => 'IT, Games & Gadgets',
                'type' => 'Tenant',
                'name' => 'bose',
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '2C-82'
                ]),
            ],
            [
                'category_id' => 'IT, Games & Gadgets',
                'type' => 'Tenant',
                'name' => 'digiplus',
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '2C 80-81b'
                ]),
            ],
            [
                'category_id' => 'IT, Games & Gadgets',
                'type' => 'Tenant',
                'name' => 'game sport',
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '2C-81a'
                ]),
            ],
            [
                'category_id' => 'IT, Games & Gadgets',
                'type' => 'Tenant',
                'name' => 'xiamoi', //NEW
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '2C-79'
                ]),
            ],
            [
                'category_id' => 'IT, Games & Gadgets',
                'type' => 'Tenant',
                'name' => 'samsung', //NEW
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '2C-78'
                ]),
            ],
            [
                'category_id' => 'Household Goods & Furniture',
                'type' => 'Tenant',
                'name' => 'king koil',
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '2C 76-77'
                ]),
            ],
            [
                'category_id' => 'Fashion, Beauty & Accessories',
                'type' => 'Tenant',
                'name' => 'staccato',
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => 'D2B'
                ]),
            ],
            [
                'category_id' => 'Fashion, Beauty & Accessories',
                'type' => 'Tenant',
                'name' => 'birkenstock',
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => 'D2B'
                ]),
            ],
            [
                'category_id' => 'Fashion, Beauty & Accessories',
                'type' => 'Tenant',
                'name' => 'new era',
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => 'D3'
                ]),
            ],
            [
                'category_id' => 'Fashion, Beauty & Accessories',
                'type' => 'Tenant',
                'name' => 'kcmtku',
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '2A-T1'
                ]),
            ],
            [
                'category_id' => 'Fashion, Beauty & Accessories',
                'type' => 'Tenant',
                'name' => 'watch studio',
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '2A-T2'
                ]),
            ],
            [
                'category_id' => 'Fashion, Beauty & Accessories',
                'type' => 'Tenant',
                'name' => 'iqos',
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '-'
                ]),
            ],
            [
                'category_id' => 'Fashion, Beauty & Accessories',
                'type' => 'Tenant',
                'name' => 'miracle & co',
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '-'
                ]),
            ],
            [
                'category_id' => 'IT, Games & Gadgets',
                'type' => 'Tenant',
                'name' => 'gino mariani',
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '-'
                ]),
            ],
            [
                'category_id' => 'Drugs & Pharmacy',
                'type' => 'Tenant',
                'name' => 'gnc',
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '2C-T2'
                ]),
            ],
            [
                'category_id' => 'Household Goods & Furniture',
                'type' => 'Tenant',
                'name' => 'tomomi',
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '2C-T1'
                ]),
            ],
            [
                'category_id' => 'Island Counter',
                'type' => 'Island',
                'name' => 'churros',
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '-'
                ]),
            ],
            [
                'category_id' => 'Island Counter',
                'type' => 'Island',
                'name' => 'lucky cheese',
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '-'
                ]),
            ],
            [
                'category_id' => 'Island Counter',
                'type' => 'Island',
                'name' => 'thai inc',
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '-'
                ]),
            ],
            [
                'category_id' => 'Island Counter',
                'type' => 'Island',
                'name' => 'photoinc',
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '-'
                ]),
            ],
            [
                'category_id' => 'Island Counter',
                'type' => 'Island',
                'name' => 'perfect relax',
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '-'
                ]),
            ],
            [
                'category_id' => 'Island Counter',
                'type' => 'Island',
                'name' => '24Bottles', //NEW
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '-'
                ]),
            ],
            [
                'category_id' => 'Island Counter',
                'type' => 'Island',
                'name' => 'doran gadget',
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '-'
                ]),
            ],
            [
                'category_id' => 'Anchor Tenant',
                'type' => 'Tenant',
                'name' => 'Planet Sport Asia', //NEW
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '-'
                ]),
            ],
            [
                'category_id' => 'Anchor Tenant',
                'type' => 'Tenant',
                'name' => 'foot locker',
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '-'
                ]),
            ],
            [
                'category_id' => 'Kids & Play Zone',
                'type' => 'Tenant',
                'name' => 'Mothercare',
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '2C-69'
                ]),
            ],
            [
                'category_id' => 'IT, Games & Gadgets',
                'type' => 'Tenant',
                'name' => 'erafone',
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '2C 66-67'
                ]),
            ],
            [
                'category_id' => 'Salon, Office & Services',
                'type' => 'Tenant',
                'name' => 'hair creator nailpia',
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '2C 66-67'
                ]),
            ],
            [
                'category_id' => 'IT, Games & Gadgets',
                'type' => 'Tenant',
                'name' => 'jbl store',
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '2C-63'
                ]),
            ],
            [
                'category_id' => 'IT, Games & Gadgets',
                'type' => 'Tenant',
                'name' => 'huawei',
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '2C-62'
                ]),
            ],
            [
                'category_id' => 'IT, Games & Gadgets',
                'type' => 'Tenant',
                'name' => 'loly poly',
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '2C-61'
                ]),
            ],
            [
                'category_id' => 'Household Goods & Furniture',
                'type' => 'Tenant',
                'name' => 'king rabbit',
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '2C-60'
                ]),
            ],
            [
                'category_id' => 'IT, Games & Gadgets',
                'type' => 'Tenant',
                'name' => 'ur store', //NEW
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '2C 58-59'
                ]),
            ],
            [
                'category_id' => 'Island Counter',
                'type' => 'Island',
                'name' => 'clean and care',
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '-'
                ]),
            ],
            [
                'category_id' => 'Island Counter',
                'type' => 'Island',
                'name' => 'homcha',
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '-'
                ]),
            ],
            [
                'category_id' => 'Island Counter',
                'type' => 'Island',
                'name' => 'phoooto.id',
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '-'
                ]),
            ],
            [
                'category_id' => 'Island Counter',
                'type' => 'Island',
                'name' => 'gacha corner',
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '-'
                ]),
            ],
            [
                'category_id' => 'Anchor Tenant',
                'type' => 'tenant',
                'name' => 'toys kingdom', //NEW
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '-'
                ]),
            ],
            [
                'category_id' => 'Island Counter',
                'type' => 'Island',
                'name' => 'oni ola',
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '-'
                ]),
            ],
            [
                'category_id' => 'Island Counter',
                'type' => 'Island',
                'name' => 'small town',
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '-'
                ]),
            ],
            [
                'category_id' => 'Anchor Tenant',
                'type' => 'tenant',
                'name' => 'gramedia',
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '-'
                ]),
            ],
            [
                'category_id' => 'Anchor Tenant',
                'type' => 'tenant',
                'name' => 'batik keris',
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '-'
                ]),
            ],
            [
                'category_id' => 'Salon, Office & Services',
                'type' => 'tenant',
                'name' => 'christopher salon',
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '2A-07'
                ]),
            ],
            [
                'category_id' => 'Salon, Office & Services',
                'type' => 'tenant',
                'name' => 'cimb niaga',
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '2A-08'
                ]),
            ],
            [
                'category_id' => 'Salon, Office & Services',
                'type' => 'tenant',
                'name' => 'yopie salon', //NEW
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '2A-09'
                ]),
            ],
            [
                'category_id' => 'Salon, Office & Services',
                'type' => 'tenant',
                'name' => 'grapari telkomsel', //NEW
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '2A 10-11'
                ]),
            ],
            [
                'category_id' => 'Salon, Office & Services',
                'type' => 'tenant',
                'name' => 'johnny andrea',
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '2A-12'
                ]),
            ],
            [
                'category_id' => 'Fashion, Beauty & Accessories',
                'type' => 'tenant',
                'name' => 'studio tas', //NEW
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '2A-12a'
                ]),
            ],
            [
                'category_id' => 'Food & Beverages',
                'type' => 'tenant',
                'name' => 'photoism', //NEW
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '2E-01c'
                ]),
            ],
            [
                'category_id' => 'Food & Beverages',
                'type' => 'tenant',
                'name' => 'zhengda', //NEW
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '2E-01a'
                ]),
            ],
            [
                'category_id' => 'Food & Beverages',
                'type' => 'tenant',
                'name' => 'mixue', //NEW
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '2E-01b'
                ]),
            ],
            [
                'category_id' => 'Food & Beverages',
                'type' => 'tenant',
                'name' => 'selfie time', //NEW
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '2E-02a'
                ]),
            ],
            [
                'category_id' => 'Food & Beverages',
                'type' => 'tenant',
                'name' => 'gong cha',
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '2E-02b'
                ]),
            ],
            [
                'category_id' => 'Food & Beverages',
                'type' => 'tenant',
                'name' => 'Tan-Panama Coffee', //NEW
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '2E-03a'
                ]),
            ],
            [
                'category_id' => 'Food & Beverages',
                'type' => 'tenant',
                'name' => 'tomoro coffee',
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '2E-03b'
                ]),
            ],
            [
                'category_id' => 'Food & Beverages',
                'type' => 'tenant',
                'name' => 'gong cha',
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '2E 05-07'
                ]),
            ],
            [
                'category_id' => 'Kids & Play Zone',
                'type' => 'tenant',
                'name' => 'bali ice skating',
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '-'
                ]),
            ],
            [
                'category_id' => 'Kids & Play Zone',
                'type' => 'tenant',
                'name' => 'mindchamps',
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '-'
                ]),
            ],
            [
                'category_id' => 'Island Counter',
                'type' => 'Island',
                'name' => 'wangsa gelato',
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '-'
                ]),
            ],
            [
                'category_id' => 'Island Counter',
                'type' => 'Island',
                'name' => 'orlenalycious',
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '-'
                ]),
            ],
            [
                'category_id' => 'Kids & Play Zone',
                'type' => 'tenant',
                'name' => 'kidz station',
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '2E-17'
                ]),
            ],
            [
                'category_id' => 'Kids & Play Zone',
                'type' => 'tenant',
                'name' => 'smiggle', //NEW
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '2E-18'
                ]),
            ],
            [
                'category_id' => 'Kids & Play Zone',
                'type' => 'tenant',
                'name' => 'FuniFun!',
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '2E-19'
                ]),
            ],
            [
                'category_id' => 'Kids & Play Zone',
                'type' => 'tenant',
                'name' => 'timezone',
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '2E-11'
                ]),
            ],
            [
                'category_id' => 'Kids & Play Zone',
                'type' => 'tenant',
                'name' => 'OH SOME!',
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '2E-12'
                ]),
            ],
            [
                'category_id' => 'Fashion, Beauty & Accessories',
                'type' => 'tenant',
                'name' => 'Mon Cherie',
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '2E-15'
                ]),
            ],
        ];

        $categories = Category::pluck('id', 'name')->toArray();

        $data = [];
        foreach ($tenants as $tenant) {
            $data[] = [
                'uuid' => (string) Str::uuid(),
                'category_id' => $categories[$tenant['category_id']],
                'type' => $tenant['type'],
                'isNew' => 0,
                'name' => mb_convert_case($tenant['name'], MB_CASE_TITLE, 'UTF-8'),
                'map_coords' => $tenant['map_coords'],
                'logo' => 'assets/images/tenant_logo/' . $tenant['name'] . '.png',
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        Tenant::insert($data);
    }
}
