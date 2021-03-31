<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShows extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shows', function (Blueprint $table) {
            $table->id('showID');
            $table->string('title', 100);
            $table->string('year', 4);
            $table->string('rated', 10);
            $table->date('release');
            $table->unsignedSmallInteger('length');
            $table->mediumText('plot');
            $table->string('poster');
            $table->mediumText('ratings');
            $table->string('type', 10);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shows');
    }
}
