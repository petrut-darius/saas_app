<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Talk;
use App\Enums\TalkType;

class UpdateTalkTest extends TestCase
{
    /**
     * A basic test example.
     */

    use RefreshDatabase;

    public function test_user_can_update_thier_talk() {
        $talk = Talk::factory()->create();

        $response = $this
            ->actingAs($talk->author)
            ->patch(route("talks.update", ["talk" => $talk]), [
                "title" => "title updated here",
                "type" => TalkType::KEYNOTE->value
            ]);



        $response->assertSessionHasNoErrors()->assertRedirect(route("talks.show", ["talk" => $talk]));
        
        $this->assertEquals("title updated here", $talk->refresh()->title);
    }

    public function test_user_canot_update_another_users_talk() {
        $talk = Talk::factory()->create();
        $originalTitle = $talk->title;
        $otherUser = User::factory()->create();

        $response = $this
            ->actingAs($otherUser)
            ->patch(route("talks.update", ["talk" => $talk]), [
                "title" => "title updated here",
                "type" => TalkType::KEYNOTE->value
            ]);



        $response->assertForbidden();
        
        $this->assertEquals($originalTitle, $talk->refresh()->title);
    }
}
