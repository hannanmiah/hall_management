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
            'name' => $this->faker->word,
            'amount' => $this->faker->numberBetween(100, 100000),
            'method' => $this->faker->randomElement(['card', 'bank']),
            'reference' => $this->faker->uuid,
            'status' => $this->faker->randomElement(['pending', 'credited', 'debited']),
            'description' => $this->faker->sentence,
        ];
    }
}
