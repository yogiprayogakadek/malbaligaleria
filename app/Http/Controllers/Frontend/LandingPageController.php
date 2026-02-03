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
                'albumPhoto:id,path,caption,tenant_id',
                'primaryPhoto:id,path,caption,tenant_id'
            ],
            $cat,
            filter_var($isNew, FILTER_VALIDATE_BOOLEAN)
        );

        return response()->json($tenants);
    }

    public function findTenantById($tenant_id)
    {
        $tenant = $this->tenantService->getTenantsWithRelationshipAndCondition(
            ['id', 'name', 'map_coords', 'category_id', 'logo', 'description'],
            [
                'category:id,name',
                'albumPhoto:id,tenant_id,path',
                'primaryPhoto:id,tenant_id,path',
            ],
            'id',
            $tenant_id
        )->map(function ($data) {
            $logoUrl = !empty($data['logo'])
                ? (str_starts_with($data['logo'], 'assets')
                    ? asset($data['logo'])
                    : asset('storage/' . $data['logo'])
                )
                : asset('assets/images/no_image.jpg');

            $photos = collect()
                ->when(
                    filled($data->primaryPhoto?->path),
                    fn($c) => $c->push(\Illuminate\Support\Facades\Storage::url($data->primaryPhoto->path))
                )
                ->concat(
                    collect($data->albumPhoto ?? [])
                        ->filter(fn($photo) => filled($photo->path))
                        ->map(fn($photo) => \Illuminate\Support\Facades\Storage::url($photo->path))
                )
                ->filter()
                ->unique()
                ->values()
                ->all();

            return [
                'name' => $data['name'],
                'category' => $data['category']['name'],
                'floor' => $data['map_coords']['floor'] == 1 ? '1st Floor' : '2nd Floor',
                'unit' => $data['map_coords']['unit'] ?? '-',
                'logo' => $logoUrl,
                'hours' => "10:00 AM - 10:00 PM",
                'description' => $data['description'],
                'images' => !empty($photos) ? $photos : [$logoUrl],
                'has_album' => !empty($photos),
            ];
        });

        return response()->json($tenant[0]);
    }
}
