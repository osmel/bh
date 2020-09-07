@extends('layouts.plantilla')
@section('title', "Editar usuario")

@section('content')
    <h1>{{ trans('aplicacion.e_pregunta') }}</h1>

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

    <form method="POST" action="{{ url("preguntas/{$pregunta->id}") }}"> 
        {{ method_field('PUT') }}
        {{ csrf_field() }}


        <div class="form-group">
            <label for="fase">{{ trans('aplicacion.fase') }}:</label>
            <input type="number" class="form-control" name="fase" id="fase" placeholder="#" value="{{ old('fase', $pregunta->fase) }}">
        </div> 

        <div class="form-group">
            <label for="name">{{ trans('autenticacion.Name') }}:</label>
            <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Pedro Perez" value="{{ old('nombre', $pregunta->nombre) }}">
        </div>


        <div class="form-group">
            <label for="dia">{{ trans('aplicacion.dia') }}:</label>
            <input type="number" class="form-control" name="dia" id="dia" placeholder="#" value="{{ old('dia', $pregunta->dia) }}">
        </div>         

       

        
        <button type="submit"  class="btn btn-primary">{{ trans('aplicacion.u_pregunta') }}</button>
        <a href="{{ route('preguntas.index') }}" class="btn btn-danger">{{ trans('aplicacion.rl_pregunta') }}</a>
        
        
    </form>

@endsection