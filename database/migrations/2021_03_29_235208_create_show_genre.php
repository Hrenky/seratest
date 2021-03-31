<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShowGenre extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('show_genre', function (Blueprint $table) {
            $table->id('showGenreID');
            $table->foreignId('showID')->references('showID')->on('shows')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('genreID')->references('genreID')->on('genres')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('show_genre');
    }
}
