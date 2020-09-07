<?php

use Illuminate\Database\Seeder;

class CandidatoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

	    DB::table('candidatos')->insert([
			'user_id'=>3, 
			'edad'=>20, 
			
			'telefono1'=>'555555',
			'telefono2'=>'555555',
			'email2'=>'no@gmail.com',
			'direccion'=>'direccion',
            
            'estado_id'=>1,
            'puesto_id'=>1,
            'nivel_id'=>1,
            'contacto_id'=>1,

        ]);
        


 // cv
 // formatoadmin,
 // contacto_id


    }
}

