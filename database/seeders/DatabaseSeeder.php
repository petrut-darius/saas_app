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
            'name' => 'Petrut Darius',
            'email' => 'eminoviciidarius@gmail.com',
        ]);

        Conference::factory(5)->create();
    }
}
