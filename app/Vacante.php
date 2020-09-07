<?php

namespace App;
Use App\Area;
Use App\Fase;
Use App\Semaforo;
Use App\Zona;
Use App\Nivel;
Use App\Especialidad;
Use App\Adjunto;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Vacante extends Model
{

   /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre','area_id','fase_id','semaforo_id','zona_id','nivel_id','especialidad_id','tipo_vacante_id','sueldo','cantidad','dias','fecha','url','descripcion','template_id',
    ];

    protected $primaryKey = 'id';


    /*transformar el formato del dato antes de guardarlo. usando mutators
    utilizando el método createFromFormat de la clase Carbon para modificar el formato de la fecha de vencimiento que recibimos por el formulario.

    //FechaVencimiento = fecha_vencimiento

    */

    //Mutator: Guardar la fecha en formato deseado
    public function setFechaAttribute($value)    { 
        //$this->attributes['fecha'] = Carbon::now()->format('Y-m-d'); // H:i:s
        $this->attributes['fecha'] = Carbon::createFromFormat('d-m-Y',$value)->format('Y-m-d'); // H:i:s
        //config('date_format_php')
    }

    //Descriptor: Mostrar la fecha en formato deseado
    public function getFechaAttribute($value)    { 
        return Carbon::createFromFormat('Y-m-d',$value)->format('d-m-Y');
    }

    


	//de mucho a uno
    public function area() {
        return $this->belongsToMany(Area::class,'vacantes','id','area_id' );
    } 

	
    public function fase() {
        return $this->belongsToMany(Fase::class);
    } 

	
    public function semaforo() {
        return $this->belongsToMany(Semaforo::class);
    }         


    public function especialidad() {
        return $this->belongsToMany(Especialidad::class);
    }  

    public function nivel() {
        return $this->belongsToMany(Nivel::class);
    }  

    public function zona() {
        return $this->belongsToMany(Zona::class);
    }  




    ////belongsToMany
    public function adjuntos() {
         return $this->belongsToMany(Adjunto::class,'adjunto_vacantes','vacante_id','adjunto_id')
                        ->withPivot([
                            'adjunto_id',
                            'vacante_id',
                            'activo',
                        ]);                
    }


    ////belongsToMany
    public function adjuntos_activos() {
         return $this->belongsToMany(Adjunto::class,'adjunto_vacantes','vacante_id','adjunto_id')
                        ->withPivot([
                            'adjunto_id',
                            'vacante_id',
                            'activo',
                        ])
                        ->wherePivot('activo',1);
    }
    


}
