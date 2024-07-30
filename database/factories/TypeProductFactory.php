<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TypeProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'    => $this->faker->name(),
            'keyword' => $this->faker->imageUrl(),
            'order'   => 1,
            'active'  => $this->faker->randomElement(['Y', 'N']),
        ];
    }
}
