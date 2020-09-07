<?php

use Illuminate\Database\Seeder;
use App\Estatu; 

class EstatuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


			Estatu::create([
                'nombre'=>'Seleccionado'
            ]);            
			Estatu::create([
                'nombre'=>'No Seleccionado'
            ]);            
			Estatu::create([
                'nombre'=>'Stand-By'
            ]);            
			Estatu::create([
                'nombre'=>'Cancelado'
            ]);            

        
    }
}
