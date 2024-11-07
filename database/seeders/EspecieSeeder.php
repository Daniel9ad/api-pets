<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EspecieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //esoecies de animales de adopcion
        $especies = [
            ['nombre' => 'Perro'],
            ['nombre' => 'Gato'],
            ['nombre' => 'Ave'],
            ['nombre' => 'Conejo'],
            ['nombre' => 'Hamster'],
            ['nombre' => 'Pez'],
            ['nombre' => 'Reptil'],
            ['nombre' => 'Otro'],
        ];

        foreach ($especies as $especie) {
            \App\Models\Especie::create($especie);
        }
    }
}
