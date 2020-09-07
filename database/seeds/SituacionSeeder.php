<?php

use Illuminate\Database\Seeder;
use App\Situacion; 

class SituacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

		Situacion::create([
                'nombre'=>'Cartera'
            ]);

		Situacion::create([
                'nombre'=>'Aprobado'
            ]);            		

		Situacion::create([
                'nombre'=>'Rechazado'
            ]);            		

		Situacion::create([
                'nombre'=>'Declino'
            ]);            		

		Situacion::create([
                'nombre'=>'Proceso'
            ]);            		
        
    }
}
