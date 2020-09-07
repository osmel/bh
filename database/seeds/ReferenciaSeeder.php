<?php

use Illuminate\Database\Seeder;
use App\Referencia;

class ReferenciaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

		foreach (range(1,2) as $index) {
            Referencia::create([
                'nombre'=>'persona '.$index,
                'telefono'=>'5555551'.$index,
                'relacion'=>'relacion '.$index,
                'candidato_id'=>3, //$index,
                'tipo_referencia_id'=>$index, //$index,
            ]);
        }; 

        
    }
}
