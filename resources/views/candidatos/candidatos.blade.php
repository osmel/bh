@extends('layouts.plantilla')

@section('title', 'candidatos')

@section('content')
    <div class="d-flex justify-content-between align-items-end mb-3">
        <h1 class="pb-1">{{ trans('aplicacion.l_candidato') }}</h1>
        <p>
            <a href="{{ route('candidatos.create') }}" class="btn btn-primary">{{ trans('aplicacion.n_candidato') }}</a>
        </p>
    </div>



    @if ($candidatos->isNotEmpty())
    
    <table id="tabla_candidato" class="display responsive nowrap" style="width:100%">
        
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">{{ trans('aplicacion.n_completo') }}</th>
            <th scope="col">{{ trans('aplicacion.s_candidato') }}</th>
            <th scope="col">{{ trans('aplicacion.co_candidato') }}</th>
            <th scope="col">{{ trans('aplicacion.movil') }}</th>
            <th scope="col">{{ trans('aplicacion.creacion') }}</th>
            <th scope="col">{{ trans('aplicacion.i_situacion') }}</th>

            <th scope="col">{{ trans('aplicacion.acciones') }}</th>
            
            
            
        </tr>
        </thead>

        
    </table>
    @else
        <p>No hay candidatos registrados.</p>
    @endif
@endsection

@section('sidebar')
    @parent
@endsection
