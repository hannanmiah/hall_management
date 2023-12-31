<?php

namespace Database\Factories;

use App\Models\Seat;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Seat>
 */
class SeatFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'student_id' => null,
            'room_id' => $this->faker->numberBetween(1, 25),
            'name' => $this->faker->word.'-'.$this->faker->randomNumber(3),
        ];
    }
}
