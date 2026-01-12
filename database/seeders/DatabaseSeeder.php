<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Lead;
use App\Models\Task;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    
    public function run(): void
    {
        $user1 = User::factory()->create([
            'name' => 'User One',
            'email' => 'user1@example.com',
            'password' => 'password',
        ]);

        $user2 = User::factory()->create([
            'name' => 'User Two',
            'email' => 'user2@example.com',
            'password' => 'password',
        ]);

        $leads1 = Lead::factory(10)->create(['assigned_to' => $user1->id]);
        $leads2 = Lead::factory(10)->create(['assigned_to' => $user2->id]);

        $allLeads = $leads1->merge($leads2);

        Task::factory(15)->make()->each(function ($task) use ($allLeads) {
            $task->lead_id = $allLeads->random()->id;
            $task->save();
        });
    }
}
