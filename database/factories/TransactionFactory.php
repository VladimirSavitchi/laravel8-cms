<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        //Get date and time
        $date = Carbon::now();
        $dateTime = $date->toDateTimeString();

        return [
            'client' => $this->faker->numberBetween(1, 29),
            'amount' => $this->faker->numberBetween(1000, 1000000),
            'transaction_date' => $dateTime,
        ];
    }
}
