<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            //$table->id();
            $table->integer('user_id')->unsigned();
            $table->primary('user_id');
            $table->foreign('user_id')->references('id')->on('users')
                                    ->onDelete('cascade')
                                    ->onUpdate('cascade');


            //cliente
            $table->string('logo')->nullable(); //imagen de la empresa
            $table->string('telefono')->nullable();
            $table->string('puesto_id')->nullable();  //relacionar usuarios con puesto de trabajo
            //$table->string('area_id')->nullable(); //relacionar usuarios con areas
            //$table->integer('almacen_id')->nullable(); //relacionar usuarios con almacenes


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
        Schema::dropIfExists('clientes');
    }
}
