@extends('layouts.plantilla')
@section('title', "Editar candidato")

@section('content')
    <h1>{{ trans('aplicacion.e_candidato') }}</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <h6>Por favor corrige los errores debajo:</h6>
            <ul>
                @foreach ($errors->all() as $error) 
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{--
        @include('candidatos.logo') 
    --}}    

<style>{{--    esto es para quitar la animacion a collapse     --}}    
    .collapsing {
        -webkit-transition: none;
        transition: none;
    }    

    button[aria-expanded="true"]{
      background-color: #007bff;
      color: #000;
    }
</style>    


    <input type="hidden" name="identificador" id="identificador" value="{{$candidato->id}}">
    <form method="POST" action="{{ url("candidatos/{$candidato->id}") }}"> 
        {{ method_field('PUT') }}
        {{ csrf_field() }}



        <p>
          <button class="btn btn-outline-primary" type="button" data-toggle="collapse" data-target="#p1, .naveg.show" aria-expanded="false" >1. {{trans('aplicacion.p_candidato')}} </button>

          <button class="btn btn-outline-primary" type="button" data-toggle="collapse" data-target="#p2, .naveg.show" aria-expanded="false">2. {{trans('aplicacion.pcontacto')}} </button>


         <button class="btn btn-outline-primary" type="button" data-toggle="collapse" data-target="#p3, .naveg.show" aria-expanded="false">3. {{trans('aplicacion.entre_eva')}} </button>


         <button class="btn btn-outline-primary" type="button" data-toggle="collapse" data-target="#p4, .naveg.show" aria-expanded="false">4. {{trans('aplicacion.aresultado')}} </button>


         <button class="btn btn-outline-primary" type="button" data-toggle="collapse" data-target="#p5, .naveg.show" aria-expanded="false">5. {{trans('aplicacion.l_referencia')}}  </button>


         <button class="btn btn-outline-primary" type="button" data-toggle="collapse" data-target="#p6, .naveg.show" aria-expanded="false">6. {{trans('aplicacion.documento')}} </button>


         <button class="btn btn-outline-primary" type="button" data-toggle="collapse" data-target="#p7, .naveg.show" aria-expanded="false">7. {{trans('aplicacion.i_situacion')}}  </button>



        <p>  
    

        <div class="row">
              <div class="col-12">


                <div class="collapse naveg" id="p1">                 
                        {{--  1) Perfil de Candidato   --}}
                        @include('candidatos.edicion.perfil_candidato') 
                </div>
                <div class="collapse naveg" id="p2">
                        {{--  2) primer Contacto   --}}
                        @include('candidatos.edicion.primer_contacto') 
                </div>
                <div class="collapse naveg" id="p3">
                        {{--  3) Entrevistas y evaluaciones   --}}
                        @include('candidatos.edicion.entrevistas')
                </div>
                <div class="collapse naveg" id="p4">
                        {{--  4) Análisis de Resultap2   --}}
                         @include('candidatos.edicion.analisis_resultado') 
                </div>
                <div class="collapse naveg" id="p5">         
                        {{--  5) Referencias personales   --}}
                         @include('candidatos.edicion.referencias.referencia_personal') 
                </div>
                <div class="collapse naveg" id="p6">
                        {{--  6) Documentos ***depende del 1)  --}}
                        @include('candidatos.edicion.documentos')
                </div>
                <div class="collapse naveg" id="p7">
                        {{--  7) Estatus Final   --}}
                         @include('candidatos.edicion.estatus_final') 
                </div>


              </div>
        </div>        

       
        <div class="row mt-2">
            <div class="col-3">
                <a href="{{ route('candidatos.index') }}" class="btn btn-outline-danger">{{ trans('aplicacion.descartar') }}</a>
            </div>
            <div class="col-3">
                <button type="button" id="ant_candidato" class="btn btn-primary">{{ trans('aplicacion.regresar') }}</button>
            </div>
            <div class="col-3">
                <button type="submit"  class="btn btn-outline-primary">{{ trans('aplicacion.u_candidato') }}</button>
            </div>
            <div class="col-3">
                <button type="button" id="sig_candidato" class="btn btn-primary">{{ trans('aplicacion.siguiente') }}</button>
            </div>    
        </div>
        
        
    </form>

@endsection