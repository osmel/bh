<?php

namespace App;
use App\Candidato;

use Illuminate\Database\Eloquent\Model;

class Contacto extends Model
{

 /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','nombre',
    ];


    public function candidatos() {
        return $this->hasMany(Candidato::class,'user_id');
    }    

    
}
