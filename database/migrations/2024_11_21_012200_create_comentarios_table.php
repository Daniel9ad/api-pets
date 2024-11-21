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
        /**
         * protected $fillable = [
         * 'comentario',
         * 'calificacion',
         * 'fecha',
         * 'id_usuario',
         * 'id_publicacion',
         * 'id_comentario_padre'
         * ]*;        */
        Schema::create('comentarios', function (Blueprint $table) {
            $table->id();
            $table->text('comentario');
            $table->integer('calificacion')->nullable();
            $table->date('fecha');
            $table->foreignId('id_usuario')->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('id_publicacion')->constrained('publicaciones')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('id_comentario_padre')->nullable()->constrained('comentarios')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comentarios');
    }
};
