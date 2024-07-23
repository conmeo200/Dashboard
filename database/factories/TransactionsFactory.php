<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class TransactionsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'transaction_id'   => $this->faker->uuid(),
            'name'             => $this->faker->name(),
            'email'            => $this->faker->email(),
            'amount'           => $this->faker->randomFloat(2, 100, 1000),
            'currency'         => $this->faker->currencyCode(),
            'created_at'       => Carbon::now()->timestamp,
            'updated_at'       => Carbon::now()->timestamp
        ];
    }
}
