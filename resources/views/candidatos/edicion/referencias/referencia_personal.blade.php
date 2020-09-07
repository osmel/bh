
    <div class="d-flex justify-content-between align-items-end mb-3">
        <h3 class="pb-1">5) {{ trans('aplicacion.l_referencia') }}</h3>
        <p>
            <a href="{{ url("/referencias/nuevo/{$candidato->id}") }}" class="btn btn-primary">{{ trans('aplicacion.n_referencia') }}</a>
        </p>
    </div>



    @if ($referencias->isNotEmpty())
    
    <table id="tabla_referencias" class="display responsive nowrap" style="width:100%">
        
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">{{ trans('autenticacion.Name') }}</th>
            <th scope="col">{{ trans('aplicacion.telefono') }}</th>
            <th scope="col">{{ trans('aplicacion.relacion') }}</th>
            <th scope="col">{{ trans('aplicacion.estatu') }}</th>

            <th scope="col">{{ trans('aplicacion.acciones') }}</th>            
        </tr>
        </thead>
      
        
    </table>
    @else
        <p>No hay usuarios registrados.</p>
    @endif
