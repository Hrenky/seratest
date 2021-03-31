<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShowLanguage extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('show_language', function (Blueprint $table) {
            $table->id('showLangID');
            $table->foreignId('showID')->references('showID')->on('shows')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('langID')->references('langID')->on('languages')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('show_language');
    }
}
