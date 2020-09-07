<?php

use App\Area; 
use Illuminate\Database\Seeder;

class AreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (range(1,2) as $index) {
            Area::create([
                'nombre'=>'Area'.$index,
                'user_id'=>2, //$index,
            ]);
        };           
    }
}
