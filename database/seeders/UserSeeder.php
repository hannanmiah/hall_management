<?php

namespace Database\Seeders;

use App\Models\Profile;
use App\Models\Seat;
use App\Models\Student;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->count(100)
            ->has(Student::factory()->has(Profile::factory())->has(Seat::factory()))
            ->has(Transaction::factory(5))
            ->create();
    }
}
