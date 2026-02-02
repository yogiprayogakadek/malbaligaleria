<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Tenant;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TenantSeederV3 extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tenants = [
            [
                'category_id' => 'Fashion, Beauty & Accessories',
                'type' => 'tenant',
                'name' => 'Aora Jewellry',
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1A-22',
                    'x' => '1086',
                    'y' => '3186'
                ]),
            ],
            [
                'category_id' => 'Fashion, Beauty & Accessories',
                'type' => 'tenant',
                'name' => 'Bamboo Blonde',
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1A-23',
                    'x' => '1083',
                    'y' => '3238'
                ]),
            ],
            [
                'category_id' => 'Fashion, Beauty & Accessories',
                'type' => 'tenant',
                'name' => 'Guess',
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1A-25',
                    'x' => '1086',
                    'y' => '3289'
                ]),
            ],
            [
                'category_id' => 'Fashion, Beauty & Accessories',
                'type' => 'tenant',
                'name' => 'Bath & Body Works',
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1A 26-27',
                    'x' => '1069',
                    'y' => '3375'
                ]),
            ],
            [
                'category_id' => 'Fashion, Beauty & Accessories',
                'type' => 'tenant',
                'name' => 'L\'occitane',
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1A-28',
                    'x' => '1064',
                    'y' => '3460'
                ]),
            ],
            [
                'category_id' => 'Fashion, Beauty & Accessories',
                'type' => 'tenant',
                'name' => 'Rotelli',
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1A-29',
                    'x' => '1064',
                    'y' => '3518'
                ]),
            ],
            [
                'category_id' => 'Fashion, Beauty & Accessories',
                'type' => 'tenant',
                'name' => 'By Aura',
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1A-30',
                    'x' => '1068',
                    'y' => '3564'
                ]),
            ],
            [
                'category_id' => 'Fashion, Beauty & Accessories',
                'type' => 'tenant',
                'name' => 'Steve Madden',
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1A-31',
                    'x' => '1064',
                    'y' => '3615'
                ]),
            ],
            [
                'category_id' => 'Sport & Swim Apparel',
                'type' => 'tenant',
                'name' => 'Arena',
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1A-32',
                    'x' => '1079',
                    'y' => '3678'
                ]),
            ],
            [
                'category_id' => 'Fashion, Beauty & Accessories',
                'type' => 'tenant',
                'name' => 'Naughty',
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1A-33',
                    'x' => '1081',
                    'y' => '3725'
                ]),
            ],
            [
                'category_id' => 'Fashion, Beauty & Accessories',
                'type' => 'tenant',
                'name' => 'Hush Puppies',
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1A-35',
                    'x' => '1081',
                    'y' => '3781'
                ]),
            ],
            [
                'category_id' => 'Fashion, Beauty & Accessories',
                'type' => 'tenant',
                'name' => 'Popits',
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1A-36',
                    'x' => '1056',
                    'y' => '3838'
                ]),
            ],
            [
                'category_id' => 'Fashion, Beauty & Accessories',
                'type' => 'tenant',
                'name' => 'American Tourister',
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1A-37',
                    'x' => '1062',
                    'y' => '3887'
                ]),
            ],
            [
                'category_id' => 'Fashion, Beauty & Accessories',
                'type' => 'tenant',
                'name' => 'Timberland',
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1A-38',
                    'x' => '1066',
                    'y' => '3942'
                ]),
            ],
            [
                'category_id' => 'Sport & Swim Apparel',
                'type' => 'tenant',
                'name' => 'Hoops',
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1A 39-40',
                    'x' => '1068',
                    'y' => '4049'
                ]),
            ],
            [
                'category_id' => 'Fashion, Beauty & Accessories',
                'type' => 'tenant',
                'name' => 'Polo',
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1A 41-42',
                    'x' => '1071',
                    'y' => '4130'
                ]),
            ],
            [
                'category_id' => 'Fashion, Beauty & Accessories',
                'type' => 'tenant',
                'name' => 'Camel Active',
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1A-43',
                    'x' => '1073',
                    'y' => '4213'
                ]),
            ],
            [
                'category_id' => 'Anchor Tenant',
                'type' => 'tenant',
                'name' => 'Matahari',
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '-',
                    'x' => '778',
                    'y' => '4542'
                ]),
            ],
            [
                'category_id' => 'Fashion, Beauty & Accessories',
                'type' => 'tenant',
                'name' => 'Intimo',
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1C-97',
                    'x' => '543',
                    'y' => '4267'
                ]),
            ],
            [
                'category_id' => 'Fashion, Beauty & Accessories',
                'type' => 'tenant',
                'name' => 'Stroberi',
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1C-96',
                    'x' => '522',
                    'y' => '4213'
                ]),
            ],
            [
                'category_id' => 'Fashion, Beauty & Accessories',
                'type' => 'tenant',
                'name' => 'Watchout!',
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1C-95',
                    'x' => '522',
                    'y' => '4158'
                ]),
            ],
            [
                'category_id' => 'Fashion, Beauty & Accessories',
                'type' => 'tenant',
                'name' => 'Gosh',
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1C-93',
                    'x' => '535',
                    'y' => '4106'
                ]),
            ],
            [
                'category_id' => 'Fashion, Beauty & Accessories',
                'type' => 'tenant',
                'name' => 'Wacoal',
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1C-92',
                    'x' => '526',
                    'y' => '4053'
                ]),
            ],
            [
                'category_id' => 'Fashion, Beauty & Accessories',
                'type' => 'tenant',
                'name' => 'Everbest',
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1C-91',
                    'x' => '530',
                    'y' => '3998'
                ]),
            ],
            [
                'category_id' => 'Fashion, Beauty & Accessories',
                'type' => 'tenant',
                'name' => 'Bata',
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1C 89-90',
                    'x' => '526',
                    'y' => '3925'
                ]),
            ],
            [
                'category_id' => 'Fashion, Beauty & Accessories',
                'type' => 'tenant',
                'name' => 'The Perfume Shop',
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1C-88',
                    'x' => '537',
                    'y' => '3838'
                ]),
            ],
            [
                'category_id' => 'Fashion, Beauty & Accessories',
                'type' => 'tenant',
                'name' => 'Minimal',
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1C-87',
                    'x' => '524',
                    'y' => '3780'
                ]),
            ],
            [
                'category_id' => 'Fashion, Beauty & Accessories',
                'type' => 'tenant',
                'name' => 'Bellagio',
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1C-86',
                    'x' => '526',
                    'y' => '3729'
                ]),
            ],
            [
                'category_id' => 'Fashion, Beauty & Accessories',
                'type' => 'tenant',
                'name' => 'Mississipi',
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1C-85',
                    'x' => '516',
                    'y' => '3675'
                ]),
            ],
            [
                'category_id' => 'Fashion, Beauty & Accessories',
                'type' => 'tenant',
                'name' => 'Levi\'s',
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1C 82-82',
                    'x' => '537',
                    'y' => '3586'
                ]),
            ],
            [
                'category_id' => 'Fashion, Beauty & Accessories',
                'type' => 'tenant',
                'name' => 'Giordano',
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1C 80-81',
                    'x' => '532',
                    'y' => '3484'
                ]),
            ],
            [
                'category_id' => 'Fashion, Beauty & Accessories',
                'type' => 'tenant',
                'name' => 'Havaianas',
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1C-79',
                    'x' => '535',
                    'y' => '3400'
                ]),
            ],
            [
                'category_id' => 'Fashion, Beauty & Accessories',
                'type' => 'tenant',
                'name' => 'Keds',
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1C-78',
                    'x' => '533',
                    'y' => '3345'
                ]),
            ],
            [
                'category_id' => 'Fashion, Beauty & Accessories',
                'type' => 'tenant',
                'name' => 'Donini',
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1C-77',
                    'x' => '513',
                    'y' => '3291'
                ]),
            ],
            [
                'category_id' => 'Fashion, Beauty & Accessories',
                'type' => 'tenant',
                'name' => 'The Body Shop',
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1C-76',
                    'x' => '501',
                    'y' => '3231'
                ]),
            ],
            [
                'category_id' => 'Sport & Swim Apparel',
                'type' => 'tenant',
                'name' => 'Puma',
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1C 73-75',
                    'x' => '505',
                    'y' => '3154'
                ]),
            ],
            [
                'category_id' => 'Fashion, Beauty & Accessories',
                'type' => 'tenant',
                'name' => 'Victoria\'s Secret',
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1C-72a',
                    'x' => '541',
                    'y' => '3065'
                ]),
            ],
            [
                'category_id' => 'Bookstore',
                'type' => 'tenant',
                'name' => 'Whsmith',
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1C-72b',
                    'x' => '449',
                    'y' => '3061'
                ]),
            ],
            [
                'category_id' => 'Fashion, Beauty & Accessories',
                'type' => 'tenant',
                'name' => 'This Is April',
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1B-51',
                    'x' => '680',
                    'y' => '4197'
                ]),
            ],
            [
                'category_id' => 'Household Goods & Furniture',
                'type' => 'tenant',
                'name' => 'Vinoti Living',
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1B-52',
                    'x' => '793',
                    'y' => '4169'
                ]),
            ],
            [
                'category_id' => 'Household Goods & Furniture',
                'type' => 'tenant',
                'name' => 'Miniso',
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1B-53',
                    'x' => '921',
                    'y' => '4181'
                ]),
            ],
            [
                'category_id' => 'Island Counter',
                'type' => 'island',
                'name' => 'Hello The Healthy Brew',
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '-',
                    'x' => '661',
                    'y' => '4096'
                ]),
            ],
            [
                'category_id' => 'Island Counter',
                'type' => 'island',
                'name' => 'Panlandwoo',
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '-',
                    'x' => '934',
                    'y' => '4095'
                ]),
            ],
            [
                'category_id' => 'Island Counter',
                'type' => 'island',
                'name' => 'Bananas',
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '-',
                    'x' => '729',
                    'y' => '4051'
                ]),
            ],
            [
                'category_id' => 'Island Counter',
                'type' => 'island',
                'name' => 'Balinata',
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '-',
                    'x' => '879',
                    'y' => '4051'
                ]),
            ],
            [
                'category_id' => 'Island Counter',
                'type' => 'island',
                'name' => 'Moncherie',
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '-',
                    'x' => '669',
                    'y' => '3990'
                ]),
            ],
            [
                'category_id' => 'Island Counter',
                'type' => 'island',
                'name' => 'Shake Shake',
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '-',
                    'x' => '876',
                    'y' => '3967'
                ]),
            ],
            [
                'category_id' => 'Island Counter',
                'type' => 'island',
                'name' => 'Zuma',
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '-',
                    'x' => '936',
                    'y' => '3907'
                ]),
            ],
            [
                'category_id' => 'Island Counter',
                'type' => 'island',
                'name' => 'Captain Burger',
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '-',
                    'x' => '878',
                    'y' => '3873'
                ]),
            ],
            [
                'category_id' => 'Island Counter',
                'type' => 'island',
                'name' => 'Kanini',
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '-',
                    'x' => '',
                    'y' => ''
                ]),
            ],
            [
                'category_id' => 'Island Counter',
                'type' => 'island',
                'name' => 'Dear Butter',
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '-',
                    'x' => '891',
                    'y' => '3788'
                ]),
            ],
            [
                'category_id' => 'Island Counter',
                'type' => 'island',
                'name' => 'Beard Papa\'s',
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '-',
                    'x' => '712',
                    'y' => '3784'
                ]),
            ],
            [
                'category_id' => 'Island Counter',
                'type' => 'island',
                'name' => 'Sour Sally',
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '-',
                    'x' => '673',
                    'y' => '3782'
                ]),
            ],
            [
                'category_id' => 'Island Counter',
                'type' => 'island',
                'name' => 'Chatime',
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => 'K2',
                    'x' => '802',
                    'y' => '3729'
                ]),
            ],
            [
                'category_id' => 'Island Counter',
                'type' => 'island',
                'name' => 'Full Hardy',
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '-',
                    'x' => '936',
                    'y' => '3782'
                ]),
            ],
            [
                'category_id' => 'Island Counter',
                'type' => 'island',
                'name' => 'Roti Boy',
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '-',
                    'x' => '710',
                    'y' => '3668'
                ]),
            ],
            [
                'category_id' => 'Island Counter',
                'type' => 'island',
                'name' => 'Chikuro',
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '-',
                    'x' => '673',
                    'y' => '3674'
                ]),
            ],
            [
                'category_id' => 'Island Counter',
                'type' => 'island',
                'name' => 'Shihlin',
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '-',
                    'x' => '896',
                    'y' => '3673'
                ]),
            ],
            [
                'category_id' => 'Island Counter',
                'type' => 'island',
                'name' => 'Puyo',
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '-',
                    'x' => '932',
                    'y' => '3673'
                ]),
            ],
            [
                'category_id' => 'Island Counter',
                'type' => 'island',
                'name' => 'Somay Little Menteng',
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '-',
                    'x' => '876',
                    'y' => '3609'
                ]),
            ],
            [
                'category_id' => 'Island Counter',
                'type' => 'island',
                'name' => 'Montato',
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '-',
                    'x' => '876',
                    'y' => '3544'
                ]),
            ],
            [
                'category_id' => 'Island Counter',
                'type' => 'island',
                'name' => 'Charlie\'s',
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '-',
                    'x' => '876',
                    'y' => '3477'
                ]),
            ],
            [
                'category_id' => 'Fashion, Beauty & Accessories',
                'type' => 'tenant',
                'name' => 'Yves Rocher',
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1B',
                    'x' => '928',
                    'y' => '3359'
                ]),
            ],
            [
                'category_id' => 'Fashion, Beauty & Accessories',
                'type' => 'tenant',
                'name' => 'C & F Perfumery',
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1B',
                    'x' => '678',
                    'y' => '3353'
                ]),
            ],
            [
                'category_id' => 'Fashion, Beauty & Accessories',
                'type' => 'tenant',
                'name' => 'Optik Seis',
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1B-49',
                    'x' => '701',
                    'y' => '3217'
                ]),
            ],
            [
                'category_id' => 'Food & Beverages',
                'type' => 'tenant',
                'name' => 'Koi The',
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => 'K1',
                    'x' => '802',
                    'y' => '3212'
                ]),
            ],
            [
                'category_id' => 'Fashion, Beauty & Accessories',
                'type' => 'tenant',
                'name' => 'Parang Kencana',
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1B-47',
                    'x' => '896',
                    'y' => '3212'
                ]),
            ],
            [
                'category_id' => 'Food & Beverages',
                'type' => 'tenant',
                'name' => 'Solaria',
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => 'V4 Galeria Resto',
                    'x' => '163',
                    'y' => '3064'
                ]),
            ],
            [
                'category_id' => 'Food & Beverages',
                'type' => 'tenant',
                'name' => 'Excelso',
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => 'V3 Galeria Resto',
                    'x' => '167',
                    'y' => '2964'
                ]),
            ],
            [
                'category_id' => 'Food & Beverages',
                'type' => 'tenant',
                'name' => 'Javabica',
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => 'V2 Galeria Resto',
                    'x' => '159',
                    'y' => '2862'
                ]),
            ],
            [
                'category_id' => 'Food & Beverages',
                'type' => 'tenant',
                'name' => 'Starbucks Coffee',
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => 'V1 Galeria Resto',
                    'x' => '165',
                    'y' => '2769'
                ]),
            ],
            [
                'category_id' => 'Food & Beverages',
                'type' => 'tenant',
                'name' => 'Ramen Ya!',
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => 'V1A Galeria Resto',
                    'x' => '165',
                    'y' => '2677'
                ]),
            ],
            [
                'category_id' => 'Food & Beverages',
                'type' => 'tenant',
                'name' => 'Tous Les Jours',
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1C 70-71',
                    'x' => '509',
                    'y' => '2861'
                ]),
            ],
            [
                'category_id' => 'Food & Beverages',
                'type' => 'tenant',
                'name' => 'J.co',
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1C 68-69',
                    'x' => '503',
                    'y' => '2736'
                ]),
            ],
            [
                'category_id' => 'Food & Beverages',
                'type' => 'tenant',
                'name' => 'Pizza Hut Ristorante',
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1C 66-67',
                    'x' => '507',
                    'y' => '2613'
                ]),
            ],
            [
                'category_id' => 'Food & Beverages',
                'type' => 'tenant',
                'name' => 'Es Teller 77',
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1C-65',
                    'x' => '530',
                    'y' => '2528'
                ]),
            ],
            [
                'category_id' => 'Food & Beverages',
                'type' => 'tenant',
                'name' => 'Marugame Udon',
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1C 62-63',
                    'x' => '528',
                    'y' => '2449'
                ]),
            ],
            [
                'category_id' => 'Food & Beverages',
                'type' => 'tenant',
                'name' => 'Raa Cha',
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1C 60-61',
                    'x' => '537',
                    'y' => '2348'
                ]),
            ],
            [
                'category_id' => 'Food & Beverages',
                'type' => 'tenant',
                'name' => 'Ichiban Sushi',
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1C 58-59',
                    'x' => '537',
                    'y' => '2234'
                ]),
            ],
            [
                'category_id' => 'Food & Beverages',
                'type' => 'tenant',
                'name' => 'Ryoshi Japanese Restaurant',
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1C 55-57',
                    'x' => '590',
                    'y' => '2142'
                ]),
            ],
            [
                'category_id' => 'Island Counter',
                'type' => 'island',
                'name' => 'Dum Dum',
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '-',
                    'x' => '706',
                    'y' => '2128'
                ]),
            ],
            [
                'category_id' => 'Island Counter',
                'type' => 'island',
                'name' => 'Herborist',
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '-',
                    'x' => '703',
                    'y' => '2015'
                ]),
            ],
            [
                'category_id' => 'Food & Beverages',
                'type' => 'tenant',
                'name' => 'Penyetan Cok',
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1A 02a-02b',
                    'x' => '1039',
                    'y' => '2045'
                ]),
            ],
            [
                'category_id' => 'Food & Beverages',
                'type' => 'tenant',
                'name' => '',
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1A',
                    'x' => '',
                    'y' => ''
                ]),
            ],
            [
                'category_id' => 'Food & Beverages',
                'type' => 'tenant',
                'name' => 'Ramen1',
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1A 03-05',
                    'x' => '1039',
                    'y' => '2118'
                ]),
            ],
            [
                'category_id' => 'Food & Beverages',
                'type' => 'tenant',
                'name' => 'Ta Wan',
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1A 06-07',
                    'x' => '1073',
                    'y' => '2234'
                ]),
            ],
            [
                'category_id' => 'Food & Beverages',
                'type' => 'tenant',
                'name' => 'Tik Tok',
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1A #A',
                    'x' => '1167',
                    'y' => '2084'
                ]),
            ],
            [
                'category_id' => 'Food & Beverages',
                'type' => 'tenant',
                'name' => 'Baso Afung',
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1A-08',
                    'x' => '1066',
                    'y' => '2319'
                ]),
            ],
            [
                'category_id' => 'Food & Beverages',
                'type' => 'tenant',
                'name' => 'MM Juice',
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1A 09-10',
                    'x' => '1058',
                    'y' => '2395'
                ]),
            ],
            [
                'category_id' => 'Food & Beverages',
                'type' => 'tenant',
                'name' => 'Pandan Kuring',
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1A 11-12',
                    'x' => '1068',
                    'y' => '2496'
                ]),
            ],
            [
                'category_id' => 'Island Counter',
                'type' => 'island',
                'name' => 'Dedari Kuliner',
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '-',
                    'x' => '1022',
                    'y' => '2571'
                ]),
            ],
            [
                'category_id' => 'Island Counter',
                'type' => 'island',
                'name' => 'Relx',
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '-',
                    'x' => '1019',
                    'y' => '2597'
                ]),
            ],
            [
                'category_id' => 'Island Counter',
                'type' => 'island',
                'name' => 'London Taxi Bike',
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '-',
                    'x' => '802',
                    'y' => '2710'
                ]),
            ],
            [
                'category_id' => 'Fashion, Beauty & Accessories',
                'type' => 'tenant',
                'name' => 'Wakai',
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1B-48',
                    'x' => '904',
                    'y' => '2715'
                ]),
            ],
            [
                'category_id' => 'Fashion, Beauty & Accessories',
                'type' => 'tenant',
                'name' => 'Fossil',
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1B-50',
                    'x' => '705',
                    'y' => '2730'
                ]),
            ],
            [
                'category_id' => 'Anchor Tenant',
                'type' => 'tenant',
                'name' => 'Nike',
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '-',
                    'x' => '1290',
                    'y' => '2695'
                ]),
            ],
            [
                'category_id' => 'Anchor Tenant',
                'type' => 'tenant',
                'name' => 'H&M',
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '-',
                    'x' => '1306',
                    'y' => '2975'
                ]),
            ],
            [
                'category_id' => 'Anchor Tenant',
                'type' => 'tenant',
                'name' => 'Cinema XXI',
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '-',
                    'x' => '1455',
                    'y' => '1780'
                ]),
            ],
            [
                'category_id' => 'Anchor Tenant',
                'type' => 'tenant',
                'name' => 'Azko',
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '-',
                    'x' => '906',
                    'y' => '1794'
                ]),
            ],
            [
                'category_id' => 'Sport & Swim Apparel',
                'type' => 'tenant',
                'name' => 'Asics',
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1E-08',
                    'x' => '558',
                    'y' => '1854'
                ]),
            ],
            [
                'category_id' => 'Sport & Swim Apparel',
                'type' => 'tenant',
                'name' => 'New Balance',
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1E-07',
                    'x' => '545',
                    'y' => '1745'
                ]),
            ],
            [
                'category_id' => 'Fashion, Beauty & Accessories',
                'type' => 'tenant',
                'name' => 'Flying Tiger',
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1E-06',
                    'x' => '556',
                    'y' => '1628'
                ]),
            ],
            [
                'category_id' => 'IT, Games & Gadgets',
                'type' => 'tenant',
                'name' => 'Digimap',
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1E-05',
                    'x' => '556',
                    'y' => '1501'
                ]),
            ],
            [
                'category_id' => 'Fashion, Beauty & Accessories',
                'type' => 'tenant',
                'name' => 'Kipling',
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1E-03b',
                    'x' => '680',
                    'y' => '1402'
                ]),
            ],
            [
                'category_id' => 'Fashion, Beauty & Accessories',
                'type' => 'tenant',
                'name' => 'Pandora',
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1E-03a',
                    'x' => '691',
                    'y' => '1325'
                ]),
            ],
            [
                'category_id' => 'Fashion, Beauty & Accessories',
                'type' => 'tenant',
                'name' => 'Saturdays',
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => 'CL Ext. 01',
                    'x' => '738',
                    'y' => '1621'
                ]),
            ],
            [
                'category_id' => 'Fashion, Beauty & Accessories',
                'type' => 'tenant',
                'name' => 'Owndays',
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => 'CL Ext. 01',
                    'x' => '851',
                    'y' => '1570'
                ]),
            ],
            [
                'category_id' => 'Fashion, Beauty & Accessories',
                'type' => 'tenant',
                'name' => 'Sociolla',
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1E-01a',
                    'x' => '1167',
                    'y' => '1279'
                ]),
            ],
            [
                'category_id' => 'Fashion, Beauty & Accessories',
                'type' => 'tenant',
                'name' => 'Amaris Parfume',
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1F-15',
                    'x' => '1273',
                    'y' => '1123'
                ]),
            ],
            [
                'category_id' => 'Fashion, Beauty & Accessories',
                'type' => 'tenant',
                'name' => 'Charles & Keith',
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1F-16',
                    'x' => '1416',
                    'y' => '1017'
                ]),
            ],
            [
                'category_id' => 'Fashion, Beauty & Accessories',
                'type' => 'tenant',
                'name' => 'The Athlete\'s Foot',
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1F-17',
                    'x' => '1504',
                    'y' => '1104'
                ]),
            ],
            [
                'category_id' => 'Anchor Tenant',
                'type' => 'tenant',
                'name' => 'Sports Direct',
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '-',
                    'x' => '1732',
                    'y' => '1143'
                ]),
            ],
            [
                'category_id' => 'Sport & Swim Apparel',
                'type' => 'tenant',
                'name' => 'Hoka',
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1F-02',
                    'x' => '1703',
                    'y' => '875'
                ]),
            ],
            [
                'category_id' => 'Fashion, Beauty & Accessories',
                'type' => 'tenant',
                'name' => 'Aldo',
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1F-03a',
                    'x' => '1634',
                    'y' => '803'
                ]),
            ],
            [
                'category_id' => 'Fashion, Beauty & Accessories',
                'type' => 'tenant',
                'name' => 'Tommy Hillfiger',
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1F-05b',
                    'x' => '1500',
                    'y' => '615'
                ]),
            ],
            [
                'category_id' => 'Sport & Swim Apparel',
                'type' => 'tenant',
                'name' => 'Adidas',
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1F-06',
                    'x' => '1397',
                    'y' => '532'
                ]),
            ],
            [
                'category_id' => 'Fashion, Beauty & Accessories',
                'type' => 'tenant',
                'name' => 'Lacoste',
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1F-07a',
                    'x' => '1293',
                    'y' => '432'
                ]),
            ],
            [
                'category_id' => 'Fashion, Beauty & Accessories',
                'type' => 'tenant',
                'name' => 'Calvin Klein',
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1F-07b',
                    'x' => '1180',
                    'y' => '383'
                ]),
            ],
            [
                'category_id' => 'Fashion, Beauty & Accessories',
                'type' => 'tenant',
                'name' => 'Marks & Spencer',
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1F 08-09',
                    'x' => '1058',
                    'y' => '201'
                ]),
            ],
            [
                'category_id' => 'Fashion, Beauty & Accessories',
                'type' => 'tenant',
                'name' => 'Cotton On',
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1F-10',
                    'x' => '808',
                    'y' => '481'
                ]),
            ],
            [
                'category_id' => 'Fashion, Beauty & Accessories',
                'type' => 'tenant',
                'name' => 'Project Soul',
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1F-11',
                    'x' => '958',
                    'y' => '573'
                ]),
            ],
            [
                'category_id' => 'Fashion, Beauty & Accessories',
                'type' => 'tenant',
                'name' => 'Frank & Co',
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1F-12',
                    'x' => '1079',
                    'y' => '702'
                ]),
            ],
            [
                'category_id' => 'Fashion, Beauty & Accessories',
                'type' => 'tenant',
                'name' => 'Sensatia',
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1F-22',
                    'x' => '964',
                    'y' => '913'
                ]),
            ],
            [
                'category_id' => 'Food & Beverages',
                'type' => 'tenant',
                'name' => 'Sate Khas Senayan',
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1E-02',
                    'x' => '827',
                    'y' => '973'
                ]),
            ],
            [
                'category_id' => 'Island Counter',
                'type' => 'island',
                'name' => 'Crusita',
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => 'Cl Ext-01',
                    'x' => '1098',
                    'y' => '541'
                ]),
            ],
            [
                'category_id' => 'Island Counter',
                'type' => 'island',
                'name' => 'Secret Garden',
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => 'Cl Ext-02',
                    'x' => '1199',
                    'y' => '622'
                ]),
            ],
            [
                'category_id' => 'Island Counter',
                'type' => 'island',
                'name' => 'Nespresso',
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => 'Cl Ext-03',
                    'x' => '1297',
                    'y' => '713'
                ]),
            ],
            [
                'category_id' => 'Island Counter',
                'type' => 'island',
                'name' => 'Shark Ninja',
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => 'Cl Ext-01',
                    'x' => '1393',
                    'y' => '805'
                ]),
            ],
            [
                'category_id' => 'Sport & Swim Apparel',
                'type' => 'tenant',
                'name' => 'Skechers',
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '2A 15-17b',
                    'x' => '1116',
                    'y' => '2581'
                ]),
            ],
            [
                'category_id' => 'Fashion, Beauty & Accessories',
                'type' => 'tenant',
                'name' => 'Crocs',
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '2A 17a',
                    'x' => '1118',
                    'y' => '2682'
                ]),
            ],
            [
                'category_id' => 'Anchor Tenant',
                'type' => 'tenant',
                'name' => 'Uniqlo',
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '-',
                    'x' => '1410',
                    'y' => '2845'
                ]),
            ],
            [
                'category_id' => 'Fashion, Beauty & Accessories',
                'type' => 'tenant',
                'name' => 'Manzone',
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '2A-21',
                    'x' => '1120',
                    'y' => '3263'
                ]),
            ],
            [
                'category_id' => 'Fashion, Beauty & Accessories',
                'type' => 'tenant',
                'name' => 'Fit Flop',
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '2A-22',
                    'x' => '1141',
                    'y' => '3092'
                ]),
            ],
            [
                'category_id' => 'Fashion, Beauty & Accessories',
                'type' => 'tenant',
                'name' => 'Celcius',
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '2A-23',
                    'x' => '1135',
                    'y' => '3151'
                ]),
            ],
            [
                'category_id' => 'Fashion, Beauty & Accessories',
                'type' => 'tenant',
                'name' => 'Advance',
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '2A-25',
                    'x' => '1128',
                    'y' => '3195'
                ]),
            ],
            [
                'category_id' => 'Fashion, Beauty & Accessories',
                'type' => 'tenant',
                'name' => 'Dr. Specs',
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '2A-26',
                    'x' => '1110',
                    'y' => '3254'
                ]),
            ],
            [
                'category_id' => 'Fashion, Beauty & Accessories',
                'type' => 'tenant',
                'name' => 'Bag\'s City',
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '2A-27',
                    'x' => '1126',
                    'y' => '3313'
                ]),
            ],
            [
                'category_id' => 'Fashion, Beauty & Accessories',
                'type' => 'tenant',
                'name' => 'Color Box',
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '2A 28-29',
                    'x' => '1099',
                    'y' => '3392'
                ]),
            ],
            [
                'category_id' => 'Fashion, Beauty & Accessories',
                'type' => 'tenant',
                'name' => 'Optik Tunggal',
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '2A-30',
                    'x' => '1110',
                    'y' => '3484'
                ]),
            ],
            [
                'category_id' => 'Fashion, Beauty & Accessories',
                'type' => 'tenant',
                'name' => 'Optik Melawai',
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '2A-31',
                    'x' => '1122',
                    'y' => '3540'
                ]),
            ],
            [
                'category_id' => 'Anchor Tenant',
                'type' => 'tenant',
                'name' => 'Hypermart',
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '-',
                    'x' => '1495',
                    'y' => '3828'
                ]),
            ],
            [
                'category_id' => 'Anchor Tenant',
                'type' => 'tenant',
                'name' => 'Matahari',
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '-',
                    'x' => '878',
                    'y' => '4283'
                ]),
            ],
            [
                'category_id' => 'Household Goods & Furniture',
                'type' => 'tenant',
                'name' => 'Simmons',
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '2C-91',
                    'x' => '580',
                    'y' => '3945'
                ]),
            ],
            [
                'category_id' => 'Household Goods & Furniture',
                'type' => 'tenant',
                'name' => 'Serta',
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '2C 88-89',
                    'x' => '582',
                    'y' => '3801'
                ]),
            ],
            [
                'category_id' => 'Household Goods & Furniture',
                'type' => 'tenant',
                'name' => 'Lady Americana',
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '2C-87',
                    'x' => '576',
                    'y' => '3717'
                ]),
            ],
            [
                'category_id' => 'Drugs & Pharmacy',
                'type' => 'tenant',
                'name' => 'Guardian Pharmacy',
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '2C 85-86',
                    'x' => '576',
                    'y' => '3631'
                ]),
            ],
            [
                'category_id' => 'IT, Games & Gadgets',
                'type' => 'tenant',
                'name' => 'Top Star Accessories',
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '2C-83',
                    'x' => '582',
                    'y' => '3543'
                ]),
            ],
            [
                'category_id' => 'IT, Games & Gadgets',
                'type' => 'tenant',
                'name' => 'Bose',
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '2C-82',
                    'x' => '570',
                    'y' => '3488'
                ]),
            ],
            [
                'category_id' => 'IT, Games & Gadgets',
                'type' => 'tenant',
                'name' => 'Digiplus',
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '2C 80-81b',
                    'x' => '539',
                    'y' => '3394'
                ]),
            ],
            [
                'category_id' => 'IT, Games & Gadgets',
                'type' => 'tenant',
                'name' => 'Game Sport',
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '2C-81a',
                    'x' => '624',
                    'y' => '3430'
                ]),
            ],
            [
                'category_id' => 'IT, Games & Gadgets',
                'type' => 'tenant',
                'name' => 'Xiaomi',
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '2C-79',
                    'x' => '564',
                    'y' => '3313'
                ]),
            ],
            [
                'category_id' => 'IT, Games & Gadgets',
                'type' => 'tenant',
                'name' => 'Samsung',
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '2C-78',
                    'x' => '584',
                    'y' => '3259'
                ]),
            ],
            [
                'category_id' => 'Household Goods & Furniture',
                'type' => 'tenant',
                'name' => 'King Koil',
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '2C 76-77',
                    'x' => '547',
                    'y' => '3181'
                ]),
            ],
            [
                'category_id' => 'Fashion, Beauty & Accessories',
                'type' => 'tenant',
                'name' => 'Staccato',
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => 'D2B',
                    'x' => '772',
                    'y' => '3148'
                ]),
            ],
            [
                'category_id' => 'Fashion, Beauty & Accessories',
                'type' => 'tenant',
                'name' => 'Birkenstock',
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => 'D2B',
                    'x' => '924',
                    'y' => '3147'
                ]),
            ],
            [
                'category_id' => 'Fashion, Beauty & Accessories',
                'type' => 'tenant',
                'name' => 'New Era',
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => 'D3',
                    'x' => '841',
                    'y' => '3056'
                ]),
            ],
            [
                'category_id' => 'Fashion, Beauty & Accessories',
                'type' => 'tenant',
                'name' => 'Kcmtku',
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '2A-T1',
                    'x' => '966',
                    'y' => '3407'
                ]),
            ],
            [
                'category_id' => 'Fashion, Beauty & Accessories',
                'type' => 'tenant',
                'name' => 'Watch Studio',
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '2A-T2',
                    'x' => '968',
                    'y' => '3503'
                ]),
            ],
            [
                'category_id' => 'Fashion, Beauty & Accessories',
                'type' => 'tenant',
                'name' => 'Iqos',
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '-',
                    'x' => '972',
                    'y' => '3615'
                ]),
            ],
            [
                'category_id' => 'Fashion, Beauty & Accessories',
                'type' => 'tenant',
                'name' => 'Miracle & Co',
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '-',
                    'x' => '849',
                    'y' => '3652'
                ]),
            ],
            [
                'category_id' => 'IT, Games & Gadgets',
                'type' => 'tenant',
                'name' => 'Gino Mariani',
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '-',
                    'x' => '726',
                    'y' => '3599'
                ]),
            ],
            [
                'category_id' => 'Drugs & Pharmacy',
                'type' => 'tenant',
                'name' => 'Gnc',
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '2C-T2',
                    'x' => '724',
                    'y' => '3497'
                ]),
            ],
            [
                'category_id' => 'Household Goods & Furniture',
                'type' => 'tenant',
                'name' => 'Tomomi',
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '2C-T1',
                    'x' => '728',
                    'y' => '3396'
                ]),
            ],
            [
                'category_id' => 'Island Counter',
                'type' => 'island',
                'name' => 'Churros',
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '-',
                    'x' => '753',
                    'y' => '3943'
                ]),
            ],
            [
                'category_id' => 'Island Counter',
                'type' => 'island',
                'name' => 'Lucky Cheese',
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '-',
                    'x' => '905',
                    'y' => '3943'
                ]),
            ],
            [
                'category_id' => 'Island Counter',
                'type' => 'island',
                'name' => 'Thai Inc',
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '-',
                    'x' => '943',
                    'y' => '3940'
                ]),
            ],
            [
                'category_id' => 'Island Counter',
                'type' => 'island',
                'name' => 'Photoinc',
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '-',
                    'x' => '1110',
                    'y' => '3959'
                ]),
            ],
            [
                'category_id' => 'Island Counter',
                'type' => 'island',
                'name' => 'Perfect Relax',
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '-',
                    'x' => '1164',
                    'y' => '3961'
                ]),
            ],
            [
                'category_id' => 'Island Counter',
                'type' => 'island',
                'name' => '24Bottles',
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '-',
                    'x' => '1010',
                    'y' => '3856'
                ]),
            ],
            [
                'category_id' => 'Island Counter',
                'type' => 'island',
                'name' => 'Doran Gadget',
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '-',
                    'x' => '1014',
                    'y' => '3763'
                ]),
            ],
            [
                'category_id' => 'Anchor Tenant',
                'type' => 'tenant',
                'name' => 'Planet Sport Asia',
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '-',
                    'x' => '',
                    'y' => ''
                ]),
            ],
            [
                'category_id' => 'Anchor Tenant',
                'type' => 'tenant',
                'name' => 'Foot Locker',
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '-',
                    'x' => '',
                    'y' => ''
                ]),
            ],
            [
                'category_id' => 'Kids & Play Zone',
                'type' => 'tenant',
                'name' => 'Mothercare',
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '2C-69',
                    'x' => '539',
                    'y' => '2629'
                ]),
            ],
            [
                'category_id' => 'IT, Games & Gadgets',
                'type' => 'tenant',
                'name' => 'Erafone',
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '2C 66-67',
                    'x' => '595',
                    'y' => '2521'
                ]),
            ],
            [
                'category_id' => 'Salon, Office & Services',
                'type' => 'tenant',
                'name' => 'Hair Creator Nailpia',
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '2C 66-67',
                    'x' => '564',
                    'y' => '2436'
                ]),
            ],
            [
                'category_id' => 'IT, Games & Gadgets',
                'type' => 'tenant',
                'name' => 'Jbl Store',
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '2C-63',
                    'x' => '580',
                    'y' => '2377'
                ]),
            ],
            [
                'category_id' => 'IT, Games & Gadgets',
                'type' => 'tenant',
                'name' => 'Huawei',
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '2C-62',
                    'x' => '578',
                    'y' => '2325'
                ]),
            ],
            [
                'category_id' => 'IT, Games & Gadgets',
                'type' => 'tenant',
                'name' => 'Loly Poly',
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '2C-61',
                    'x' => '572',
                    'y' => '2276'
                ]),
            ],
            [
                'category_id' => 'Household Goods & Furniture',
                'type' => 'tenant',
                'name' => 'King Rabbit',
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '2C-60',
                    'x' => '580',
                    'y' => '2209'
                ]),
            ],
            [
                'category_id' => 'IT, Games & Gadgets',
                'type' => 'tenant',
                'name' => 'Ur Store',
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '2C 58-59',
                    'x' => '570',
                    'y' => '2146'
                ]),
            ],
            [
                'category_id' => 'Island Counter',
                'type' => 'island',
                'name' => 'Clean And Care',
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '-',
                    'x' => '687',
                    'y' => '2031'
                ]),
            ],
            [
                'category_id' => 'Island Counter',
                'type' => 'island',
                'name' => 'Homcha',
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '-',
                    'x' => '693',
                    'y' => '1976'
                ]),
            ],
            [
                'category_id' => 'Island Counter',
                'type' => 'island',
                'name' => 'Phoooto.id',
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '-',
                    'x' => '691',
                    'y' => '1928'
                ]),
            ],
            [
                'category_id' => 'Island Counter',
                'type' => 'island',
                'name' => 'Gacha Corner',
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '-',
                    'x' => '637',
                    'y' => '1919'
                ]),
            ],
            [
                'category_id' => 'Anchor Tenant',
                'type' => 'tenant',
                'name' => 'Toys Kingdom',
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '-',
                    'x' => '589',
                    'y' => '1681'
                ]),
            ],
            [
                'category_id' => 'Island Counter',
                'type' => 'island',
                'name' => 'Oni Ola',
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '-',
                    'x' => '791',
                    'y' => '1489'
                ]),
            ],
            [
                'category_id' => 'Island Counter',
                'type' => 'island',
                'name' => 'Small Town',
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '-',
                    'x' => '876',
                    'y' => '1490'
                ]),
            ],
            [
                'category_id' => 'Anchor Tenant',
                'type' => 'tenant',
                'name' => 'Gramedia',
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '-',
                    'x' => '1010',
                    'y' => '1788'
                ]),
            ],
            [
                'category_id' => 'Anchor Tenant',
                'type' => 'tenant',
                'name' => 'Batik Keris',
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '-',
                    'x' => '1076',
                    'y' => '2001'
                ]),
            ],
            [
                'category_id' => 'Salon, Office & Services',
                'type' => 'tenant',
                'name' => 'Christopher Salon',
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '2A-07',
                    'x' => '1124',
                    'y' => '2155'
                ]),
            ],
            [
                'category_id' => 'Salon, Office & Services',
                'type' => 'tenant',
                'name' => 'Cimb Niaga',
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '2A-08',
                    'x' => '1118',
                    'y' => '2218'
                ]),
            ],
            [
                'category_id' => 'Salon, Office & Services',
                'type' => 'tenant',
                'name' => 'Yopie Salon',
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '2A-09',
                    'x' => '1116',
                    'y' => '2267'
                ]),
            ],
            [
                'category_id' => 'Salon, Office & Services',
                'type' => 'tenant',
                'name' => 'Grapari Telkomsel',
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '2A 10-11',
                    'x' => '1116',
                    'y' => '2353'
                ]),
            ],
            [
                'category_id' => 'Salon, Office & Services',
                'type' => 'tenant',
                'name' => 'Johnny Andrea',
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '2A-12',
                    'x' => '1118',
                    'y' => '2428'
                ]),
            ],
            [
                'category_id' => 'Fashion, Beauty & Accessories',
                'type' => 'tenant',
                'name' => 'Studio Tas',
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '2A-12a',
                    'x' => '1118',
                    'y' => '2482'
                ]),
            ],
            [
                'category_id' => 'Food & Beverages',
                'type' => 'tenant',
                'name' => 'Photoism',
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '2E-01c',
                    'x' => '1035',
                    'y' => '1590'
                ]),
            ],
            [
                'category_id' => 'Food & Beverages',
                'type' => 'tenant',
                'name' => 'Zhengda',
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '2E-01a',
                    'x' => '1037',
                    'y' => '1526'
                ]),
            ],
            [
                'category_id' => 'Food & Beverages',
                'type' => 'tenant',
                'name' => 'Mixue',
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '2E-01b',
                    'x' => '1047',
                    'y' => '1469'
                ]),
            ],
            [
                'category_id' => 'Food & Beverages',
                'type' => 'tenant',
                'name' => 'Selfie Time',
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '2E-02a',
                    'x' => '1085',
                    'y' => '1407'
                ]),
            ],
            [
                'category_id' => 'Food & Beverages',
                'type' => 'tenant',
                'name' => 'Gong Cha',
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '2E-02b',
                    'x' => '1166',
                    'y' => '1375'
                ]),
            ],
            [
                'category_id' => 'Food & Beverages',
                'type' => 'tenant',
                'name' => 'Tan-Panama Coffee',
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '2E-03a',
                    'x' => '1197',
                    'y' => '1321'
                ]),
            ],
            [
                'category_id' => 'Food & Beverages',
                'type' => 'tenant',
                'name' => 'Tomoro Coffee',
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '2E-03b',
                    'x' => '1231',
                    'y' => '1277'
                ]),
            ],
            [
                'category_id' => 'Food & Beverages',
                'type' => 'tenant',
                'name' => 'Hyang Togol',
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '2E 05-07',
                    'x' => '1331',
                    'y' => '1171'
                ]),
            ],
            [
                'category_id' => 'Kids & Play Zone',
                'type' => 'tenant',
                'name' => 'Bali Ice Skating',
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '-',
                    'x' => '1574',
                    'y' => '1558'
                ]),
            ],
            [
                'category_id' => 'Kids & Play Zone',
                'type' => 'tenant',
                'name' => 'Mindchamps',
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '-',
                    'x' => '776',
                    'y' => '1122'
                ]),
            ],
            [
                'category_id' => 'Island Counter',
                'type' => 'island',
                'name' => 'Wangsa Gelato',
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '-',
                    'x' => '857',
                    'y' => '1344'
                ]),
            ],
            [
                'category_id' => 'Island Counter',
                'type' => 'island',
                'name' => 'Orlenalycious',
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '-',
                    'x' => '816',
                    'y' => '1305'
                ]),
            ],
            [
                'category_id' => 'Kids & Play Zone',
                'type' => 'tenant',
                'name' => 'Kidz Station',
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '2E-17',
                    'x' => '1289',
                    'y' => '895'
                ]),
            ],
            [
                'category_id' => 'Kids & Play Zone',
                'type' => 'tenant',
                'name' => 'Smiggle',
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '2E-18',
                    'x' => '1091',
                    'y' => '1092'
                ]),
            ],
            [
                'category_id' => 'Kids & Play Zone',
                'type' => 'tenant',
                'name' => 'Funifun!',
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '2E-19',
                    'x' => '1491',
                    'y' => '684'
                ]),
            ],
            [
                'category_id' => 'Kids & Play Zone',
                'type' => 'tenant',
                'name' => 'Timezone',
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '2E-11',
                    'x' => '1305',
                    'y' => '411'
                ]),
            ],
            [
                'category_id' => 'Kids & Play Zone',
                'type' => 'tenant',
                'name' => 'OH SOME!',
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '2E-12',
                    'x' => '910',
                    'y' => '536'
                ]),
            ],
            [
                'category_id' => 'Fashion, Beauty & Accessories',
                'type' => 'tenant',
                'name' => 'Mon Cherie',
                'map_coords' => json_encode([
                    'floor' => '2',
                    'unit' => '2E-15',
                    'x' => '1030',
                    'y' => '871'
                ]),
            ],
            [
                'category_id' => 'Sport & Swim Apparel',
                'type' => 'tenant',
                'name' => 'Salomon',
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1F-03b',
                    'x' => '1598',
                    'y' => '743'
                ]),
            ],
        ];

        $categories = Category::pluck('id', 'name')->toArray();

        $data = [];
        foreach ($tenants as $tenant) {
            $data[] = [
                'uuid' => (string) Str::uuid(),
                'category_id' => $categories[$tenant['category_id']] ?? null,
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