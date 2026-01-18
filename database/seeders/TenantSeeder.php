<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Tenant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TenantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tenants = [
            "adidas",
            "advance",
            "aldo",
            "amaris",
            "american tourister",
            "aora jewellry",
            "arena",
            "asics",
            "azko",
            "bag's city",
            "bali ice skating",
            "bamboo blonde",
            "baso afung",
            "bata",
            "bath & body works",
            "batik keris",
            "bellagio",
            "birkenstock",
            "bose",
            "by aura",
            "c & f perfumery",
            "calvin klein",
            "camel active",
            "celcius",
            "charles & keith",
            "chatime",
            "chikuro",
            "christopher salon",
            "cimb niaga",
            "color box",
            "cotton on",
            "crocs",
            "digimap",
            "digiplus",
            "donini",
            "doran gadget",
            "dr. specs",
            "erafone",
            "es teller 77",
            "everbest",
            "excelso",
            "expert",
            "fit flop",
            "flying tiger",
            "foot locker",
            "fossil",
            "frank & co",
            "funni fun",
            "giordano",
            "gosh",
            "gramedia",
            "gs shop",
            "jbl store",
            "hair creator",
            "guardian pharmacy",
            "h&m",
            "hyang togol",
            "hypermart",
            "gong cha",
            "guess",
            "hush puppies",
            "huawei",
            "j.co",
            "johnny andrean",
            "javabica",
            "hoka",
            "josh coffee",
            "hoops",
            "ic centre bali",
            "ichiban sushi",
            "intimo",
            "havaianas",
            "kidz station",
            "miniso",
            "king koil",
            "l'occitane",
            "koi the",
            "keds",
            "king rabbit",
            "levi's",
            "kipling",
            "lady americana",
            "lacoste",
            "loly poly"
        ];

        $islands = [
            "balinata",
            "bananas",
            "beard papa's",
            "captain burger",
            "charlie's",
            "churros",
            "clean and care",
            "crusita",
            "dear butter",
            "dedari kuliner",
            "drink me",
            "dum dum",
            "full hardy",
            "gacha corner",
            "gino mariani",
            "gita gemilang",
            "gnc",
            "hello the healthy brew",
            "herborist",
            "homcha",
            "iqos",
            "kanini",
            "kcmtku",
            "london bus",
            "london taxi bike",
            "lucky cheese",
            "marquisa",
            "moncherie",
            "montato",
            "motor train",
            "nespresso",
            "oni ola",
            "orlenalycious",
            "panlandwoo",
            "perfect health",
            "perfect relax",
            "phoooto.id",
            "photoinc",
            "playworks",
            "puyo",
            "relx",
            "roti boy",
            "roti o",
            "secret garden",
            "shake shake",
            "shihlin",
            "smolton",
            "somay little menteng",
            "sour sally",
            "thai inc",
            "tomomi",
            "wangsa gelato",
            "watch studio",
            "zuma"
        ];

        $data = [];
        $categoriesId = Category::pluck('id')->toArray();

        foreach ($tenants as $key => $value) {
            $data[] = [
                'uuid' => (string) Str::uuid(),
                'name' => mb_convert_case($value, MB_CASE_TITLE, 'UTF-8'),
                'category_id' => $categoriesId[array_rand($categoriesId)],
                'type' => 'tenant',
                'isNew' => rand(0, 1),
                'map_coords' => json_encode([
                    'floor' => rand(1, 2),
                ]),
                'logo' => 'assets/images/tenant_logo/' . $value . '.png',
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        foreach ($islands as $key => $value) {
            $data[] = [
                'uuid' => (string) Str::uuid(),
                'name' => mb_convert_case($value, MB_CASE_TITLE, 'UTF-8'),
                'category_id' => $categoriesId[array_rand($categoriesId)],
                'type' => 'island',
                'isNew' => rand(0, 1),
                'map_coords' => json_encode([
                    'floor' => rand(1, 2),
                ]),
                'logo' => 'assets/images/tenant_logo/' . $value . '.png',
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        Tenant::insert($data);
    }
}
