<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePromoRequest;
use App\Http\Requests\UpdatePromoRequest;
use App\Services\PromoService;
use App\Services\TenantService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PromoController extends Controller
{
    protected $promoService, $tenantService, $role;

    public function __construct(PromoService $promoService, TenantService $tenantService)
    {
        $this->promoService = $promoService;
        $this->tenantService = $tenantService;
        $this->role = Auth::user()->getRoleNames()->first();
    }

    public function index()
    {
        $promos = $this->promoService->getPromoWithRelationship(['id', 'tenant_id', 'uuid', 'name', 'start_date', 'end_date', 'description', 'is_active'], ['tenant:id,name']);
        return view('backend.admin.promo.index', compact('promos'));
    }

    public function create()
    {
        $tenants = $this->tenantService->getAll(['id', 'name']);
        return view('backend.admin.promo.create', compact('tenants'));
    }

    public function store(StorePromoRequest $request)
    {
        $tenantId = $this->role == 'admin' ? $request->tenant_id : Auth::user()->tenant->id;

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
        $tenantId = $this->role == 'admin' ? $request->tenant_id : Auth::user()->tenant->id;

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
