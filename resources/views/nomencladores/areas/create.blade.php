@extends('layouts.plantilla')
@section('title', "Crear usuario")

@section('content')
      <div class="card">
        <h4 class="card-header"> {{ trans('aplicacion.c_area') }}</h4>
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
            

            <form method="POST" action="{{ route('areas.crear') }}">
                {{ csrf_field() }}

                {{-- user --}}
                 <div class="form-group">
                        <label for="user_id">{{ trans('aplicacion.user') }}:</label>
                            <select name="user_id" id="user_id"  tipo="entrada"  class="form-control">
                                    @foreach ($clientes as $key => $valor)
                                        <option value="{{ $valor->id }}"
                                        
                                            @if ($key == old('user_id', $valor->id))
                                                selected="selected"
                                            @endif
                                        >{{ $valor->name  }}</option>
                                    @endforeach
                            </select>
                </div> 
                <div class="form-group">
                    <label for="nombre">{{ trans('autenticacion.Name') }}:</label>
                    <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Pedro Perez" value="{{ old('nombre') }}">
                </div>

               

                <button type="submit" class="btn btn-primary">{{ trans('aplicacion.c_area') }}</button>
                <a href="{{ route('areas.index') }}" class="btn btn-danger">{{ trans('aplicacion.rl_area') }}</a>
            </form>
        </div>
    </div>
@endsection