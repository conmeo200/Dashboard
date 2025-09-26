<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class NailsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => 'Mẫu ' . $this->faker->words(2, true), 
            'description' => $this->faker->sentence(8),
            'image_url' => 'images/designs/' . $this->faker->unique()->word . '.jpg',
            'price' => $this->faker->numberBetween(150000, 300000),
            'status' => 'active',
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
