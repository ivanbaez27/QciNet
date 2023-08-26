<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarreraPublicacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carrera_publicacion', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('carrera_id');
            $table->unsignedBigInteger('publicacion_id');

            $table->foreign('carrera_id')->references('id')->on('carreras')->onDelete('cascade');
            $table->foreign('publicacion_id')->references('id')->on('publicaciones')->onDelete('cascade');
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
        Schema::dropIfExists('carrera_publicacion');
    }
}
