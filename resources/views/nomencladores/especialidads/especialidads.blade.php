@extends('layouts.plantilla')

@section('title', 'Usuarios')

@section('content')
    <div class="d-flex justify-content-between align-items-end mb-3">
        <h1 class="pb-1">{{ trans('aplicacion.l_especialidad') }}</h1>
        <p>
            <a href="{{ route('especialidads.create') }}" class="btn btn-primary">{{ trans('aplicacion.n_especialidad') }}</a>
        </p>
    </div>



    @if ($especialidads->isNotEmpty())
    
    <table id="tabla_especialidads" class="display responsive nowrap" style="width:100%">
        
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
