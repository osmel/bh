<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdjuntoVacantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adjunto_vacantes', function (Blueprint $table) {

            $table->increments('id');
           
            $table->integer('adjunto_id')->unsigned();
            $table->integer('vacante_id')->unsigned();

            $table->foreign('adjunto_id')->references('id')->on('adjuntos')->onDelete('cascade');
            $table->foreign('vacante_id')->references('id')->on('vacantes')->onDelete('cascade');

            $table->boolean('activo');

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
        Schema::dropIfExists('adjunto_vacantes');
    }
}
