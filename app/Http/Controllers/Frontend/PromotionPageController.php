<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Services\CategoryService;
use App\Services\PromoService;
use Illuminate\Http\Request;

class PromotionPageController extends Controller
{
    protected $categoryService, $promoService;

    public function __construct(CategoryService $categoryService, PromoService $promoService)
    {
        $this->categoryService = $categoryService;
        $this->promoService = $promoService;
    }

    public function index()
    {
        $categories = $this->categoryService->getAll(['id', 'name']);

        return view('frontend.promotion.index', compact('categories'));
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
                'tenantLogo' => asset('storage/' . $data->tenant->logo),
                'category' => $data->tenant->category->name,
                'floor' => $data->tenant['map_coords']['floor'] == 1 ? $data->tenant['map_coords']['floor'] . 'st Floor' : $data->tenant['map_coords']['floor'] . 'nd Floor',
                'unit' => $data->tenant->map_coords['unit'],
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
