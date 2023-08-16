<?php

namespace Database\Seeders;

use App\Models\Profile;
use App\Models\Room;
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
        User::factory()->create([
            'email' => 'admin@admin.com',
            'password' => bcrypt('12345678'),
            'name' => 'Admin',
        ]);

        User::factory()->count(100)
            ->has(Student::factory()->has(Profile::factory())->has(Seat::factory()->for(Room::factory())))
            ->has(Transaction::factory(5))
            ->create();
    }
}
