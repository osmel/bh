<?php

use Illuminate\Database\Seeder;

class FaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

  		DB::table('fases')->insert([
            'nombre'=>'Descripción de la vacante',
        ]);

  		DB::table('fases')->insert([
            'nombre'=>'Búsqueda',
        ]);

  		DB::table('fases')->insert([
            'nombre'=>'Entrevistas y Evaluaciones',
        ]);

  		DB::table('fases')->insert([
            'nombre'=>'Selección de candidatos',
        ]);


  		DB::table('fases')->insert([
            'nombre'=>'Entrevistas con el Cliente',
        ]);

 		DB::table('fases')->insert([
            'nombre'=>'Selección de candidatos cliente',
        ]);        

 		DB::table('fases')->insert([
            'nombre'=>'Consolidación de información',
        ]);        
        
 		DB::table('fases')->insert([
            'nombre'=>'Contratación por parte del cliente',
        ]);        


    }
}
