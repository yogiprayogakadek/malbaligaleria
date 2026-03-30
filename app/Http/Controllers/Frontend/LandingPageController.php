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
        )->sortBy('name');

        $events = $this->eventService->getEventsWithRelationship(
            ['id', 'uuid', 'name', 'type', 'start_date', 'end_date', 'description', 'highlights', 'start_time', 'end_time'],
            [
                'primaryPhoto:id,path,caption,event_id,is_primary'
            ]
        );

        $regularEvents = $this->eventService->getRegularEvents(
            ['id', 'uuid', 'name', 'type', 'description', 'recurring_label', 'start_time', 'end_time', 'location', 'highlights', 'start_date', 'end_date'],
            [
                'primaryPhoto:id,path,caption,event_id,is_primary'
            ]
        );

        $exhibitionEvents = $this->eventService->getExhibitionEvents(
            ['id', 'uuid', 'name', 'type', 'start_date', 'end_date', 'description', 'location', 'highlights', 'start_time', 'end_time'],
            [
                'primaryPhoto:id,path,caption,event_id,is_primary'
            ]
        );
        // dd($exhibitionEvents);

        return view('landing_v2', compact('tenants', 'events', 'regularEvents', 'exhibitionEvents'));
    }

    public function tenantData($cat = "new store", $isNew)
    {
        $tenants = $this->tenantService->getDataByFloor(
            ['id', 'name', 'map_coords', 'category_id', 'logo', 'isNew'],
            [
                'category:id,name',
                'primaryPhoto:id,path,caption,tenant_id'
            ],
            $cat,
            filter_var($isNew, FILTER_VALIDATE_BOOLEAN)
        );

        return response()->json($tenants->sortBy('name')->values());
    }

    public function findTenantById($tenant_id)
    {
        $tenant = $this->tenantService->getTenantsWithRelationshipAndCondition(
            ['id', 'name', 'map_coords', 'map_original_size', 'category_id', 'logo', 'description'],
            [
                'category:id,name',
                'albumPhoto:id,tenant_id,path',
                'primaryPhoto:id,tenant_id,path',
            ],
            'id',
            $tenant_id
        )->map(function ($data) {
            $logoUrl = !empty($data->logo)
                ? (str_starts_with($data->logo, 'assets')
                    ? asset($data->logo)
                    : asset('storage/' . $data->logo)
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
                'name' => $data->name,
                'category' => $data->category->name,
                'floor' => $data->map_coords['floor'] == 1 ? '1st Floor' : '2nd Floor',
                'floor_id' => $data->map_coords['floor'],
                'unit' => $data->map_coords['unit'] ?? '-',
                'x' => $data->map_coords['x'] ?? null,
                'y' => $data->map_coords['y'] ?? null,
                'map_coords' => $data->map_coords,
                'map_original_size' => $data->map_original_size,
                'logo' => $logoUrl,
                'hours' => "10:00 AM - 10:00 PM",
                'description' => $data->description,
                'images' => !empty($photos) ? $photos : [$logoUrl],
                'has_album' => !empty($photos),
            ];
        });

        return response()->json($tenant[0]);
    }

    public function findEventByUuid($uuid)
    {
        $event = $this->eventService->getEventsWithRelationshipAndCondition(
            ['id', 'uuid', 'name', 'type', 'start_date', 'end_date', 'start_time', 'end_time', 'description', 'location', 'recurring_label', 'highlights'],
            [
                'primaryPhoto:id,event_id,path',
                'photos:id,event_id,path',
            ],
            'uuid',
            $uuid
        )->map(function ($data) {
            $photos = collect()
                ->when(
                    filled($data->primaryPhoto?->path),
                    fn($c) => $c->push(\Illuminate\Support\Facades\Storage::url($data->primaryPhoto->path))
                )
                ->concat(
                    collect($data->photos ?? [])
                        ->filter(fn($photo) => filled($photo->path))
                        ->map(fn($photo) => \Illuminate\Support\Facades\Storage::url($photo->path))
                )
                ->filter()
                ->unique()
                ->values()
                ->all();

            $dateStr = '';
            if ($data->type === 'regular') {
                $dateStr = $data->recurring_label ?: 'Every Weekend';
            } else {
                if ($data->start_date) {
                    $dateStr = date('d M Y', strtotime($data->start_date));
                    if ($data->end_date && $data->start_date != $data->end_date) {
                        $dateStr = date('d M', strtotime($data->start_date)) . ' - ' . date('d M Y', strtotime($data->end_date));
                    }
                } else {
                    $dateStr = $data->recurring_label ?: 'All Day';
                }
            }

            $typeLabels = [
                'regular'    => 'Regular Show',
                'special'    => 'Special Event',
                'exhibition' => 'Exhibition',
                'upcoming'   => 'Upcoming Event',
            ];

            return [
                'name' => $data->name,
                'uuid' => $data->uuid,
                'date' => $dateStr,
                'location' => $data->location ?: 'Mal Bali Galeria',
                'description' => $data->description,
                'highlights' => $data->highlights ?: '-',
                'start_time' => $data->start_time,
                'end_time' => $data->end_time,
                'images' => !empty($photos) ? $photos : [asset('assets/images/no_image.jpg')],
                'type' => $typeLabels[$data->type] ?? 'Event',
            ];
        });

        if ($event->isEmpty()) {
            return response()->json(['error' => 'Event not found'], 404);
        }

        return response()->json($event[0]);
    }
}
