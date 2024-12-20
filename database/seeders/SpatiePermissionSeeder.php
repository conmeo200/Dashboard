<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class SpatiePermissionSeeder extends Seeder
{
    public function run()
    {
        // 1. Guard name mặc định
        $guardName = 'web'; // Hoặc thay đổi thành guard bạn đang sử dụng, ví dụ: 'api'

        // 2. Tạo danh sách permissions
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

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(
                ['name' => $permission, 'guard_name' => $guardName]
            );
        }

        // 3. Tạo các roles
        $roles = [
            'admin',
            'manager',
            'editor',
            'user',
        ];

        foreach ($roles as $roleName) {
            Role::firstOrCreate(
                ['name' => $roleName, 'guard_name' => $guardName]
            );
        }

        // 4. Gắn quyền cho các vai trò
        $adminRole = Role::where('name', 'admin')->first();
        
        if ($adminRole) {
            $adminRole->syncPermissions(Permission::all());
        }

        $managerRole = Role::where('name', 'manager')->first();
        if ($managerRole) {
            $managerRole->syncPermissions([
                'view users',
                'view roles',
                'view permissions',
            ]);
        }

        $editorRole = Role::where('name', 'editor')->first();
        if ($editorRole) {
            $editorRole->syncPermissions([
                'view users',
                'edit users',
                'view permissions',
            ]);
        }

        // 5. Gắn role cho các user (nếu có user trong DB)
        $adminUser = \App\Models\User::find(1); // User đầu tiên trong DB
        if ($adminUser) {
            $adminUser->assignRole('admin');
        }

        $managerUser = \App\Models\User::find(2); // User thứ hai
        if ($managerUser) {
            $managerUser->assignRole('manager');
        }

        $editorUser = \App\Models\User::find(3); // User thứ ba
        if ($editorUser) {
            $editorUser->assignRole('editor');
        }
    }
}

