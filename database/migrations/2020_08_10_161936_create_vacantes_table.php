<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVacantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vacantes', function (Blueprint $table) {
            
            $table->increments('id');
            $table->string('nombre');

            $table->integer('area_id')->unsigned();
            $table->foreign('area_id')->references('id')->on('areas');  //

            $table->integer('fase_id')->unsigned();
            $table->foreign('fase_id')->references('id')->on('fases');  //

            $table->integer('semaforo_id')->unsigned();
            $table->foreign('semaforo_id')->references('id')->on('semaforos');  //

             $table->integer('zona_id')->unsigned();  
             $table->foreign('zona_id')->references('id')->on('zonas');  
            
             $table->integer('nivel_id')->unsigned();  
             $table->foreign('nivel_id')->references('id')->on('nivels');  

             $table->integer('especialidad_id')->unsigned();  
             $table->foreign('especialidad_id')->references('id')->on('especialidads');

              
             $table->integer('tipo_vacante_id')->unsigned();  
             $table->foreign('tipo_vacante_id')->references('id')->on('tipo_vacantes');

             $table->integer('template_id')->unsigned();  
             $table->foreign('template_id')->references('id')->on('templates');

             $table->decimal('sueldo', 8, 2);   
             $table->integer('cantidad');   //cantidadPosiciones
             $table->integer('dias');   //diasPromedio
             $table->date('fecha');    //fecha_inicio
             //$table->dateTime('fecha', 0);    //fecha_inicio

             $table->text('url')->nullable();   //levantamientoInfo(url)  

             $table->text('descripcion')->nullable();   //levantamientoInfo(url)  
             
             //rangoEdad
             
             
             
             

 

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
        Schema::dropIfExists('vacantes');
    }
}
