@extends('layouts.plantilla')
@section('title', "Crear usuario")

@section('content')
      <div class="card">
        <h4 class="card-header"> {{ trans('aplicacion.Create user') }}</h4>
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
            <form method="POST" action="{{ route('users.crear') }}">
                {{ csrf_field() }}


                 <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="name">{{ trans('aplicacion.n_completo') }}:</label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="Pedro Perez" value="{{ old('name') }}">
                        </div>

                        <div class="form-group">
                            <label for="email">{{ trans('aplicacion.correo') }}:</label>
                            <input type="email" class="form-control" name="email" id="email" placeholder="pedro@example.com" value="{{ old('email') }}">
                        </div>
                    </div>    
                    <div class="col-6">
                        {{-- Perfiles o roles--}}
                         <div class="form-group">
                                <label for="role_id">{{ trans('aplicacion.roles') }}:</label>
                                    <select name="role_id" id="role_id"  tipo="entrada"  class="form-control">
                                            @foreach ($perfiles as $key => $valor)
                                                <option value="{{ $valor->id }}"
                                                
                                                    @if ($valor->id == old('role_id'))
                                                        selected="selected"
                                                    @endif
                                                >{{ $valor->nombre_rol  }}</option>
                                            @endforeach
                                    </select>
                        </div> 



                    <div class="form-group">
                        <label for="password">{{ trans('autenticacion.Password') }}:</label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="Mayor a 6 caracteres">
                    </div>


                    </div>        

                </div> 


             

                <button type="submit" class="btn btn-primary">{{ trans('aplicacion.Create user') }}</button>
                <a href="{{ route('users.index') }}" class="btn btn-danger">{{ trans('aplicacion.Return to user list') }}</a>
            </form>
            
        </div>
    </div>
@endsection