<?php

namespace Tests\Feature;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RolePermissionManagementTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Seed basic roles
        Role::firstOrCreate(['name' => 'superuser']);
        Role::firstOrCreate(['name' => 'admin']);
        Role::firstOrCreate(['name' => 'hr']);

        // Seed permissions list to prevent Spatie PermissionDoesNotExist exceptions on sidebar rendering
        $permissions = [
            'view dashboard',
            'view category tenants', 'create category tenants', 'edit category tenants', 'delete category tenants',
            'view tenants', 'create tenants', 'edit tenants', 'delete tenants',
            'view events', 'create events', 'edit events', 'delete events',
            'view gallery', 'create gallery', 'edit gallery', 'delete gallery',
            'view promo', 'create promo', 'edit promo', 'delete promo',
            'view careers', 'create careers', 'edit careers', 'delete careers',
            'view settings', 'create settings', 'edit settings', 'delete settings',
            'view announcements', 'create announcements', 'edit announcements', 'delete announcements'
        ];

        foreach ($permissions as $perm) {
            Permission::firstOrCreate(['name' => $perm]);
        }
    }

    public function test_superuser_can_access_role_permission_management_page(): void
    {
        $superuser = User::factory()->create();
        $superuser->assignRole('superuser');

        $response = $this->actingAs($superuser)->get(route('admin.role-permission.index'));

        $response->assertStatus(200);
        $response->assertSee('Role & Permission Matrix', false);
    }

    public function test_non_superuser_cannot_access_role_permission_management_page(): void
    {
        $admin = User::factory()->create();
        $admin->assignRole('admin');

        $response = $this->actingAs($admin)->get(route('admin.role-permission.index'));

        $response->assertStatus(403);
    }

    public function test_superuser_can_update_roles_and_permissions_matrix(): void
    {
        $superuser = User::factory()->create();
        $superuser->assignRole('superuser');

        $adminRole = Role::where('name', 'admin')->first();
        $permissionName = 'view settings';

        $this->assertFalse($adminRole->hasPermissionTo($permissionName));

        // Submit form
        $response = $this->actingAs($superuser)->post(route('admin.role-permission.update'), [
            'permissions' => [
                $adminRole->id => [$permissionName]
            ]
        ]);

        $response->assertRedirect(route('admin.role-permission.index'));
        
        // Refresh & assert
        $adminRole = $adminRole->fresh();
        $this->assertTrue($adminRole->hasPermissionTo($permissionName));
    }

    public function test_permissions_correctly_guard_protected_routes(): void
    {
        $admin = User::factory()->create();
        $admin->assignRole('admin');

        // Access denied first (admin doesn't have permission)
        $response = $this->actingAs($admin)->get(route('admin.setting.index'));
        $response->assertStatus(403);

        // Grant permission
        $admin->givePermissionTo('view settings');

        // Access allowed now
        $response = $this->actingAs($admin)->get(route('admin.setting.index'));
        $response->assertStatus(200);
    }

    public function test_superuser_automatically_passes_all_permission_guards(): void
    {
        $superuser = User::factory()->create();
        $superuser->assignRole('superuser');

        $response = $this->actingAs($superuser)->get(route('admin.setting.index'));
        
        // Allowed by Gate::before bypass
        $response->assertStatus(200);
    }
}
