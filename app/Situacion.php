<?php

namespace App;

use App\CandidatoVacante;
use Illuminate\Database\Eloquent\Model;

class Situacion extends Model
{


 /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','nombre',
    ];


    public function seleccionesCliente() {
        return $this->hasMany(CandidatoVacante::class); //,'user_id'
    }  

    
}
