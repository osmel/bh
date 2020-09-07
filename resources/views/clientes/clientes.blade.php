@extends('layouts.plantilla')

@section('title', 'clientes')

@section('content')
    <div class="d-flex justify-content-between align-items-end mb-3">
        <h1 class="pb-1">{{ trans('aplicacion.l_cliente') }}</h1>
        <p>
            <a href="{{ route('clientes.create') }}" class="btn btn-primary">{{ trans('aplicacion.n_cliente') }}</a>
        </p>
    </div>



    @if ($clientes->isNotEmpty())
    
    <table id="tabla_cliente" class="display responsive nowrap" style="width:100%">
        
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">{{ trans('aplicacion.n_completo') }}</th>
            <th scope="col">{{ trans('aplicacion.puestos') }}</th>
            <th scope="col">{{ trans('aplicacion.telefono') }}</th>
            <th scope="col">{{ trans('aplicacion.correo') }}</th>
            <th scope="col">{{ trans('aplicacion.acciones') }}</th>
            
        </tr>
        </thead>

        
    </table>
    @else
        <p>No hay clientes registrados.</p>
    @endif
@endsection

@section('sidebar')
    @parent
@endsection
