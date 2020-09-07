@extends('layouts.plantilla')
@section('title', "Editar usuario")

@section('content')
    <h1>{{ trans('aplicacion.e_area') }}</h1>

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

    <form method="POST" action="{{ url("areas/{$area->id}") }}"> 
        {{ method_field('PUT') }}
        {{ csrf_field() }}

            {{-- user--}}
             <div class="form-group">
                    <label for="user_id">{{ trans('aplicacion.warehouse') }}:</label>
                        <select name="user_id" id="user_id"  tipo="entrada"  class="form-control">
                                @foreach ($clientes as $key => $valor)
                                    <option value="{{ $valor->id }}"
                                    
                                        @if ($area->user_id == old('user_id', $valor->id))
                                            selected="selected"
                                        @endif
                                    >{{ $valor->name  }}</option>
                                @endforeach
                        </select>
            </div>         

        <div class="form-group">
            <label for="name">{{ trans('autenticacion.Name') }}:</label>
            <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Pedro Perez" value="{{ old('nombre', $area->nombre) }}">
        </div>

       

        
        <button type="submit"  class="btn btn-primary">{{ trans('aplicacion.u_area') }}</button>
        <a href="{{ route('areas.index') }}" class="btn btn-danger">{{ trans('aplicacion.rl_area') }}</a>
        
        
    </form>

@endsection