<?php

use Illuminate\Database\Seeder;

class SemaforoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

  		DB::table('semaforos')->insert([
            'nombre'=>'En proceso',
            'color'=>'blue',

        ]);

  		DB::table('semaforos')->insert([
            'nombre'=>'Concluido',
            'color'=>'green',
        ]);

  		DB::table('semaforos')->insert([
            'nombre'=>'Stand-By',
            'color'=>'yellow',
        ]);

  		DB::table('semaforos')->insert([
            'nombre'=>'Cancelado',
            'color'=>'red',
        ]);
        
    }
}
