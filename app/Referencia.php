<?php

namespace App;

Use App\Tipo_referencia;
Use App\Candidato;

use Illuminate\Database\Eloquent\Model;

class Referencia extends Model
{

/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'candidato_id', 'tipo_referencia_id', 'nombre','telefono','relacion',
    ];


    //de mucho a uno
    public function candidato()   { 
        return $this->belongsTo(Candidato::class);  ///,  '','id'
    }   

    


    public function tiporeferencia() {
        return $this->belongsTo(Tipo_referencia::class,'tipo_referencia_id');  
    }  

}
