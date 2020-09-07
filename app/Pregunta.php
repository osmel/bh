<?php

namespace App;

use App\Template;
use Illuminate\Database\Eloquent\Model;

class Pregunta extends Model
{
    protected $table = 'preguntas';
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','fase','nombre','dia',
    ];

    ////belongsToMany
    public function templates() {
        return $this->belongsToMany(Template::class,'pregunta_templates','pregunta_id'); //,'template_id'                 
    }

}
