<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Services\TenantService;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    protected $userService, $tenantService;

    public function __construct(UserService $userService, TenantService $tenantService)
    {
        $this->userService = $userService;
        $this->tenantService = $tenantService;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $users = $this->userService->getUsersWithRelationship(
                ['id', 'name', 'tenant_id', 'email', 'phone', 'status', 'is_active', 'email_verified_at'],
                [
                    'tenant:id,name'
                ]
            );

            return DataTables::of($users)
                ->addIndexColumn()
                ->addColumn('email_verified', function ($row) {
                    if ($row->email_verified_at) {
                        return '<button type="button" class="btn btn-sm bg-success-subtle text-success border border-success btn-toggle-verify" data-user-id="' . $row->id . '" data-verified="1" title="Click to unverify">
                            <i class="ti ti-circle-check fs-4 me-1 align-middle"></i> Verified
                        </button>';
                    }
                    return '<button type="button" class="btn btn-sm bg-danger-subtle text-danger border border-danger btn-toggle-verify" data-user-id="' . $row->id . '" data-verified="0" title="Click to verify">
                        <i class="ti ti-alert-circle fs-4 me-1 align-middle"></i> Unverified
                    </button>';
                })
                ->addColumn('status', function ($row) {
                    return $row->status == 'pending'
                        ? '<span class="badge bg-info">Pending</span>'
                        : ($row->status == 'approved'
                            ? '<span class="badge bg-success">Approved</span>'
                            : '<span class="badge bg-danger">Rejected</span>');
                })
                ->addColumn('is_active', function ($row) {
                    return $row->is_active == true
                        ? '<span class="badge bg-primary">Active</span>'
                        : '<span class="badge bg-danger">Inactive</span>';
                })
                ->addColumn('action', function ($row) {
                    $button = '';
                    if ($row->is_active == true && $row->status == 'pending') {
                        $button .= '<button type="button" class="justify-content-center w-80 btn mb-1 bg-success-subtle text-success btn-approve" data-user-id="' . $row->id . '">
                        <i class="ti ti-circle-check-filled fs-4 me-2"></i>
                        Approve
                    </button>
                    <button type="button"
                        class="justify-content-center w-80 btn mb-1 bg-danger-subtle text-danger btn-reject"
                        data-user-id="' . $row->id . '">
                        <i class="ti ti-x fs-4 me-2"></i>
                        Reject
                    </button>
                    ';
                    }

                    $button .= '<a href="' . route('admin.user.edit', $row->id) . '">
                        <button type="button"
                            class="justify-content-center w-80 btn mb-1 bg-primary-subtle text-primary">
                            <i class="ti ti-pencil fs-4 me-2"></i>
                            Edit
                        </button>
                    </a>
                    ';

                    return $button;
                })
                ->rawColumns(['action', 'status', 'is_active', 'email_verified'])
                ->make(true);
        }

        return view('backend.admin.user.index');
    }

    public function create()
    {
        $tenants = $this->tenantService->getAll(['uuid', 'id', 'name']);
        return view('backend.admin.user.create', compact('tenants'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'nullable|string|max:20',
            'tenant_id' => 'nullable|exists:tenants,id',
            'password' => 'required|min:8|confirmed',
        ]);

        DB::beginTransaction();
        try {
            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'tenant_id' => $request->tenant_id,
                'password' => Hash::make($request->password),
                'status' => 'approved',
                'is_active' => true,
                'email_verified_at' => now(),
            ];

            $user = $this->userService->create($data);
            
            // Assign default admin role if no other logic
            $user->assignRole('admin');

            DB::commit();
            return redirect()->route('admin.user.index')->with('success', 'User created successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Error creating user: ' . $e->getMessage())->withInput();
        }
    }

    public function edit($id)
    {
        $user = $this->userService->findById($id);
        $tenants = $this->tenantService->getAll(['uuid', 'id', 'name']);

        return view('backend.admin.user.edit', compact('user', 'tenants'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'phone' => 'nullable|string|max:20',
            'tenant_id' => 'nullable|exists:tenants,id',
            'password' => 'nullable|min:8|confirmed',
            'is_active' => 'nullable|in:0,1',
            'email_verified' => 'required|in:0,1',
        ]);

        DB::beginTransaction();
        try {
            $user = $this->userService->findById($id);

            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'tenant_id' => $request->tenant_id,
            ];

            if ($request->filled('password')) {
                $data['password'] = Hash::make($request->password);
            }

            if ($request->email_verified == 1) {
                if (!$user->email_verified_at) {
                    $data['email_verified_at'] = now();
                }
            } else {
                $data['email_verified_at'] = null;
            }

            // Secure status update: Only allow changing is_active if user is approved
            if ($user->status == 'approved') {
                $data['is_active'] = $request->is_active;
            }

            $this->userService->update($data, $id);

            DB::commit();
            return redirect()->route('admin.user.index')->with('success', 'User updated successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Error updating user: ' . $e->getMessage())->withInput();
        }
    }

    public function activate(Request $request, $id)
    {
        $data = [
            'status' => $request->action,
            'status_note' => $request->reason
        ];

        $this->userService->update($data, $id);
    }

    public function toggleVerify(Request $request, $id)
    {
        $user = $this->userService->findById($id);
        if ($user->email_verified_at) {
            $user->email_verified_at = null;
        } else {
            $user->email_verified_at = now();
        }
        
        // Use save directly to bypass repository pattern if needed, or update via repository
        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Email verification status toggled successfully.'
        ]);
    }
}
