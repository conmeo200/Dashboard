<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class SpatiePermissionSeeder extends Seeder
{
    public function run()
    {
        try {
            // 1. Guard name mặc định
            $guardName = 'api'; // Hoặc thay đổi thành guard bạn đang sử dụng, ví dụ: 'api'

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

            //5. Gắn role cho các user (nếu có user trong DB)
            $adminUser = \App\Models\User::where('id', 1)->first(); // User đầu tiên trong DB

            if ($adminUser) {
                $role2 = Role::where('name', 'admin')->first();

                $adminUser->assignRole($role2);
            }

            $managerUser = \App\Models\User::where('id', 2)->first(); // User thứ hai
            if ($managerUser) {
                $role = Role::where('name', 'manager')->first();

                $managerUser->assignRole($role);
            }

            $editorUser = \App\Models\User::where('id', 3)->first(); // User thứ ba
            if ($editorUser) {
                $role1 = Role::where('name', 'editor')->first();
                $editorUser->assignRole($role1);
            }
        } catch (\Exception $e) {
            Log::error("Run SpatiePermissionSeeder Error : " . $e->getMessage());
        }
    }
}

