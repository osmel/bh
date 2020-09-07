<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReferenciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('referencias', function (Blueprint $table) {


            $table->increments('id');

            
            $table->integer('candidato_id')->unsigned();
            $table->integer('tipo_referencia_id')->unsigned();

            $table->foreign('candidato_id')->references('user_id')->on('candidatos');
            $table->foreign('tipo_referencia_id')->references('id')->on('tipo_referencias');

            $table->string('nombre');
            $table->string('telefono');
            $table->string('relacion');
            
            
            
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
        Schema::dropIfExists('referencias');
    }
}
