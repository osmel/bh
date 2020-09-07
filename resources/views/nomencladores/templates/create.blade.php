@extends('layouts.plantilla')
@section('title', "Crear usuario")

@section('content')
      <div class="card">
        <h4 class="card-header"> {{ trans('aplicacion.c_template') }}</h4>
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
            

            <form method="POST" action="{{ route('templates.crear') }}">
                {{ csrf_field() }}

                <div class="form-group">
                    <label for="nombre">{{ trans('autenticacion.Name') }}:</label>
                    <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Pedro Perez" value="{{ old('nombre') }}">
                </div>

            {{-- pregunta--}}
             <div class="form-group">
                    @foreach ($preguntas as  $valor)
                       
                            <p>Fase {{ $valor->fase.': '.$valor->nombre}} 
                            <input type="number" class="form-control1" name="dia[]" id="dia" placeholder="#" value="{{ old('dia[]') }}">   
                            <input type="hidden" name="key[]" value="{{  $valor->id}}">  
                            
                            </p>

                       
                    @endforeach
                        
                 </div>                     

               

                <button type="submit" class="btn btn-primary">{{ trans('aplicacion.c_template') }}</button>
                <a href="{{ route('templates.index') }}" class="btn btn-danger">{{ trans('aplicacion.rl_template') }}</a>
            </form>
        </div>
    </div>
@endsection