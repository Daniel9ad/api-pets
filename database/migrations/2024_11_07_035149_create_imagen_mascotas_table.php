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
        // Schema::create('imagen_mascotas', function (Blueprint $table) {
        //     $table->id();
        //     $table->unsignedBigInteger('id_publicacion');
        //     $table->string('urlIMG');
        //     $table->timestamps();

        //     $table->foreign('id_publicacion')->references('id')->on('publicaciones_2');

        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::dropIfExists('imagen_mascotas');
    }
};
