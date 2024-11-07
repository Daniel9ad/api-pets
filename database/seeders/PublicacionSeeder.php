<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class PublicacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //puiblicaciones de prueba
        $publicaciones = [
            [
                'titulo' => 'Adopción de cachorros mestizos',
                'descripcion' => 'Hermosos cachorros mestizos buscan un hogar cariñoso y responsable.',
                'raza' => 'Mestizo',
                'edad' => 2,
                'cantidad_machos' => 3,
                'cantidad_hembras' => 2,
                'telefono' => '1234567890',
                'fecha_publicacion' => Carbon::now(),
                'estado' => true,
                'usuario_id' => 1,
                'ciudad_id' => 1,
                'especie_id' => 1
            ],
            [
                'titulo' => 'Gatitos siameses en adopción',
                'descripcion' => 'Lindos gatitos de raza siamesa listos para encontrar una familia.',
                'raza' => 'Siames',
                'edad' => 3,
                'cantidad_machos' => 1,
                'cantidad_hembras' => 3,
                'telefono' => '0987654321',
                'fecha_publicacion' => Carbon::now(),
                'estado' => true,
                'usuario_id' => 2,
                'ciudad_id' => 2,
                'especie_id' => 2
            ],
            [
                'titulo' => 'Perros Golden Retriever buscan hogar',
                'descripcion' => 'Perros de raza Golden Retriever, juguetones y cariñosos, disponibles para adopción.',
                'raza' => 'Golden Retriever',
                'edad' => 4,
                'cantidad_machos' => 2,
                'cantidad_hembras' => 1,
                'telefono' => '1122334455',
                'fecha_publicacion' => Carbon::now(),
                'estado' => true,
                'usuario_id' => 3,
                'ciudad_id' => 3,
                'especie_id' => 1,                
            ],
            [
                'titulo' => 'Gatitos persas disponibles',
                'descripcion' => 'Gatitos de raza persa buscan un hogar tranquilo y amoroso.',
                'raza' => 'Persa',
                'edad' => 2,
                'cantidad_machos' => 2,
                'cantidad_hembras' => 2,
                'telefono' => '5566778899',
                'fecha_publicacion' => Carbon::now(),
                'estado' => true,
                'usuario_id' => 4,
                'ciudad_id' => 4,
                'especie_id' => 2,
            ],
        ];
        foreach ($publicaciones as $publicacion) {
            \App\Models\Publicacion::create($publicacion);
        }
    }
}
