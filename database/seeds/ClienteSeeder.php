<?php

use Illuminate\Database\Seeder;

class ClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
	    DB::table('clientes')->insert([
			'user_id'=>2, 
			//'logo'=>, 
			'telefono'=>'555555',
			//'puesto_id'=>,

        ]);



    }
}
