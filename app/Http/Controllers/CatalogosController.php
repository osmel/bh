<?php

namespace App\Http\Controllers;

use App\Role as perfil; //modelo User del ORM eloquent

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

use App\Cliente;
use App\User;

use App\Zona;
use App\Especialidad;
use App\Nivel;
use App\Estado;

use App\Template;
use App\Pregunta;
use App\PreguntaTemplate;

use App\Adjunto;
use App\AdjuntoVacante;

use App\Contacto;
use App\Tipo_referencia;
use App\Referencia;



use Illuminate\Support\Facades\DB;  //para usar DB, para consultas nativas y constructor laravel

use App\Http\Servicios\NotificacionesInterface as NotificacionesInterface;

use Illuminate\Http\Request;


use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

//use Barryvdh\Debugbar\Facade as Debugbar;



class CatalogosController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    //Sin importar cómo se resuelva esta inyección de dependencias, $miclase debe ser capaz de usar los métodos que dicta la interfaz.
    public function __construct(NotificacionesInterface $miclase)
    {
       
        //cuando trata de entrar en esta clase sino esta logueado lo redirecciona a login
        $this->middleware('auth');  
        $this->middleware('EsAdmin');  

    }


    //////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////Gestion de perfiles//////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////

    //listado de tabla perfiles
    public function index_perfil() {
        //$dtToronto = Carbon::create(2012, 1, 1, 0, 0, 0, 'America/Toronto');
        //$dtToronto = Carbon::now('America/mexico_city');
        //dd($dtToronto);





        $perfiles= Perfil::all()->take(10); 
        return view('catalogos.perfiles.perfiles',['title'=>'Listado de perfiles','perfiles'=>$perfiles]); 
    }
 
    //Crear un nuevo perfil
    public function create_perfil() { //motrar el formulario
        return view('catalogos.perfiles.create');
    }

    
    //validacion creacion de nuevo perfil
    public function store_perfil() { //procesar el formulario
        $data = request()->validate([
            'nombre_rol' => 'required',
        ], [
            'nombre_rol.required' => 'El campo nombre es obligatorio',
        ]);
        Perfil::create([  //creando o insertando un registro en perfil
            'nombre_rol' => $data['nombre_rol'],
        ]);
        return redirect()->route('perfiles.index'); //redirigiendo a 
    }


    //editar perfil
    public function edit_perfil(Perfil $perfil) {
        return view('catalogos.perfiles.edit', ['perfil' => $perfil]);
    }

    //validacion de edicion de perfiles
    public function update_perfil(Perfil $perfil){
        $data = request()->validate([
            'nombre_rol' => 'required',
        ]);

        $data['nombre_rol'] = $data['nombre_rol'];

        $perfil->update($data);
        return redirect()->route('perfiles.index'); 
    }

  
    function eliminar_perfil(Perfil $perfil){
        $perfil->delete();
        return redirect()->route('perfiles.index'); 
    }


//////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////Gestion de areas//////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////

    //listado de tabla areas
    public function index_area() {
        $areas= Area::all()->take(10); 
        return view('nomencladores.areas.areas',['title'=>'Listado de areas','areas'=>$areas]); 
    }
 
    //Crear un nuevo area
    public function create_area() { //motrar el formulario
        
        //todos los usuarios que contengan al menos 1 relaciones con cliente
        $clientes = User::has('cliente', '>=', 1)->get(); 
        //dd($clientes);
        return view('nomencladores.areas.create',['clientes'=>$clientes]);
    }

    
    //validacion creacion de nuevo area
    public function store_area() { //procesar el formulario
        $data = request()->validate([
            'nombre' => 'required',
            'user_id'=>'',
        ], [
            'nombre.required' => 'El campo nombre es obligatorio',
        ]);
        Area::create([  //creando o insertando un registro en area
            'nombre' => $data['nombre'],
            'user_id'=> $data['user_id'],
        ]);
        return redirect()->route('areas.index'); //redirigiendo a 
    }


    //editar area
    public function edit_area(area $area) {
        $clientes = User::has('cliente', '>=', 1)->get(); 
        return view('nomencladores.areas.edit', ['area' => $area,'clientes' => $clientes]);
    }

    //validacion de edicion de areas
    public function update_area(area $area){
        $data = request()->validate([
            'nombre' => 'required',
            'user_id'=>'',
        ]);

        $data['nombre'] = $data['nombre'];
        $area->update($data);
        return redirect()->route('areas.index'); 
    }

  
    function eliminar_area(area $area){
        $area->delete();
        return redirect()->route('areas.index'); 
    }


//////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////Gestion de puestos//////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////

    //listado de tabla puestos
    public function index_puesto() {
        $puestos= puesto::all()->take(10); 
        return view('nomencladores.puestos.puestos',['title'=>'Listado de puestos','puestos'=>$puestos]); 
    }
 
    //Crear un nuevo puesto
    public function create_puesto() { //motrar el formulario
        return view('nomencladores.puestos.create');
    }

    
    //validacion creacion de nuevo puesto
    public function store_puesto() { //procesar el formulario
        $data = request()->validate([
            'nombre' => 'required',
        ], [
            'nombre.required' => 'El campo nombre es obligatorio',
        ]);
        puesto::create([  //creando o insertando un registro en puesto
            'nombre' => $data['nombre'],
        ]);
        return redirect()->route('puestos.index'); //redirigiendo a 
    }


    //editar puesto
    public function edit_puesto(puesto $puesto) {
        return view('nomencladores.puestos.edit', ['puesto' => $puesto]);
    }

    //validacion de edicion de puestos
    public function update_puesto(puesto $puesto){
        $data = request()->validate([
            'nombre' => 'required',
        ]);

        $data['nombre'] = $data['nombre'];

        $puesto->update($data);
        return redirect()->route('puestos.index'); 
    }

  
    function eliminar_puesto(puesto $puesto){
        $puesto->delete();
        return redirect()->route('puestos.index'); 
    }





//////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////Gestion de situacions//////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////

    //listado de tabla situacions
    public function index_situacion() {
        $situacions= situacion::all()->take(10); 
        return view('nomencladores.situacions.situacions',['title'=>'Listado de situacions','situacions'=>$situacions]); 
    }
 
    //Crear un nuevo situacion
    public function create_situacion() { //motrar el formulario
        return view('nomencladores.situacions.create');
    }

    
    //validacion creacion de nuevo situacion
    public function store_situacion() { //procesar el formulario
        $data = request()->validate([
            'nombre' => 'required',
        ], [
            'nombre.required' => 'El campo nombre es obligatorio',
        ]);
        situacion::create([  //creando o insertando un registro en situacion
            'nombre' => $data['nombre'],
        ]);
        return redirect()->route('situacions.index'); //redirigiendo a 
    }


    //editar situacion
    public function edit_situacion(situacion $situacion) {
        return view('nomencladores.situacions.edit', ['situacion' => $situacion]);
    }

    //validacion de edicion de situacions
    public function update_situacion(situacion $situacion){
        $data = request()->validate([
            'nombre' => 'required',
        ]);

        $data['nombre'] = $data['nombre'];

        $situacion->update($data);
        return redirect()->route('situacions.index'); 
    }

  
    function eliminar_situacion(situacion $situacion){
        $situacion->delete();
        return redirect()->route('situacions.index'); 
    }



//////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////Gestion de estatus//////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////

    //listado de tabla estatus
    public function index_estatu() {
        $estatus= estatu::all()->take(10); 
        return view('nomencladores.estatus.estatus',['title'=>'Listado de estatus','estatus'=>$estatus]); 
    }
 
    //Crear un nuevo estatu
    public function create_estatu() { //motrar el formulario
        return view('nomencladores.estatus.create');
    }

    
    //validacion creacion de nuevo estatu
    public function store_estatu() { //procesar el formulario
        $data = request()->validate([
            'nombre' => 'required',
        ], [
            'nombre.required' => 'El campo nombre es obligatorio',
        ]);
        estatu::create([  //creando o insertando un registro en estatu
            'nombre' => $data['nombre'],
        ]);
        return redirect()->route('estatus.index'); //redirigiendo a 
    }


    //editar estatu
    public function edit_estatu(estatu $estatu) {
        return view('nomencladores.estatus.edit', ['estatu' => $estatu]);
    }

    //validacion de edicion de estatus
    public function update_estatu(estatu $estatu){
        $data = request()->validate([
            'nombre' => 'required',
        ]);

        $data['nombre'] = $data['nombre'];

        $estatu->update($data);
        return redirect()->route('estatus.index'); 
    }

  
    function eliminar_estatu(estatu $estatu){
        $estatu->delete();
        return redirect()->route('estatus.index'); 
    }


//////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////Gestion de semaforos//////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////

    //listado de tabla semaforos
    public function index_semaforo() {
        $semaforos= semaforo::all()->take(10); 
        return view('nomencladores.semaforos.semaforos',['title'=>'Listado de semaforos','semaforos'=>$semaforos]); 
    }
 
    //Crear un nuevo semaforo
    public function create_semaforo() { //motrar el formulario
        return view('nomencladores.semaforos.create');
    }

    
    //validacion creacion de nuevo semaforo
    public function store_semaforo() { //procesar el formulario
        $data = request()->validate([
            'nombre' => 'required',
        ], [
            'nombre.required' => 'El campo nombre es obligatorio',
        ]);
        semaforo::create([  //creando o insertando un registro en semaforo
            'nombre' => $data['nombre'],
        ]);
        return redirect()->route('semaforos.index'); //redirigiendo a 
    }


    //editar semaforo
    public function edit_semaforo(semaforo $semaforo) {
        return view('nomencladores.semaforos.edit', ['semaforo' => $semaforo]);
    }

    //validacion de edicion de semaforos
    public function update_semaforo(semaforo $semaforo){
        $data = request()->validate([
            'nombre' => 'required',
        ]);

        $data['nombre'] = $data['nombre'];

        $semaforo->update($data);
        return redirect()->route('semaforos.index'); 
    }

  
    function eliminar_semaforo(semaforo $semaforo){
        $semaforo->delete();
        return redirect()->route('semaforos.index'); 
    }



//////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////Gestion de fases//////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////

    //listado de tabla fases
    public function index_fase() {
        $fases= fase::all()->take(10); 
        return view('nomencladores.fases.fases',['title'=>'Listado de fases','fases'=>$fases]); 
    }
 
    //Crear un nuevo fase
    public function create_fase() { //motrar el formulario
        return view('nomencladores.fases.create');
    }

    
    //validacion creacion de nuevo fase
    public function store_fase() { //procesar el formulario
        $data = request()->validate([
            'nombre' => 'required',
        ], [
            'nombre.required' => 'El campo nombre es obligatorio',
        ]);
        fase::create([  //creando o insertando un registro en fase
            'nombre' => $data['nombre'],
        ]);
        return redirect()->route('fases.index'); //redirigiendo a 
    }


    //editar fase
    public function edit_fase(fase $fase) {
        return view('nomencladores.fases.edit', ['fase' => $fase]);
    }

    //validacion de edicion de fases
    public function update_fase(fase $fase){
        $data = request()->validate([
            'nombre' => 'required',
        ]);

        $data['nombre'] = $data['nombre'];

        $fase->update($data);
        return redirect()->route('fases.index'); 
    }

  
    function eliminar_fase(fase $fase){
        $fase->delete();
        return redirect()->route('fases.index'); 
    }


//////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////Gestion de tipo_entrevistas//////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////

    //listado de tabla tipo_entrevistas
    public function index_tipo_entrevista() {
        $tipo_entrevistas= tipo_entrevista::all()->take(10); 
        return view('nomencladores.tipo_entrevistas.tipo_entrevistas',['title'=>'Listado de tipo_entrevistas','tipo_entrevistas'=>$tipo_entrevistas]); 
    }
 
    //Crear un nuevo tipo_entrevista
    public function create_tipo_entrevista() { //motrar el formulario
        return view('nomencladores.tipo_entrevistas.create');
    }

    
    //validacion creacion de nuevo tipo_entrevista
    public function store_tipo_entrevista() { //procesar el formulario
        $data = request()->validate([
            'nombre' => 'required',
        ], [
            'nombre.required' => 'El campo nombre es obligatorio',
        ]);
        tipo_entrevista::create([  //creando o insertando un registro en tipo_entrevista
            'nombre' => $data['nombre'],
        ]);
        return redirect()->route('tipo_entrevistas.index'); //redirigiendo a 
    }


    //editar tipo_entrevista
    public function edit_tipo_entrevista(tipo_entrevista $tipo_entrevista) {
        return view('nomencladores.tipo_entrevistas.edit', ['tipo_entrevista' => $tipo_entrevista]);
    }

    //validacion de edicion de tipo_entrevistas
    public function update_tipo_entrevista(tipo_entrevista $tipo_entrevista){
        $data = request()->validate([
            'nombre' => 'required',
        ]);

        $data['nombre'] = $data['nombre'];

        $tipo_entrevista->update($data);
        return redirect()->route('tipo_entrevistas.index'); 
    }

  
    function eliminar_tipo_entrevista(tipo_entrevista $tipo_entrevista){
        $tipo_entrevista->delete();
        return redirect()->route('tipo_entrevistas.index'); 
    }


//////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////Gestion de tipo_vacantes//////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////

    //listado de tabla tipo_vacantes
    public function index_tipo_vacante() {
        $tipo_vacantes= tipo_vacante::all(); 
        return view('nomencladores.tipo_vacantes.tipo_vacantes',['title'=>'Listado de tipo_vacantes','tipo_vacantes'=>$tipo_vacantes]); 
    }
 
    //Crear un nuevo tipo_vacante
    public function create_tipo_vacante() { //motrar el formulario
        return view('nomencladores.tipo_vacantes.create');
    }

    
    //validacion creacion de nuevo tipo_vacante
    public function store_tipo_vacante() { //procesar el formulario
        $data = request()->validate([
            'nombre' => 'required',
        ], [
            'nombre.required' => 'El campo nombre es obligatorio',
        ]);
        tipo_vacante::create([  //creando o insertando un registro en tipo_vacante
            'nombre' => $data['nombre'],
        ]);
        return redirect()->route('tipo_vacantes.index'); //redirigiendo a 
    }


    //editar tipo_vacante
    public function edit_tipo_vacante(tipo_vacante $tipo_vacante) {
        return view('nomencladores.tipo_vacantes.edit', ['tipo_vacante' => $tipo_vacante]);
    }


    //validacion de edicion de tipo_vacantes
    public function update_tipo_vacante(tipo_vacante $tipo_vacante){
        $data = request()->validate([
            'nombre' => 'required',
        ]);

        $data['nombre'] = $data['nombre'];

        $tipo_vacante->update($data);
        return redirect()->route('tipo_vacantes.index'); 
    }

  
    function eliminar_tipo_vacante(tipo_vacante $tipo_vacante){
        $tipo_vacante->delete();
        return redirect()->route('tipo_vacantes.index'); 
    }


//////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////Gestion de vacantes//////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////

    //listado de tabla vacantes
    public function index_vacante() {
        $vacantes= vacante::all(); 
       

        return view('nomencladores.vacantes.vacantes',[
            'vacantes'=>$vacantes
        ]); 
    }
 
    //Crear un nuevo vacante
    public function create_vacante() { //motrar el formulario
        $areas= Area::all(); 
        $tipo_vacantes= Tipo_vacante::all(); 
        $zonas= Zona::all(); 
        $especialidads= Especialidad::all(); 
        $nivels= Nivel::all(); 
        $templates= Template::all(); 

        $adjuntos = Adjunto::get();

        //dd($adjuntos);

        return view('nomencladores.vacantes.create',[
            
            'areas'=>$areas,
            'tipo_vacantes'=>$tipo_vacantes,
            'zonas'=>$zonas,
            'especialidads'=>$especialidads,
            'nivels'=>$nivels,
            'templates'=>$templates,
            'adjuntos'=>$adjuntos,
            
            
        ]); 

    }

    
    //validacion creacion de nuevo vacante
    public function store_vacante() { //procesar el formulario
        $data = request()->validate([
            
            'area_id' => '',
            'tipo_vacante_id' => '',
            'nombre' => 'required',
            'sueldo' => '',
            'cantidad' => '',
            'especialidad_id' => '',
            'nivel_id' => '',
            'zona_id' => '',
            'dias' => '',
            'fecha' => '',
            'descripcion' => 'required',
            'template_id' => '',
            'activo.*' => '',

        ], [
            'nombre.required' => 'El campo nombre es obligatorio',
        ]);

        $vaca=vacante::create([  //creando o insertando un registro en vacante
            'fase_id' => 1,
            'semaforo_id' => 1,

            'area_id' => $data['area_id'],
            'tipo_vacante_id' => $data['tipo_vacante_id'],
            'nombre' => $data['nombre'],
            'sueldo' => $data['sueldo'],
            'cantidad' => $data['cantidad'],
            'especialidad_id' => $data['especialidad_id'],
            'nivel_id' => $data['nivel_id'],
            'zona_id' => $data['zona_id'],
            'dias' => $data['dias'],
            'fecha' => $data['fecha'],
            'descripcion' => $data['descripcion'],
            'template_id' => $data['template_id'],

        ]);

        
        //como se necesita recorrer todos
        $adjuntos = Adjunto::get();

        foreach ($adjuntos as $key => $valor) {

                    $dato['activo'] = 0; 
                if (isset($data['activo']) )
                    if   (   ( in_array( $valor->id, $data['activo'] ) ) ) {
                        $dato['activo'] = 1; 
                    } 


                
                $dato['adjunto_id'] = $valor->id; 
                $dato['vacante_id'] = $vaca->id;
                AdjuntoVacante::create($dato);


        }    

        


        return redirect()->route('vacantes.index'); //redirigiendo a 
    }


    //editar vacante
    public function edit_vacante(vacante $vacante) {

        $areas= Area::all(); 
        $tipo_vacantes= Tipo_vacante::all(); 
        $zonas= Zona::all(); 
        $especialidads= Especialidad::all(); 
        $nivels= Nivel::all(); 
        $templates= Template::all();
        
        //dd($vacante->id);

        $adjuntos = $vacante::where('id',"=",$vacante->id)->with('adjuntos')
                        ->get(); 

        //dd($adjuntos);                        

        return view('nomencladores.vacantes.edit',[
            'vacante' => $vacante,
            'areas'=>$areas,
            'tipo_vacantes'=>$tipo_vacantes,
            'zonas'=>$zonas,
            'especialidads'=>$especialidads,
            'nivels'=>$nivels,
            'templates'=>$templates,
            'adjuntos'=>$adjuntos,
        ]); 


    }

    //validacion de edicion de vacantes
    public function update_vacante(vacante $vacante){
        $data = request()->validate([
            'area_id' => '',
            'tipo_vacante_id' => '',
            'nombre' => 'required',
            'sueldo' => '',
            'cantidad' => '',
            'especialidad_id' => '',
            'nivel_id' => '',
            'zona_id' => '',
            'dias' => '',
            'fecha' => '',
            'descripcion' => 'required',
            'template_id' => '',  
            'activo.*' => '',    
        ]);        

        $data['nombre'] = $data['nombre'];
        $data['fase_id'] = 1;
        $data['semaforo_id'] = 1;


            //desactivar todos marcados
            $dato['activo'] = 0; 
            $dato['vacante_id'] = $vacante->id;
            $preg=AdjuntoVacante::where('vacante_id', $dato['vacante_id']);
            $preg->update($dato);

        if (isset($data['activo']) )    //activar los marcados
            foreach ($data['activo'] as $key => $valor) {
                $dato['activo'] = 1; 
                $dato['adjunto_id'] = $valor; 
                $dato['vacante_id'] = $vacante->id;
                $preg=AdjuntoVacante::where('adjunto_id', $dato['adjunto_id'])
                                        ->where('vacante_id', $dato['vacante_id'])
                                        ->first();
                $preg->update($dato);
                
            }


        $vacante->update($data);
        return redirect()->route('vacantes.index'); 
    }

  
    function eliminar_vacante(vacante $vacante){
        $vacante->delete();
        return redirect()->route('vacantes.index'); 
    }





//////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////Gestion de entrevistas//////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////

    //listado de tabla entrevistas
    public function index_entrevista() {
        $entrevistas= entrevista::all(); 
        return view('nomencladores.entrevistas.entrevistas',['title'=>'Listado de entrevistas','entrevistas'=>$entrevistas]); 
    }
 
    //Crear un nuevo entrevista
    public function create_entrevista() { //motrar el formulario
        return view('nomencladores.entrevistas.create');
    }

    
    //validacion creacion de nuevo entrevista
    public function store_entrevista() { //procesar el formulario
        $data = request()->validate([
            'nombre' => 'required',
        ], [
            'nombre.required' => 'El campo nombre es obligatorio',
        ]);
        entrevista::create([  //creando o insertando un registro en entrevista
            'nombre' => $data['nombre'],
        ]);
        return redirect()->route('entrevistas.index'); //redirigiendo a 
    }


    //editar entrevista
    public function edit_entrevista(entrevista $entrevista) {
        return view('nomencladores.entrevistas.edit', ['entrevista' => $entrevista]);
    }

    //validacion de edicion de entrevistas
    public function update_entrevista(entrevista $entrevista){
        $data = request()->validate([
            'nombre' => 'required',
        ]);

        $data['nombre'] = $data['nombre'];

        $entrevista->update($data);
        return redirect()->route('entrevistas.index'); 
    }

  
    function eliminar_entrevista(entrevista $entrevista){
        $entrevista->delete();
        return redirect()->route('entrevistas.index'); 
    }



//////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////Gestion de zonas//////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////
    
    //listado de tabla zonas
    public function index_zona() {
            //william regex        
        //$zona= zona::whereRaw('LENGTH(nombre)','>','4')->get();
        //$todo=Categoria::whereRaw(['$where' => ['this.codigo.length > 1']])->get();

        
        $zonas= zona::all(); 
        return view('nomencladores.zonas.zonas',['zonas'=>$zonas]); 
    }
 
    //Crear un nuevo zona
    public function create_zona() { //motrar el formulario
        return view('nomencladores.zonas.create');
    }

    
    //validacion creacion de nuevo zona
    public function store_zona() { //procesar el formulario
        $data = request()->validate([
            'nombre' => 'required',
        ], [
            'nombre.required' => 'El campo nombre es obligatorio',
        ]);
        zona::create([  //creando o insertando un registro en zona
            'nombre' => $data['nombre'],
        ]);
        return redirect()->route('zonas.index'); //redirigiendo a 
    }


    //editar zona
    public function edit_zona(zona $zona) {
        return view('nomencladores.zonas.edit', ['zona' => $zona]);
    }

    //validacion de edicion de zonas
    public function update_zona(zona $zona){
        $data = request()->validate([
            'nombre' => 'required',
        ]);

        $data['nombre'] = $data['nombre'];

        $zona->update($data);
        return redirect()->route('zonas.index'); 
    }

  
    function eliminar_zona(zona $zona){
        $zona->delete();
        return redirect()->route('zonas.index'); 
    }


//////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////Gestion de contactos//////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////
    
    //listado de tabla contactos
    public function index_contacto() {
            //william regex        
        //$contacto= contacto::whereRaw('LENGTH(nombre)','>','4')->get();
        //$todo=Categoria::whereRaw(['$where' => ['this.codigo.length > 1']])->get();

        
        $contactos= contacto::all(); 
        return view('nomencladores.contactos.contactos',['contactos'=>$contactos]); 
    }
 
    //Crear un nuevo contacto
    public function create_contacto() { //motrar el formulario
        return view('nomencladores.contactos.create');
    }

    
    //validacion creacion de nuevo contacto
    public function store_contacto() { //procesar el formulario
        $data = request()->validate([
            'nombre' => 'required',
        ], [
            'nombre.required' => 'El campo nombre es obligatorio',
        ]);
        contacto::create([  //creando o insertando un registro en contacto
            'nombre' => $data['nombre'],
        ]);
        return redirect()->route('contactos.index'); //redirigiendo a 
    }


    //editar contacto
    public function edit_contacto(contacto $contacto) {
        return view('nomencladores.contactos.edit', ['contacto' => $contacto]);
    }

    //validacion de edicion de contactos
    public function update_contacto(contacto $contacto){
        $data = request()->validate([
            'nombre' => 'required',
        ]);

        $data['nombre'] = $data['nombre'];

        $contacto->update($data);
        return redirect()->route('contactos.index'); 
    }

  
    function eliminar_contacto(contacto $contacto){
        $contacto->delete();
        return redirect()->route('contactos.index'); 
    }

//////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////Gestion de tipo_referencias//////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////
    
    //listado de tabla tipo_referencias
    public function index_tipo_referencia() {
            //william regex        
        //$tipo_referencia= tipo_referencia::whereRaw('LENGTH(nombre)','>','4')->get();
        //$todo=Categoria::whereRaw(['$where' => ['this.codigo.length > 1']])->get();

        
        $tipo_referencias= tipo_referencia::all(); 
        return view('nomencladores.tipo_referencias.tipo_referencias',['tipo_referencias'=>$tipo_referencias]); 
    }
 
    //Crear un nuevo tipo_referencia
    public function create_tipo_referencia() { //motrar el formulario
        return view('nomencladores.tipo_referencias.create');
    }

    
    //validacion creacion de nuevo tipo_referencia
    public function store_tipo_referencia() { //procesar el formulario
        $data = request()->validate([
            'nombre' => 'required',
        ], [
            'nombre.required' => 'El campo nombre es obligatorio',
        ]);
        tipo_referencia::create([  //creando o insertando un registro en tipo_referencia
            'nombre' => $data['nombre'],
        ]);
        return redirect()->route('tipo_referencias.index'); //redirigiendo a 
    }


    //editar tipo_referencia
    public function edit_tipo_referencia(tipo_referencia $tipo_referencia) {
        return view('nomencladores.tipo_referencias.edit', ['tipo_referencia' => $tipo_referencia]);
    }

    //validacion de edicion de tipo_referencias
    public function update_tipo_referencia(tipo_referencia $tipo_referencia){
        $data = request()->validate([
            'nombre' => 'required',
        ]);

        $data['nombre'] = $data['nombre'];

        $tipo_referencia->update($data);
        return redirect()->route('tipo_referencias.index'); 
    }

  
    function eliminar_tipo_referencia(tipo_referencia $tipo_referencia){
        $tipo_referencia->delete();
        return redirect()->route('tipo_referencias.index'); 
    }


//////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////Gestion de referencias//////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////
    

    //Crear un nuevo referencia
    public function create_referencia(Candidato $candidato) { //motrar el formulario
        $tipo_referencias= Tipo_referencia::all(); 
        return view('candidatos.edicion.referencias.create',[
                    'candidato'=>$candidato,
                    'tipo_referencias'=>$tipo_referencias,
                ]); 
    }

    
    //validacion creacion de nuevo referencia
    public function store_referencia(Candidato $candidato) { //procesar el formulario
        
        $data = request()->validate([
            'nombre' => 'required',
            'telefono' => 'required',
            'relacion' => 'required',
            'tipo_referencia_id' => 'required',
            'candidato_id' => '',
        ], [
            'nombre.required' => 'El campo nombre es obligatorio',
        ]);
        referencia::create([  //creando o insertando un registro en referencia

            'candidato_id' => $candidato->user_id,
            'nombre' => $data['nombre'],
            'telefono' => $data['telefono'],
            'relacion' => $data['relacion'],
            'tipo_referencia_id' => $data['tipo_referencia_id'],
            
            
        ]);
        return redirect('candidatos/'.$candidato->user_id.'/editar');
    }


    //editar referencia
    public function edit_referencia(referencia $referencia, Candidato $candidato) {
        
        $tipo_referencias= Tipo_referencia::all(); 
        return view('candidatos.edicion.referencias.edit', [
                        'referencia' => $referencia,
                        'candidato' => $candidato,
                        'tipo_referencias'=>$tipo_referencias,

                    ]);
    }

    //validacion de edicion de referencias
    public function update_referencia(referencia $referencia, Candidato $candidato){
        $data = request()->validate([
            'nombre' => 'required',
            'telefono' => 'required',
            'relacion' => 'required',
            'tipo_referencia_id' => 'required',
        ]);

        $data['nombre'] = $data['nombre'];

        $referencia->update($data);
        return redirect('candidatos/'.$candidato->user_id.'/editar');
    }

  
    function eliminar_referencia(referencia $referencia, Candidato $candidato){
        $referencia->delete();
        return redirect('candidatos/'.$candidato->user_id.'/editar');
    }



//////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////Gestion de adjuntos//////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////

    //listado de tabla adjuntos
    public function index_adjunto() {
        $adjuntos= adjunto::all()->take(10); 
        return view('nomencladores.adjuntos.adjuntos',['title'=>'Listado de adjuntos','adjuntos'=>$adjuntos]); 
    }
 
    //Crear un nuevo adjunto
    public function create_adjunto() { //motrar el formulario
        return view('nomencladores.adjuntos.create');
    }

    
    //validacion creacion de nuevo adjunto
    public function store_adjunto() { //procesar el formulario
        $data = request()->validate([
            'nombre' => 'required',
            'orden' => 'required',
        ], [
            'nombre.required' => 'El campo nombre es obligatorio',
            'orden.required' => 'El campo orden es obligatorio',
        ]);
        adjunto::create([  //creando o insertando un registro en adjunto
            'nombre' => $data['nombre'],
            'orden' => $data['orden'],
        ]);
        return redirect()->route('adjuntos.index'); //redirigiendo a 
    }


    //editar adjunto
    public function edit_adjunto(adjunto $adjunto) {
        return view('nomencladores.adjuntos.edit', ['adjunto' => $adjunto]);
    }

    //validacion de edicion de adjuntos
    public function update_adjunto(adjunto $adjunto){
        $data = request()->validate([
            'nombre' => 'required',
            'orden' => 'required',
        ], [
            'nombre.required' => 'El campo nombre es obligatorio',
            'orden.required' => 'El campo orden es obligatorio',
        ]);

        $data['nombre'] = $data['nombre'];

        $adjunto->update($data);
        return redirect()->route('adjuntos.index'); 
    }

  
    function eliminar_adjunto(adjunto $adjunto){
        $adjunto->delete();
        return redirect()->route('adjuntos.index'); 
    }





//////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////Gestion de templates//////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////

    //listado de tabla templates
    public function index_template() {
        $templates= template::all()->take(10); 
        return view('nomencladores.templates.templates',['title'=>'Listado de templates','templates'=>$templates]); 
    }
 
    //Crear un nuevo template
    public function create_template() { //motrar el formulario
        $preguntas = Pregunta::get(); //->toJson();
        //dd($preguntas);
        return view('nomencladores.templates.create', ['preguntas' => $preguntas ]);
    }

    
    //validacion creacion de nuevo template
    public function store_template() { //procesar el formulario
        $data = request()->validate([
            'nombre' => 'required',
            'dia.*' => 'required',
            'key.*' => 'required',
            
        ], [
            'nombre.required' => 'El campo nombre es obligatorio',
            'dia.*.required' => 'Todos los días son obligatorios',
            
        ]);

        $template = Template::create([  //creando o insertando un registro en template
            'nombre' => $data['nombre'],
        ]);

        foreach ($data['dia'] as $key => $valor) {
            $dato['dia'] = $data['dia'][$key];
            $dato['pregunta_id'] = $data['key'][$key];
            $dato['template_id'] = $template->id;
            PreguntaTemplate::create($dato);
            
        }



        return redirect()->route('templates.index'); //redirigiendo a 
    }

/*
        foreach ($data['dia'] as $key => $valor) {
            $dato['dia'] = $data['dia'][$key];
            $dato['pregunta_id'] = $data['key'][$key];
            $dato['template_id'] = $template->id;
            $preg=PreguntaTemplate::where('pregunta_id', $dato['pregunta_id'])
                                    ->where('template_id', $dato['template_id'])
                                    ->first();
            $preg->update($dato);
            
        }


        $template->update($data);
        return redirect()->route('templates.index'); 

*/




    //editar template
    public function edit_template(template $template) {
        $preguntas = $template::where('id',"=",$template->id)->with('preguntas')
                        ->get(); //->toJson();

        return view('nomencladores.templates.edit', ['template' => $template,'preguntas' => $preguntas ]);
    }


    //validacion de edicion de templates
    public function update_template(template $template){
        $data = request()->validate([
            'nombre' => 'required',
            'dia.*' => 'required',
            'key.*' => 'required',
            
        ], [
            'nombre.required' => 'El campo nombre es obligatorio',
            'dia.*.required' => 'Todos los días son obligatorios',
            
        ]);


        foreach ($data['dia'] as $key => $valor) {
            $dato['dia'] = $data['dia'][$key];
            $dato['pregunta_id'] = $data['key'][$key];
            $dato['template_id'] = $template->id;
            $preg=PreguntaTemplate::where('pregunta_id', $dato['pregunta_id'])
                                    ->where('template_id', $dato['template_id'])
                                    ->first();
            $preg->update($dato);
            
        }


        $template->update($data);
        return redirect()->route('templates.index'); 
    }

  
    function eliminar_template(template $template){
        $template->delete();
        return redirect()->route('templates.index'); 
    }

    //cargar template
    public function get_template(template $template) {
        $preguntas = $template::where('id',"=",$template->id)->with('preguntas')
                        ->get(); //->toJson();

        return $preguntas;
    }


//////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////Gestion de preguntas//////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////

    //listado de tabla preguntas
    public function index_pregunta() {
        $preguntas= pregunta::all()->take(10); 
        return view('nomencladores.preguntas.preguntas',['title'=>'Listado de preguntas','preguntas'=>$preguntas]); 
    }
 
    //Crear un nuevo pregunta
    public function create_pregunta() { //motrar el formulario
        return view('nomencladores.preguntas.create');
    }

    
    //validacion creacion de nuevo pregunta
    public function store_pregunta() { //procesar el formulario
        $data = request()->validate([
            'fase'  => 'required',
            'nombre' => 'required',
            'dia'  => 'required',
        ], [
            'fase.required' => 'El campo fase es obligatorio',
            'nombre.required' => 'El campo nombre es obligatorio',
            'dia.required' => 'El campo dia es obligatorio',
        ]);
        pregunta::create([  //creando o insertando un registro en pregunta
            'fase' => $data['fase'],
            'nombre' => $data['nombre'],
            'dia' => $data['dia'],
        ]);
        return redirect()->route('preguntas.index'); //redirigiendo a 
    }


    //editar pregunta
    public function edit_pregunta(pregunta $pregunta) {
        return view('nomencladores.preguntas.edit', ['pregunta' => $pregunta]);
    }

    //validacion de edicion de preguntas
    public function update_pregunta(pregunta $pregunta){
        $data = request()->validate([
            'fase'  => 'required',
            'nombre' => 'required',
            'dia'  => 'required',
        ], [
            'fase.required' => 'El campo fase es obligatorio',
            'nombre.required' => 'El campo nombre es obligatorio',
            'dia.required' => 'El campo dia es obligatorio',
        ]);

        $data['nombre'] = $data['nombre'];

        $pregunta->update($data);
        return redirect()->route('preguntas.index'); 
    }

  
    function eliminar_pregunta(pregunta $pregunta){
        $pregunta->delete();
        return redirect()->route('preguntas.index'); 
    }    


//////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////Gestion de especialidads//////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////

    //listado de tabla especialidads
    public function index_especialidad() {
        $especialidads= especialidad::all()->take(10); 
        return view('nomencladores.especialidads.especialidads',['title'=>'Listado de especialidads','especialidads'=>$especialidads]); 
    }
 
    //Crear un nuevo especialidad
    public function create_especialidad() { //motrar el formulario
        return view('nomencladores.especialidads.create');
    }

    
    //validacion creacion de nuevo especialidad
    public function store_especialidad() { //procesar el formulario
        $data = request()->validate([
            'nombre' => 'required',
        ], [
            'nombre.required' => 'El campo nombre es obligatorio',
        ]);
        especialidad::create([  //creando o insertando un registro en especialidad
            'nombre' => $data['nombre'],
        ]);
        return redirect()->route('especialidads.index'); //redirigiendo a 
    }


    //editar especialidad
    public function edit_especialidad(especialidad $especialidad) {
        return view('nomencladores.especialidads.edit', ['especialidad' => $especialidad]);
    }

    //validacion de edicion de especialidads
    public function update_especialidad(especialidad $especialidad){
        $data = request()->validate([
            'nombre' => 'required',
        ]);

        $data['nombre'] = $data['nombre'];

        $especialidad->update($data);
        return redirect()->route('especialidads.index'); 
    }

  
    function eliminar_especialidad(especialidad $especialidad){
        $especialidad->delete();
        return redirect()->route('especialidads.index'); 
    }


//////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////Gestion de nivels//////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////

    //listado de tabla nivels
    public function index_nivel() {
        $nivels= nivel::all()->take(10); 
        return view('nomencladores.nivels.nivels',['title'=>'Listado de nivels','nivels'=>$nivels]); 
    }
 
    //Crear un nuevo nivel
    public function create_nivel() { //motrar el formulario
        return view('nomencladores.nivels.create');
    }

    
    //validacion creacion de nuevo nivel
    public function store_nivel() { //procesar el formulario
        $data = request()->validate([
            'nombre' => 'required',
        ], [
            'nombre.required' => 'El campo nombre es obligatorio',
        ]);
        nivel::create([  //creando o insertando un registro en nivel
            'nombre' => $data['nombre'],
        ]);
        return redirect()->route('nivels.index'); //redirigiendo a 
    }


    //editar nivel
    public function edit_nivel(nivel $nivel) {
        return view('nomencladores.nivels.edit', ['nivel' => $nivel]);
    }

    //validacion de edicion de nivels
    public function update_nivel(nivel $nivel){
        $data = request()->validate([
            'nombre' => 'required',
        ]);

        $data['nombre'] = $data['nombre'];

        $nivel->update($data);
        return redirect()->route('nivels.index'); 
    }

  
    function eliminar_nivel(nivel $nivel){
        $nivel->delete();
        return redirect()->route('nivels.index'); 
    }



//////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////Gestion de estados//////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////

    //listado de tabla estados
    public function index_estado() {
        $estados= estado::all()->take(10); 
        return view('nomencladores.estados.estados',['title'=>'Listado de estados','estados'=>$estados]); 
    }
 
    //Crear un nuevo estado
    public function create_estado() { //motrar el formulario
        return view('nomencladores.estados.create');
    }

    
    //validacion creacion de nuevo estado
    public function store_estado() { //procesar el formulario
        $data = request()->validate([
            'nombre' => 'required',
        ], [
            'nombre.required' => 'El campo nombre es obligatorio',
        ]);
        estado::create([  //creando o insertando un registro en estado
            'nombre' => $data['nombre'],
        ]);
        return redirect()->route('estados.index'); //redirigiendo a 
    }


    //editar estado
    public function edit_estado(estado $estado) {
        return view('nomencladores.estados.edit', ['estado' => $estado]);
    }

    //validacion de edicion de estados
    public function update_estado(estado $estado){
        $data = request()->validate([
            'nombre' => 'required',
        ]);

        $data['nombre'] = $data['nombre'];

        $estado->update($data);
        return redirect()->route('estados.index'); 
    }

  
    function eliminar_estado(estado $estado){
        $estado->delete();
        return redirect()->route('estados.index'); 
    }




}
