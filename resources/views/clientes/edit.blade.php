@extends('layouts.plantilla')
@section('title', "Editar cliente")


@section('content')
    <h1>{{ trans('aplicacion.e_cliente') }}</h1>

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

    @include('clientes.logo') 
    
    <form method="POST" action="{{ url("clientes/{$cliente->id}") }}"> 
        {{ method_field('PUT') }}
        {{ csrf_field() }}

        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label for="name">{{ trans('aplicacion.n_completo') }}:</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Pedro Perez" value="{{ old('name', $cliente->name) }}">
                </div>

                    {{-- puesto--}}
                 <div class="form-group">
                        <label for="puesto_id">{{ trans('aplicacion.puestos') }}:</label>
                            <select name="puesto_id" id="puesto_id"  tipo="entrada"  class="form-control">
                                    @foreach ($puestos as $key => $valor)
                                        <option value="{{ $valor->id }}"
                                        
                                            @if ($cliente->cliente->puesto_id == old('puesto_id', $valor->id))
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

                    type="tel"  class="form-control" name="telefono" id="telefono" placeholder="5510506072" value="{{ old('telefono', $cliente->cliente->telefono) }}">

                         


                </div> 

                <div class="form-group">
                    <label for="email">{{ trans('aplicacion.correo') }}:</label>
                    <input 
                    type="email" class="form-control" name="email" id="email" placeholder="pedro@example.com" value="{{ old('email', $cliente->email) }}">
                </div>
            </div>    
        </div>     



            {{-- Perfiles o roles--}}
             <div class="form-group" style="display:none;">
                    <label for="role_id">{{ trans('aplicacion.roles') }}:</label>
                        <select name="role_id" id="role_id"  tipo="entrada"  class="form-control">
                                @foreach ($perfiles as $key => $valor)
                                    <option value="{{ $valor->id }}"
                                    
                                        @if ($cliente->role_id == old('role_id', $valor->id))
                                            selected="selected"
                                        @endif
                                    >{{ $valor->nombre_rol  }}</option>
                                @endforeach
                        </select>
            </div> 



        <div class="form-group" style="display:none;">
            <label for="password">{{ trans('autenticacion.Password') }}:</label>
            <input type="password" class="form-control" name="password" id="password" placeholder="Mayor a 6 caracteres" value="{{ old('password', $cliente->password) }}">

        </div>

        
        <button type="submit"  class="btn btn-primary">{{ trans('aplicacion.u_cliente') }}</button>
        <a href="{{ route('clientes.index') }}" class="btn btn-danger">{{ trans('aplicacion.rl_cliente') }}</a>
        
        
    </form>

@endsection