<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\FrontendMenu;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Spatie\Permission\Models\Role;

class FrontendMenuController extends Controller
{
    /**
     * Display a listing of frontend menus.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $menus = FrontendMenu::orderBy('order')->get();

            return DataTables::of($menus)
                ->addIndexColumn()
                ->addColumn('roles', function ($row) {
                    if (empty($row->roles)) {
                        return '<span class="badge bg-secondary-subtle text-secondary border border-secondary">All (Guests included)</span>';
                    }
                    $rolesBadge = '';
                    foreach ($row->roles as $role) {
                        $rolesBadge .= '<span class="badge bg-primary-subtle text-primary border border-primary me-1">' . htmlspecialchars($role) . '</span>';
                    }
                    return $rolesBadge;
                })
                ->addColumn('is_active', function ($row) {
                    if ($row->is_active) {
                        return '<button type="button" class="btn btn-sm bg-success-subtle text-success border border-success btn-toggle-active" data-id="' . $row->id . '" data-active="1" title="Click to deactivate">
                            <i class="ti ti-circle-check fs-4 me-1 align-middle"></i> Active
                        </button>';
                    }
                    return '<button type="button" class="btn btn-sm bg-danger-subtle text-danger border border-danger btn-toggle-active" data-id="' . $row->id . '" data-active="0" title="Click to activate">
                        <i class="ti ti-alert-circle fs-4 me-1 align-middle"></i> Inactive
                    </button>';
                })
                ->addColumn('action', function ($row) {
                    return '<a href="' . route('admin.menu.edit', $row->id) . '" class="btn btn-sm btn-primary">
                        <i class="ti ti-edit"></i> Edit
                    </a>';
                })
                ->rawColumns(['roles', 'is_active', 'action'])
                ->make(true);
        }

        return view('backend.admin.menu.index');
    }

    /**
     * Show the form for editing the specified frontend menu.
     */
    public function edit($id)
    {
        $menu = FrontendMenu::findOrFail($id);
        $roles = Role::all();

        return view('backend.admin.menu.edit', compact('menu', 'roles'));
    }

    /**
     * Update the specified frontend menu in storage.
     */
    public function update(Request $request, $id)
    {
        $menu = FrontendMenu::findOrFail($id);

        $request->validate([
            'is_active' => 'required|in:0,1',
            'roles' => 'nullable|array',
            'roles.*' => 'string|exists:roles,name',
        ]);

        $menu->update([
            'is_active' => $request->is_active == '1',
            'roles' => $request->roles,
        ]);

        return redirect()->route('admin.menu.index')->with('success', 'Frontend menu updated successfully.');
    }

    /**
     * Toggle active state of a menu via AJAX.
     */
    public function toggleActive($id)
    {
        $menu = FrontendMenu::findOrFail($id);
        $menu->update([
            'is_active' => !$menu->is_active
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Menu visibility status updated successfully.'
        ]);
    }
}
