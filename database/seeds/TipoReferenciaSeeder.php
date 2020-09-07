<?php

use Illuminate\Database\Seeder;
use App\Tipo_referencia;

class TipoReferenciaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        	Tipo_referencia::create([
                'nombre'=>'Pendiente'
            ]);            
			Tipo_referencia::create([
                'nombre'=>'Contactado'
            ]);
    }
}
