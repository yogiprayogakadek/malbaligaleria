<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Services\CategoryService;
use App\Services\TenantService;
use Illuminate\Http\Request;

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
        return view('frontend.directory.index');
    }

    public function getCategoryTenant()
    {
        $categories = $this->categoryService->getAll(['id', 'name']);

        return response()->json($categories);
    }

    public function getTenants()
    {
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
            return [
                'name' => $data['name'],
                'category' => $data['category']['name'],
                'floor' => $data['map_coords']['floor'] == 1 ? '1st Floor' : '2nd Floor',
                'unit' => $data['map_coords']['unit'],
                'logo' => asset('storage/' . $data['logo']),
                'hours' => "10:00 AM - 10:00 PM",
                'description' => $data['description'],
                'mapCoords' => [
                    'x' => $data['map_coords']['x'],
                    'y' => $data['map_coords']['y'],
                ],
                'mapOriginalSize' => [
                    'width' => $data['map_original_size']['width'] ?? ($data['map_coords']['floor'] == 1 ? 1216 : 1024),
                    'height' => $data['map_original_size']['height'] ?? ($data['map_coords']['floor'] == 1 ? 880 : 1024),
                ],
                'images' => collect([asset('storage/' . $data->primaryPhoto->path)])->concat(
                    $data->albumPhoto->map(function ($photo) {
                        return asset('storage/' . $photo->path);
                    })
                )->all(),
            ];
        });

        return response()->json($tenants);
    }
}
