<?php

use Illuminate\Database\Seeder;
use App\Tipo_vacante;

class TipoVacanteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        	Tipo_vacante::create([
                'nombre'=>'tipo vacante1'
            ]);            
			Tipo_vacante::create([
                'nombre'=>'tipo vacante2'
            ]);            
			Tipo_vacante::create([
                'nombre'=>'tipo vacante3'
            ]);            
			
    }
}
