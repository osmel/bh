@extends('layouts.plantilla')
@section('title', "Crear usuario")

@section('content')
      <div class="card">
        <h4 class="card-header"> {{ trans('aplicacion.Create variations') }}</h4>
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
            

            <form method="POST" action="{{ route('variacions.crear') }}">
                {{ csrf_field() }}

                <div class="form-group">
                    <label for="nombre">{{ trans('autenticacion.Name') }}:</label>
                    <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Pedro Perez" value="{{ old('nombre') }}">
                </div>

              {{-- modelo--}}
              
                <div class="form-group" style="display:{{ ( (Auth::user()->role_id==1) ? '' : 'none') }}" >
                    
                    <div class="col-sm-12">
                        <label for="precio">{{ trans('aplicacion.variations') }}:</label>
                            <select name="modelo_id" id="modelo_id"  tipo="entrada"  class="form-control">
                                    @foreach ($modelos as $key => $valor)
                                        <option value="{{ $valor->id }}"
                                            @if (   ( (empty(Auth::user()->modelo_id)) ? 1 : Auth::user()->modelo_id) == old('modelo_id', $valor->id))
                                                selected="selected"
                                            @endif
                                        >{{ $valor->nombre  }}</option>
                                    @endforeach
                            </select>
                    </div>
                    
                </div>    

               

                <button type="submit" class="btn btn-primary">{{ trans('aplicacion.Create variations') }}</button>
                <a href="{{ route('variacions.index') }}" class="btn btn-danger">{{ trans('aplicacion.Return to variations list') }}</a>
            </form>
        </div>
    </div>
@endsection