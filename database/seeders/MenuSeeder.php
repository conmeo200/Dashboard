<?php

namespace Database\Seeders;

use App\Models\MenuModel;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $listItem = [
            [
                'parent_id' => 0,
                'name'      => 'Dashboard',
                'keyword'   => 'dashboard',
                'icon'      => 'dashboard',
                'order'     => 1,
                'active'    => 'Y',
            ],
            [
                'parent_id' => 0,
                'name'      => 'List User',
                'keyword'   => 'list-user',
                'icon'      => 'dashboard',
                'order'     => 1,
                'active'    => 'Y',
            ],
            [
                'parent_id' => 0,
                'name'      => 'Role',
                'keyword'   => 'role',
                'icon'      => 'dashboard',
                'order'     => 1,
                'active'    => 'Y',
            ],
            [
                'parent_id' => 0,
                'name'      => 'Log',
                'keyword'   => 'log',
                'icon'      => 'dashboard',
                'order'     => 1,
                'active'    => 'Y',
            ],
            [
                'parent_id' => 0,
                'name'      => 'Stripe',
                'keyword'   => 'stripe',
                'icon'      => 'dashboard',
                'order'     => 2,
                'active'    => 'N',
            ],
            [
                'parent_id' => 0,
                'name'      => 'Paypal',
                'keyword'   => 'pay-pal',
                'icon'      => 'dashboard',
                'order'     => 2,
                'active'    => 'N',
            ]
        ];

        MenuModel::query()->insert($listItem);
    }
}
