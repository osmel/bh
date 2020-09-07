<?php

use Illuminate\Database\Seeder;
use App\Tipo_entrevista;

class TipoEntrevistaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        	Tipo_entrevista::create([
                'nombre'=>'Primer Filtro',
                'campo'=>'primero'
            ]);            
			Tipo_entrevista::create([
                'nombre'=>'Segundo Filtro',
                'campo'=>'segundo'
            ]);            
			Tipo_entrevista::create([
                'nombre'=>'Examen psicométrico',
                'campo'=>'exampsico'
            ]);            
			Tipo_entrevista::create([
                'nombre'=>'Examen práctico',
                'campo'=>'exampractico'
                
            ]);   
			Tipo_entrevista::create([
                'nombre'=>'Tercer Filtro',
                'campo'=>'tercero'

                
            ]);            


    }
}
