<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Services\EventService;
use App\Services\TenantService;
use Illuminate\Http\Request;

use function PHPSTORM_META\map;

class LandingPageController extends Controller
{

    protected $tenantService, $eventService;

    public function __construct(TenantService $tenantService, EventService $eventService)
    {
        $this->tenantService = $tenantService;
        $this->eventService = $eventService;
    }

    public function index()
    {
        $tenants = $this->tenantService->getTenantsWithRelationship(
            ['id', 'name', 'map_coords', 'category_id'],
            [
                'category:id,name',
                'primaryPhoto:id,path,caption,tenant_id,is_primary'
            ]
        );

        $events = $this->eventService->getEventsWithRelationship(
            ['id', 'uuid', 'name', 'start_date', 'description'],
            [
                'primaryPhoto:id,path,caption,event_id,is_primary'
            ]
        );

        return view('landing_v2', compact('tenants', 'events'));
    }

    public function tenantData($cat = "new store", $isNew)
    {
        $tenants = $this->tenantService->getDataByFloor(
            ['id', 'name', 'map_coords', 'category_id', 'logo', 'isNew'],
            [
                'category:id,name',
                'albumPhoto:id,path,caption,tenant_id'
            ],
            $cat,
            filter_var($isNew, FILTER_VALIDATE_BOOLEAN)
        );

        return response()->json($tenants);
    }

    public function findTenantById($tenant_id)
    {
        // $tenant = $this->tenantService->getTenantsWithRelationshipAndCondition(
        //     ['id', 'name', 'map_coords', 'category_id', 'logo', 'description'],
        //     [
        //         'category:id,name',
        //         'primaryPhoto:id,path,caption,tenant_id',
        //         'albumPhoto:id,tenant_id,path,caption'
        //     ],
        //     'id',
        //     $tenant_id
        // )->map(function ($t) {
        //     return [
        //         'name' => $t['name'],
        //         'floor' => $t['map_coords']['floor'] == 1 ? $t['map_coords']['floor'] . 'st Floor' : $t['map_coords']['floor'] . 'nd Floor',
        //         'category' => $t['category']['name'],
        //         'unit' => $t['map_coords']['unit'] ?? '-',
        //         'hours' => "10:00 AM - 10:00 PM",
        //         'logo' => !empty($t['logo'])
        //             ? (str_starts_with($t['logo'], 'assets')
        //                 ? asset($t['logo'])
        //                 : asset('storage/' . $t['logo'])
        //             )
        //             : asset('assets/images/no_image.jpg'),
        //         'description' => $t['description'],
        //         'album' => collect()
        //             ->when($t->primaryPhoto, function ($c) use ($t) {
        //                 $c->push(asset('storage/' . $t->primaryPhoto->path));
        //             })
        //             ->concat(
        //                 $t->albumPhoto->map(fn($photo) => asset('storage/' . $photo->path))
        //             )
        //             ->unique()
        //             ->values()
        //             ->all(),
        //     ];
        // });

        $tenant = $this->tenantService->getTenantsWithRelationshipAndCondition(
            ['id', 'name', 'map_coords', 'category_id', 'logo', 'description'],
            [
                'category:id,name',
            ],
            'id',
            $tenant_id
        )->map(function ($t) {

            $logoUrl = !empty($t['logo'])
                ? (str_starts_with($t['logo'], 'assets')
                    ? asset($t['logo'])
                    : asset('storage/' . $t['logo'])
                )
                : asset('assets/images/no_image.jpg');

            return [
                'name' => $t['name'],
                'floor' => $t['map_coords']['floor'] == 1
                    ? $t['map_coords']['floor'] . 'st Floor'
                    : $t['map_coords']['floor'] . 'nd Floor',
                'category' => $t['category']['name'],
                'unit' => $t['map_coords']['unit'] ?? '-',
                'hours' => "10:00 AM - 10:00 PM",
                'logo' => $logoUrl,
                'description' => $t['description'],
                'album' => [$logoUrl],
            ];
        });


        return response()->json($tenant[0]);
    }
}
