@extends('layouts.plantilla')
@section('title', "Crear usuario")

@section('content')
      <div class="card">
        <h4 class="card-header"> {{ trans('aplicacion.c_adjunto') }}</h4>
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
            

            <form method="POST" action="{{ route('adjuntos.crear') }}">
                {{ csrf_field() }}

                <div class="form-group">
                    <label for="nombre">{{ trans('autenticacion.Name') }}:</label>
                    <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Pedro Perez" value="{{ old('nombre') }}">
                </div>

                <div class="form-group">
                    <label for="orden">{{ trans('aplicacion.orden') }}:</label>
                    <input type="number" class="form-control" name="orden" id="orden" placeholder="#" value="{{ old('orden') }}">
                </div>
               

                <button type="submit" class="btn btn-primary">{{ trans('aplicacion.c_adjunto') }}</button>
                <a href="{{ route('adjuntos.index') }}" class="btn btn-danger">{{ trans('aplicacion.rl_adjunto') }}</a>
            </form>
        </div>
    </div>
@endsection