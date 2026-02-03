<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Services\CategoryService;
use App\Services\TenantService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DirectoryController extends Controller
{
    protected $categoryService, $tenantService;

    public function __construct(CategoryService $categoryService, TenantService $tenantService)
    {
        $this->categoryService = $categoryService;
        $this->tenantService = $tenantService;
    }

    public function index()
    {
        $categories = $this->categoryService->getAll(['id', 'name', 'color_zone']);

        return view('frontend.directory.index', compact('categories'));
    }

    public function getCategoryTenant()
    {
        $categories = $this->categoryService->getAll(['id', 'name']);

        return response()->json($categories);
    }

    public function getTenants()
    {
        // $tenants = $this->tenantService->getTenantsWithRelationshipAndCondition(
        //     ['id', 'name', 'category_id', 'map_coords', 'logo', 'description'],
        //     [
        //         'category:id,name',
        //         'albumPhoto:id,tenant_id,path',
        //         'primaryPhoto:id,tenant_id,path',
        //     ],
        //     'is_active',
        //     true
        // )->map(function ($data) {
        //     return [
        //         'name' => $data['name'],
        //         'category' => $data['category']['name'],
        //         'floor' => $data['map_coords']['floor'] == 1 ? '1st Floor' : '2nd Floor',
        //         'unit' => $data['map_coords']['unit'] ?? '-',
        //         'logo' => !empty($data['logo'])
        //             ? (str_starts_with($data['logo'], 'assets')
        //                 ? asset($data['logo'])
        //                 : asset('storage/' . $data['logo'])
        //             )
        //             : asset('assets/images/no_image.jpg'),
        //         'hours' => "10:00 AM - 10:00 PM",
        //         'description' => $data['description'],
        //         'mapCoords' => [
        //             'x' => $data['map_coords']['x'] ?? '-',
        //             'y' => $data['map_coords']['y'] ?? '-',
        //         ],
        //         'mapOriginalSize' => [
        //             'width' => $data['map_original_size']['width'] ?? ($data['map_coords']['floor'] == 1 ? 1216 : 1024),
        //             'height' => $data['map_original_size']['height'] ?? ($data['map_coords']['floor'] == 1 ? 880 : 1024),
        //         ],
        //         'images' => collect()
        //             ->when(
        //                 filled($data->primaryPhoto?->path),
        //                 fn($c) => $c->push(Storage::url($data->primaryPhoto->path))
        //             )
        //             ->concat(
        //                 collect($data->albumPhoto ?? [])
        //                     ->filter(fn($photo) => filled($photo->path))
        //                     ->map(fn($photo) => Storage::url($photo->path))
        //             )
        //             ->values()
        //             ->all(),
        //     ];
        // });

        $tenants = $this->tenantService->getTenantsWithRelationshipAndCondition(
            ['id', 'name', 'category_id', 'map_coords', 'logo', 'description'],
            [
                'category:id,name',
                'albumPhoto:id,tenant_id,path',
                'primaryPhoto:id,tenant_id,path',
            ],
            'is_active',
            true
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
                    fn($c) => $c->push(Storage::url($data->primaryPhoto->path))
                )
                ->concat(
                    collect($data->albumPhoto ?? [])
                        ->filter(fn($photo) => filled($photo->path))
                        ->map(fn($photo) => Storage::url($photo->path))
                )
                ->filter()
                ->unique()
                ->values()
                ->all();

            $tenantData = [
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

            $hasValidCoords = isset($data['map_coords']['x']) && 
                            isset($data['map_coords']['y']) &&
                            is_numeric($data['map_coords']['x']) && 
                            is_numeric($data['map_coords']['y']);

            if ($hasValidCoords) {
                $tenantData['mapCoords'] = [
                    'x' => (float) $data['map_coords']['x'],
                    'y' => (float) $data['map_coords']['y'],
                ];

                $tenantData['mapOriginalSize'] = [
                    'width' => $data['map_original_size']['width']
                        ?? ($data['map_coords']['floor'] == 1 ? 2084 : 2130),
                    'height' => $data['map_original_size']['height']
                        ?? ($data['map_coords']['floor'] == 1 ? 4788 : 4728),
                ];
            }

            return $tenantData;
        });
        // dd($tenants);

        return response()->json($tenants);
    }
}
