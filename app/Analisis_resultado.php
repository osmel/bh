<?php

namespace App;
use App\CandidatoVacante;

use Illuminate\Database\Eloquent\Model;

class Analisis_resultado extends Model
{
   /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'candidato_vacante_id','logro','fortaleza','debilidad','sueldo_final'
    ];

    protected $primaryKey = 'candidato_vacante_id';

    public function candidato_vacante() {
        return $this->belongsTo(CandidatoVacante::class);
    }    
}
