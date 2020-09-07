<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCandidatoVacantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidato_vacantes', function (Blueprint $table) {
            //$table->id();
            $table->increments('id');
            $table->integer('candidato_id')->unsigned();
            $table->integer('vacante_id')->unsigned();

            $table->foreign('candidato_id')->references('user_id')->on('candidatos');
            $table->foreign('vacante_id')->references('id')->on('vacantes');
            
            $table->float('sueldo', 8, 2)->nullable(); //sueldo del candidato

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
        Schema::dropIfExists('candidato_vacantes');
    }
}
