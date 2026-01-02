<?php

namespace App\Http\Controllers\Backend\Tenant;

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
        $promos = $this->promoService->getPromoWithRelationshipAndCondition(
            ['id', 'tenant_id', 'uuid', 'name', 'start_date', 'end_date', 'description', 'is_active'],
            ['tenant:id,name'],
            'tenant_id',
            Auth::user()->tenant_id
        );
        return view('backend.tenant.promo.index', compact('promos'));
    }

    public function create()
    {
        return view('backend.tenant.promo.create');
    }

    public function store(StorePromoRequest $request)
    {
        $tenantId = Auth::user()->tenant->id;

        $data = [
            'tenant_id' => $tenantId,
            'name' => $request->name,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'description' => $request->description,
            'banner' => $request->banner,
        ];

        $this->promoService->create($data);

        return redirect()->route('tenant.promo.index')->with('success', 'Promo saved successfully');
    }

    public function edit($uuid)
    {
        $tenants = $this->tenantService->getAll(['id', 'name']);
        $promo = $this->promoService->findByUuid($uuid);

        return view('backend.tenant.promo.edit', compact('tenants', 'promo'));
    }

    public function update(UpdatePromoRequest $request, $uuid)
    {
        $tenantId = Auth::user()->tenant->id;

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

        return redirect()->route('tenant.promo.index')->with('success', 'Promo updated successfully');
    }
}
