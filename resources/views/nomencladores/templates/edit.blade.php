@extends('layouts.plantilla')
@section('title', "Editar usuario")

@section('content')
    <h1>{{ trans('aplicacion.e_template') }}</h1>

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

    <form method="POST" action="{{ url("templates/{$template->id}") }}"> 
        {{ method_field('PUT') }}
        {{ csrf_field() }}

        <div class="form-group">
            <label for="name">{{ trans('autenticacion.Name') }}:</label>
            <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Pedro Perez" value="{{ old('nombre', $template->nombre) }}">
        </div>


            {{-- pregunta--}}
             <div class="form-group">
                    @foreach ($preguntas as  $valor)
                    
                        @foreach ($valor->preguntas as $tag)
                            <p>Fase {{ $tag->id.': '.$tag->nombre}} 
                            
                            <input type="number" class="form-control1" name="dia[]" id="dia" placeholder="#" value="{{ old("dia[]", $tag->pivot->dia) }}">

                            <input type="hidden" name="key[]" value="{{  $tag->id}}">

                            </p>

                        @endforeach    
                    @endforeach
                        
             </div>         

       

        
        <button type="submit"  class="btn btn-primary">{{ trans('aplicacion.u_template') }}</button>
        <a href="{{ route('templates.index') }}" class="btn btn-danger">{{ trans('aplicacion.rl_template') }}</a>
        
        
    </form>

@endsection