@extends('layouts.plantilla')
@section('title', "Crear usuario")

@section('content')
      <div class="card">
        <h4 class="card-header"> {{ trans('aplicacion.c_referencia') }}</h4>
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
            

            <form method="POST" action="{{ url("referencias/crear/{$candidato->user_id}") }}">
                {{ csrf_field() }}

                <div class="form-group">
                    <label for="nombre">{{ trans('autenticacion.Name') }}:</label>
                    <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Pedro Perez" value="{{ old('nombre') }}">
                </div>

                <div class="form-group">
                    <label for="telefono">{{ trans('aplicacion.telefono') }}:</label>
                    <input type="text" class="form-control" name="telefono" id="telefono" placeholder="555533333" value="{{ old('telefono') }}">
                </div>        

                <div class="form-group">
                    <label for="relacion">{{ trans('aplicacion.relacion') }}:</label>
                    <input type="text" class="form-control" name="relacion" id="relacion" placeholder="555533333" value="{{ old('relacion') }}">
                </div>  

                    {{-- tipo_referencia--}}
                     <div class="form-group">
                            <label for="tipo_referencia_id">{{ trans('aplicacion.tipo_referencia') }}:</label>
                                <select name="tipo_referencia_id" id="tipo_referencia_id"  tipo="entrada"  class="form-control">
                                        @foreach ($tipo_referencias as $key => $valor)

                                            <option value="{{ $valor->id }}"
                                                @if ($valor->id == old('tipo_referencia_id') )
                                                    selected="selected"
                                                @endif
                                            >{{ $valor->nombre  }}</option>

                                        @endforeach
                                </select>
                     </div>                 

               

                <button type="submit" class="btn btn-primary">{{ trans('aplicacion.c_referencia') }}</button>
               <a href="{{ url("candidatos/{$candidato->user_id}/editar") }}" class="btn btn-danger">{{ trans('aplicacion.rl_referencia') }}</a>
            </form>
        </div>
    </div>
@endsection