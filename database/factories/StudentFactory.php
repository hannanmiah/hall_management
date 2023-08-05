<?php

namespace Database\Factories;

use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => $this->faker->numberBetween(1, 10),
            'full_name' => $this->faker->name,
            'roll_no' => $this->faker->unique()->numberBetween(1, 100),
            'department' => $this->faker->randomElement(['CSE', 'ECE', 'EEE', 'ME', 'CE', 'IT']),
            'session' => $this->faker->randomElement(['2017-2021', '2018-2022', '2019-2023', '2020-2024', '2021-2025']),
            'allotment_date' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'allotment_status' => $this->faker->boolean(50),
        ];
    }
}
