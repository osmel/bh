<?php

use Illuminate\Database\Seeder;
use App\Contacto;

class ContactoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

		
	        Contacto::create([
	            'nombre'=>'Redes sociales'
	        ]);

	        Contacto::create([
	            'nombre'=>'Presencial'
	        ]);	        
    }
}
