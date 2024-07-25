<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SubdomainFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'   => $this->faker->name(),
            'link'   => $this->faker->url(),
            'active' => $this->faker->randomElement(['Y', 'N']),
        ];
    }
}
