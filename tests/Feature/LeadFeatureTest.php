<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Lead;

class LeadFeatureTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_cannot_view_others_leads(): void
    {
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();
        $lead = Lead::factory()->create(['assigned_to' => $user2->id]);

        $response = $this->actingAs($user1)->get(route('leads.show', $lead));

        $response->assertStatus(403);
    }

    public function test_lead_creation_validation(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('leads.store'), [
            'full_name' => '',
            'phone' => '12',
        ]);

        $response->assertSessionHasErrors(['full_name', 'phone']);
    }

    public function test_user_can_create_lead(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('leads.store'), [
            'full_name' => 'John Doe',
            'phone' => '1234567890',
            'status' => 'new',
        ]);

        $response->assertRedirect(route('leads.index'));
        $this->assertDatabaseHas('leads', ['full_name' => 'John Doe']);
    }
}
