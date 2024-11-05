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
        Schema::create('publicacions', function (Blueprint $table) {
            $table->id('id_publicacion');              
            $table->string('id_usuario');
            // foreignId('id_usuario') ->constrained('usuarios')  ->onDelete('cascade');
            $table->string('id_mascota');
            // foreignId('id_mascota')->constrained('mascotas') ->onDelete('cascade');
            $table->string('titulo');                 
            $table->text('descripcion');               
            $table->string('tipo_publicacion');          //  "adoptar", "dar en adopción"
            $table->date('fecha_publicacion');        
            $table->string('estado');                    //  "disponible", "adoptado"
            $table->timestamps();                        
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('publicacions');
    }
};
