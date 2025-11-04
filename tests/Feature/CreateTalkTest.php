<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Talk;
use App\Enums\TalkType;

class CreateTalkTest extends TestCase
{
    /**
     * A basic test example.
     */

    use RefreshDatabase;

    public function test_user_can_create_a_talk() {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->post(route("talks.store"), [
                "title" => $title = fake()->sentence(),
                "type" => TalkType::KEYNOTE->value,
            ]);

        $response->assertRedirect(route("talks.index"));
        
        $this->assertDatabaseHas("talks", [
            "title" => $title
        ]);
    }
}
