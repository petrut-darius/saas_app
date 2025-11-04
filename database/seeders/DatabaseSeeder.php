<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Talk;
use App\Models\Conference;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        
        User::factory()
        ->has(Talk::factory(5))    
        ->create([
            'name' => 'Alexandra Sorlea',
            'email' => 'sorlea_alexandra@gmail.com',
            "password" => bcrypt("30ianpdi")
        ]);

        Conference::factory(5)->create();
    }
}
