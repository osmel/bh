<?php

namespace App\Http\Controllers;

use App\User; //modelo User del ORM eloquent
use App\Role;
use App\Area; 
use App\Producto; 
use App\Almacen_Producto; 
use App\Cliente; 
use App\Candidato; 
use App\Proyecto;
use App\ProyectoUser;

use App\Estado;
use App\Nivel;
use App\Contacto;
use App\Situacion;  //estatus final
use App\Estatu;   //estatus seleccion
use App\Referencia;
use App\Tipo_referencia;
use App\Vacante;
use App\Adjunto;
use App\Tipo_entrevista;
use App\Selector_tipo;
use App\CandidatoVacante;

use App\Primer_contacto;
use App\Analisis_resultado;
use App\Candidato_final;
use App\Entrevista;

use App\Puesto;






use Illuminate\Support\Facades\DB;  //para usar DB, para consultas nativas y constructor laravel

use App\Http\Servicios\NotificacionesInterface as NotificacionesInterface;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder; 
//use App\User as Image;
use Intervention\Image\Facades\Image;

Use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Carbon\Carbon;




class InicioController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    private $photos_path;

    //Sin importar cómo se resuelva esta inyección de dependencias, $miclase debe ser capaz de usar los métodos que dicta la interfaz.
    public function __construct(NotificacionesInterface $miclase)
    {
        //dd( $miclase->mensaje('will') );

        //$miclase->index();
        //dd($miclase->index());

        //cuando trata de entrar en esta clase sino esta logueado lo redirecciona a login
        $this->middleware('auth');  
        $this->middleware('EsAdmin');  

        $this->photos_path = public_path('/images/projects');


            //parent::__construct($attributes);

            


    }




  
//////////////////////////////galeria
public function uploadNo($id, Request $request)
{
    $file = $request->file('file');
    $path = public_path() . '/images/projects';
    $fileName = uniqid() . $file->getClientOriginalName();

    $file->move($path, $fileName);

    $projectImage = new ProyectoUser();
    $projectImage->proyecto_id = $id;
    $projectImage->user_id = auth()->user()->id;

    
    
    $projectImage->name = $fileName;
    $projectImage->description = $fileName;

    $projectImage->file_name = $fileName;
    $projectImage->save();
}


    public function upload_image(Request $request)
    {
        $photos = $request->file('file');

        if (!is_array($photos)) {
            $photos = [$photos];
        }

        if (!is_dir($this->photos_path)) { //si el directorio no existe se creara
            mkdir($this->photos_path, 0777);
        }

        for ($i = 0; $i < count($photos); $i++) { //recorriendo todos los archivos
            $photo = $photos[$i];
            $name = sha1(date('YmdHis') . Str::random(30)); //nombre único del archivo cargado
            $save_name = $name . '.' . $photo->getClientOriginalExtension();
            $resize_name = $name . Str::random(2) . '.' . $photo->getClientOriginalExtension(); //nombre del icono creado

            //creamos un icono de 250 píxeles de ancho sin cambiar la relación de aspecto. 
            Image::make($photo)  
                ->resize(250, null, function ($constraints) {
                    $constraints->aspectRatio();
                })
                ->save($this->photos_path . '/' . $resize_name);

            $photo->move($this->photos_path, $save_name); //guardando en la carpeta

            //crea un registro de base de datos 
            $upload = new ProyectoUser();
            $upload->proyecto_id = 1;
            $upload->user_id = auth()->user()->id;

            $upload->filename = $save_name;
            $upload->resized_name = $resize_name;
            $upload->original_name = basename($photo->getClientOriginalName());
            $upload->save();
        }

        // se envía una respuesta json exitosa.
        return response()->json([
            'message' => 'Image saved Successfully'
        ], 200);
    }

    public function destroy_image(Request $request)
    {
        $filename = $request->id;
        $uploaded_image = ProyectoUser::where('original_name', basename($filename))->first();

        if (empty($uploaded_image)) {
            return response()->json(['message' => 'Sorry file does not exist'], 400);
        }

        $file_path = $this->photos_path . '/' . $uploaded_image->filename;
        $resized_file = $this->photos_path . '/' . $uploaded_image->resized_name;

        if (file_exists($file_path)) {
            unlink($file_path);
        }

        if (file_exists($resized_file)) {
            unlink($resized_file);
        }

        if (!empty($uploaded_image)) {
            $uploaded_image->delete();
        }

         return response()->json(['message' => 'File successfully delete'], 200);
    }


/////////////////subir imagen

public function updatePhoto(User $user,Request $request) //
{ 

    $this->validate($request, [
        'photo' => 'required|image'
    ]);

    $file = $request->file('photo');  //recibe la imagen, con todos los atributos
    $extension = $file->getClientOriginalExtension(); //get a la extension
    


    $fileName = $user->id . '.' . $extension;//idUsuario.ext
    $path = public_path('images/users/'.$fileName); //ruta donde se guardara
    
    //usando el INTERVENTION IMAGE para reducirla a (144x144) y guardarla
    Image::make($file)->fit(144, 144)->save($path); //guardar el archivo

    //guardar en el modelo usuario la extension
    //$user = $user->user();


    $user->photo = $extension;
    $saved = $user->update();

    //guardar el arreglo q voy a devolver a ajax
    $data['success'] = $saved;
    $data['path'] = $user->getAvatarUrl() . '?' . uniqid();
    
    return $data;
}    



    //////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////Gestion de usuarios//////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////

    //listado de tabla usuarios
    public function index() { //index
        $users=User::where('role_id',1)->get(); 
        return view('usuarios.usuarios',['title'=>'Listado de usuarios','users'=>$users ]); 
    }

  
    //Crear un nuevo usuario
    public function create() { //motrar el formulario
        $areas = Area::select('id', 'nombre')->get();
        $perfiles = Role::select('id', 'nombre_rol')->where('id',1)->get();
        $id = Auth::user()->id;
        //
      $proyecto = Proyecto::find($id);
      $photos = ProyectoUser::all(); //falta ponerle el id
        return view('usuarios.create',['areas'=>$areas, 'perfiles'=>$perfiles,'proyecto'=>$proyecto,'photos'=>$photos ]);
    }



    
    //validacion creacion de nuevo usuario
    public function store() { //procesar el formulario

        //metodo validate para las reglas de validación
        $data = request()->validate([
            'name' => 'required',
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => 'required',
            'role_id' => 'required',
        ], [
            'name.required' => 'El campo nombre es obligatorio',
            'email.required' => 'El campo email es obligatorio',
            'email.unique' => 'El campo email es unico',
            'role_id.required' => 'El campo perfil es obligatorio',
        ]);
        
        User::create([  //creando o insertando un registro en user
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'role_id' => $data['role_id'],
        ]);

        return redirect()->route('users.index'); //redirigiendo a 
    }


    //editar usuario
    public function edit(User $user) {
        $areas = Area::select('id', 'nombre')->get();
        $perfiles = Role::select('id', 'nombre_rol')->where('id',1)->get();
        return view('usuarios.edit', ['user' => $user, 'areas'=>$areas, 'perfiles'=>$perfiles]); 
    }

    //validacion de edicion de usuarios
    public function update(User $user){
        $data = request()->validate([
            'name' => 'required',
            'email' => ['required', 'email', 'unique:users,email,'.$user->id ],
            'password' => '', //aqui no lo validamos
            'role_id' => 'required',
        ]);

        //pero luego de no haberlo validado, si viene con valor, lo tenemos en cuenta para el modelo
        if ($data['password'] != null) {
            $data['password'] = bcrypt($data['password']);
        } else {  //em casp contrario, no lo tenemos en cuenta para la actualizacion del modelo
            unset($data['password']);
        }

        $user->update($data);
        return redirect('/usuarios');  //return redirect()->route('users.index', ['user' => $user]);
    }

  
    function eliminar_usuario(User $user) {
        $user->delete();
        return redirect()->route('users.index');
    }




//////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////Gestion de Clientes//////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////

    //listado de tabla usuarios
    public function index_cliente() { //index
        $clientes= User::where('role_id',2)->get()->take(10); 
        return view('clientes.clientes',['clientes'=>$clientes ]); 
    }



    //Crear un nuevo cliente
    public function create_cliente() { //motrar el formulario
        $puestos = Puesto::all();
        $perfiles = Role::select('id', 'nombre_rol')->where('id',2)->get();
        
        return view('clientes.create',['puestos'=>$puestos, 'perfiles'=>$perfiles]);
    }



    
    //validacion creacion de nuevo cliente
    public function store_cliente() { //procesar el formulario

        //metodo validate para las reglas de validación
        $data = request()->validate([
            'name' => 'required',
            'puesto_id' => 'required',
            'telefono' => 'required',
            'email' => ['required', 'email', 'unique:users,email'],
            'role_id' => 'required',
            'password' => '', //aqui no lo validamos
        ], [
            'name.required' => 'El campo nombre es obligatorio',
            'email.required' => 'El campo email es obligatorio',
            'email.unique' => 'El campo email es unico',
            'role_id.required' => 'El campo perfil es obligatorio',
        ]);
        
        $usuario=User::create([  //creando o insertando un registro en user
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'role_id' => $data['role_id'],
        ]);

        Cliente::create([  //creando o insertando un registro en user
            'user_id' => $usuario->id,
            'telefono' => $data['name'],
            'puesto_id' => $data['email'],
        ]);

        return redirect()->route('clientes.index'); //redirigiendo a 
    }


    //editar cliente
    public function edit_cliente(User $user) {
        $puestos = Puesto::get();
        $perfiles = Role::select('id', 'nombre_rol')->where('id',2)->get();
        return view('clientes.edit', ['cliente' => $user, 'puestos'=>$puestos, 'perfiles'=>$perfiles]); 

    }

    //validacion de edicion de clientes
    public function update_cliente(User $user){
        $data = request()->validate([
            'name' => 'required',
            'puesto_id' => 'required',
            'telefono' => 'required',
            'email' => ['required', 'email', 'unique:users,email,'.$user->id ],
            'role_id' => 'required',
            'password' => '', //aqui no lo validamos
        ]);

        //pero luego de no haberlo validado, si viene con valor, lo tenemos en cuenta para el modelo
        if ($data['password'] != null) {
            $data['password'] = bcrypt($data['password']);
        } else {  //em casp contrario, no lo tenemos en cuenta para la actualizacion del modelo
            unset($data['password']);
        }

        $user->update($data);
        
        $user->cliente->update($data);    
        /*
            ['candidato_id' => $user->id
                //'vacante_id' => $data['vacante_id']
            ],
        */
        return redirect('/clientes');  
    }

  
    function eliminar_cliente(User $user) {
        $user->delete();
        return redirect()->route('clientes.index');
    }

//////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////Gestion de candidatos//////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////

    //listado de tabla usuarios
    public function index_candidato() { //index
        $candidatos= User::where('role_id',4)->get()->take(10); 
        return view('candidatos.candidatos',['candidatos'=>$candidatos ]); 
    }



    //Crear un nuevo candidato
    public function create_candidato() { //motrar el formulario
        $areas = Area::select('id', 'nombre')->get();
        $perfiles = Role::select('id', 'nombre_rol')->where('id',4)->get();
        $estados= Estado::all(); 
        $nivels= Nivel::all(); 
        $contactos= Contacto::all(); 
        $situacions= Situacion::all(); 
        $estatus= Estatu::all(); 

        $hoy=Carbon::now()->format('Y-m-d'); // H:i:s
        $vacantes= Vacante::where('fecha','>=', $hoy )->get();

        return view('candidatos.create',[
                            'areas'=>$areas, 
                            'perfiles'=>$perfiles,
                            'estados'=>$estados,
                            'estados'=>$estados,
                            'nivels'=>$nivels,
                            'contactos'=>$contactos,
                            'estatus'=>$estatus,
                            'situacions'=>$situacions,  
                            'vacantes'=>$vacantes,                          
                    ]);
    }



    
    //validacion creacion de nuevo candidato
    public function store_candidato() { //procesar el formulario

        //metodo validate para las reglas de validación
        $data = request()->validate([
        //1-
            'name' => 'required',
            'edad' => '',
            'estado_id' =>'',
            'nivel_id' =>'',
            
            'telefono1' =>'',
            'telefono2' =>'',
            'email' => ['required', 'email', 'unique:users,email'],
            'email2'=>'',
            'direccion'=>'',
            'role_id' => 'required',
            'password' => '', //aqui no lo validamos
            'vacante_id'=>'',

            'sueldo'=>'',
            
        ], [
            'name.required' => 'El campo nombre es obligatorio',
            'email.required' => 'El campo email es obligatorio',
            'email.unique' => 'El campo email es unico',
            //'almacen_id.required' => 'El campo almacen es obligatorio',
            'role_id.required' => 'El campo perfil es obligatorio',
        ]);
        
        $usuario = User::create([  //creando o insertando un registro en user
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'role_id' => $data['role_id'],
            //photo,
        ]);

        if (isset($data['vacante_id'])){

            $candidato = Candidato::create([  //creando o insertando un registro en user
                'user_id' => $usuario->id,
                'edad' => $data['edad'],
                'estado_id' =>$data['estado_id'],
                'nivel_id' =>$data['nivel_id'],
                'telefono1' =>$data['telefono1'],
                'telefono2' =>$data['telefono2'],
                'email2'=>$data['email2'],
                'direccion'=>$data['direccion'],
                //'vacante_id'=>$data['vacante_id'],
                'puesto_id'=>1,
                'contacto_id'=>1,
                //  ,   cv, formatoadmin,
            ]);

        
            CandidatoVacante::create([  //creando o insertando un registro en user
             'candidato_id'=>$usuario->id,
                'vacante_id'=>$data['vacante_id'],
                    'sueldo'=>$data['sueldo']
            ]);
        }



         return redirect('/candidatos/'.$usuario->id.'/editar'); //redirigiendo a 
        //return redirect()->route('candidatos.index'); //redirigiendo a 
    }


    //editar candidato
    public function edit_candidato(User $user) {

        $estados= Estado::all(); 
        $nivels= Nivel::all(); 
        $contactos= Contacto::all(); 
        $situacions= Situacion::all(); 
        $estatus= Estatu::all(); 
        $tipo_referencias= Tipo_referencia::all(); 
        $tipo_entrevistas= Tipo_entrevista::all(); 

        $hoy=Carbon::now()->format('Y-m-d'); // H:i:s
        
        $vacantes= Vacante::where('fecha','>=', $hoy )->get();

        $selector_tipos= Selector_tipo::get();
        
        $id_vacante_candidato= (isset($user->candidato->vacante_activa[0]->pivot->id)) ? $user->candidato->vacante_activa[0]->pivot->id : null;

        $primer_contacto= Primer_contacto::where('candidato_vacante_id',$id_vacante_candidato)->first();

        $analisis_resultado= Analisis_resultado::where('candidato_vacante_id',$id_vacante_candidato)->first();

        $candidato_final= Candidato_final::where('candidato_vacante_id',$id_vacante_candidato)->first();

        $entrevistas= Entrevista::where('candidato_vacante_id',$id_vacante_candidato)->get();

        $adjuntos=Vacante::with('adjuntos_activos')->first();


        $areas = Area::select('id', 'nombre')->get();

        $perfiles = Role::select('id', 'nombre_rol')->where('id',4)->get();

        $referencias= Referencia::where('candidato_id',$user->id)->get();

        return view('candidatos.edit', ['candidato' => $user, 
                                        'areas'=>$areas, 
                                        'perfiles'=>$perfiles,
                                        'estados'=>$estados,
                                        'nivels'=>$nivels,
                                        'contactos'=>$contactos,
                                        'estatus'=>$estatus,
                                        'situacions'=>$situacions,
                                        'referencias'=>$referencias,
                                        'tipo_referencias'=>$tipo_referencias,
                                        'vacantes'=>$vacantes,
                                        'adjuntos'=>$adjuntos,
                                        'tipo_entrevistas'=>$tipo_entrevistas,
                                        'selector_tipos'=>$selector_tipos,
                                        'primer_contacto'=>$primer_contacto,
                                        'analisis_resultado'=>$analisis_resultado,
                                        'candidato_final'=>$candidato_final,
                                        'entrevistas'=>$entrevistas,
                                        


                                        ]); 

    }

    //validacion de edicion de candidatos
    public function update_candidato(User $user){
        //dd( request()->request );

        
        $data = request()->validate([
            //1-
            'name' => 'required',
            'edad' => '',
            'estado_id' =>'',
            'nivel_id' =>'',
            
            'telefono1' =>'',
            'telefono2' =>'',
            'email' => ['required', 'email', 'unique:users,email,'.$user->id ],
            'email2'=>'',
            'direccion'=>'',
            'role_id' => 'required',
            'password' => '', //aqui no lo validamos
            'vacante_id'   => '', //'required|not_in:'.$user->id,

            //pivot
              'sueldo' =>'',

            //2 primer_contacto
            
            'contacto_id' =>'',
            'intento' =>'',
            'estatu_id' =>'',
            'descripcion' =>'',
            'fecha_contacto' =>'',

            //3) Entrevistas y Evaluaciones
              'comentario.*' => '',
              'fecha.*' => '',
              'selector_tipo_id.*' => '',
              'adjunto.*' => '',
              
            

            
            //4) Análisis de Resultados
             'logro' =>'',
             'fortaleza' =>'',
             'debilidad' =>'',
             'sueldo_final' =>'',
            

             
             // 7) Estatus Final
             'situacion_id' =>'',


            
        ]);

        if ($data['vacante_id'] == 0) {
            
            return redirect('/candidatos/'.$user->id.'/editar');  
        }    

        //pero luego de no haberlo validado, si viene con valor, lo tenemos en cuenta para el modelo
        if ($data['password'] != null) {
            $data['password'] = bcrypt($data['password']);
        } else {  //em casp contrario, no lo tenemos en cuenta para la actualizacion del modelo
            unset($data['password']);
        }

        $dato_pivot['sueldo']=$data['sueldo'];
        

        $user->update($data);
        $user->candidato->update($data);

          if (isset($data['vacante_id'])){
            $dato_pivot['vacante_id']=$data['vacante_id'];
            //
            $pivot = CandidatoVacante::has('vacantes_activa', '>=', 1)
                ->updateOrCreate(
                ['candidato_id' => $user->id
                    //'vacante_id' => $data['vacante_id']
                ],
                $dato_pivot
            );
            //$user->candidato->vacante_activa[0]->pivot->update($dato_pivot);

            foreach ($data['selector_tipo_id'] as $key1 => $value) {
                

                Entrevista::has('candidato_vacante', '>=', 1)
                ->updateOrCreate(
                        [
                            'candidato_vacante_id' => $user->candidato->vacante_activa[0]->pivot->id,
                            'tipo_entrevista_id'   => ($key1+1) //$dat_array['tipo_entrevista_id']
                        ],
                        [

                        'tipo_entrevista_id'   => ($key1+1),
                        'selector_tipo_id' => $data['selector_tipo_id'][$key1],
                        'comentario' => $data['comentario'][$key1],
                        'fecha' => '2022-09-06',
                        'adjunto' => $data['adjunto'][$key1]
                        ]
                );  

                
            }
            //die;


            $pivot = Primer_contacto::has('candidato_vacante', '>=', 1)
                ->updateOrCreate(
                ['candidato_vacante_id' => $user->candidato->vacante_activa[0]->pivot->id
                ],
                [
                    
                    'contacto_id' =>$data['contacto_id'],
                    'intento' =>$data['intento'],
                    'estatu_id' =>$data['estatu_id'],
                    'descripcion' =>$data['descripcion'],
                    'fecha_contacto' =>'2020-09-06' //$data['fecha_contacto']


                ]
            );            

                
            $pivot = Analisis_resultado::has('candidato_vacante', '>=', 1)
                ->updateOrCreate(
                ['candidato_vacante_id' => $user->candidato->vacante_activa[0]->pivot->id
                ],
                [
                    'logro' =>$data['logro'],
                    'fortaleza' =>$data['fortaleza'],
                    'debilidad' =>$data['debilidad'],
                    'sueldo_final' =>$data['sueldo_final']
                ]
            );    
                   


            $pivot = Candidato_final::has('candidato_vacante', '>=', 1)
                ->updateOrCreate(
                ['candidato_vacante_id' => $user->candidato->vacante_activa[0]->pivot->id
                ],
                [
                    'situacion_id' =>$data['situacion_id']
                ]
            );   

            }         

          //dd( $user->candidato->vacante_activa[0]->pivot->candidato_final ); 
            
        return redirect('/candidatos');  
    }

  
    function eliminar_candidato(User $user) {
        $user->delete();
        return redirect()->route('candidatos.index');
    }    

 //////////////////////////////////////////////////////////////////////////////////
 /////////////////////////////////otros//////////////////////////////
 //////////////////////////////////////////////////////////////////////////////////



    public function condiciones(Request $request)
    {
        $name = $request->input('condiciones');
        return json_encode($name);

        //
    }
   
   

    public function dashboard(Request $request) { //index
        return view('inicio',['title'=>'Listado de usuarios']); 
    }


}
