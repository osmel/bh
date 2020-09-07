<?php

namespace App;

use App\Vacante;
use Illuminate\Database\Eloquent\Model;

class Zona extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','nombre',
    ];


    public function vacantes() {
        return $this->hasMany(Vacante::class); //,'user_id'
    } 
}
