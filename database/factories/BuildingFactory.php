<?php

namespace Database\Factories;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Building;

class BuildingFactory extends Factory
{
    protected $model = Building::class;

    public function definition()
    {
        return [
            'name' => $this->faker->company,
            'address' => $this->faker->address
        ];
    }
}
