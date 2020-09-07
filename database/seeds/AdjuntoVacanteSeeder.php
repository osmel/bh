<?php

use App\AdjuntoVacante;

use Illuminate\Database\Seeder;

class AdjuntoVacanteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (range(1,2) as $vac) {
    	    foreach (range(1,11) as $index) {
        		AdjuntoVacante::create([
    	            'adjunto_id'=>$index,
                    'vacante_id'=>$vac, //por default
    	            'activo'=>0,
    	        ]);

    	    };  
        };      
        
    }
}
