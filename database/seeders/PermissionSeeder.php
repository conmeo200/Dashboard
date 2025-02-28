<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    public function run()
    {
        // Danh sách các permissions
        $permissions = [
            'view users',
            'create users',
            'edit users',
            'delete users',
            'view roles',
            'create roles',
            'edit roles',
            'delete roles',
            'view permissions',
            'create permissions',
            'edit permissions',
            'delete permissions',
        ];

        // Tạo permissions
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => $permission]);
        }

        // Tạo role admin và gán toàn bộ permissions
        $adminRole = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'admin']);
        $adminRole->syncPermissions($permissions);

        // // Tạo role user và chỉ gán một số permissions
        // $userRole        = Role::firstOrCreate(['name' => 'user']);
        // $userPermissions = ['view users', 'view roles', 'view permissions'];

        // $userRole->syncPermissions($userPermissions);
    }
}
