<?php

use Illuminate\Database\Seeder;
use App\Selector_tipo;

class SelectorTipoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
			Selector_tipo::create([
                'nombre'=>'Procede',
                'tipo_entrevista_id'=>1
            ]);      	
			Selector_tipo::create([
                'nombre'=>'No Procede',
                'tipo_entrevista_id'=>1
            ]);      	            


			Selector_tipo::create([
                'nombre'=>'Procede',
                'tipo_entrevista_id'=>2
            ]);      	
			Selector_tipo::create([
                'nombre'=>'No Procede',
                'tipo_entrevista_id'=>2
            ]);      	            

			Selector_tipo::create([
                'nombre'=>'Nivel 1',
                'tipo_entrevista_id'=>3
            ]);      	
			Selector_tipo::create([
                'nombre'=>'Nivel 2',
                'tipo_entrevista_id'=>3
            ]);      	            


			Selector_tipo::create([
                'nombre'=>'Calificación 1',
                'tipo_entrevista_id'=>4
            ]);      	
			Selector_tipo::create([
                'nombre'=>'Calificación 2',
                'tipo_entrevista_id'=>4
            ]);      	          

			Selector_tipo::create([
                'nombre'=>'Procede',
                'tipo_entrevista_id'=>5
            ]);      	
			Selector_tipo::create([
                'nombre'=>'No Procede',
                'tipo_entrevista_id'=>5
            ]);      	            



        
    }
}
