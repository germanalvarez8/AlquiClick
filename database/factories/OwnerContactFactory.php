<?php

namespace Database\Factories;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\OwnerContact;

class OwnerContactFactory extends Factory
{
    protected $model = OwnerContact::class;

    public function definition()
    {
        $contactTypes = ['facebook', 'linkedIn', 'telefono', 'mail', 'twitter'];

        return [
            'owner_id' => $this->faker->numberBetween(1, 10),
            'contact_type' => $this->faker->randomElement($contactTypes),
            'username' => $this->faker->userName,
            'link' => $this->faker->url
        ];
    }
}
