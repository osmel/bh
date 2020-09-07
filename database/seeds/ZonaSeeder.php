<?php

use App\Zona;
use Illuminate\Database\Seeder;

class ZonaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	        Zona::create([
	            'nombre'=>'Zona1'
	        ]);

	        Zona::create([
	            'nombre'=>'Zona2'
	        ]);
    }
}
