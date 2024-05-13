<?php

namespace Database\Factories;

use App\Models\{TaskStatus, User};
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Auth;

class TaskFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->text(50),
            'description' => $this->faker->text,
            'task_status_id' => TaskStatus::factory(),
            'created_by_id' => Auth::id() ?? User::factory(),
            'assigned_to_id' => User::factory(),
        ];
    }
}
