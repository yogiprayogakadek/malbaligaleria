<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTenantRequest;
use App\Http\Requests\UpdateTenantRequest;
use App\Services\CategoryService;
use App\Services\TenantService;
use Illuminate\Http\Request;

class TenantController extends Controller
{
    protected $tenantService, $categoryService;

    public function __construct(TenantService $tenantService, CategoryService $categoryService)
    {
        $this->tenantService = $tenantService;
        $this->categoryService = $categoryService;
    }

    public function index()
    {
        $tenants = $this->tenantService->getTenantsByStatus(['uuid', 'name', 'phone', 'is_active', 'map_coords'], true);
        return view('backend.admin.tenant.index', compact('tenants'));
    }

    public function create()
    {
        $categories = $this->categoryService->getCategoriesByStatus(['id', 'name'], true);
        return view('backend.admin.tenant.create', compact('categories'));
    }

    public function store(StoreTenantRequest $request)
    {
        // dd($request->all());
        $data = [
            'category_id' => $request->category_id,
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'website' => $request->website,
            'logo' => $request->logo,
            'description' => $request->description,
            'map_coords' => [
                'x' => $request->position_x,
                'y' => $request->position_y,
                'floor' => $request->floor,
                'unit' => $request->unit,
            ]
        ];

        $this->tenantService->create($data);

        return redirect()->route('admin.tenant.index')->with('success', 'Tenant saved successfully.');
    }

    public function edit($uuid)
    {
        $categories = $this->categoryService->getCategoriesByStatus(['id', 'name'], true);
        $tenant = $this->tenantService->findByUuid($uuid);
        return view('backend.admin.tenant.edit', compact('tenant', 'categories'));
    }

    public function update(UpdateTenantRequest $request, $uuid)
    {
        $data = [
            'category_id' => $request->category_id,
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'website' => $request->website,
            'description' => $request->description,
            'map_coords' => [
                'x' => $request->position_x,
                'y' => $request->position_y,
                'floor' => $request->floor,
                'unit' => $request->unit,
            ]
        ];

        if ($request->logo != '') {
            $data['logo'] = $request->logo;
        }

        $this->tenantService->update($data, $uuid);

        return redirect()->route('admin.tenant.index')->with('success', 'Tenant updated successfully.');
    }
}
