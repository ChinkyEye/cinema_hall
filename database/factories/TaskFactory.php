<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Task;
use Carbon\Carbon;
use App\Models\User;

class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Task::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'category' => $this->faker->word,
            'reminder' => now()->addDays(rand(1, 5)),
            'status' => $this->faker->randomElement(['Pending', 'Completed']),
            'created_by' => User::factory(),
        ];
    }
}
