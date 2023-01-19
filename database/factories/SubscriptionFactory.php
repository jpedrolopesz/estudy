<?php

namespace Database\Factories;

use App\Models\Plan;
use App\Models\User;
use Couchbase\QueryStringSearchQuery;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubscriptionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {


        return [
            'user_id' => User::all()->random()->id,
            'name' => $this->faker->word,
            'stripe_id' => $this->faker->uuid,
            'stripe_plan' => $this->faker->randomElement(['plan_1', 'plan_2', 'plan_3']),
            'quantity' => $this->faker->numberBetween(1, 5),
        ];

    }
}
