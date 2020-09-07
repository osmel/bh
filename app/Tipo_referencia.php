<?php

namespace App;
use App\Referencia;

use Illuminate\Database\Eloquent\Model;

class Tipo_referencia extends Model
{
   /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','nombre',
    ];


    public function referencias() {
        return $this->hasMany(Referencia::class); //,'user_id'
    }   
}
