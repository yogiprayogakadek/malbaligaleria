<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Services\CategoryService;
use App\Services\PromoService;
use App\Services\SettingService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PromotionPageController extends Controller
{
    protected $categoryService, $promoService, $settingService;

    public function __construct(CategoryService $categoryService, PromoService $promoService, SettingService $settingService)
    {
        $this->categoryService = $categoryService;
        $this->promoService = $promoService;
        $this->settingService = $settingService;
    }

    public function index()
    {
        $setting = $this->settingService->getByPage('promo', ['payload']);
        $categories = $this->categoryService->getAll(['id', 'name']);

        return view('frontend.promotion.index', compact('categories', 'setting'));
    }

    public function loadPromotion()
    {
        $promos = $this->promoService->getPromoWithRelationship(
            ['id', 'name', 'banner', 'tenant_id', 'description', 'start_date', 'end_date', 'created_at'],
            [
                'tenant:id,name,logo,category_id,map_coords',
                'tenant.category:id,name',
            ]
        )->map(function ($data) {
            return [
                'id' => $data->id,
                'title' => $data->name,
                'tenant' => $data->tenant->name,
                'tenantLogo' => (Storage::disk('public')->exists($data->tenant->logo)) ? asset('storage/' . $data->tenant->logo) : asset($data->tenant->logo),
                'category' => $data->tenant->category->name,
                'floor' => ($data->tenant->map_coords['floor'] == 1 || $data->tenant->map_coords['floor'] == 'floor1') ? '1st Floor' : '2nd Floor',
                'unit' => $data->tenant->map_coords['unit'] ?? '-',
                'validFrom' => $data->start_date,
                'validUntil' => $data->end_date,
                'createdAt' => $data->created_at,
                'description' => $data->description,
                'images' => [
                    asset('storage/' . $data->banner)
                ]
            ];
        });

        return response()->json($promos);
    }
}
