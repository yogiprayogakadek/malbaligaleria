<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionController extends Controller
{
    protected function getPermissionsConfig()
    {
        return [
            'Dashboard' => [
                'view dashboard' => 'View Dashboard Menu & Page',
            ],
            'Category Tenants' => [
                'view category tenants' => 'View Category Tenants',
                'create category tenants' => 'Create Category Tenant',
                'edit category tenants' => 'Edit Category Tenant',
                'delete category tenants' => 'Delete Category Tenant',
            ],
            'Tenants' => [
                'view tenants' => 'View Tenants',
                'create tenants' => 'Create Tenant',
                'edit tenants' => 'Edit Tenant',
                'delete tenants' => 'Delete Tenant',
            ],
            'Events' => [
                'view events' => 'View Events',
                'create events' => 'Create Event',
                'edit events' => 'Edit Event',
                'delete events' => 'Delete Event',
            ],
            'Gallery' => [
                'view gallery' => 'View Gallery',
                'create gallery' => 'Create Gallery Item',
                'edit gallery' => 'Edit Gallery Item',
                'delete gallery' => 'Delete Gallery Item',
            ],
            'Promo' => [
                'view promo' => 'View Promo',
                'create promo' => 'Create Promo',
                'edit promo' => 'Edit Promo',
                'delete promo' => 'Delete Promo',
            ],
            'Careers' => [
                'view careers' => 'View Careers (Vacancies & Applications)',
                'create careers' => 'Create Vacancies',
                'edit careers' => 'Edit Vacancies / Applications',
                'delete careers' => 'Delete Vacancies / Applications',
            ],
            'Settings' => [
                'view settings' => 'View Settings',
                'create settings' => 'Create Setting Item',
                'edit settings' => 'Edit Settings',
                'delete settings' => 'Delete Settings',
            ],
            'Announcements' => [
                'view announcements' => 'View Announcements',
                'create announcements' => 'Create Announcement',
                'edit announcements' => 'Edit Announcement',
                'delete announcements' => 'Delete Announcement',
            ],
        ];
    }

    public function index()
    {
        $modules = $this->getPermissionsConfig();

        // Self-heal/ensure all permissions exist
        foreach ($modules as $moduleName => $permissions) {
            foreach ($permissions as $permissionName => $displayName) {
                Permission::firstOrCreate(['name' => $permissionName]);
            }
        }

        // Fetch roles except superuser
        $roles = Role::where('name', '!=', 'superuser')->get();

        return view('backend.admin.role_permission.index', compact('modules', 'roles'));
    }

    public function update(Request $request)
    {
        $roles = Role::where('name', '!=', 'superuser')->get();
        $inputPermissions = $request->input('permissions', []);

        foreach ($roles as $role) {
            // Retrieve checked permissions for this role, or empty array
            $rolePermissions = $inputPermissions[$role->id] ?? [];
            $role->syncPermissions($rolePermissions);
        }

        // Log manual activity if helper exists
        if (function_exists('activity')) {
            activity()
                ->causedBy(auth()->user())
                ->log('Updated roles and permissions matrix');
        }

        return redirect()->route('admin.role-permission.index')
            ->with('success', 'Roles and permissions updated successfully.');
    }
}
