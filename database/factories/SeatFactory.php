<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Movie;
use App\Models\User;

class SeatFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'row' => $this->faker->randomDigit,
            'column' => $this->faker->randomDigit,
            'type' => $this->faker->randomElement(['vip', 'regular','accessible']),
            'is_occupied' => '0',
            'movie_id' => Movie::factory(),
            'created_by' => User::factory(),
        ];
    }
}
