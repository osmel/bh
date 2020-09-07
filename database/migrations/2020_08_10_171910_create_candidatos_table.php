<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCandidatosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidatos', function (Blueprint $table) {
            //$table->id();

            $table->integer('user_id')->unsigned();
            $table->primary('user_id');
            $table->foreign('user_id')->references('id')->on('users')
                        ->onDelete('cascade')
                        ->onUpdate('cascade');

            $table->integer('edad')->nullable();
            
            $table->integer('estado_id')->unsigned();  //relacionar candidatos con estado civil
            $table->integer('puesto_id')->unsigned();  //relacionar candidatos con nivel de estudio
            $table->integer('nivel_id')->unsigned();  //relacionar candidatos con nivel de estudio
            $table->integer('contacto_id')->unsigned();  //relacionar candidatos con medio de contacto

            $table->foreign('estado_id')->references('id')->on('estados');  
            $table->foreign('puesto_id')->references('id')->on('puestos');  
            $table->foreign('nivel_id')->references('id')->on('nivels');  
            $table->foreign('contacto_id')->references('id')->on('contactos');  


            
            $table->string('telefono1')->nullable();
            $table->string('telefono2')->nullable();
            $table->string('email2')->nullable();
            $table->text('direccion')->nullable();
            $table->string('cv')->nullable(); //curriculum vitae
            $table->string('formatoadmin')->nullable(); //formato BH
            

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
        Schema::dropIfExists('candidatos');
    }
}
