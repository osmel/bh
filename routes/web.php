<?php

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder; 

use App\User;
use App\Role as Perfil;
use App\Area;
use App\Puesto;
use App\Situacion;
use App\Estatu;
use App\Semaforo;
use App\Fase;
use App\Tipo_entrevista;

use App\Tipo_vacante;
use App\Vacante;
use App\Candidato;
use App\Entrevista;


use App\Zona;
use App\Especialidad;
use App\Nivel;
use App\Estado;

use App\Template;
use App\Pregunta;

use App\Adjunto;

use App\Contacto;
use App\Tipo_referencia;
use App\Referencia;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


//Route::get('/proyecto/{id}/imagenes', 'InicioController@index');
//Route::post('/proyecto/{id}/imagenes', 'InicioController@upload');

//Route::get('/', 'InicioController@create');
//Route::get('/images-show', 'InicioController@index');

//aqui adentro pongo todas las rutas
Route::group(['middleware' => ['idiomas']], function () {
     //throw new ModelNotFoundException('User not found by ID ' . $user_id);


	Route::get('lang/{lang}', function ($lang) {
        session(['lang' => $lang]);
        return \Redirect::back();
    })->where([ //Limito el valor del parámetro {lang} solo a «en» o «es» para evitar que se asigne a la variable de sesión un idioma que no exista.
        'lang' => 'en|es'  //
    ]);


    //Route::get('/', 'HomeController@index')
    //->name('home');

	
	Route::get('/', 'InicioController@dashboard')
    ->name('inicio');
    

    Route::get('/estudiante', 'ClienteController@dashboard');

    Route::POST('/pagina',  'InicioController@condiciones');


/////////////////////////////////gestion de Usuarios//////////////////
    Route::get('/usuarios', 'InicioController@index')
    ->name('users.index');

       //nuevo
    Route::get('/usuarios/nuevo', 'InicioController@create') //crear nuevo usuario
        ->name('users.create');
    Route::POST('/usuarios/crear', 'InicioController@store') //validacion creacion de nuevo usuario
        ->name('users.crear');

        //editar
    Route::get('/usuarios/{user}/editar', 'InicioController@edit') //editar usuario
        ->name('users.edit');
    Route::put('/usuarios/{user}', 'InicioController@update'); //validacion edicion de usuario

       //eliminar    
    Route::get('/eliminar_usuario/{user}', 'InicioController@eliminar_usuario');
    //Route::delete('/usuarios/{user}', 'InicioController@destroy')->name('users.destroy');


    ///////subir logo
    //Route::post('/perfil/foto', 'InicioController@updatePhoto');

    Route::put('/usuarios/{user}/logo', 'InicioController@updatePhoto'); //validacion edicion de usuario

//resultados para la tabla
    //https://yajrabox.com/docs/laravel-datatables/master/engine-eloquent 
    
 
   Route::get('usuarios/tabla_usuario', function () {
        $data = request()->all();
        
        $usuario= User::with(['role'])
        ->where('role_id',1)->get(); 
          return datatables()
            ->of($usuario)->make(true);
    });



    ///////galeria
    Route::post('/images-save', 'InicioController@upload_image');
    

    Route::post('/images-delete', 'InicioController@destroy_image');

//////////////////////////////////////////////////////////////////
/////////////////////////////////gestion de clientes////////////////// 
//////////////////////////////////////////////////////////////////

    Route::get('/clientes', 'InicioController@index_cliente')
    ->name('clientes.index');

   //nuevo
    Route::get('/clientes/nuevo', 'InicioController@create_cliente') 
        ->name('clientes.create');
    Route::POST('/clientes/crear', 'InicioController@store_cliente') 
        ->name('clientes.crear');

        //editar
    Route::get('/clientes/{user}/editar', 'InicioController@edit_cliente') 
        ->name('clientes.edit');
    Route::put('/clientes/{user}', 'InicioController@update_cliente'); 

       //eliminar    
    Route::get('/eliminar_cliente/{user}', 'InicioController@eliminar_cliente');


    
    //https://yajrabox.com/docs/laravel-datatables/master/engine-eloquent 
    Route::get('clientes/tabla_cliente', function () {
        $data = request()->all();
        $cliente= User::
           with([
               'cliente' => function($query)  { //use ($busq)
                   $query->with('puesto'); 
               },   
           ]) 
          ->where('role_id',2)->get(); 


          return datatables()
            ->of($cliente)->make(true);
    });


//////////////////////////////////////////////////////////////////
/////////////////////////////////gestion de candidatos//////////////////
//////////////////////////////////////////////////////////////////

    Route::get('/candidatos', 'InicioController@index_candidato')
    ->name('candidatos.index');

   //nuevo
    Route::get('/candidatos/nuevo', 'InicioController@create_candidato') 
        ->name('candidatos.create');
    Route::POST('/candidatos/crear', 'InicioController@store_candidato') 
        ->name('candidatos.crear');

        //editar
    Route::get('/candidatos/{user}/editar', 'InicioController@edit_candidato') 
        ->name('candidatos.edit');
    Route::put('/candidatos/{user}', 'InicioController@update_candidato'); 

       //eliminar    
    Route::get('/eliminar_candidato/{user}', 'InicioController@eliminar_candidato');


    
    
    Route::get('candidatos/tabla_candidato', function () {
        $data = request()->all();
        $candidato= User::with([
               'candidato' => function($query)  { //use ($busq)
                   $query->with('vacante_activa'); 
               },   
           ]) 
            ->where('role_id',4)->get(); 

          return datatables()
            ->of($candidato)->make(true);
    });


    Route::get('candidatos/adjunto_devacante/{identificador}', function($identificador){
        $data = request()->all();
          $adjunto= Vacante::with([
               'adjuntos_activos' 
           ])->where('id',$identificador)
                    ->get(); 
          return datatables()
            ->of($adjunto)->make(true);        

      
    });


        
////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////catalogos///////////////////////////////
////////////////////////////////////////////////////////////////////////////////


////////////////////////////////////////Perfiles//////////////////

     Route::get('/perfiles', 'CatalogosController@index_perfil')
    ->name('perfiles.index');


       //nuevo
    Route::get('/perfiles/nuevo', 'CatalogosController@create_perfil') //crear nuevo perfil
        ->name('perfiles.create');
    Route::POST('/perfiles/crear', 'CatalogosController@store_perfil') //validacion creacion de nuevo perfil
        ->name('perfiles.crear');

        //editar
    Route::get('/perfiles/{perfil}/editar', 'CatalogosController@edit_perfil') //editar perfil
        ->name('perfiles.edit');
    Route::put('/perfiles/{perfil}', 'CatalogosController@update_perfil'); //validacion edicion de perfil

       //eliminar    
    Route::get('/eliminar_perfil/{perfil}', 'CatalogosController@eliminar_perfil');



  Route::get('api/resultado_perfiles', function () {
        $data = request()->all();

      return datatables()
            ->eloquent(Perfil::query())
            ->filter(function ($query) {
                $cadena = request('search')['value'];                
                if ($cadena!='') {
                    $query->where('nombre_rol', 'like', "%" . request('search')['value'] . "%");
                    
                }
                

            })
            ->toJson();
    });


///////////////////////////////////////areas/////////////////////////////////



     Route::get('/areas', 'CatalogosController@index_area')
    ->name('areas.index');


       //nuevo
    Route::get('/areas/nuevo', 'CatalogosController@create_area') //crear nuevo area
        ->name('areas.create');
    Route::POST('/areas/crear', 'CatalogosController@store_area') //validacion creacion de nuevo area
        ->name('areas.crear');

        //editar
    Route::get('/areas/{area}/editar', 'CatalogosController@edit_area') //editar area
        ->name('areas.edit');
    Route::put('/areas/{area}', 'CatalogosController@update_area'); //validacion edicion de area

       //eliminar    
    Route::get('/eliminar_area/{area}', 'CatalogosController@eliminar_area');

    Route::get('api/resultado_areas', function () {
            $busq = request('search')['value']; 
            
            $areas = area::with([
               'cliente' => function($query) use ($busq) {
                   $query->with('user'); //select('*')
                        /*->Where(function ($query) use($busq) {
                            $query->orwhere('cliente.users_id', 'like',  '%' . $busq .'%');
                        });*/
               },   
               

           ]);
           

            return DataTables::eloquent($areas)
                    ->addIndexColumn()
                        ->filter(function ($query) use ($busq) {  
                            return true; //ya verifique encima
                        })
                        
                    ->addColumn('cliente', function($row){
                        return $row->cliente; //->telefono; //user->name;
                    })
                    ->addColumn('user', function($row){
                        return $row->cliente->user; //->telefono; //user->name;
                    })                    
                    
                   ->toJson();
    });            

  /*
  Route::get('api/resultado_areas2', function () {
        $data = request()->all();

      return datatables()
            ->eloquent(area::query())
            ->filter(function ($query) {
                $cadena = request('search')['value'];                
                if ($cadena!='') {
                    $query->where('nombre', 'like', "%" . request('search')['value'] . "%");
                    
                }
                

            })
            ->toJson();
    });
*/
///////////////////////////////////////puestos/////////////////////////////////



     Route::get('/puestos', 'CatalogosController@index_puesto')
    ->name('puestos.index');


       //nuevo
    Route::get('/puestos/nuevo', 'CatalogosController@create_puesto') //crear nuevo puesto
        ->name('puestos.create');
    Route::POST('/puestos/crear', 'CatalogosController@store_puesto') //validacion creacion de nuevo puesto
        ->name('puestos.crear');

        //editar
    Route::get('/puestos/{puesto}/editar', 'CatalogosController@edit_puesto') //editar puesto
        ->name('puestos.edit');
    Route::put('/puestos/{puesto}', 'CatalogosController@update_puesto'); //validacion edicion de puesto

       //eliminar    
    Route::get('/eliminar_puesto/{puesto}', 'CatalogosController@eliminar_puesto');


  Route::get('api/resultado_puestos', function () {
        $data = request()->all();

      return datatables()
            ->eloquent(puesto::query())
            ->filter(function ($query) {
                $cadena = request('search')['value'];                
                if ($cadena!='') {
                    $query->where('nombre_rol', 'like', "%" . request('search')['value'] . "%");
                    
                }
                

            })
            ->toJson();
    });



///////////////////////////////////////situacions/////////////////////////////////



     Route::get('/situacions', 'CatalogosController@index_situacion')
    ->name('situacions.index');


       //nuevo
    Route::get('/situacions/nuevo', 'CatalogosController@create_situacion') //crear nuevo situacion
        ->name('situacions.create');
    Route::POST('/situacions/crear', 'CatalogosController@store_situacion') //validacion creacion de nuevo situacion
        ->name('situacions.crear');

        //editar
    Route::get('/situacions/{situacion}/editar', 'CatalogosController@edit_situacion') //editar situacion
        ->name('situacions.edit');
    Route::put('/situacions/{situacion}', 'CatalogosController@update_situacion'); //validacion edicion de situacion

       //eliminar    
    Route::get('/eliminar_situacion/{situacion}', 'CatalogosController@eliminar_situacion');


  Route::get('api/resultado_situacions', function () {
        $data = request()->all();

      return datatables()
            ->eloquent(situacion::query())
            ->filter(function ($query) {
                $cadena = request('search')['value'];                
                if ($cadena!='') {
                    $query->where('nombre_rol', 'like', "%" . request('search')['value'] . "%");
                    
                }
                

            })
            ->toJson();
    });

///////////////////////////////////////estatus/////////////////////////////////



     Route::get('/estatus', 'CatalogosController@index_estatu')
    ->name('estatus.index');


       //nuevo
    Route::get('/estatus/nuevo', 'CatalogosController@create_estatu') //crear nuevo estatu
        ->name('estatus.create');
    Route::POST('/estatus/crear', 'CatalogosController@store_estatu') //validacion creacion de nuevo estatu
        ->name('estatus.crear');

        //editar
    Route::get('/estatus/{estatu}/editar', 'CatalogosController@edit_estatu') //editar estatu
        ->name('estatus.edit');
    Route::put('/estatus/{estatu}', 'CatalogosController@update_estatu'); //validacion edicion de estatu

       //eliminar    
    Route::get('/eliminar_estatu/{estatu}', 'CatalogosController@eliminar_estatu');


  Route::get('api/resultado_estatus', function () {
        $data = request()->all();

      return datatables()
            ->eloquent(estatu::query())
            ->filter(function ($query) {
                $cadena = request('search')['value'];                
                if ($cadena!='') {
                    $query->where('nombre_rol', 'like', "%" . request('search')['value'] . "%");
                    
                }
                

            })
            ->toJson();
    });


///////////////////////////////////////semaforos/////////////////////////////////



     Route::get('/semaforos', 'CatalogosController@index_semaforo')
    ->name('semaforos.index');


       //nuevo
    Route::get('/semaforos/nuevo', 'CatalogosController@create_semaforo') //crear nuevo semaforo
        ->name('semaforos.create');
    Route::POST('/semaforos/crear', 'CatalogosController@store_semaforo') //validacion creacion de nuevo semaforo
        ->name('semaforos.crear');

        //editar
    Route::get('/semaforos/{semaforo}/editar', 'CatalogosController@edit_semaforo') //editar semaforo
        ->name('semaforos.edit');
    Route::put('/semaforos/{semaforo}', 'CatalogosController@update_semaforo'); //validacion edicion de semaforo

       //eliminar    
    Route::get('/eliminar_semaforo/{semaforo}', 'CatalogosController@eliminar_semaforo');


  Route::get('api/resultado_semaforos', function () {
        $data = request()->all();

      return datatables()
            ->eloquent(semaforo::query())
            ->filter(function ($query) {
                $cadena = request('search')['value'];                
                if ($cadena!='') {
                    $query->where('nombre_rol', 'like', "%" . request('search')['value'] . "%");
                    
                }
                

            })
            ->toJson();
    });

///////////////////////////////////////fases/////////////////////////////////



     Route::get('/fases', 'CatalogosController@index_fase')
    ->name('fases.index');


       //nuevo
    Route::get('/fases/nuevo', 'CatalogosController@create_fase') //crear nuevo fase
        ->name('fases.create');
    Route::POST('/fases/crear', 'CatalogosController@store_fase') //validacion creacion de nuevo fase
        ->name('fases.crear');

        //editar
    Route::get('/fases/{fase}/editar', 'CatalogosController@edit_fase') //editar fase
        ->name('fases.edit');
    Route::put('/fases/{fase}', 'CatalogosController@update_fase'); //validacion edicion de fase

       //eliminar    
    Route::get('/eliminar_fase/{fase}', 'CatalogosController@eliminar_fase');


  Route::get('api/resultado_fases', function () {
        $data = request()->all();

      return datatables()
            ->eloquent(fase::query())
            ->filter(function ($query) {
                $cadena = request('search')['value'];                
                if ($cadena!='') {
                    $query->where('nombre_rol', 'like', "%" . request('search')['value'] . "%");
                    
                }
                

            })
            ->toJson();
    });

///////////////////////////////////////tipo_entrevistas/////////////////////////////////



     Route::get('/tipo_entrevistas', 'CatalogosController@index_tipo_entrevista')
    ->name('tipo_entrevistas.index');


       //nuevo
    Route::get('/tipo_entrevistas/nuevo', 'CatalogosController@create_tipo_entrevista') //crear nuevo tipo_entrevista
        ->name('tipo_entrevistas.create');
    Route::POST('/tipo_entrevistas/crear', 'CatalogosController@store_tipo_entrevista') //validacion creacion de nuevo tipo_entrevista
        ->name('tipo_entrevistas.crear');

        //editar
    Route::get('/tipo_entrevistas/{tipo_entrevista}/editar', 'CatalogosController@edit_tipo_entrevista') //editar tipo_entrevista
        ->name('tipo_entrevistas.edit');
    Route::put('/tipo_entrevistas/{tipo_entrevista}', 'CatalogosController@update_tipo_entrevista'); //validacion edicion de tipo_entrevista

       //eliminar    
    Route::get('/eliminar_tipo_entrevista/{tipo_entrevista}', 'CatalogosController@eliminar_tipo_entrevista');


  Route::get('api/resultado_tipo_entrevistas', function () {
        $data = request()->all();

      return datatables()
            ->eloquent(tipo_entrevista::query())
            ->filter(function ($query) {
                $cadena = request('search')['value'];                
                if ($cadena!='') {
                    $query->where('nombre_rol', 'like', "%" . request('search')['value'] . "%");
                    
                }
                

            })
            ->toJson();
    });



///////////////////////////////////////vacantes/////////////////////////////////



     Route::get('/vacantes', 'CatalogosController@index_vacante')
    ->name('vacantes.index');


       //nuevo
    Route::get('/vacantes/nuevo', 'CatalogosController@create_vacante') //crear nuevo vacante
        ->name('vacantes.create');
    Route::POST('/vacantes/crear', 'CatalogosController@store_vacante') //validacion creacion de nuevo vacante
        ->name('vacantes.crear');

        //editar
    Route::get('/vacantes/{vacante}/editar', 'CatalogosController@edit_vacante') //editar vacante
        ->name('vacantes.edit');
    Route::put('/vacantes/{vacante}', 'CatalogosController@update_vacante'); //validacion edicion de vacante

       //eliminar    
    Route::get('/eliminar_vacante/{vacante}', 'CatalogosController@eliminar_vacante');


    Route::get('api/resultado_vacantes', function () {
            $busq = request('search')['value']; 
            
            $vacantes = vacante::with([
               'area' => function($query) use ($busq) {
                        $query
                        ->Where(function ($query) use($busq) {
                            $query->orwhere('areas.nombre', 'like',  '%' . $busq .'%');
                        });
               },   
               

           ]);
           

            return DataTables::eloquent($vacantes)
                    ->addIndexColumn()
                        ->filter(function ($query) use ($busq) {  
                            return true; //ya verifique encima
                        })
                        
                    ->addColumn('area', function($row){
                        return $row->area[0]->nombre; 
                    })
                    
                   ->toJson();
    });     


///////////////////////////////////////tipo_vacantes/////////////////////////////////



     Route::get('/tipo_vacantes', 'CatalogosController@index_tipo_vacante')
    ->name('tipo_vacantes.index');


       //nuevo
    Route::get('/tipo_vacantes/nuevo', 'CatalogosController@create_tipo_vacante') //crear nuevo tipo_vacante
        ->name('tipo_vacantes.create');
    Route::POST('/tipo_vacantes/crear', 'CatalogosController@store_tipo_vacante') //validacion creacion de nuevo tipo_vacante
        ->name('tipo_vacantes.crear');

        //editar
    Route::get('/tipo_vacantes/{tipo_vacante}/editar', 'CatalogosController@edit_tipo_vacante') //editar tipo_vacante
        ->name('tipo_vacantes.edit');
    Route::put('/tipo_vacantes/{tipo_vacante}', 'CatalogosController@update_tipo_vacante'); //validacion edicion de tipo_vacante

       //eliminar    
    Route::get('/eliminar_tipo_vacante/{tipo_vacante}', 'CatalogosController@eliminar_tipo_vacante');


  Route::get('api/resultado_tipo_vacantes', function () {
        $data = request()->all();

      return datatables()
            ->eloquent(tipo_vacante::query())
            ->filter(function ($query) {
                $cadena = request('search')['value'];                
                if ($cadena!='') {
                    $query->where('nombre', 'like', "%" . request('search')['value'] . "%");
                    
                }
                

            })
            ->toJson();
    });




///////////////////////////////////////entrevistas/////////////////////////////////



     Route::get('/entrevistas', 'CatalogosController@index_entrevista')
    ->name('entrevistas.index');


       //nuevo
    Route::get('/entrevistas/nuevo', 'CatalogosController@create_entrevista') //crear nuevo entrevista
        ->name('entrevistas.create');
    Route::POST('/entrevistas/crear', 'CatalogosController@store_entrevista') //validacion creacion de nuevo entrevista
        ->name('entrevistas.crear');

        //editar
    Route::get('/entrevistas/{entrevista}/editar', 'CatalogosController@edit_entrevista') //editar entrevista
        ->name('entrevistas.edit');
    Route::put('/entrevistas/{entrevista}', 'CatalogosController@update_entrevista'); //validacion edicion de entrevista

       //eliminar    
    Route::get('/eliminar_entrevista/{entrevista}', 'CatalogosController@eliminar_entrevista');


  Route::get('api/resultado_entrevistas', function () {
        $data = request()->all();

      return datatables()
            ->eloquent(Entrevista::query())
            ->filter(function ($query) {
                $cadena = request('search')['value'];                
                if ($cadena!='') {
                    $query->where('nombre', 'like', "%" . request('search')['value'] . "%");
                    
                }
                

            })
            ->toJson();
    });




///////////////////////////////////////zonas/////////////////////////////////



     Route::get('/zonas', 'CatalogosController@index_zona')
    ->name('zonas.index');


       //nuevo
    Route::get('/zonas/nuevo', 'CatalogosController@create_zona') //crear nuevo zona
        ->name('zonas.create');
    Route::POST('/zonas/crear', 'CatalogosController@store_zona') //validacion creacion de nuevo zona
        ->name('zonas.crear');

        //editar
    Route::get('/zonas/{zona}/editar', 'CatalogosController@edit_zona') //editar zona
        ->name('zonas.edit');
    Route::put('/zonas/{zona}', 'CatalogosController@update_zona'); //validacion edicion de zona

       //eliminar    
    Route::get('/eliminar_zona/{zona}', 'CatalogosController@eliminar_zona');


  Route::get('api/resultado_zonas', function () {
        $data = request()->all();

      return datatables()
            ->eloquent(zona::query())
            ->filter(function ($query) {
                $cadena = request('search')['value'];                
                if ($cadena!='') {
                    $query->where('nombre', 'like', "%" . request('search')['value'] . "%");
                    
                }
                

            })
            ->toJson();
    });



///////////////////////////////////////contactos/////////////////////////////////



     Route::get('/contactos', 'CatalogosController@index_contacto')
    ->name('contactos.index');


       //nuevo
    Route::get('/contactos/nuevo', 'CatalogosController@create_contacto') //crear nuevo contacto
        ->name('contactos.create');
    Route::POST('/contactos/crear', 'CatalogosController@store_contacto') //validacion creacion de nuevo contacto
        ->name('contactos.crear');

        //editar
    Route::get('/contactos/{contacto}/editar', 'CatalogosController@edit_contacto') //editar contacto
        ->name('contactos.edit');
    Route::put('/contactos/{contacto}', 'CatalogosController@update_contacto'); //validacion edicion de contacto

       //eliminar    
    Route::get('/eliminar_contacto/{contacto}', 'CatalogosController@eliminar_contacto');


  Route::get('api/resultado_contactos', function () {
        $data = request()->all();

      return datatables()
            ->eloquent(contacto::query())
            ->filter(function ($query) {
                $cadena = request('search')['value'];                
                if ($cadena!='') {
                    $query->where('nombre', 'like', "%" . request('search')['value'] . "%");
                    
                }
                

            })
            ->toJson();
    });


///////////////////////////////////////tipo_referencias/////////////////////////////////

     Route::get('/tipo_referencias', 'CatalogosController@index_tipo_referencia')
    ->name('tipo_referencias.index');


       //nuevo
    Route::get('/tipo_referencias/nuevo', 'CatalogosController@create_tipo_referencia') //crear nuevo tipo_referencia
        ->name('tipo_referencias.create');
    Route::POST('/tipo_referencias/crear', 'CatalogosController@store_tipo_referencia') //validacion creacion de nuevo tipo_referencia
        ->name('tipo_referencias.crear');

        //editar
    Route::get('/tipo_referencias/{tipo_referencia}/editar', 'CatalogosController@edit_tipo_referencia') //editar tipo_referencia
        ->name('tipo_referencias.edit');
    Route::put('/tipo_referencias/{tipo_referencia}', 'CatalogosController@update_tipo_referencia'); //validacion edicion de tipo_referencia

       //eliminar    
    Route::get('/eliminar_tipo_referencia/{tipo_referencia}', 'CatalogosController@eliminar_tipo_referencia');


  Route::get('api/resultado_tipo_referencias', function () {
        $data = request()->all();

      return datatables()
            ->eloquent(tipo_referencia::query())
            ->filter(function ($query) {
                $cadena = request('search')['value'];                
                if ($cadena!='') {
                    $query->where('nombre', 'like', "%" . request('search')['value'] . "%");
                    
                }
                

            })
            ->toJson();
    });



///////////////////////////////////////referencias/////////////////////////////////


       //nuevo
    Route::get('/referencias/nuevo/{candidato}', 'CatalogosController@create_referencia'); 
    Route::POST('/referencias/crear/{candidato}', 'CatalogosController@store_referencia'); 

        //editar
    Route::get('/referencias/{referencia}/editar/{candidato}', 'CatalogosController@edit_referencia');
    Route::put('/referencias/{referencia}/{candidato}', 'CatalogosController@update_referencia'); 
       //eliminar    
    Route::get('/eliminar_referencia/{referencia}/{candidato}', 'CatalogosController@eliminar_referencia');
    Route::get('api/resultado_referencias/{identificador}', function($identificador){
        $data = request()->all();


          $referencia= Referencia::with(['tiporeferencia'])
                    ->where('candidato_id',$identificador)
                    ->get(); 
          return datatables()
            ->of($referencia)->make(true);        

      
    });


///////////////////////////////////////adjuntos/////////////////////////////////



     Route::get('/adjuntos', 'CatalogosController@index_adjunto')
    ->name('adjuntos.index');


       //nuevo
    Route::get('/adjuntos/nuevo', 'CatalogosController@create_adjunto') //crear nuevo adjunto
        ->name('adjuntos.create');
    Route::POST('/adjuntos/crear', 'CatalogosController@store_adjunto') //validacion creacion de nuevo adjunto
        ->name('adjuntos.crear');

        //editar
    Route::get('/adjuntos/{adjunto}/editar', 'CatalogosController@edit_adjunto') //editar adjunto
        ->name('adjuntos.edit');
    Route::put('/adjuntos/{adjunto}', 'CatalogosController@update_adjunto'); //validacion edicion de adjunto

       //eliminar    
    Route::get('/eliminar_adjunto/{adjunto}', 'CatalogosController@eliminar_adjunto');


  Route::get('api/resultado_adjuntos', function () {
        $data = request()->all();

      return datatables()
            ->eloquent(adjunto::query())
            ->filter(function ($query) {
                $cadena = request('search')['value'];                
                if ($cadena!='') {
                    $query->where('nombre', 'like', "%" . request('search')['value'] . "%");
                    
                }
                

            })
            ->toJson();
    });



///////////////////////////////////////templates/////////////////////////////////



     Route::get('/templates', 'CatalogosController@index_template')
    ->name('templates.index');


       //nuevo
    Route::get('/templates/nuevo', 'CatalogosController@create_template') //crear nuevo template
        ->name('templates.create');
    Route::POST('/templates/crear', 'CatalogosController@store_template') //validacion creacion de nuevo template
        ->name('templates.crear');

        //editar
    Route::get('/templates/{template}/editar', 'CatalogosController@edit_template') //editar template
        ->name('templates.edit');
    Route::put('/templates/{template}', 'CatalogosController@update_template'); //validacion edicion de template

       //eliminar    
    Route::get('/eliminar_template/{template}', 'CatalogosController@eliminar_template');


  Route::get('api/resultado_templates', function () {
        $data = request()->all();

      return datatables()
            ->eloquent(template::query())
            ->filter(function ($query) {
                $cadena = request('search')['value'];                
                if ($cadena!='') {
                    $query->where('nombre', 'like', "%" . request('search')['value'] . "%");
                    
                }
                

            })
            ->toJson();
    });


          //cargar template para ajax
    Route::get('/templates/{template}/cargar', 'CatalogosController@get_template');

///////////////////////////////////////preguntas/////////////////////////////////



     Route::get('/preguntas', 'CatalogosController@index_pregunta')
    ->name('preguntas.index');


       //nuevo
    Route::get('/preguntas/nuevo', 'CatalogosController@create_pregunta') //crear nuevo pregunta
        ->name('preguntas.create');
    Route::POST('/preguntas/crear', 'CatalogosController@store_pregunta') //validacion creacion de nuevo pregunta
        ->name('preguntas.crear');

        //editar
    Route::get('/preguntas/{pregunta}/editar', 'CatalogosController@edit_pregunta') //editar pregunta
        ->name('preguntas.edit');
    Route::put('/preguntas/{pregunta}', 'CatalogosController@update_pregunta'); //validacion edicion de pregunta

       //eliminar    
    Route::get('/eliminar_pregunta/{pregunta}', 'CatalogosController@eliminar_pregunta');


  Route::get('api/resultado_preguntas', function () {
        $data = request()->all();

      return datatables()
            ->eloquent(pregunta::query())
            ->filter(function ($query) {
                $cadena = request('search')['value'];                
                if ($cadena!='') {
                    $query->where('nombre', 'like', "%" . request('search')['value'] . "%");
                    
                }
                

            })
            ->toJson();
    });


///////////////////////////////////////especialidads/////////////////////////////////



     Route::get('/especialidads', 'CatalogosController@index_especialidad')
    ->name('especialidads.index');


       //nuevo
    Route::get('/especialidads/nuevo', 'CatalogosController@create_especialidad') //crear nuevo especialidad
        ->name('especialidads.create');
    Route::POST('/especialidads/crear', 'CatalogosController@store_especialidad') //validacion creacion de nuevo especialidad
        ->name('especialidads.crear');

        //editar
    Route::get('/especialidads/{especialidad}/editar', 'CatalogosController@edit_especialidad') //editar especialidad
        ->name('especialidads.edit');
    Route::put('/especialidads/{especialidad}', 'CatalogosController@update_especialidad'); //validacion edicion de especialidad

       //eliminar    
    Route::get('/eliminar_especialidad/{especialidad}', 'CatalogosController@eliminar_especialidad');


  Route::get('api/resultado_especialidads', function () {
        $data = request()->all();

      return datatables()
            ->eloquent(especialidad::query())
            ->filter(function ($query) {
                $cadena = request('search')['value'];                
                if ($cadena!='') {
                    $query->where('nombre', 'like', "%" . request('search')['value'] . "%");
                    
                }
                

            })
            ->toJson();
    });


///////////////////////////////////////nivels/////////////////////////////////



     Route::get('/nivels', 'CatalogosController@index_nivel')
    ->name('nivels.index');


       //nuevo
    Route::get('/nivels/nuevo', 'CatalogosController@create_nivel') //crear nuevo nivel
        ->name('nivels.create');
    Route::POST('/nivels/crear', 'CatalogosController@store_nivel') //validacion creacion de nuevo nivel
        ->name('nivels.crear');

        //editar
    Route::get('/nivels/{nivel}/editar', 'CatalogosController@edit_nivel') //editar nivel
        ->name('nivels.edit');
    Route::put('/nivels/{nivel}', 'CatalogosController@update_nivel'); //validacion edicion de nivel

       //eliminar    
    Route::get('/eliminar_nivel/{nivel}', 'CatalogosController@eliminar_nivel');


  Route::get('api/resultado_nivels', function () {
        $data = request()->all();

      return datatables()
            ->eloquent(nivel::query())
            ->filter(function ($query) {
                $cadena = request('search')['value'];                
                if ($cadena!='') {
                    $query->where('nombre', 'like', "%" . request('search')['value'] . "%");
                    
                }
                

            })
            ->toJson();
    });



///////////////////////////////////////estados/////////////////////////////////



     Route::get('/estados', 'CatalogosController@index_estado')
    ->name('estados.index');


       //nuevo
    Route::get('/estados/nuevo', 'CatalogosController@create_estado') //crear nuevo estado
        ->name('estados.create');
    Route::POST('/estados/crear', 'CatalogosController@store_estado') //validacion creacion de nuevo estado
        ->name('estados.crear');

        //editar
    Route::get('/estados/{estado}/editar', 'CatalogosController@edit_estado') //editar estado
        ->name('estados.edit');
    Route::put('/estados/{estado}', 'CatalogosController@update_estado'); //validacion edicion de estado

       //eliminar    
    Route::get('/eliminar_estado/{estado}', 'CatalogosController@eliminar_estado');


  Route::get('api/resultado_estados', function () {
        $data = request()->all();

      return datatables()
            ->eloquent(estado::query())
            ->filter(function ($query) {
                $cadena = request('search')['value'];                
                if ($cadena!='') {
                    $query->where('nombre', 'like', "%" . request('search')['value'] . "%");
                    
                }
                

            })
            ->toJson();
    });





































////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////Inventarios////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////    
    Route::get('/inventario', 'InventarioController@index')
    ->name('inventario.index');

    Route::get('busqueda_productos','InventarioController@busqueda_productos')
        ->name('predictivo.busqueda_productos');


    Route::POST('/inventario/crear', 'InventarioController@store_entrada') //validacion creacion de nuevo usuario
        ->name('inventario.crear');    


    Route::get('busqueda_recepcion_temporal', function () {   
        $authors = Movimiento::where('user_id', (Auth::user()->id)  )
                    ->with(['almacens','productos']); //'almacens'
        return DataTables::eloquent($authors)->toJson();
    });    


       //eliminar    
    Route::get('/eliminar_recepcion/{movimiento}', 'InventarioController@eliminar_recepcion');

    
    Route::POST('/inventario/entrada_existencia', 'InventarioController@entrada_existencia') //validacion creacion de nuevo usuario
        ->name('inventario.entrada_existencia');
  
    

        
/////////////////////////////////modal_imagen///////////////////////////////////////

Route::get('/modal_imagen/{producto}/', 'HomeController@modal_imagen') 
        ->name('modal.imagen');

Route::POST('/cambio_imagen_modal/{producto}/', 'HomeController@cambio_imagen_modal') 
        ->name('modal.cambio');



///////////////Busqueda predictiva por typeahead/////////////////

Route::get('resultado','HomeController@resultado');



Route::get('get_elementos_productos','HomeController@get_elementos_productos')
    ->name('get.elementos_productos');



///////////////////////////////busqueda///////////////////////////////////////////
Route::get('/buscar/', 'HomeController@buscar') 
        ->name('busqueda.predictiva');

/////////////session de lo que tiene en la cesta cada usuario/////////////////////
Route::POST('/session_producto/', 'HomeController@session_producto') 
        ->name('session.producto');



//filtro https://www.itsolutionstuff.com/post/custom-filter-search-with-laravel-datatables-exampleexample.html
Route::get('api/resultado_productos', function () {
    $busq=explode(' ', request('search.value'));


            $productos = Producto::whereHas('variacions.modelo.marca', 
                  function (Builder $query) use ($busq) {

                    $query->Where(function ($query) use($busq) { //este simula un like con un whereIn
                         for ($i = 0; $i < count($busq); $i++){
                            $query->orwhere('variacions.nombre', 'like',  '%' . $busq[$i] .'%');
                            $query->orwhere('modelos.nombre', 'like',  '%' . $busq[$i] .'%');
                            $query->orwhere('marcas.nombre', 'like',  '%' . $busq[$i] .'%');
                         }      
                    });

            }, '>=', 1)

            ->orWhereHas('descripcion', 
                  function (Builder $query) use ($busq) {
                    $query->Where(function ($query) use($busq) { //este simula un like con un whereIn
                         for ($i = 0; $i < count($busq); $i++){
                            $query->orwhere('descripcions.nombre', 'like',  '%' . $busq[$i] .'%');
                         }      
                    });

            }, '>=', 1)            

            ->orWhereHas('codigo', 
                  function (Builder $query) use ($busq) {
                    $query->Where(function ($query) use($busq) { //este simula un like con un whereIn
                         for ($i = 0; $i < count($busq); $i++){
                            $query->orwhere('codigos.nombre', 'like',  '%' . $busq[$i] .'%');
                         }      
                    });

            }, '>=', 1)

            ->orWhereHas( 'fabricante', 
                  function (Builder $query) use ($busq) {
                    $query->Where(function ($query) use($busq) { //este simula un like con un whereIn
                         for ($i = 0; $i < count($busq); $i++){
                            $query->orwhere('fabricantes.nombre', 'like',  '%' . $busq[$i] .'%');
                         }      
                    });

            }, '>=', 1)

            ->orWhereHas('categoria', 
                  function (Builder $query) use ($busq) {
                    $query->Where(function ($query) use($busq) { //este simula un like con un whereIn
                         for ($i = 0; $i < count($busq); $i++){
                            $query->orwhere('categorias.nombre', 'like',  '%' . $busq[$i] .'%');
                         }      
                    });

            }, '>=', 1)->get();
 

            return DataTables::of($productos)
                    ->addIndexColumn()
                        ->filter(function ($query) use ($busq) {  
                            return true; //ya verifique encima
                        }) 

                    ->addColumn('codigos', function($row){
                        $variacion='';
                        foreach ($row['codigo'] as $key => $value) {
                            $variacion.=$value->nombre. ( (( count($row['codigo'])-1) == $key ) ? '' : ',') ;
                        }
                         
                            return $variacion;
                    })                        

                    
                    ->addColumn('descripciones', function($row){
                        $variacion='';
                        foreach ($row['descripcion'] as $key => $value) {
                            $variacion.=$value->nombre. ( (( count($row['descripcion'])-1) == $key ) ? '' : ',') ;
                        }
                         
                            return $variacion;
                    })                        

                    ->addColumn('marca', function($row){
                        $variacion='';
                        foreach ($row['marca'] as $key => $value) {
                            $variacion.=$value->nombre. ( (( count($row['marca'])-1) == $key ) ? '' : ',') ;
                        }
                         
                            return $variacion;
                    })
                    ->addColumn('modelo', function($row){
                        $variacion='';
                        foreach ($row['modelo'] as $key => $value) {
                            $variacion.=$value->nombre . ( (( count($row['modelo'])-1) == $key ) ? '' : ',') ;
                        }
                         
                            return $variacion;
                    })                    
                        
                    ->addColumn('variacion', function($row){
                        $variacion='';
                        foreach ($row['variacions'] as $key => $value) {
                            $variacion.=$value->nombre. ( (( count($row['variacions'])-1) == $key ) ? '' : ',') ;
                        }
                         
                            return $variacion;
                    })
                    //->rawColumns(['nombre_mio'])
                    ->make(true);


});




///////////////////////////////////////////////////////////////////////////////////////



    //Autenticacion
    Auth::routes();

    




   


    //use Illuminate\Support\Facades\Storage;


    //resultados para idioma de aplicacion
    Route::POST('idioma', function () {
        //$url = Storage::disk('local');

        //$url = "https://raw.githubusercontent.com/jpatokal/openflights/master/data/airports.dat";

        //$data = file_get_contents( resource_path('views/inicio.blade.php') );

        $data = file_get_contents( resource_path('lang/es/aplicacion.json') );
        
        $data=str_replace('=>',":",$data);

        $data=str_replace('<?php return',"",$data);

        $data=str_replace(']',"}",$data);
        $data=str_replace('[',"{",$data);
        $data=str_replace(';',"",$data);
        $data=str_replace('n',"",$data);
        
        $url = '{"a":1,"b":2,"c":3,"d":4,"e":5}';


        //dd(  json_encode( $data,true )  ) ;
        //resources/lang/es
        //$url = "https://raw.githubusercontent.com/jpatokal/openflights/master/data/airports.dat";
        //$url = Storage::files(  asset('storage/') );
        

        //
        //$products = json_decode($data, true);
        return $data;
        return  json_encode( (string)$url,true);  
      //return datatables()->eloquent(App\User::query())->toJson();
    })->where([ 
        'lang' => 'en|es'  //
    ]);







});	 

/*
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
*/