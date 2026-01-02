<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $users = $this->userService->getUsersWithRelationship(
                ['id', 'name', 'tenant_id', 'email', 'phone', 'status', 'is_active'],
                [
                    'tenant:id,name'
                ]
            );

            return DataTables::of($users)
                ->addIndexColumn()
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
                        : '<span class="badge bg-danger">Not Active</span>';
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
                ->rawColumns(['action', 'status', 'is_active'])
                ->make(true);
        }

        return view('backend.admin.user.index');
    }

    public function activate(Request $request, $id)
    {
        $data = [
            'status' => $request->action,
            'status_note' => $request->reason
        ];

        $this->userService->update($data, $id);
    }
}
