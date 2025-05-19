<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'price'           => $this->faker->randomFloat(2, 10, 1000),
            'images'          => $this->faker->imageUrl(),
            'type_product_id' => $this->faker->randomElement([1, 2, 3]),
            'name'            => $this->faker->words(3, true),
            'created_at'      => now()->timestamp,
            'updated_at'      => now()->timestamp,
        ];
    }
}
