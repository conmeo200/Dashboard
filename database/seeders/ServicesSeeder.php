<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now();

        DB::table('services')->insert([
            [
                'name'        => 'Cắt da & dưỡng móng',
                'description' => 'Cắt da, vệ sinh và dưỡng móng cơ bản.',
                'duration'    => 30,                                        // phút
                'price'       => 100000,
                'status'      => 'active',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'name'        => 'Sơn gel cơ bản',
                'description' => 'Sơn gel màu đơn giản, bền màu.',
                'duration'    => 45,
                'price'       => 150000,
                'status'      => 'active',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'name'        => 'Đắp bột',
                'description' => 'Đắp bột móng dài, tạo form đẹp.',
                'duration'    => 60,
                'price'       => 250000,
                'status'      => 'active',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'name'        => 'Vẽ họa tiết nghệ thuật',
                'description' => 'Vẽ móng theo mẫu yêu cầu.',
                'duration'    => 40,
                'price'       => 200000,
                'status'      => 'active',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'name'        => 'Sơn gel + vẽ họa tiết',
                'description' => 'Sơn gel kết hợp với vẽ móng nghệ thuật.',
                'duration'    => 70,
                'price'       => 300000,
                'status'      => 'active',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
        ]);
    }
}
