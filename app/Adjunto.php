<?php

use App\Vacante;
namespace App;

use Illuminate\Database\Eloquent\Model;

class Adjunto extends Model
{

    protected $table = 'adjuntos';
    protected $fillable = [
        'id','nombre','orden',
    ];

    ////belongsToMany
    public function vacantes() {
        return $this->belongsToMany(Vacante::class,'adjunto_vacantes','adjunto_id','vacante_id')
        				->withPivot([
                            'adjunto_id',
                            'vacante_id',
                            'activo',
                        ]);
    }

}
