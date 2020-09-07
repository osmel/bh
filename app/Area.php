<?php

namespace App;
Use App\Cliente;
Use App\Vacante;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{

/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre', 'user_id'
    ];


    //de mucho a uno
    public function cliente()   { 
        return $this->belongsTo(Cliente::class,'user_id','user_id');  ///,  '','id'
    }   

    


    public function vacantes() {
        return $this->hasMany(Vacante::class);
    }  


}
