<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CiudadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ciudades = [
            //ciudades de bolivia
            ['nombre' => 'La Paz'],
            ['nombre' => 'Cochabamba'],
            ['nombre' => 'Santa Cruz'],
            ['nombre' => 'Oruro'],
            ['nombre' => 'Potosí'],
            ['nombre' => 'Tarija'],
            ['nombre' => 'Sucre'],
            ['nombre' => 'Beni'],
            ['nombre' => 'Pando'],
        ];
    
        foreach ($ciudades as $ciudad) {
            \App\Models\Ciudad::create($ciudad);
        }
    }
}
