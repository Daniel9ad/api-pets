<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('publicaciones', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->text('descripcion');
            $table->string('raza');
            $table->integer('edad');
            $table->integer('cantidad_machos');
            $table->integer('cantidad_hembras');
            $table->string('telefono');
            $table->date('fecha_publicacion')->default(DB::raw('CURRENT_DATE'));
            $table->boolean('estado')->default(true);
            $table->foreignId('usuario_id')->constrained('usuarios');
            $table->foreignId('ciudad_id')->constrained('ciudades');
            $table->foreignId('especie_id')->constrained('especies');
            $table->timestamps();                        
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('publicaciones');
    }
};
