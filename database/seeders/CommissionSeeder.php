<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CommissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Commission::factory(10)->create();
    }
}
