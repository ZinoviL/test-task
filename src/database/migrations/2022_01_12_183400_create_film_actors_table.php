<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilmActorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('film_actors', function (Blueprint $table) {
            $table->unsignedBigInteger('film_id');
            $table->unsignedBigInteger('actor_id');

            $table->foreign('actor_id')->references('id')->on('actors')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('film_id')->references('id')->on('films')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('film_actors');
    }
}
