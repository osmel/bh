<?php

namespace App;
Use App\Tipo_entrevista;
Use App\Candidato;

use App\CandidatoVacante;

use Illuminate\Database\Eloquent\Model;

class Entrevista extends Model
{

/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'candidato_vacante_id', 'tipo_entrevista_id', 'comentario','selector_tipo_id','fecha','adjunto'
    ];

        //protected $primaryKey = 'candidato_vacante_id';
        protected $primaryKey = 'id';
        //protected $primaryKey = ['candidato_vacante_id', 'tipo_entrevista_id'];
        //public $incrementing = false;

    //de mucho a uno
    /* creo q va hacer "a travez de "
    public function candidato()   { 
        return $this->belongsTo(Candidato::class);  ///,  '','id'
    } 
    */  

    


    public function tipoentrevista() {
        return $this->belongsTo(Tipo_entrevista::class);  
    }  

   

    public function candidato_vacante() {
        return $this->belongsTo(CandidatoVacante::class);
    }        

    
}
