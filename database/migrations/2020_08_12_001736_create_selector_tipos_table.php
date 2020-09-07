<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSelectorTiposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('selector_tipos', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('tipo_entrevista_id')->unsigned();
            $table->foreign('tipo_entrevista_id')->references('id')->on('tipo_entrevistas');

            $table->string('nombre');

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
        Schema::dropIfExists('selector_tipos');
    }
}
