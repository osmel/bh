@extends('layouts.plantilla')
@section('title', "Crear usuario")

@section('content')
      <div class="card">
        <h4 class="card-header"> {{ trans('aplicacion.c_cliente') }}</h4>
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
            <form method="POST" action="{{ route('clientes.crear') }}">
                {{ csrf_field() }}
 <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label for="name">{{ trans('aplicacion.n_completo') }}:</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Pedro Perez" value="{{ old('name') }}">
                </div>

                    {{-- puesto--}}
                 <div class="form-group">
                        <label for="puesto_id">{{ trans('aplicacion.puestos') }}:</label>
                            <select name="puesto_id" id="puesto_id"  tipo="entrada"  class="form-control">
                                    @foreach ($puestos as $key => $valor)
                                        <option value="{{ $valor->id }}"
                                            
                                            @if ($valor->id == old('puesto_id') )
                                                selected="selected"
                                            @endif
                                        >{{ $valor->nombre  }}</option>
                                    @endforeach
                            </select>
                </div>        
            </div>    
            <div class="col-6">

                <div class="form-group"> {{-- pattern="[0-9]{3}-[0-9]{2}-[0-9]{3}" --}}
                    <label for="telefono">{{ trans('aplicacion.movil') }}:</label>
                    <input 
                            placeholder="+52 (__) __-__-__-__" data-slots="_"
                            pattern="\+[0-9]{2} \([0-9]{2}\) [0-9]{2}-[0-9]{2}-[0-9]{2}-[0-9]{2}"
                    type="tel"  class="form-control" name="telefono" id="telefono"  value="{{ old('telefono') }}">
                </div> 

                <div class="form-group">
                    <label for="email">{{ trans('aplicacion.correo') }}:</label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="pedro@example.com" value="{{ old('email') }}">
                </div>
            </div>    
        </div>     



            {{-- Perfiles o roles--}}
             <div class="form-group" style="display:none;">
                    <label for="role_id">{{ trans('aplicacion.roles') }}:</label>
                        <select name="role_id" id="role_id"  tipo="entrada"  class="form-control">
                                @foreach ($perfiles as $key => $valor)
                                    <option value="{{ $valor->id }}"
                                        
                                        @if ($valor->id == old('role_id') )
                                            selected="selected"
                                        @endif
                                    >{{ $valor->nombre_rol  }}</option>
                                @endforeach
                        </select>
            </div> 



        <div class="form-group" style="display:none;">
            <label for="password">{{ trans('autenticacion.Password') }}:</label>
            <input type="password" class="form-control" name="password" id="password" placeholder="Mayor a 6 caracteres" value="nada">
        </div>

                <button type="submit" class="btn btn-primary">{{ trans('aplicacion.c_cliente') }}</button>
                <a href="{{ route('clientes.index') }}" class="btn btn-danger">{{ trans('aplicacion.rl_cliente') }}</a>
            </form>
            
        </div>
    </div>
@endsection