<?php

use App\Role; 
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
	    DB::table('roles')->insert([
            'nombre_rol'=>'admin'
        ]);

    	DB::table('roles')->insert([
            'nombre_rol'=>'Cliente'
        ]);

        DB::table('roles')->insert([
            'nombre_rol'=>'area'
        ]);

        DB::table('roles')->insert([
            'nombre_rol'=>'candidato'
        ]);


    }
}
