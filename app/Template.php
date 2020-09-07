<?php

namespace App;

use App\Vacante;
use App\Pregunta;
use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    protected $table = 'templates';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','nombre',
    ];


    public function vacantes() {
        return $this->hasMany(Vacante::class); //,'user_id'
    } 

   ////belongsToMany
    public function preguntas() {
        return $this->belongsToMany(Pregunta::class,'pregunta_templates','template_id','pregunta_id') //,'pregunta_templates','template_id'
                    ->withPivot([
                            'template_id',
                            'pregunta_id',
                            'dia',
                        ]);
            //,'pregunta_id'

    }


    /////////////// https://desarrolloweb.com/articulos/relaciones-modelos-through.html
    /*esto se aplica por ejemplo para saber el modelo q tiene un producto, q no hay una relacion directa*/
        


}
