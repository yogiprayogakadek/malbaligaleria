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
            ['id', 'name', 'start_date', 'description'],
            [
                'primaryPhoto:id,path,caption,event_id,is_primary'
            ]
        );

        return view('landing', compact('tenants', 'events'));
    }

    public function tenantData($cat = "new store")
    {
        $tenants = $this->tenantService->getDataByFloor(
            ['id', 'name', 'map_coords', 'category_id', 'logo'],
            [
                'category:id,name',
                'albumPhoto:id,path,caption,tenant_id'
            ],
            $cat
        );

        // dd($tenants);

        return response()->json($tenants);
    }

    public function findTenantById($tenant_id)
    {
        $tenant = $this->tenantService->getTenantsWithRelationshipAndCondition(
            ['id', 'name', 'map_coords', 'category_id', 'logo', 'description'],
            [
                'category:id,name',
                'primaryPhoto:id,path,caption,tenant_id',
                'albumPhoto:id,tenant_id,path,caption'
            ],
            'id',
            $tenant_id
        )->map(function ($t) {
            return [
                'name' => $t['name'],
                'floor' => $t['map_coords']['floor'] == 1 ? $t['map_coords']['floor'] . 'st Floor' : $t['map_coords']['floor'] . 'nd Floor',
                'category' => $t['category']['name'],
                'unit' => $t['map_coords']['unit'],
                'hours' => "10:00 AM - 10:00 PM",
                'logo' => asset('storage/' . $t['logo']),
                'description' => $t['description'],
                'album' => collect([asset('storage/' . $t->primaryPhoto->path)])->concat(
                    $t->albumPhoto->map(function ($photo) {
                        return asset('storage/' . $photo->path);
                    })
                )->all(),
            ];
        });

        return response()->json($tenant[0]);
    }
}
