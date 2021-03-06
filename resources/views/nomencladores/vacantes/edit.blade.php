@extends('layouts.plantilla')
@section('title', "Editar usuario")

@section('content')
    <h1>{{ trans('aplicacion.e_vacante') }}</h1>

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

    <form method="POST" action="{{ url("vacantes/{$vacante->id}") }}"> 
        {{ method_field('PUT') }}
        {{ csrf_field() }}
        <div class="row">
        
        <div class="col-md-4">
            
            {{-- area--}}
             <div class="form-group">
                    <label for="area_id">{{ trans('aplicacion.area') }}:</label>
                        <select name="area_id" id="area_id"  tipo="entrada"  class="form-control">
                                @foreach ($areas as $key => $valor)
                                    <option value="{{ $valor->id }}"
                                    
                                        @if ($vacante->area_id == old('area_id', $valor->id))
                                            selected="selected"
                                        @endif
                                    >{{ $valor->nombre  }}</option>
                                @endforeach
                        </select>
             </div>  
        
            {{-- tipo_vacante--}}
             <div class="form-group">
                    <label for="tipo_vacante_id">{{ trans('aplicacion.tipo_vacante') }}:</label>
                        <select name="tipo_vacante_id" id="tipo_vacante_id"  tipo="entrada"  class="form-control">
                                @foreach ($tipo_vacantes as $key => $valor)
                                    <option value="{{ $valor->id }}"
                                    
                                        @if ($vacante->tipo_vacante_id == old('tipo_vacante_id', $valor->id))
                                            selected="selected"
                                        @endif
                                    >{{ $valor->nombre  }}</option>
                                @endforeach
                        </select>
            </div>  

           <div class="form-group">
                <label for="name">{{ trans('autenticacion.Name') }}:</label>
                <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Pedro Perez" value="{{ old('nombre', $vacante->nombre) }}">
            </div>

            <div class="form-group">
                <label for="sueldo">{{ trans('aplicacion.sueldo') }}:</label>
                <input type="number"  min="0"  pattern="^\d*(\.\d{0,2})?$" step="any" class="form-control" name="sueldo" id="sueldo" placeholder="#.##" value="{{ old('sueldo', $vacante->sueldo) }}">
            </div>

        </div>
        
        <div class="col-md-4">


            <div class="form-group">
                <label for="cantidad">{{ trans('aplicacion.cantidad') }}:</label>
                <input type="number" class="form-control" name="cantidad" id="cantidad" placeholder="#.##" value="{{ old('cantidad', $vacante->cantidad) }}">
            </div>            
            {{-- especialidad--}}
             <div class="form-group">
                    <label for="especialidad_id">{{ trans('aplicacion.especialidad') }}:</label>
                        <select name="especialidad_id" id="especialidad_id"  tipo="entrada"  class="form-control">
                                @foreach ($especialidads as $key => $valor)
                                    <option value="{{ $valor->id }}"
                                    
                                        @if ($vacante->especialidad_id == old('especialidad_id', $valor->id))
                                            selected="selected"
                                        @endif
                                    >{{ $valor->nombre  }}</option>
                                @endforeach
                        </select>
            </div>  
            {{-- nivel--}}
             <div class="form-group">
                    <label for="nivel_id">{{ trans('aplicacion.nivel') }}:</label>
                        <select name="nivel_id" id="nivel_id"  tipo="entrada"  class="form-control">
                                @foreach ($nivels as $key => $valor)
                                    <option value="{{ $valor->id }}"
                                    
                                        @if ($vacante->nivel_id == old('nivel_id', $valor->id))
                                            selected="selected"
                                        @endif
                                    >{{ $valor->nombre  }}</option>
                                @endforeach
                        </select>
            </div>   

            {{-- zona--}}
             <div class="form-group">
                    <label for="zona_id">{{ trans('aplicacion.zona') }}:</label>
                        <select name="zona_id" id="zona_id"  tipo="entrada"  class="form-control">
                                @foreach ($zonas as $key => $valor)
                                    <option value="{{ $valor->id }}"
                                    
                                        @if ($vacante->zona_id == old('zona_id', $valor->id))
                                            selected="selected"
                                        @endif
                                    >{{ $valor->nombre  }}</option>
                                @endforeach
                        </select>
            </div>                                             
        </div> 

       <div class="col-md-4 col-md-offset-4">
            <div class="form-group">
                <label for="fecha">{{ trans('aplicacion.f_registro') }}</label>
                <input disabled type="text" class="form-control datepicker"
                 value="{{ $vacante->created_at }}">
                <div class="input-group-addon">
                     <span class="glyphicon glyphicon-th"></span>
                </div>     
            </div>

            <div class="form-group">
                <label for="dias">{{ trans('aplicacion.d_prom') }}</label>
                <input type="number" class="form-control" name="dias" id="dias" placeholder="#.##" value="{{ old('dias', $vacante->dias) }}">
            </div>
           
            <div class="form-group">
                <label for="fecha">{{ trans('aplicacion.f_inicio') }}</label>
                <input type="text" class="form-control datepicker" name="fecha" value="{{ old('fecha', $vacante->fecha) }}">
                <div class="input-group-addon">
                     <span class="glyphicon glyphicon-th"></span>
                </div>     
            </div>    

        </div>     

         </div>
       

        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="descripcion">{{ trans('aplicacion.descripcion') }}:</label>
                    <input type="text" class="form-control" name="descripcion" id="descripcion" placeholder="Texto Plano" value="{{ old('descripcion', $vacante->descripcion) }}">
                </div>
            </div>    
        </div>             


        <div class="row">
            <div class="col-md-6">
                {{-- template--}}
                 <div class="form-group">
                        <label for="template_id">{{ trans('aplicacion.template') }}:</label>
                            <select name="template_id" id="template_id"  tipo="entrada"  class="form-control">
                                    @foreach ($templates as $key => $valor)

                                        <option value="{{ $valor->id }}"
                                            
                                            @if ($vacante->template_id == old('template_id', $valor->id))
                                                selected="selected"
                                            @endif
                                        >{{ $valor->nombre  }}</option>

                                    @endforeach
                            </select>
                 </div> 
                 <div class="form-group template" id="contenido_template">
                 
                 </div>                 
            </div> 

            <div class="col-md-6">
                <h4>Configuración de documentos adjuntos</h4>
              {{-- adjunto--}}
                 <div class="form-group">
                        @foreach ($adjuntos as  $valor)
                        
                            @foreach ($valor->adjuntos as $tag)
                              <label class="form-check-inline">
                                  <input class="form-check-input" type="checkbox" name="activo[]" 

                                        value="{{$tag->id}}" 
                                         
                                        {{ ( (is_array(old('activo')) and in_array( $tag->id, old('activo')) ) || ( (!is_array(old('activo'))) and  $tag->pivot->activo) )    ? ' checked' : '' }}

                                  >
                                {{ $tag->nombre}}
                             </label>    <br/>

                            @endforeach    
                        @endforeach
                            
                 </div>    

            </div> 

        </div>    


        
        <button type="submit"  class="btn btn-primary">{{ trans('aplicacion.u_vacante') }}</button>
        <a href="{{ route('vacantes.index') }}" class="btn btn-danger">{{ trans('aplicacion.rl_vacante') }}</a>
        
        
    </form>

@endsection