<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class TagFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'         => $this->faker->word,
            'created_time' => Carbon::now()->timestamp,
            'updated_time' => Carbon::now()->timestamp,
        ];
    }
}
