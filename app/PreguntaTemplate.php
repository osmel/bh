<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PreguntaTemplate extends Model
{
    protected $table = 'pregunta_templates';


     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'pregunta_id','template_id','dia',
    ];
}
