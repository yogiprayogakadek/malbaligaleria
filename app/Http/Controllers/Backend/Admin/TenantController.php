<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTenantRequest;
use App\Http\Requests\UpdateTenantRequest;
use App\Services\CategoryService;
use App\Services\TenantService;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class TenantController extends Controller
{
    protected $tenantService, $categoryService;

    public function __construct(TenantService $tenantService, CategoryService $categoryService)
    {
        $this->tenantService = $tenantService;
        $this->categoryService = $categoryService;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $tenants = $this->tenantService->getAll(
                ['id', 'uuid', 'name', 'phone', 'is_active', 'map_coords', 'launched_at', 'category_id', 'type'],
            );

            return DataTables::of($tenants)
                ->addIndexColumn()
                ->addColumn('category', function ($row) {
                    if (!$row->category->is_active) {
                        return '<div class="d-flex align-items-center">
                                    <span class="text-muted me-2">' . $row->category->name . '</span>
                                    <span class="badge bg-danger-subtle text-danger" style="font-size: 0.75em">Inactive</span>
                                </div>';
                    }
                    return $row->category->name;
                })
                ->addColumn('type', function ($row) {
                    return ucfirst($row->type);
                })
                ->editColumn('is_active', function ($row) {
                    return $row->is_active == true
                        ? '<span class="badge bg-primary">Active</span>'
                        : '<span class="badge bg-danger">Inactive</span>';
                })
                ->addColumn('map_coords', function ($row) {
                    $floor = $row->map_coords?->floor ?? null;

                    return $floor
                        ? ($floor === 1 ? "{$floor}st Floor" : "{$floor}nd Floor")
                        : '-';
                })
                ->addColumn('action', function ($row) {
                    return '<a href="' . route('admin.tenant.edit', $row->uuid) . '">
                        <button type="button"
                            class="justify-content-center w-80 btn mb-1 bg-primary-subtle text-primary">
                            <i class="ti ti-pencil fs-4 me-2"></i>
                            Edit
                        </button>
                    </a>';
                })
                ->rawColumns(['action', 'is_active', 'category'])
                ->make(true);
        }
        return view('backend.admin.tenant.index');
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
            'type' => $request->type,
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
            ],
            'launched_at' => $request->launched_at,
            'isNew' => $request->is_new ?? false,
            'map_original_size' => [
                'width' => $request->map_original_width,
                'height' => $request->map_original_height,
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
            'type' => $request->type,
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
            ],
            'launched_at' => $request->launched_at,
            'isNew' => $request->is_new ?? false,
            'map_original_size' => [
                'width' => $request->map_original_width,
                'height' => $request->map_original_height,
            ]
        ];

        if ($request->logo != '') {
            $data['logo'] = $request->logo;
        }

        $this->tenantService->update($data, $uuid);

        return redirect()->route('admin.tenant.index')->with('success', 'Tenant updated successfully.');
    }
}
