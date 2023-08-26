<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoordinadorPublicacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coordinador_publicacion', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('coordinador_id');
            $table->unsignedBigInteger('publicacion_id');

            $table->foreign('coordinador_id')->references('id')->on('coordinadores')->onDelete('cascade');
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
        Schema::dropIfExists('coordinador_publicacion');
    }
}
