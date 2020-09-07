<?php

namespace App;
use App\Vacante;

use Illuminate\Database\Eloquent\Model;

class Semaforo extends Model
{


 /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','nombre','color',
    ];


    public function vancantes() {
        return $this->hasMany(Vacante::class);
    }    



}
