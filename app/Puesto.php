<?php

namespace App;
use App\Candidato;
use App\Cliente;

use Illuminate\Database\Eloquent\Model;

class Puesto extends Model
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

    public function clientes() {
        return $this->hasMany(Cliente::class,'user_id');
    }    
    
}
