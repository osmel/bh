<?php

use App\Especialidad;
use Illuminate\Database\Seeder;

class EspecialidadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	        Especialidad::create([
	            'nombre'=>'Especiaslista A'
	        ]);

	        Especialidad::create([
	            'nombre'=>'Especiaslista B'
	        ]);
    }
}
