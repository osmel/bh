<?php

use Illuminate\Database\Seeder;
use App\CandidatoVacante; 

class CandidatoVacanteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            CandidatoVacante::create([
                'candidato_id'=>3,
                'vacante_id'=>1, 
                'sueldo'=>10000,
                /*
                'seleccionadmin'=>'Area'.$index,
                'seleccioncliente'=>'Area'.$index,
                'entrevistacliente'=>'Area'.$index,
                'consolidacion'=>'Area'.$index,
                'contratacion'=>'Area'.$index,
                */

            ]);
    }
}
