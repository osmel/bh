<?php

use App\Template;
use Illuminate\Database\Seeder;

class TemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    		Template::create([
	            'nombre'=>'Plantilla por defecto',
	        ]);


    }
}
