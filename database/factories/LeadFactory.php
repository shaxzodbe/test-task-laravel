<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;


class LeadFactory extends Factory
{
    
    public function definition(): array
    {
        return [
            'full_name' => fake()->name(),
            'phone' => fake()->phoneNumber(),
            'status' => fake()->randomElement(['new', 'in_progress', 'done']),
            'note' => fake()->sentence(),
            'assigned_to' => \App\Models\User::factory(),
        ];
    }
}
