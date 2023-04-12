<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(1000)->create();
        // \App\Models\Userimage::factory(1000)->create();
        // \App\Models\ProfileCategory::factory(1000)->create();
        // \App\Models\spot::factory(1000)->create();
    }
}
