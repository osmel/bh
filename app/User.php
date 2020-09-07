<?php

namespace App;

use App\Role;
use App\Movimiento;
Use App\Inventario;
Use App\Cliente;
Use App\Candidato;


use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Carbon\Carbon;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','role_id','almacen_id','photo',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    //relacion de "usuario y role", devolviendome todos los campos de la tabla role
    // Puedo acceder ------>  dd($this->role->nombre_rol ); //$this->role->id
    public function role()   { 
        return $this->belongsTo(Role::class); //->withTimestamps();
    }

 
    public function esAdministrador()  {
        
        //this=tabla usuario   dd($this->id);   dd($this->email);

        if (!(isset($this->role->nombre_rol))) { //este es el caso de los usuarios exteriores q se dieron altas por fuera con rol_id=null
            return false;    
        }

        if (($this->role->nombre_rol=='admin')  || ($this->role->nombre_rol=='Almacenista') )   {
            return true;
        } 
        return false;
    }



    ////belongsTo
    /*
    public function inventario()   { 
        return $this->hasMany(Inventario::class); 
    }   


    public function movimientos()   { 
        return $this->hasMany(Movimiento::class);  //'producto_id', , 'id'
    }   
    */


    public function cliente() {
      return $this->hasOne(Cliente::class);
    }

    public function candidato() {
      return $this->hasOne(Candidato::class); //,'user_id','id'
    }


//subir imagen por ajax
public function getAvatarUrl(){
    if ($this->photo)
        return asset('images/users/'.$this->id.'.'.$this->photo);

    return asset('images/users/default.jpg');
}




    //Descriptor: Mostrar la fecha en formato deseado
    public function getCreatedAtAttribute($value)    { 
        return Carbon::createFromTimeStamp(strtotime($value))
                ->format("d-m-Y");
    }    
}
