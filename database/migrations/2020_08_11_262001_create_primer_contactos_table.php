<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrimerContactosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('primer_contactos', function (Blueprint $table) {

            $table->integer('candidato_vacante_id')->unsigned();
            $table->primary('candidato_vacante_id');
            $table->foreign('candidato_vacante_id')->references('id')->on('candidato_vacantes')
                        ->onDelete('cascade')
                        ->onUpdate('cascade');

           
            $table->integer('contacto_id')->unsigned(); 
            $table->foreign('contacto_id')->references('id')->on('contactos');
            
            $table->integer('intento')->nullable();             
            
            $table->integer('estatu_id')->unsigned(); 
            $table->foreign('estatu_id')->references('id')->on('estatus');

            $table->text('descripcion')->nullable();             
            $table->date('fecha_contacto'); 

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
        Schema::dropIfExists('primer_contactos');
    }
}
