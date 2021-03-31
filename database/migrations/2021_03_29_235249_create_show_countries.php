<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShowCountries extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('show_countries', function (Blueprint $table) {
            $table->id('showCountryID');
            $table->foreignId('showID')->references('showID')->on('shows')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('countryID')->references('countryID')->on('countries')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('show_countries');
    }
}
