<?php

namespace App;
use App\User;
use App\Area;
use App\Puesto;

use Illuminate\Database\Eloquent\Model;


use Illuminate\Support\Facades\Auth;

Use Illuminate\Support\Facades\Session;

class Cliente extends Model
{


  //protected $connection = 'mysql'; // User::class; //session('coneccion'); 
  //protected $table = 'xxxx';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'logo', 'telefono', 'puesto_id','user_id',
    ];

/*
public function __construct() {
    $this->connection =  Auth::user()->mibase;
}
*/
    protected $primaryKey = 'user_id';


    public function user() {
      return $this->belongsTo(User::class); //,'user_id','id'
    }

    public function areas() {
        return $this->hasMany(Area::class);
        //return (Session::get('coneccion'));
        //Auth::user()->photo; //'osmel';
        
    } 

    public function puesto() {
        return $this->belongsTo(Puesto::class);
    }    

}
