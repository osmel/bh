@extends('layouts.plantilla')

@section('title', 'Usuarios')

@section('content')
    <div class="d-flex justify-content-between align-items-end mb-3">
        <h1 class="pb-1">{{ trans('aplicacion.l_tvacante') }}</h1>
        <p>
            <a href="{{ route('tipo_vacantes.create') }}" class="btn btn-primary">{{ trans('aplicacion.n_tvacante') }}</a>
        </p>
    </div>



    @if ($tipo_vacantes->isNotEmpty())
    
    <table id="tabla_tipo_vacantes" class="display responsive nowrap" style="width:100%">
        
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">{{ trans('autenticacion.Name') }}</th>
            <th scope="col">{{ trans('aplicacion.acciones') }}</th>            
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
