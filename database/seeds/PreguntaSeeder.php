<?php

use App\Pregunta;
use Illuminate\Database\Seeder;

class PreguntaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    		Pregunta::create([
	            'fase'=>0,
	            'nombre'=>'Levantamiento de información',
	            'dia'=>'3'
	        ]);

	        Pregunta::create([
	            'fase'=>1,
	            'nombre'=>'Descripción de la vacante',
	            'dia'=>'3'
	        ]);

	        Pregunta::create([
	            'fase'=>2,
	            'nombre'=>'Búsqueda',
	            'dia'=>'3'
	        ]);

	        Pregunta::create([
	            'fase'=>3,
	            'nombre'=>'Entrevistas y Evaluaciones',
	            'dia'=>'3'
	        ]);

	        Pregunta::create([
	            'fase'=>4,
	            'nombre'=>'Selección de candidatos',
	            'dia'=>'3'
	        ]);

	        Pregunta::create([
	            'fase'=>5,
	            'nombre'=>'Entrevista con cliente',
	            'dia'=>'3'
	        ]);

	        Pregunta::create([
	            'fase'=>6,
	            'nombre'=>'Selección de candidatos/Cliente',
	            'dia'=>'3'
	        ]);

	        Pregunta::create([
	            'fase'=>7,
	            'nombre'=>'Consolidación de información',
	            'dia'=>'3'
	        ]);

	        Pregunta::create([
	            'fase'=>8,
	            'nombre'=>'Contratación por Cliente',
	            'dia'=>'3'
	        ]);
    }
}
