<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGameResultsTable extends Migration
{
    public function up()
    {
        Schema::create('game_results', function (Blueprint $table) {
            $table->id();
            $table->string('user_name');
            $table->integer('total_time');
            $table->integer('total_score');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('game_results');
    }
}
