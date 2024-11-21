<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Comentario;
use App\Models\User;
use App\Models\Publicacion;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comentario>
 */
class ComentarioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        /**
         * protected $fillable = [
         * 'comentario',
         * 'calificacion',
         * 'fecha',
         * 'id_usuario',
         * 'id_publicacion',
         * 'id_comentario_padre'
         * ]*;        */

        $id_usuario = User::inRandomOrder()->first()->id;
        $id_publicacion = Publicacion::inRandomOrder()->first()->id;
        $id_comentario_padre = Comentario::inRandomOrder()->first()->id;
        return [
            'comentario' => $this->faker->text,
            'calificacion' => $this->faker->randomNumber(5),
            'fecha' => $this->faker->date(),
            'id_usuario' => $id_usuario,
            'id_publicacion' => $id_publicacion,
            'id_comentario_padre' => $id_comentario_padre
        ];
    }
}
