<?php

namespace Database\Factories;

use App\Models\{TaskStatus, User};
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->text(50),
            'description' => $this->faker->text,
            'task_status_id' => TaskStatus::inRandomOrder()->first()->id,
            'created_by_id' => User::inRandomOrder()->first()->id,
            'assigned_to_id' => User::inRandomOrder()->first()->id,
        ];
    }
}
