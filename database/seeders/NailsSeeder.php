<?php

namespace Database\Seeders;

use App\Models\Nails;
use Illuminate\Database\Seeder;

class NailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Nails::factory()->count(50)->create();
    }
}
