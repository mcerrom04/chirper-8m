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

        // Memes/bulos específicos sobre el 8M y violencia de género
        $items = [
            [
                'message' => 'La mayoría de las denuncias por violencia de género son falsas, solo quieren hundir al hombre.',
                'image_url' => null,
                'explicacion' => 'Según datos de la Fiscalía General del Estado (España), las denuncias falsas representan el 0,01% del total. De millones de denuncias presentadas desde 2009, la inmensa mayoría son verídicas o se archivan por falta de pruebas, no por ser falsas.'
            ],
            [
                'message' => '¿Y para cuándo el día del hombre? ¿Por qué no existe?',
                'image_url' => null,
                'explicacion' => 'Sí existe. El Día Internacional del Hombre se celebra el 19 de noviembre. El 8-M tiene mayor repercusión mediática porque nace de una reivindicación histórica de derechos laborales y civiles que las mujeres no tenían.'
            ],
            [
                'message' => 'La brecha salarial es un mito, cobran menos porque trabajan menos horas o eligen peores trabajos.',
                'image_url' => null,
                'explicacion' => 'Existe la brecha ajustada y la no ajustada. Incluso comparando puestos de igual valor, las mujeres en la UE ganan de media un 13% menos por hora que los hombres. Además, las mujeres ocupan mayoritariamente trabajos a tiempo parcial no por elección, sino por asumir los cuidados familiares (hijos/mayores).'
            ],
            [
                'message' => 'Ni machismo ni feminismo: igualdad.',
                'image_url' => null,
                'explicacion' => 'Es un error de concepto. El machismo es una conducta de prepotencia o discriminación hacia la mujer. El feminismo es, por definición de la RAE, el principio de igualdad de derechos de la mujer y el hombre. Por tanto, si quieres igualdad, la palabra correcta es feminismo. No son términos opuestos, sino distintos.'
            ],
            [
                'message' => 'La violencia no tiene género, las mujeres también pegan.',
                'image_url' => null,
                'explicacion' => 'La violencia doméstica existe en todas direcciones, pero la violencia de género es un tipo específico que se ejerce contra la mujer por el mero hecho de serlo, utilizada históricamente como herramienta de control. Las estadísticas de la ONU y la OMS muestran que una de cada tres mujeres en el mundo ha sufrido violencia física o sexual, mayoritariamente por parte de una pareja o expareja.'
            ],
        ];

        foreach ($items as $item) {
            $users->random()->memes()->create([
                'message' => $item['message'],
                'image_url' => $item['image_url'],
                'explicacion' => $item['explicacion'],
                'created_at' => now()->subMinutes(rand(5, 1440)),
            ]);
        }
    }
}
