<?php

namespace App;
use App\CandidatoVacante;

use Illuminate\Database\Eloquent\Model;

class Candidato_final extends Model
{
   /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'candidato_vacante_id','situacion_id'
    ];

    protected $primaryKey = 'candidato_vacante_id';

    public function candidato_vacante() {
        return $this->belongsTo(CandidatoVacante::class);
    }

}
