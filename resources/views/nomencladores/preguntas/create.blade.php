@extends('layouts.plantilla')
@section('title', "Crear usuario")

@section('content')
      <div class="card">
        <h4 class="card-header"> {{ trans('aplicacion.c_pregunta') }}</h4>
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
            

            <form method="POST" action="{{ route('preguntas.crear') }}">
                {{ csrf_field() }}


                <div class="form-group">
                    <label for="fase">{{ trans('aplicacion.fase') }}:</label>
                    <input type="number"  class="form-control" name="fase" id="fase" placeholder="#" value="{{ old('fase') }}">
                </div>

                <div class="form-group">
                    <label for="nombre">{{ trans('autenticacion.Name') }}:</label>
                    <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Pedro Perez" value="{{ old('nombre') }}">
                </div>

                <div class="form-group">
                    <label for="dia">{{ trans('aplicacion.dia') }}:</label>
                    <input type="number"  class="form-control" name="dia" id="dia" placeholder="#" value="{{ old('dia') }}">
                </div>                

               

                <button type="submit" class="btn btn-primary">{{ trans('aplicacion.c_pregunta') }}</button>
                <a href="{{ route('preguntas.index') }}" class="btn btn-danger">{{ trans('aplicacion.rl_pregunta') }}</a>
            </form>
        </div>
    </div>
@endsection