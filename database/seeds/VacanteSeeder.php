<?php

use App\Vacante; 
use Illuminate\Database\Seeder;
use Carbon\Carbon;
class VacanteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        foreach (range(1,2) as $index) {
            Vacante::create([
                'nombre'=>'Vacante'.$index,
                'area_id'=>1, //$index,
                'fase_id'=>1, //$index,
                'semaforo_id'=>1, //$index,
                'zona_id'=>1, //$index,
                'especialidad_id'=>1, //$index,
                'nivel_id'=>1, //$index,
                'tipo_vacante_id'=>1, //$index,
                'sueldo'=>100*$index,
                'cantidad'=>$index,
                'dias'=>10*$index,
                'fecha'=>'02-02-2012',
                'template_id'=>1, //$index,
                'descripcion'=>'descripcion etc',
                    
                 
                
                //'url'=>nulo,
                //descripcion

            ]);
        };  

        
    }
}
