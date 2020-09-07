<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCandidatoFinalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidato_finals', function (Blueprint $table) {
            
            $table->integer('candidato_vacante_id')->unsigned();
            $table->primary('candidato_vacante_id');
            $table->foreign('candidato_vacante_id')->references('id')->on('candidato_vacantes')
                        ->onDelete('cascade')
                        ->onUpdate('cascade');

            $table->integer('situacion_id')->unsigned(); //relacionada "situacions"
            $table->foreign('situacion_id')->references('id')->on('situacions');
            
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
        Schema::dropIfExists('candidato_finals');
    }
}
