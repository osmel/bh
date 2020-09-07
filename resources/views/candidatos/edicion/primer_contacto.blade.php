<h3> 2) {{  trans('aplicacion.pcontacto') }}</h3>
<div class="row">

    <div class="col-6"> 
            {{-- medio contacto --}}
             <div class="form-group">
                    <label for="contacto_id">{{ trans('aplicacion.m_contacto') }}:</label>
                        <select name="contacto_id" id="contacto_id"  tipo="entrada"  class="form-control">
                                @foreach ($contactos as $key => $valor)
                                    <option value="{{ $valor->id }}"
                                    
                                            @php
                                                    $contacto_id= ( (isset($primer_contacto->contacto_id)) ? $primer_contacto->contacto_id : 0);   
                                            @endphp                                    

                                        @if ($contacto_id == old('contacto_id', $valor->id))
                                            selected="selected"
                                        @endif
                                    >{{ $valor->nombre  }}</option>
                                @endforeach
                        </select>
            </div>  


                <div class="form-group">
                    <label for="intento">{{ trans('aplicacion.i_contacto') }}:</label>


                    @php
                       $intento= ( (isset($primer_contacto->intento)) ? $primer_contacto->intento : null);
                    @endphp 

                    <input type="number" class="form-control" name="intento" id="intento" placeholder="#" value="{{ old('intento', $intento) }}">
                </div>


            {{-- Estatus de interesado estatu --}}
             <div class="form-group">
                    <label for="estatu_id">{{ trans('aplicacion.i_estatu') }}:</label>
                        <select name="estatu_id" id="estatu_id"  tipo="entrada"  class="form-control">
                                @foreach ($estatus as $key => $valor)
                                    <option value="{{ $valor->id }}"

                                            @php
                                                    $estatu_id= ( (isset($primer_contacto->estatu_id)) ? $primer_contacto->estatu_id : 0);   
                                            @endphp                                    
                                    
                                        @if ($estatu_id == old('estatu_id', $valor->id))
                                            selected="selected"
                                        @endif
                                    >{{ $valor->nombre  }}</option>
                                @endforeach
                        </select>
            </div>  

			<div class="col-md-12">
                <div class="form-group">
                    <label for="descripcion">{{ trans('aplicacion.descripcion') }}:</label>
                   @php
                       $descripcion= ( (isset($primer_contacto->descripcion)) ? $primer_contacto->descripcion : null);
                    @endphp                     
                    <input type="text" class="form-control" name="descripcion" id="descripcion" placeholder="Texto Plano" value="{{ old('descripcion', $descripcion) }}">
                </div>
            </div>


    </div>


    <div class="col-6"> 

            <div class="form-group">
                <label for="fecha">{{ trans('aplicacion.f_registro') }}</label>
                <input  type="text" class="form-control datepicker"
                 value="{{ $candidato->created_at }}">
                <div class="input-group-addon">
                     <span class="glyphicon glyphicon-th"></span>
                </div>     
            </div>


   </div>

</div>                