<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTenantPhotoRequest;
use App\Http\Requests\UpdateTenantPhotoRequest;
use App\Services\TenantPhotoService;
use App\Services\TenantService;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class TenantPhotoController extends Controller
{
    protected $tenantPhotoService, $tenantService;

    public function __construct(TenantPhotoService $tenantPhotoService, TenantService $tenantService)
    {
        $this->tenantPhotoService = $tenantPhotoService;
        $this->tenantService = $tenantService;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $tenantPhotos = $this->tenantPhotoService->getAll();

            return DataTables::of($tenantPhotos)
                ->addIndexColumn()
                ->addColumn('photo', function ($row) {
                    return '<img src="' . asset("storage/" . $row->path) . '"
                    alt="' . $row->caption . '" class="rounded-1"
                    style="width: 200px; height: 200px">';
                })
                ->addColumn('name', function ($row) {
                    return $row->tenant->name;
                })
                ->addColumn('action', function ($row) {
                    return '<a href="' . route('admin.tenant.photo.edit', $row->id) . '">
                        <button type="button"
                            class="justify-content-center w-80 btn mb-1 bg-primary-subtle text-primary">
                            <i class="ti ti-pencil fs-4 me-2"></i>
                            Edit
                        </button>
                    </a>

                    <button type="button"
                        class="justify-content-center w-80 btn mb-1 bg-danger-subtle text-danger btn-delete"
                        data-id="' . $row->tenant_id . '">
                        <i class="ti ti-trash fs-4 me-2"></i>
                        Delete
                    </button>
                    ';
                })
                ->rawColumns(['photo', 'action'])
                ->make(true);
        }

        return view('backend.admin.tenant-photo.index');
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

        return redirect()->back()->with('success', 'Photo saved successfully');
        // return redirect()->route('admin.tenant.photo.index')->with('success', 'Photo saved successfully');
    }

    public function edit($id)
    {
        // $tenantPhoto = $this->tenantPhotoService->findByTenantId($tenant_id, true);
        $tenantPhoto = $this->tenantPhotoService->findById($id);
        $album = $this->tenantPhotoService->getPhotoIsPrimary($tenantPhoto->tenant_id, false)->map(function ($photo) {
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

    public function delete($tenant_id)
    {
        $this->tenantPhotoService->delete($tenant_id);

        // return redirect()->route('admin.tenant.photo.index')->with('success', 'Photo deleted successfully');
    }
}
