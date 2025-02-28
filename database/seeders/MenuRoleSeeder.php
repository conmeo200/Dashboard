<?php

namespace Database\Seeders;

use App\Models\MenuModel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roleMenus = [
            5 => [1, 2, 3, 4, 5, 6], 
            6 => [1, 2], 
            7 => [3, 4], 
            8 => [5, 6], 
        ];

        $data = [];
        foreach ($roleMenus as $roleId => $menuIds) {
            foreach ($menuIds as $menuId) {
                $data[] = [
                    'role_id' => $roleId,
                    'menu_id' => $menuId
                ];
            }
        }

        // Chèn vào bảng trung gian menu_role
        DB::table('menu_roles')->insert($data);
    }
}
