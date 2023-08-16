<?php

namespace Database\Factories;

use App\Models\Profile;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Profile>
 */
class ProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'student_id' => $this->faker->numberBetween(1, 25),
            'date_of_birth' => $this->faker->date(),
            'fathers_name' => $this->faker->name,
            'mothers_name' => $this->faker->name,
            'district' => $this->faker->city,
            'upazila' => $this->faker->city,
            'union' => $this->faker->city,
            'village' => $this->faker->city,
            'post_office' => $this->faker->city,
            'post_code' => $this->faker->postcode,
            'nid' => $this->faker->numberBetween(10000000, 99999999),
            'phone' => $this->faker->phoneNumber,
            'photo' => $this->faker->imageUrl(),
            'signature' => $this->faker->imageUrl(),
            'nationality' => $this->faker->country,
            'religion' => $this->faker->country,
            'guardian_name' => $this->faker->name,
            'guardian_phone' => $this->faker->phoneNumber,
        ];
    }
}
