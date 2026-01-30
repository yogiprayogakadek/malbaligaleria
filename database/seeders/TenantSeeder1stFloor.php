<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Tenant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TenantSeeder1stFloor extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tenants = [
            [
                'category_id' => 'Fashion, Beauty & Accessories',
                'type' => 'Tenant',
                'name' => 'aora jewellry',
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1A-22'
                ]),
            ],
            [
                'category_id' => 'Fashion, Beauty & Accessories',
                'type' => 'Tenant',
                'name' => 'bamboo blonde',
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1A-23'
                ]),
            ],
            [
                'category_id' => 'Fashion, Beauty & Accessories',
                'type' => 'Tenant',
                'name' => 'guess',
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1A-25'
                ]),
            ],
            [
                'category_id' => 'Fashion, Beauty & Accessories',
                'type' => 'Tenant',
                'name' => 'bath & body works',
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1A 26-27'
                ]),
            ],
            [
                'category_id' => 'Fashion, Beauty & Accessories',
                'type' => 'Tenant',
                'name' => "l'occitane",
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1A-28'
                ]),
            ],
            [
                'category_id' => 'Fashion, Beauty & Accessories',
                'type' => 'Tenant',
                'name' => 'rotelli', //NEW
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1A-29'
                ]),
            ],
            [
                'category_id' => 'Fashion, Beauty & Accessories',
                'type' => 'Tenant',
                'name' => 'by aura',
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1A-30'
                ]),
            ],
            [
                'category_id' => 'Fashion, Beauty & Accessories',
                'type' => 'Tenant',
                'name' => 'steve madden', //NEW
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1A-31'
                ]),
            ],
            [
                'category_id' => 'Sport & Swim Apparel',
                'type' => 'Tenant',
                'name' => 'arena', //NEW
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1A-32'
                ]),
            ],
            [
                'category_id' => 'Fashion, Beauty & Accessories',
                'type' => 'Tenant',
                'name' => 'naughty', //NEW
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1A-33'
                ]),
            ],
            [
                'category_id' => 'Fashion, Beauty & Accessories',
                'type' => 'Tenant',
                'name' => 'hush puppies',
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1A-35'
                ]),
            ],
            [
                'category_id' => 'Fashion, Beauty & Accessories',
                'type' => 'Tenant',
                'name' => 'popits', //NEW
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1A-36'
                ]),
            ],
            [
                'category_id' => 'Fashion, Beauty & Accessories',
                'type' => 'Tenant',
                'name' => 'american tourister',
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1A-37'
                ]),
            ],
            [
                'category_id' => 'Fashion, Beauty & Accessories',
                'type' => 'Tenant',
                'name' => 'timberland', //NEW
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1A-38'
                ]),
            ],
            [
                'category_id' => 'Sport & Swim Apparel',
                'type' => 'Tenant',
                'name' => 'hoops',
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1A 39-40'
                ]),
            ],
            [
                'category_id' => 'Fashion, Beauty & Accessories',
                'type' => 'Tenant',
                'name' => 'polo', //NEW
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1A 41-42'
                ]),
            ],
            [
                'category_id' => 'Fashion, Beauty & Accessories',
                'type' => 'Tenant',
                'name' => 'camel active',
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1A-43'
                ]),
            ],
            [
                'category_id' => 'Anchor Tenant',
                'type' => 'Tenant',
                'name' => 'matahari', //NEW
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '-'
                ]),
            ],
            [
                'category_id' => 'Fashion, Beauty & Accessories',
                'type' => 'Tenant',
                'name' => 'intimo',
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1C-97'
                ]),
            ],
            [
                'category_id' => 'Fashion, Beauty & Accessories',
                'type' => 'Tenant',
                'name' => 'stroberi', //NEW
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1C-96'
                ]),
            ],
            [
                'category_id' => 'Fashion, Beauty & Accessories',
                'type' => 'Tenant',
                'name' => 'watchout!',
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1C-95'
                ]),
            ],
            [
                'category_id' => 'Fashion, Beauty & Accessories',
                'type' => 'Tenant',
                'name' => 'gosh',
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1C-93'
                ]),
            ],
            [
                'category_id' => 'Fashion, Beauty & Accessories',
                'type' => 'Tenant',
                'name' => 'wacoal', //NEW
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1C-92'
                ]),
            ],
            [
                'category_id' => 'Fashion, Beauty & Accessories',
                'type' => 'Tenant',
                'name' => 'everbest',
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1C-91'
                ]),
            ],
            [
                'category_id' => 'Fashion, Beauty & Accessories',
                'type' => 'Tenant',
                'name' => 'bata',
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1C 89-90'
                ]),
            ],
            [
                'category_id' => 'Fashion, Beauty & Accessories',
                'type' => 'Tenant',
                'name' => 'the perfume shop', //NEW
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1C-88'
                ]),
            ],
            [
                'category_id' => 'Fashion, Beauty & Accessories',
                'type' => 'Tenant',
                'name' => 'minimal', //NEW
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1C-87'
                ]),
            ],
            [
                'category_id' => 'Fashion, Beauty & Accessories',
                'type' => 'Tenant',
                'name' => 'bellagio',
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1C-86'
                ]),
            ],
            [
                'category_id' => 'Fashion, Beauty & Accessories',
                'type' => 'Tenant',
                'name' => 'mississipi', //NEW
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1C-85'
                ]),
            ],
            [
                'category_id' => 'Fashion, Beauty & Accessories',
                'type' => 'Tenant',
                'name' => "levi's",
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1C 82-82'
                ]),
            ],
            [
                'category_id' => 'Fashion, Beauty & Accessories',
                'type' => 'Tenant',
                'name' => 'giordano',
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1C 80-81'
                ]),
            ],
            [
                'category_id' => 'Fashion, Beauty & Accessories',
                'type' => 'Tenant',
                'name' => 'havaianas',
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1C-79'
                ]),
            ],
            [
                'category_id' => 'Fashion, Beauty & Accessories',
                'type' => 'Tenant',
                'name' => 'keds',
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1C-78'
                ]),
            ],
            [
                'category_id' => 'Fashion, Beauty & Accessories',
                'type' => 'Tenant',
                'name' => 'donini',
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1C-77'
                ]),
            ],
            [
                'category_id' => 'Fashion, Beauty & Accessories',
                'type' => 'Tenant',
                'name' => 'the body shop', //NEW
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1C-76'
                ]),
            ],
            [
                'category_id' => 'Sport & Swim Apparel',
                'type' => 'Tenant',
                'name' => 'puma', //NEW
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1C 73-75'
                ]),
            ],
            [
                'category_id' => 'Fashion, Beauty & Accessories',
                'type' => 'Tenant',
                'name' => "victoria's secret", //NEW
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1C-72a'
                ]),
            ],
            [
                'category_id' => 'Bookstore',
                'type' => 'Tenant',
                'name' => 'WHSmith', //NEW
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1C-72b'
                ]),
            ],
            [
                'category_id' => 'Fashion, Beauty & Accessories',
                'type' => 'Tenant',
                'name' => "this is april", //NEW
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1B-51'
                ]),
            ],
            [
                'category_id' => 'Household Goods & Furniture',
                'type' => 'Tenant',
                'name' => "vinoti living", //NEW
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1B-52'
                ]),
            ],
            [
                'category_id' => 'Household Goods & Furniture',
                'type' => 'Tenant',
                'name' => "miniso",
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1B-53'
                ]),
            ],
            [
                'category_id' => 'Island Counter',
                'type' => 'Island',
                'name' => "hello the healthy brew",
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '-'
                ]),
            ],
            [
                'category_id' => 'Island Counter',
                'type' => 'Island',
                'name' => "panlandwoo",
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '-'
                ]),
            ],
            [
                'category_id' => 'Island Counter',
                'type' => 'Island',
                'name' => "bananas",
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '-'
                ]),
            ],
            [
                'category_id' => 'Island Counter',
                'type' => 'Island',
                'name' => "balinata",
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '-'
                ]),
            ],
            [
                'category_id' => 'Island Counter',
                'type' => 'Island',
                'name' => "moncherie",
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '-'
                ]),
            ],
            [
                'category_id' => 'Island Counter',
                'type' => 'Island',
                'name' => "shake shake",
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '-'
                ]),
            ],
            [
                'category_id' => 'Island Counter',
                'type' => 'Island',
                'name' => "zuma",
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '-'
                ]),
            ],
            [
                'category_id' => 'Island Counter',
                'type' => 'Island',
                'name' => "captain burger",
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '-'
                ]),
            ],
            [
                'category_id' => 'Island Counter',
                'type' => 'Island',
                'name' => "kanini",
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '-'
                ]),
            ],
            [
                'category_id' => 'Island Counter',
                'type' => 'Island',
                'name' => "dear butter",
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '-'
                ]),
            ],
            [
                'category_id' => 'Island Counter',
                'type' => 'Island',
                'name' => "beard papa's",
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '-'
                ]),
            ],
            [
                'category_id' => 'Island Counter',
                'type' => 'Island',
                'name' => "sour sally",
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '-'
                ]),
            ],
            [
                'category_id' => 'Island Counter',
                'type' => 'Island',
                'name' => "chatime",
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '-'
                ]),
            ],
            [
                'category_id' => 'Island Counter',
                'type' => 'Island',
                'name' => "full hardy",
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '-'
                ]),
            ],
            [
                'category_id' => 'Island Counter',
                'type' => 'Island',
                'name' => "roti boy",
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '-'
                ]),
            ],
            [
                'category_id' => 'Island Counter',
                'type' => 'Island',
                'name' => "chikuro",
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '-'
                ]),
            ],
            [
                'category_id' => 'Island Counter',
                'type' => 'Island',
                'name' => "shihlin",
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '-'
                ]),
            ],
            [
                'category_id' => 'Island Counter',
                'type' => 'Island',
                'name' => "puyo",
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '-'
                ]),
            ],
            [
                'category_id' => 'Island Counter',
                'type' => 'Island',
                'name' => "somay little menteng",
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '-'
                ]),
            ],
            [
                'category_id' => 'Island Counter',
                'type' => 'Island',
                'name' => "montato",
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '-'
                ]),
            ],
            [
                'category_id' => 'Island Counter',
                'type' => 'Island',
                'name' => "charlie's",
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '-'
                ]),
            ],
            [
                'category_id' => 'Fashion, Beauty & Accessories',
                'type' => 'Tenant',
                'name' => "yves rocher", //NEW
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1B'
                ]),
            ],
            [
                'category_id' => 'Fashion, Beauty & Accessories',
                'type' => 'Tenant',
                'name' => "c & f perfumery",
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1B'
                ]),
            ],
            [
                'category_id' => 'Fashion, Beauty & Accessories',
                'type' => 'Tenant',
                'name' => "optik seis", //NEW
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1B-49'
                ]),
            ],
            [
                'category_id' => 'Food & Beverages',
                'type' => 'Tenant',
                'name' => "koi the",
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => 'K1'
                ]),
            ],
            [
                'category_id' => 'Fashion, Beauty & Accessories',
                'type' => 'Tenant',
                'name' => "parang kencana", //NEW
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1B-47'
                ]),
            ],
            [
                'category_id' => 'Food & Beverages',
                'type' => 'Tenant',
                'name' => "solaria", //NEW
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => 'V4 Galeria Resto'
                ]),
            ],
            [
                'category_id' => 'Food & Beverages',
                'type' => 'Tenant',
                'name' => "excelso",
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => 'V3 Galeria Resto'
                ]),
            ],
            [
                'category_id' => 'Food & Beverages',
                'type' => 'Tenant',
                'name' => "javabica",
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => 'V2 Galeria Resto'
                ]),
            ],
            [
                'category_id' => 'Food & Beverages',
                'type' => 'Tenant',
                'name' => "starbucks coffee", //NEW
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => 'V1 Galeria Resto'
                ]),
            ],
            [
                'category_id' => 'Food & Beverages',
                'type' => 'Tenant',
                'name' => "Ramen Ya!", //NEW
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => 'V1A Galeria Resto'
                ]),
            ],
            [
                'category_id' => 'Food & Beverages',
                'type' => 'Tenant',
                'name' => "tous les jours", //NEW
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1C 70-71'
                ]),
            ],
            [
                'category_id' => 'Food & Beverages',
                'type' => 'Tenant',
                'name' => "j.co",
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1C 68-69'
                ]),
            ],
            [
                'category_id' => 'Food & Beverages',
                'type' => 'Tenant',
                'name' => "pizza hut ristorante", //NEW
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1C 66-67'
                ]),
            ],
            [
                'category_id' => 'Food & Beverages',
                'type' => 'Tenant',
                'name' => "es teller 77",
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1C-65'
                ]),
            ],
            [
                'category_id' => 'Food & Beverages',
                'type' => 'Tenant',
                'name' => "marugame udon", //NEW
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1C 62-63'
                ]),
            ],
            [
                'category_id' => 'Food & Beverages',
                'type' => 'Tenant',
                'name' => "raa cha", //NEW
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1C 60-61'
                ]),
            ],
            [
                'category_id' => 'Food & Beverages',
                'type' => 'Tenant',
                'name' => "ichiban sushi",
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1C 58-59'
                ]),
            ],
            [
                'category_id' => 'Food & Beverages',
                'type' => 'Tenant',
                'name' => "ryoshi japanese restaurant", //NEW
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1C 55-57'
                ]),
            ],
            [
                'category_id' => 'Island Counter',
                'type' => 'Island',
                'name' => "dum dum",
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '-'
                ]),
            ],
            [
                'category_id' => 'Island Counter',
                'type' => 'Island',
                'name' => "herborist",
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '-'
                ]),
            ],
            [
                'category_id' => 'Food & Beverages',
                'type' => 'Tenant',
                'name' => "penyetan cok", //NEW
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1A 02a-02b'
                ]),
            ],
            [
                'category_id' => 'Food & Beverages',
                'type' => 'Tenant',
                'name' => "",
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1A'
                ]),
            ],
            [
                'category_id' => 'Food & Beverages',
                'type' => 'Tenant',
                'name' => "ramen1", //NEW
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1A 03-05'
                ]),
            ],
            [
                'category_id' => 'Food & Beverages',
                'type' => 'Tenant',
                'name' => "ta wan", //NEW
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1A 06-07'
                ]),
            ],
            [
                'category_id' => 'Food & Beverages',
                'type' => 'Tenant',
                'name' => "tik tok", //NEW
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1A #A'
                ]),
            ],
            [
                'category_id' => 'Food & Beverages',
                'type' => 'Tenant',
                'name' => "baso afung",
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1A-08'
                ]),
            ],
            [
                'category_id' => 'Food & Beverages',
                'type' => 'Tenant',
                'name' => "MM juice", //NEW
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1A 09-10'
                ]),
            ],
            [
                'category_id' => 'Food & Beverages',
                'type' => 'Tenant',
                'name' => "pandan kuring",
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1A 11-12'
                ]),
            ],
            [
                'category_id' => 'Island Counter',
                'type' => 'Island',
                'name' => "dedari kuliner",
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '-'
                ]),
            ],
            [
                'category_id' => 'Island Counter',
                'type' => 'Island',
                'name' => "relx",
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '-'
                ]),
            ],
            [
                'category_id' => 'Island Counter',
                'type' => 'Island',
                'name' => "london taxi bike",
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '-'
                ]),
            ],
            [
                'category_id' => 'Fashion, Beauty & Accessories',
                'type' => 'Tenant',
                'name' => "wakai", //NEW
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1B-48'
                ]),
            ],
            [
                'category_id' => 'Fashion, Beauty & Accessories',
                'type' => 'Tenant',
                'name' => "fossil",
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1B-50'
                ]),
            ],
            [
                'category_id' => 'Anchor Tenant',
                'type' => 'Tenant',
                'name' => "nike", //NEW
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '-'
                ]),
            ],
            [
                'category_id' => 'Anchor Tenant',
                'type' => 'Tenant',
                'name' => "h&m",
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '-'
                ]),
            ],
            [
                'category_id' => 'Anchor Tenant',
                'type' => 'Tenant',
                'name' => "XXI", //NEW
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '-'
                ]),
            ],
            [
                'category_id' => 'Anchor Tenant',
                'type' => 'Tenant',
                'name' => "azko",
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '-'
                ]),
            ],
            [
                'category_id' => 'Sport & Swim Apparel',
                'type' => 'Tenant',
                'name' => "asics",
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1E-08'
                ]),
            ],
            [
                'category_id' => 'Sport & Swim Apparel',
                'type' => 'Tenant',
                'name' => "new balance", //NEW
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1E-07'
                ]),
            ],
            [
                'category_id' => 'Fashion, Beauty & Accessories',
                'type' => 'Tenant',
                'name' => "flying tiger",
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1E-06'
                ]),
            ],
            [
                'category_id' => 'IT, Games & Gadgets',
                'type' => 'Tenant',
                'name' => "digimap",
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1E-05'
                ]),
            ],
            [
                'category_id' => 'Fashion, Beauty & Accessories',
                'type' => 'Tenant',
                'name' => "kipling",
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1E-03b'
                ]),
            ],
            [
                'category_id' => 'Fashion, Beauty & Accessories',
                'type' => 'Tenant',
                'name' => "pandora", //NEW
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1E-03a'
                ]),
            ],
            [
                'category_id' => 'Fashion, Beauty & Accessories',
                'type' => 'Tenant',
                'name' => "saturdays", //NEW
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => 'CL Ext. 01'
                ]),
            ],
            [
                'category_id' => 'Fashion, Beauty & Accessories',
                'type' => 'Tenant',
                'name' => "owndays", //NEW
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => 'CL Ext. 01'
                ]),
            ],
            [
                'category_id' => 'Fashion, Beauty & Accessories',
                'type' => 'Tenant',
                'name' => "sociolla", //NEW
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1E-01a'
                ]),
            ],
            [
                'category_id' => 'Fashion, Beauty & Accessories',
                'type' => 'Tenant',
                'name' => "amaris",
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1F-15'
                ]),
            ],
            [
                'category_id' => 'Fashion, Beauty & Accessories',
                'type' => 'Tenant',
                'name' => "charles & keith",
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1F-16'
                ]),
            ],
            [
                'category_id' => 'Fashion, Beauty & Accessories',
                'type' => 'Tenant',
                'name' => "the athlete's foot", //NEW
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1F-17'
                ]),
            ],
            [
                'category_id' => 'Anchor Tenant',
                'type' => 'Tenant',
                'name' => "sport direct",
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '-'
                ]),
            ],
            [
                'category_id' => 'Sport & Swim Apparel',
                'type' => 'Tenant',
                'name' => "hoka",
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1F-02'
                ]),
            ],
            [
                'category_id' => 'Fashion, Beauty & Accessories',
                'type' => 'Tenant',
                'name' => "aldo",
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1F-03a'
                ]),
            ],
            [
                'category_id' => 'Fashion, Beauty & Accessories',
                'type' => 'Tenant',
                'name' => "tommy hillfiger",
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1F-05b'
                ]),
            ],
            [
                'category_id' => 'Sport & Swim Apparel',
                'type' => 'Tenant',
                'name' => "adidas",
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1F-06'
                ]),
            ],
            [
                'category_id' => 'Fashion, Beauty & Accessories',
                'type' => 'Tenant',
                'name' => "lacoste",
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1F-07a'
                ]),
            ],
            [
                'category_id' => 'Fashion, Beauty & Accessories',
                'type' => 'Tenant',
                'name' => "calvin klein",
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1F-07b'
                ]),
            ],
            [
                'category_id' => 'Fashion, Beauty & Accessories',
                'type' => 'Tenant',
                'name' => "marks & spencer",
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1F 08-09'
                ]),
            ],
            [
                'category_id' => 'Fashion, Beauty & Accessories',
                'type' => 'Tenant',
                'name' => "cotton on",
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1F-10'
                ]),
            ],
            [
                'category_id' => 'Fashion, Beauty & Accessories',
                'type' => 'Tenant',
                'name' => "project soul", //NEW
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1F-11'
                ]),
            ],
            [
                'category_id' => 'Fashion, Beauty & Accessories',
                'type' => 'Tenant',
                'name' => "frank & co",
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1F-12'
                ]),
            ],
            [
                'category_id' => 'Fashion, Beauty & Accessories',
                'type' => 'Tenant',
                'name' => "sensatia", //NEW
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1F-22'
                ]),
            ],
            [
                'category_id' => 'Food & Beverages',
                'type' => 'Tenant',
                'name' => "sate khas senayan",
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => '1E-02'
                ]),
            ],
            [
                'category_id' => 'Island Counter',
                'type' => 'Island',
                'name' => "crusita",
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => 'Cl Ext-01'
                ]),
            ],
            [
                'category_id' => 'Island Counter',
                'type' => 'Island',
                'name' => "secret garden",
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => 'Cl Ext-02'
                ]),
            ],
            [
                'category_id' => 'Island Counter',
                'type' => 'Island',
                'name' => "nespresso",
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => 'Cl Ext-03'
                ]),
            ],
            [
                'category_id' => 'Island Counter',
                'type' => 'Island',
                'name' => "shark ninja", //NEW
                'map_coords' => json_encode([
                    'floor' => '1',
                    'unit' => 'Cl Ext-01'
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
