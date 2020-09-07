<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnalisisResultadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('analisis_resultados', function (Blueprint $table) {

            $table->integer('candidato_vacante_id')->unsigned();
            $table->primary('candidato_vacante_id');
            $table->foreign('candidato_vacante_id')->references('id')->on('candidato_vacantes')
                        ->onDelete('cascade')
                        ->onUpdate('cascade');

            $table->string('logro')->nullable(); 
            $table->string('fortaleza')->nullable(); 
            $table->string('debilidad')->nullable(); 
            $table->decimal('sueldo_final', 8, 2);    
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
        Schema::dropIfExists('analisis_resultados');
    }
}
