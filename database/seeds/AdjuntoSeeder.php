<?php

use App\Adjunto;
use Illuminate\Database\Seeder;

class AdjuntoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
   			Adjunto::create([
	            'nombre'=>'Acta de nacimiento(jpg y pdf)',
	            'orden'=>'1'
	        ]);

   			Adjunto::create([
	            'nombre'=>'Estado civil: Soltero/Casado/Unión Libre(Selección)',
	            'orden'=>'2'
	        ]);

   			Adjunto::create([
	            'nombre'=>'RFC (jpg y pdf)',
	            'orden'=>'3'
	        ]);

   			Adjunto::create([
	            'nombre'=>'CURP (jpg y pdf)',
	            'orden'=>'4'
	        ]);

   			Adjunto::create([
	            'nombre'=>'Carta de recomendación(2) (jpg y pdf)',
	            'orden'=>'5'
	        ]);

   			Adjunto::create([
	            'nombre'=>'Comprobante de estudios (jpg y pdf)',
	            'orden'=>'6'
	        ]);

   			Adjunto::create([
	            'nombre'=>'Hoja de IMSS con NSS (jpg y pdf)',
	            'orden'=>'7'
	        ]);

   			Adjunto::create([
	            'nombre'=>'Copia de INE por ambos lados (jpg y pdf)',
	            'orden'=>'8'
	        ]);

   			Adjunto::create([
	            'nombre'=>'Comprobante de domicilio (jpg y pdf)',
	            'orden'=>'9'
	        ]);

   			Adjunto::create([
	            'nombre'=>'Referencias personales',
	            'orden'=>'10'
	        ]);

   			Adjunto::create([
	            'nombre'=>'Fotografía digital (jpg y pdf)',
	            'orden'=>'11'
	        ]);





    }
}
