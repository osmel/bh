<?php

use Illuminate\Database\Seeder;
use App\Estado;
class EstadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
		
	        Estado::create([
	            'nombre'=>'Casado'
	        ]);

	        Estado::create([
	            'nombre'=>'Soltero'
	        ]);		

    }
}
