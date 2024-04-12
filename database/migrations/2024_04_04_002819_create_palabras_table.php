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
        Schema::create('palabras', function (Blueprint $table) {
            $table->id();
            $table->string('palabra');
            $table->string('pista');
            $table->enum('direccion', ['horizontal', 'vertical']);
            $table->integer('posicion_x'); // Coordenada de inicio en el eje X
            $table->integer('posicion_y'); // Coordenada de inicio en el eje Y
            $table->timestamps();
        });
        
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('palabras');
    }
};
