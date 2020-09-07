{{-- Estatus final situacion --}}
             <h3> 7) {{  trans('aplicacion.i_situacion') }}</h3>   
             <div class="form-group">
                    
                        <select name="situacion_id" id="situacion_id"  tipo="entrada"  class="form-control">
                                @foreach ($situacions as $key => $valor)
                                    <option value="{{ $valor->id }}"
                                        
                                            @php
                                                    $situacion_id= ( (isset($candidato_final->situacion_id)) ? $candidato_final->situacion_id : 0);   
                                            @endphp
                                        @if ($situacion_id == old('situacion_id', $valor->id))
                                            selected="selected"
                                        @endif
                                    >{{ $valor->nombre  }}</option>
                                @endforeach
                        </select>
            </div>  