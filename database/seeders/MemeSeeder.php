<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Meme;
use Illuminate\Database\Seeder;

class MemeSeeder extends Seeder
{
    public function run(): void
    {
        // Ensure we have at least 3 users
        $users = User::count() < 3
            ? collect([
                User::create([
                    'name' => 'Alice Developer',
                    'email' => 'alice@example.com',
                    'password' => bcrypt('password'),
                ]),
                User::create([
                    'name' => 'Bob Builder',
                    'email' => 'bob@example.com',
                    'password' => bcrypt('password'),
                ]),
                User::create([
                    'name' => 'Charlie Coder',
                    'email' => 'charlie@example.com',
                    'password' => bcrypt('password'),
                ]),
            ])
            : User::take(3)->get();

        // Deterministic list: each message has a dedicated image
        $items = [
            [
                'message' => 'Hoy recordamos a las víctimas de la violencia de género. #8M #NiUnaMenos',
                'image_url' => 'https://cataas.com/cat/says/Recordamos%20a%20las%20víctimas'
            ],
            [
                'message' => '8M: Solidaridad y lucha contra la violencia machista.',
                'image_url' => 'https://api.memegen.link/images/buzz/8m/solidaridad.webp'
            ],
            [
                'message' => 'No estás sola. Apoyemos a las supervivientes.',
                'image_url' => 'https://cataas.com/cat/says/No%20estas%20sola'
            ],
            [
                'message' => 'La igualdad es imprescindible. #8M',
                'image_url' => 'https://api.memegen.link/images/buzz/igualdad/igualdad.webp'
            ],
            [
                'message' => 'Rompe el silencio, denuncia la violencia de género.',
                'image_url' => 'https://cataas.com/cat/says/Rompe%20el%20silencio'
            ],
            [
                'message' => 'Educar para prevenir: la violencia no tiene excusa.',
                'image_url' => 'https://api.memegen.link/images/buzz/educar/prevenir.webp'
            ],
        ];

        foreach ($items as $item) {
            $users->random()->memes()->create([
                'message' => $item['message'],
                'image_url' => $item['image_url'],
                'created_at' => now()->subMinutes(rand(5, 1440)),
            ]);
        }

        // A couple of explicit anonymous memes with fixed images
        Meme::create([
            'user_id' => null,
            'image_url' => 'https://cataas.com/cat/says/Anonimo%201',
            'message' => '8M: Ni una menos. Solidaridad y memoria.'
        ]);

        Meme::create([
            'user_id' => null,
            'image_url' => 'https://api.memegen.link/images/buzz/anon/anon2.webp',
            'message' => '8M: Ni una menos. Solidaridad y memoria.'
        ]);
    }
}
