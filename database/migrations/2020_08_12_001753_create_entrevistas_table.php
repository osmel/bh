<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntrevistasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entrevistas', function (Blueprint $table) {

            $table->increments('id');
            $table->integer('candidato_vacante_id')->unsigned();
            //$table->primary('candidato_vacante_id');
            $table->foreign('candidato_vacante_id')->references('id')->on('candidato_vacantes')
                        ->onDelete('cascade')
                        ->onUpdate('cascade');

            
            $table->integer('tipo_entrevista_id')->unsigned();
            $table->unique(['candidato_vacante_id','tipo_entrevista_id']);
            
            $table->foreign('tipo_entrevista_id')->references('id')->on('tipo_entrevistas');


            $table->text('comentario')->nullable();
            
            $table->date('fecha')->nullable();
            $table->string('adjunto')->nullable();

            $table->integer('selector_tipo_id')->unsigned();
            $table->foreign('selector_tipo_id')->references('id')->on('selector_tipos');
            

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
        Schema::dropIfExists('entrevistas');
    }
}
