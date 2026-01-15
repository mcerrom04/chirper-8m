<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Meme;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Memes for the created user
        $user->memes()->create([
            'image_url' => 'https://cataas.com/cat/says/Hello%20world!',
            'message' => 'Hoy recordamos a las víctimas de la violencia de género. #8M'
        ]);

        $user->memes()->create([
            'image_url' => 'https://api.memegen.link/images/buzz/memes/memes_everywhere.webp',
            'message' => '8M: Ni una menos. Solidaridad y memoria.'
        ]);

        // Anonymous meme (no user)
        Meme::create([
            'user_id' => null,
            'image_url' => 'https://cataas.com/cat',
            'message' => 'Anonymous meme sample'
        ]);
    }
}
