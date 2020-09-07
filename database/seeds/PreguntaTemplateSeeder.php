<?php

use App\PreguntaTemplate;
use Illuminate\Database\Seeder;

class PreguntaTemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	foreach (range(1,9) as $index) {
    		
    		PreguntaTemplate::create([
	            'pregunta_id'=>$index,
                'template_id'=>1, //por default
	            'dia'=>6
	        ]);

	    };  
    }
}
