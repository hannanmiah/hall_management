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
            'student_id' => null,  //null or $this->faker->randomNumber(3),
            'name' => $this->faker->name,
            'room_no' => $this->faker->randomNumber(3),
        ];
    }
}
