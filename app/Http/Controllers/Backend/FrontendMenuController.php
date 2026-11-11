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
     * Show the form for creating a new frontend menu.
     */
    public function create()
    {
        $roles = Role::all();
        $nextOrder = (int) FrontendMenu::max('order') + 1;

        return view('backend.admin.menu.create', compact('roles', 'nextOrder'));
    }

    /**
     * Store a newly created frontend menu.
     */
    public function store(Request $request)
    {
        $validated = $request->validate($this->rules());

        FrontendMenu::create([
            'name' => $validated['name'],
            'url' => $validated['url'],
            'is_active' => $validated['is_active'] == '1',
            'roles' => $validated['roles'] ?? null,
            'order' => $validated['order'] ?? ((int) FrontendMenu::max('order') + 1),
        ]);

        return redirect()->route('admin.menu.index')->with('success', 'Frontend menu created successfully.');
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

        $validated = $request->validate($this->rules());

        $menu->update([
            'name' => $validated['name'],
            'url' => $validated['url'],
            'is_active' => $validated['is_active'] == '1',
            'roles' => $validated['roles'] ?? null,
            'order' => $validated['order'] ?? $menu->order,
        ]);

        return redirect()->route('admin.menu.index')->with('success', 'Frontend menu updated successfully.');
    }

    /**
     * Validation rules for create/update.
     */
    private function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'url' => [
                'required',
                'string',
                'max:2048',
                function ($attribute, $value, $fail) {
                    if (!preg_match('#^(https?://|/|\#)#i', $value)) {
                        $fail('The URL must be an external http(s) URL, an internal path starting with /, or an anchor starting with #.');
                    }
                },
            ],
            'order' => 'nullable|integer|min:0',
            'is_active' => 'required|in:0,1',
            'roles' => 'nullable|array',
            'roles.*' => 'string|exists:roles,name',
        ];
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
