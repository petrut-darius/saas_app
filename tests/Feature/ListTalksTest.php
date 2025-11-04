<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Talk;

class ListTalksTest extends TestCase
{
    /**
     * A basic test example.
     */

    use RefreshDatabase;

    public function test_lists_talks_on_the_list_talks(): void
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get("/talks");
        $response->assertOk();
    }

    public function test_lists_talks_on_the_talks_index_page() {
        $user = User::factory()->has(Talk::factory(2))->create();

        $response = $this->actingAs($user)->get("/talks")->assertSee($user->talks->first()->title);
        $response->assertOk();   
    }

    public function test_shows_basic_talk_details_on_the_talk_show_page() {
        $talk = Talk::factory()->create();

        $response = $this->actingAs($talk->author)->get(route("talks.show", ["talk" => $talk]))->assertSee($talk->title);
        $response->assertOk(); 
    }

    public function test_users_cant_see_the_talk_show_page_for_others_talks() {
        $talk = Talk::factory()->create();
        $otherUser = User::factory()->create();

        $response = $this->actingAs($otherUser)->get(route("talks.show", ["talk" => $talk]))->assertForbidden();
    }
}
