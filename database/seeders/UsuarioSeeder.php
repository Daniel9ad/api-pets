<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //usuarios de prueba
        $usuarios = [
            [
                'nombre' => 'Juan',
                'apellido' => 'Perez',
                'email' => 'juanperez@email.com',
                'password' => Hash::make('123456'),
                'telefono' => '1234567890',
            ],
            [
                'nombre' => 'Maria',
                'apellido' => 'Gomez',
                'email' => 'mariagomez@email.com',
                'password' => Hash::make('654321'),
                'telefono' => '0987654321',
            ],
            [
                'nombre' => 'Pedro',
                'apellido' => 'Rodriguez',
                'email' => 'pedrorodriguez@email.com',
                'password' => Hash::make('123654'),
                'telefono' => '147852369',
            ],
            [
                'nombre' => 'Ana',
                'apellido' => 'Martinez',
                'email' => 'anamartinez@email.com',
                'password' => Hash::make('456321'),
                'telefono' => '963852741',
            ]
        ];

        foreach ($usuarios as $usuario) {
            \App\Models\Usuario::create($usuario);
        }
    }
}
