<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Descuento extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre','valor',
    ];

}