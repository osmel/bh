<?php

use Illuminate\Database\Seeder;
use App\Puesto;
class PuestoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

		foreach (range(1,2) as $index) {
	        Puesto::create([
	            'nombre'=>'puesto'.$index
	        ]);
		};
        
    }
}
