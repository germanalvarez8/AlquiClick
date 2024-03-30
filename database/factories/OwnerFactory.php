<?php

namespace Database\Factories;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Owner;

class OwnerFactory extends Factory
{
    protected $model = Owner::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'photo' => 'path/to/photo.jpg'
        ];
    }
}
