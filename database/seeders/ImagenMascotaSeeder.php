<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ImagenMascota;

class ImagenMascotaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Imágenes de prueba para las publicaciones
        $imagenes = [
            [
                'id_publicacion' => 1,
                'urlIMG' => 'https://example.com/images/cachorro1.jpg',
            ],
            [
                'id_publicacion' => 1,
                'urlIMG' => 'https://example.com/images/cachorro2.jpg',
            ],
            [
                'id_publicacion' => 2,
                'urlIMG' => 'https://example.com/images/gatito1.jpg',
            ],
            [
                'id_publicacion' => 2,
                'urlIMG' => 'https://example.com/images/gatito2.jpg',
            ],
            [
                'id_publicacion' => 3,
                'urlIMG' => 'https://example.com/images/golden1.jpg',
            ],
            [
                'id_publicacion' => 4,
                'urlIMG' => 'https://example.com/images/persa1.jpg',
            ],
        ];

        foreach ($imagenes as $imagen) {
            ImagenMascota::create($imagen);
        }
    }
}
