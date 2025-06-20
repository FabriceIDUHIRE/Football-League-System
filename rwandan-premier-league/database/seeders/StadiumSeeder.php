<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Stadium;

class StadiumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Stadium::create(['name' => 'Stadium A']);
        Stadium::create(['name' => 'Stadium B']);
        Stadium::create(['name' => 'Stadium C']);
        // Add more stadiums if needed
    }
}
