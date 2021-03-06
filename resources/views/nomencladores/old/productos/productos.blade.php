@extends('layouts.plantilla')

@section('title', 'Usuarios')

@section('content')
    <div class="d-flex justify-content-between align-items-end mb-3">
        <h1 class="pb-1">{{ trans('aplicacion.List of products') }}</h1>
        <p>
            <a href="{{ route('productos.create') }}" class="btn btn-primary">{{ trans('aplicacion.New products') }}</a>
        </p>
    </div>



    @if ($productos->isNotEmpty())
    
    <table id="tabla_productos" class="display responsive nowrap" style="width:100%">
        
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">{{ trans('aplicacion.codigo') }}</th>
            <th scope="col">{{ trans('aplicacion.descripciones') }}</th>
            <th scope="col">{{ trans('aplicacion.marca') }}</th>
            <th scope="col">{{ trans('aplicacion.model') }}</th>
            <th scope="col">{{ trans('aplicacion.variations') }}</th>

            {{--
            <th scope="col">{{ trans('aplicacion.acciones') }}</th> 
            --}}           
        </tr>
        </thead>
      
        
    </table>
    @else
        <p>No hay usuarios registrados.</p>
    @endif
@endsection

@section('sidebar')
    @parent
@endsection
