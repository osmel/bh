<?php

namespace App;
use App\User;

use App\Estado;
use App\Nivel;
use App\Puesto;
use App\Contacto;
use App\Vacante;

use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;

class Candidato extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'edad', 'estado_id', 'puesto_id','nivel_id', 'contacto_id', 'telefono1','telefono2', 'email2', 'direccion','cv', 'formatoadmin',  'user_id',
    ];



    protected $primaryKey = 'user_id';


    public function user() {
      return $this->belongsTo(User::class); //,'user_id','id'
    }


	//de mucho a uno
    public function estado() {
        return $this->belongsToMany(Estado::class);
    }    

    public function nivel() {
        return $this->belongsToMany(Nivel::class);
    }    

    public function puesto() {
        return $this->belongsToMany(Puesto::class);
    }    

    public function contacto() {
        return $this->belongsToMany(Contacto::class);
    } 


    public function vacantes() {  //todas las vacantes
      return $this->belongsToMany(Vacante::class,'candidato_vacantes','candidato_id','vacante_id');
    }   


    public function vacante_activa() {  //todas las vacantes
       //Carbon::now()->format('Y-m-d'); // H:i:s

      $hoy=Carbon::now()->format('Y-m-d'); // H:i:s
      return $this->belongsToMany(Vacante::class,'candidato_vacantes','candidato_id','vacante_id')
                ->withPivot([
                      'id',
                      'candidato_id',
                      'vacante_id',
                      'sueldo',
                 ])
                ->where('vacantes.fecha','>=', $hoy );

    }   



    //Descriptor: Mostrar la fecha en formato deseado

    public function getCreatedAtAttribute($value)    { 
        return Carbon::createFromTimeStamp(strtotime($value))
                ->format("d-m-Y");
    }   
      //caso de tipo date no timestamp
    //return Carbon::createFromFormat('Y-m-d',$value)->format('d-m-Y');  

}
