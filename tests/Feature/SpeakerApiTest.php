<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Testing\Fluent\AssertableJson;

class SpeakerApiTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_gets_speakers(): void
    {
        User::factory(3)->create();
        $firstUser = User::first();
        $response = $this->get('/api/speakers');
        
        $response
            ->assertJson(fn (AssertableJson $json) =>
                $json
                    ->has('data', 3)
                    ->has('data.0', fn (AssertableJson $json) =>
                        $json->where('name', $firstUser->name)->etc()
                    )
            );
    }
}
