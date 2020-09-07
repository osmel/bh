<?php

namespace App;
use App\CandidatoVacante;

use Illuminate\Database\Eloquent\Model;

class Primer_contacto extends Model
{
 
   /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'candidato_vacante_id','contacto_id','intento','estatu_id','descripcion','fecha_contacto'
    ];

    protected $primaryKey = 'candidato_vacante_id';

    public function candidato_vacante() {
        return $this->belongsTo(CandidatoVacante::class);
    }
}
