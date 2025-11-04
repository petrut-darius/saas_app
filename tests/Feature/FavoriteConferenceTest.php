<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Conference;

class FavoriteConferenceTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_favorites_a_conference() {
        $conference = Conference::factory()->create();
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route("conferences.favorite", ["conference" => $conference]));
        
        $this->assertCount(1, $user->favoritedConferences);    
        $this->assertTrue($user->favoritedConferences->pluck("id")->contains($conference->id));
    }

    public function test_unfavorites_a_conference() {
        $conference = Conference::factory()->create();
        $user = User::factory()->create();

        $user->favoritedConferences()->attach($conference);

        $response = $this->actingAs($user)->delete(route("conferences.unfavorite", ["conference" => $conference]));
        
        $this->assertCount(0, $user->favoritedConferences);    
        }
}
