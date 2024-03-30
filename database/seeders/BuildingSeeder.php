<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Building;

class BuildingSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Building::factory(10)->create();
    }
}
