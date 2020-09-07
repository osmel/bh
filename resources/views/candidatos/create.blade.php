@extends('layouts.plantilla')
@section('title', "Crear usuario")

@section('content')
      <div class="card">
        <h4 class="card-header"> {{ trans('aplicacion.c_candidato') }}</h4>
        <div class="card-body">

           {{-- Esto es para mostrar listado de errores al comienzo --}}
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
@include('usuarios.logo')             

@include('usuarios.galeria') 
@include('usuarios.mostrargaleria') 
--}}
            <form method="POST" action="{{ route('candidatos.crear') }}">
                {{ csrf_field() }}



<p>
          <button class="btn btn-primary" type="button" >1. {{trans('aplicacion.p_candidato')}} </button>

          <button disabled class="btn btn-outline-primary" type="button" >2. {{trans('aplicacion.pcontacto')}} </button>


         <button disabled class="btn btn-outline-primary" type="button" >3. {{trans('aplicacion.entre_eva')}} </button>


         <button disabled class="btn btn-outline-primary" type="button" >4. {{trans('aplicacion.aresultado')}} </button>


         <button disabled class="btn btn-outline-primary" type="button" >5. {{trans('aplicacion.l_referencia')}}  </button>


         <button disabled class="btn btn-outline-primary" type="button" >6. {{trans('aplicacion.documento')}} </button>


         <button disabled class="btn btn-outline-primary" type="button" >7. {{trans('aplicacion.i_situacion')}}  </button>



        <p>  


            <div class="row">
              <div class="col-12">
                            {{--  1) Perfil de Candidato   --}}
                            @include('candidatos.crear.perfil_candidato') 
                </div>    
            </div>    


               <div class="form-group">
                    <label for="password">{{ trans('autenticacion.Password') }}:</label>
                    <input type="password" class="form-control" name="password" id="password" placeholder="Mayor a 6 caracteres">
                </div>

                
                


        <div class="row mt-2">
            <div class="col-3">
                <a href="{{ route('candidatos.index') }}" class="btn btn-outline-danger">{{ trans('aplicacion.descartar') }}</a>
            </div>
            <div class="col-3">
                <button type="button" disabled class="btn btn-primary">{{ trans('aplicacion.regresar') }}</button>
            </div>
            <div class="col-3">
                <button type="submit"  class="btn btn-outline-primary">{{ trans('aplicacion.c_candidato') }}</button>
            </div>
            <div class="col-3">
                <button type="button" disabled class="btn btn-primary">{{ trans('aplicacion.siguiente') }}</button>
            </div>    
        </div>



            

            </form>
            
        </div>
    </div>
@endsection