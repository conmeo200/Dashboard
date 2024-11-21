<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class BlogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title'            => $this->faker->sentence,
            'post'             => $this->faker->text,
            'slug'             => $this->faker->slug,
            'image'            => $this->faker->imageUrl,
            'meta_description' => $this->faker->sentence,
            'views'            => $this->faker->numberBetween(0, 1000),
            'post_exceprt'     => $this->faker->sentence,
            'created_time'     => Carbon::now()->timestamp,
            'updated_time'     => Carbon::now()->timestamp,
            'user_id'          => \App\Models\User::inRandomOrder()->first()->id,   // Chọn ngẫu nhiên user_id
        ];
    }
}
