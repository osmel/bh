<?php

namespace App;
use App\Vacante;

use Illuminate\Database\Eloquent\Model;

class Fase extends Model
{


 /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','nombre',
    ];


    public function vancantes() {
        return $this->hasMany(Vacante::class);
    }    

}
