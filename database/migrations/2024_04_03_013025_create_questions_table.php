<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsTable extends Migration
{
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->text('question'); // La pregunta en sí
            $table->string('option_a'); // Opción A
            $table->string('option_b'); // Opción B
            $table->string('option_c'); // Opción C
            $table->string('option_d'); // Opción D
            $table->char('correct_answer', 1); // La letra de la respuesta correcta (A, B, C, o D)
            $table->timestamps(); // Marcas de tiempo para created_at y updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('questions');
    }
}
