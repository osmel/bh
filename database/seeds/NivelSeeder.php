<?php

use Illuminate\Database\Seeder;
use App\Nivel;
class NivelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		
	        Nivel::create([
	            'nombre'=>'Superior'
	        ]);

	        Nivel::create([
	            'nombre'=>'Medio'
	        ]);
		
        
    }
}
