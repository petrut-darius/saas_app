<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Console\Commands\ImportConferences;
use App\Models\Conference;

class ImportConferencesTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_imports_a_conference(): void
    {
        $command = new ImportConferences;
        $data = [
            "name" => "this is the name from the api",
            "_rel" => ["cfp_uri" => "v1/cfp/o1i34ion123io4n1"]
        ];

        $command->importOrUpdateConference($data);
        $first = Conference::first();
        $this->assertEquals($first->title, $data["name"]);
    }

    public function test_updates_a_conference(): void
    {
        $command = new ImportConferences;

        Conference::create([
            "title" => "original title", 
            "callingallpapers_id" => "v1/cfp/o1i34ion123io4n1"
        ]);

        $data = [
            "name" => "this is the name from the api",
            "_rel" => ["cfp_uri" => "v1/cfp/o1i34ion123io4n1"]
        ];

        $command->importOrUpdateConference($data);
        $first = Conference::first();
        $this->assertEquals($first->title, $data["name"]);
        $this->assertEquals(1, Conference::count());
    }

}
