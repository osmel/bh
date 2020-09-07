@extends('layouts.plantilla')

@section('title', 'Usuarios')

@section('content')
<style type="text/css">
    div.container { max-width: 1200px }
</style>

    <div class="d-flex justify-content-between align-items-end mb-3">
        <h1 class="pb-1">{{ trans('aplicacion.List of users') }}</h1>
        <p>
            <a href="{{ route('users.create') }}" class="btn btn-primary">{{ trans('aplicacion.New user') }}</a>
        </p>
    </div>



    @if ($users->isNotEmpty())
    
    <table id="tabla_usuario"  class="display responsive nowrap" style="width:100%">
        
        <thead>
        <tr>
            <th scope="col">#</th>
            
            <th scope="col">{{ trans('aplicacion.n_completo') }}</th>
            <th scope="col">{{ trans('aplicacion.rol') }}</th>
            <th scope="col">{{ trans('aplicacion.correo') }}</th>
            <th scope="col">{{ trans('aplicacion.acciones') }}</th>
        </tr>
        </thead>
        {{-- 
        <tbody>
        @foreach($users as $user)
        <tr>
            <th scope="row">{{ $user->id }}</th>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>
                <form action="{{ route('users.destroy', $user) }}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    
                    <a href="{{ route('users.show', $user) }}" class="btn btn-link"><span class="oi oi-eye"></span></a>
                    
                    <a href="{{ route('users.edit', $user) }}" class="btn btn-link"><span class="oi oi-pencil"></span></a>

                    <button type="submit" class="btn btn-link"><span class="oi oi-trash"></span></button>
                </form>
            </td> 
        </tr>
        @endforeach
        </tbody>
        --}}

        
    </table>
    @else
        <p>No hay usuarios registrados.</p>
    @endif
@endsection

@section('sidebar')
    @parent
@endsection
