<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Seeder;
use App\Models\Room;

class RoomFactory extends Factory
{
    protected $model = Room::class;

    public function definition()
    {
        return [
            'capacity' => $this->faker->numberBetween(1, 4),
            'bedrooms' => $this->faker->numberBetween(0, 3),
            'owner_id' => $this->faker->numberBetween(1, 10),
            'building_id' => $this->faker->numberBetween(1, 10),
            'is_available' => $this->faker->boolean
        ];
    }
}
