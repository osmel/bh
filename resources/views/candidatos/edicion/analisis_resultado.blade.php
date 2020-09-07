<h3> 4) {{  trans('aplicacion.aresultado') }}</h3>
<div class="row">

    <div class="col-12"> 
            
                <div class="form-group">
                    <label for="logro">{{ trans('aplicacion.logro') }}:</label>

                    @php
                       $logro= ( (isset($analisis_resultado->logro)) ? $analisis_resultado->logro : 0);   
                    @endphp                         
                    <input type="text" class="form-control" name="logro" id="logro" placeholder="Texto Plano" value="{{ old('logro', $logro) }}">
                </div>

                <div class="form-group">
                    <label for="fortaleza">{{ trans('aplicacion.fortaleza') }}:</label>
                    @php
                       $fortaleza= ( (isset($analisis_resultado->fortaleza)) ? $analisis_resultado->fortaleza : 0);   
                    @endphp                         

                    <input type="text" class="form-control" name="fortaleza" id="fortaleza" placeholder="Texto Plano" value="{{ old('fortaleza', $fortaleza) }}">
                </div>

                <div class="form-group">
                    <label for="debilidad">{{ trans('aplicacion.debilidad') }}:</label>
                 
                    @php
                       $debilidad= ( (isset($analisis_resultado->debilidad)) ? $analisis_resultado->debilidad : 0);   
                    @endphp     

                    <input type="text" class="form-control" name="debilidad" id="debilidad" placeholder="Texto Plano" value="{{ old('debilidad', $debilidad) }}">
                </div>


                <div class="form-group">
                    <label for="sueldo_final">{{ trans('aplicacion.sueldo_final') }}:</label>
                    @php
                       $sueldo_final= ( (isset($analisis_resultado->sueldo_final)) ? $analisis_resultado->sueldo_final : 0);   
                    @endphp                     
                    <input type="text" class="form-control" name="sueldo_final" id="sueldo_final" placeholder="Texto Plano" value="{{ old('sueldo_final', $sueldo_final) }}">
                </div>                                                
            


    </div>




</div>                