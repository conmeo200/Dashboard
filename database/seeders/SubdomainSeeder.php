<?php

namespace Database\Seeders;

use App\Models\Subdomain;
use Illuminate\Database\Seeder;

class SubdomainSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Subdomain::factory(10)->create();
    }
}
