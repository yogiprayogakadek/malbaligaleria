<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTenantPhotoRequest;
use App\Http\Requests\UpdateTenantPhotoRequest;
use App\Services\TenantPhotoService;
use App\Services\TenantService;
use Illuminate\Http\Request;

class TenantPhotoController extends Controller
{
    protected $tenantPhotoService, $tenantService;

    public function __construct(TenantPhotoService $tenantPhotoService, TenantService $tenantService)
    {
        $this->tenantPhotoService = $tenantPhotoService;
        $this->tenantService = $tenantService;
    }

    public function index()
    {
        $tenantPhotos = $this->tenantPhotoService->getAll();

        return view('backend.admin.tenant-photo.index', compact('tenantPhotos'));
    }

    public function create()
    {
        $tenants = $this->tenantService->findEmptyPhotoTenants(['id', 'uuid', 'name']);

        return view('backend.admin.tenant-photo.create', compact('tenants'));
    }

    public function store(StoreTenantPhotoRequest $request)
    {
        $data = [
            'tenant_id' => $request->tenant_id,
            'caption'   => $request->caption,
            'is_primary'    => true,
            'path'      => $request->path,
            'album'     => $request->file('album')
        ];

        $this->tenantPhotoService->create($data);

        return redirect()->route('admin.tenant.photo.index')->with('success', 'Photo saved successfully');
    }

    public function edit($tenant_id)
    {
        $tenantPhoto = $this->tenantPhotoService->findByTenantId($tenant_id, true);
        $album = $this->tenantPhotoService->getPhotoIsPrimary($tenant_id, false)->map(function ($photo) {
            return [
                'path' => asset('storage/' . $photo->path),
                'id' => $photo->id
            ];
        });

        return view('backend.admin.tenant-photo.edit', compact('tenantPhoto', 'album'));
    }

    public function update(UpdateTenantPhotoRequest $request, $tenant_id)
    {
        $data = [
            'caption'   => $request->caption,
            'album'     => $request->file('album')
            // 'path'      => $request->path
        ];

        if ($request->path != '') {
            $data['path'] = $request->path;
        }

        $this->tenantPhotoService->update($data, $tenant_id);
        return redirect()->route('admin.tenant.photo.index')->with('success', 'Photo updated successfully');
    }

    public function delete($id)
    {
        $this->tenantPhotoService->delete($id);

        // return redirect()->route('admin.tenant.photo.index')->with('success', 'Photo deleted successfully');
    }
}
