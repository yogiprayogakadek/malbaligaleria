<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePromoRequest;
use App\Http\Requests\UpdatePromoRequest;
use App\Services\PromoService;
use App\Services\TenantService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class PromoController extends Controller
{
    protected $promoService, $tenantService, $role;

    public function __construct(PromoService $promoService, TenantService $tenantService)
    {
        $this->promoService = $promoService;
        $this->tenantService = $tenantService;
        $this->role = Auth::user()->getRoleNames()->first();
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $promos = $this->promoService->getAllWithRelationship(['id', 'tenant_id', 'uuid', 'name', 'start_date', 'end_date', 'description', 'is_active'], ['tenant:id,name']);

            return DataTables::of($promos)
                ->addIndexColumn()
                ->editColumn('start_date', function ($row) {
                    return date_format(date_create($row->start_date), 'd M Y');
                })
                ->editColumn('end_date', function ($row) {
                    return date_format(date_create($row->end_date), 'd M Y');
                })
                ->editColumn('is_active', function ($row) {
                    return $row->is_active == true
                        ? '<span class="badge bg-primary">Active</span>'
                        : '<span class="badge bg-danger">Inactive</span>';
                })
                ->addColumn('action', function ($row) {
                    return '<a href="' . route('admin.promo.edit', $row->uuid) . '">
                        <button type="button"
                            class="justify-content-center w-80 btn mb-1 bg-primary-subtle text-primary">
                            <i class="ti ti-pencil fs-4 me-2"></i>
                            Edit
                        </button>
                    </a>';
                })
                ->rawColumns(['start_date', 'end_date', 'is_active', 'action'])
                ->make(true);
        }
        return view('backend.admin.promo.index');
    }

    public function create()
    {
        $tenants = $this->tenantService->getAll(['id', 'name']);
        return view('backend.admin.promo.create', compact('tenants'));
    }

    public function store(StorePromoRequest $request)
    {
        $tenantId = in_array($this->role, ['admin', 'superuser']) ? $request->tenant_id : Auth::user()->tenant->id;

        $data = [
            'tenant_id' => $tenantId,
            'name' => $request->name,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'description' => $request->description,
            'banner' => $request->banner,
        ];

        $this->promoService->create($data);

        return redirect()->route('admin.promo.index')->with('success', 'Promo saved successfully');
    }

    public function edit($uuid)
    {
        $tenants = $this->tenantService->getAll(['id', 'name']);
        $promo = $this->promoService->findByUuid($uuid);

        return view('backend.admin.promo.edit', compact('tenants', 'promo'));
    }

    public function update(UpdatePromoRequest $request, $uuid)
    {
        $tenantId = in_array($this->role, ['admin', 'superuser']) ? $request->tenant_id : Auth::user()->tenant->id;

        $data = [
            'tenant_id' => $tenantId,
            'name' => $request->name,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'description' => $request->description,
            'is_active' => $request->is_active,
        ];

        if ($request->banner != '') {
            $data['banner'] = $request->banner;
        }

        $this->promoService->update($data, $uuid);

        return redirect()->route('admin.promo.index')->with('success', 'Promo updated successfully');
    }
}
