<?php

namespace App;
Use App\Tipo_entrevista;

use Illuminate\Database\Eloquent\Model;

class Selector_tipo extends Model
{
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre', 'tipo_entrevista_id'
    ];


    public function tipoentrevista() {
        return $this->belongsTo(Tipo_entrevista::class);  
    }  

}
