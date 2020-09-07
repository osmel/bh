<?php

namespace App;

use App\CandidatoVacante;
use Illuminate\Database\Eloquent\Model;

class Estatu extends Model
{

 /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','nombre',
    ];


    public function seleccionesAdmin() {
        return $this->hasMany(CandidatoVacante::class); //,'user_id'
    }  

    public function entrevistasClientes() {
        return $this->hasMany(CandidatoVacante::class); //,'user_id'
    }  
    
}
