<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdjuntoVacante extends Model
{
	protected $table = 'adjunto_vacantes';


     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'adjunto_id','vacante_id','activo',
    ];
}
