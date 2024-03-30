<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Owner;
use App\Models\OwnerContact;

class OwnerContactSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        OwnerContact::factory(20)->create();
    }
}
