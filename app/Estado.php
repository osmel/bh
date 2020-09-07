<?php

namespace App;
use App\Candidato;
use App\Vacante;

use Illuminate\Database\Eloquent\Model;

class Estado extends Model
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

    public function vacantes() {
        return $this->hasMany(Vacante::class,'user_id'); //
    } 


}
