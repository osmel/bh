<?php

namespace App;

use App\Entrevista;
use Illuminate\Database\Eloquent\Model;

class Tipo_entrevista extends Model
{


 /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','nombre',
    ];


    public function entrevistas() {
        return $this->hasMany(Entrevista::class); //,'user_id'
    }    

    
}
