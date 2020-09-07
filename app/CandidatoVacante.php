<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
Use App\Vacante;

Use App\Primer_contacto;
Use App\Analisis_resultado;
Use App\Candidato_final;

use Carbon\Carbon;

class CandidatoVacante extends Model
{

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
	protected $table = 'candidato_vacantes';
    protected $primaryKey = 'id';

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'candidato_id','vacante_id','sueldo',
    ]; 


    public function vacantes_activa()
    {

        $hoy=Carbon::now()->format('Y-m-d'); // H:i:s
                
        return $this->hasMany(Vacante::class, 'id', 'vacante_id' )
                ->where('vacantes.fecha','>=', $hoy );

                //$query->where('fecha','>=', $hoy);
    }



    public function primer_contacto() {
      return $this->hasOne(Primer_contacto::class); 
    }



    public function analisis_resultado() {
      return $this->hasOne(Analisis_resultado::class); 
    }


    public function candidato_final() {
      return $this->hasOne(Candidato_final::class); 
    }

    

    

    
}
