<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassesProfesseuresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classes_professeures', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idClass')->foreign('idClass')->references('id')->on('classes');
            $table->integer('idProf')->foreign('idProf')->references('id')->on('professeures');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('classes_professeures');
    }
}
