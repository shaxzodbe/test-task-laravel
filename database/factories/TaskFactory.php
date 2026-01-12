<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;


class TaskFactory extends Factory
{
    
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(4),
            'due_at' => fake()->dateTimeBetween('now', '+1 month'),
            'is_done' => fake()->boolean(),
            'lead_id' => \App\Models\Lead::factory(),
        ];
    }
}
