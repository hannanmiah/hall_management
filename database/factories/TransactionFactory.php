<?php

namespace Database\Factories;

use App\Models\Transaction;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => 1,
            'name' => $this->faker->randomElement(['fee', 'expense', 'other']),
            'amount' => $this->faker->numberBetween(100, 100000),
            'method' => $this->faker->randomElement(['card', 'bank', 'cash']),
            'reference' => $this->faker->dateTimeBetween('-1 year', 'now')->format('Y-m-d'),
            'status' => $this->faker->randomElement(['pending', 'credited', 'debited']),
            'description' => $this->faker->sentence,
        ];
    }
}
