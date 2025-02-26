<?php

namespace Database\Seeders;

use App\Models\Role;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $listRole = [
            [
                'name'       => 'Admin',
                'guard_name' => 'Admin',
            ],
            [
                'name'       => 'Developer',
                'guard_name' => 'Developer',
            ],
            [
                'name'       => 'MKT',
                'guard_name' => 'MKT',
            ],
            [
                'name'       => 'User',
                'guard_name' => 'User',
            ],
        ];

        Role::query()->insert($listRole);
    }
}
