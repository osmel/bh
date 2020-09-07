
{{-- $candidato->candidato->vacante_activa[0]->pivot->sueldo --}}
<h3> 1) {{  trans('aplicacion.p_candidato') }}</h3>
 <div class="row">
           <div class="col-6"> 
                <div class="form-group">
                    <label for="name">{{ trans('autenticacion.Name') }}:</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Pedro Perez" value="{{ old('name') }}">
                </div>

                 <div class="form-group">
                    <label for="edad">{{ trans('aplicacion.edad') }}:</label>
                    <input type="number" class="form-control" name="edad" id="edad" placeholder="#" value="{{ old('edad') }}">
                </div>


                    {{-- estado civil--}}
                     <div class="form-group">
                            <label for="estado_id">{{ trans('aplicacion.ecivil') }}:</label>
                                <select name="estado_id" id="estado_id"  tipo="entrada"  class="form-control">
                                        @foreach ($estados as $key => $valor)
                                            <option value="{{ $valor->id }}"

                                                @if ($valor->id == old('estado_id') )
                                                    selected="selected"
                                                @endif
                                            >{{ $valor->nombre  }}</option>



                                        @endforeach
                                </select>
                    </div>  


                    {{-- nivel civil--}}
               
                     <div class="form-group">
                            <label for="nivel_id">{{ trans('aplicacion.neducacion') }}:</label>
                                <select name="nivel_id" id="nivel_id"  tipo="entrada"  class="form-control">
                                        @foreach ($nivels as $key => $valor)
                                            <option value="{{ $valor->id }}"
                                                
                                                @if ($valor->id == old('nivel_id') )
                                                    selected="selected"
                                                @endif
                                            >{{ $valor->nombre  }}</option>
                                        @endforeach
                                </select>
                    </div>  

                <div class="form-group">
                    <label for="sueldo">{{ trans('aplicacion.sueldo') }}:</label>
                    
                    <input type="number" step = "any"  class="form-control" name="sueldo" id="sueldo" placeholder="#.##" value="{{ old('sueldo') }}">
                </div>

                


            </div>  
        



            <div class="col-6"> 

               <div class="form-group"> {{-- pattern="[0-9]{3}-[0-9]{2}-[0-9]{3}" --}}
                    <label for="telefono1">{{ trans('aplicacion.movil') }}:</label>
                    <input type="tel"  class="form-control" name="telefono1" id="telefono1" placeholder="5510506072" value="{{ old('telefono1') }}">
                </div>                


               <div class="form-group">
                    <label for="telefono2">{{ trans('aplicacion.telefono') }}:</label>
                    <input type="tel"  class="form-control" name="telefono2" id="telefono2" placeholder="5510506072" value="{{ old('telefono2') }}">
                </div>                


                <div class="form-group">
                    <label for="email">{{ trans('aplicacion.correo') }}:</label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="pedro@example.com" value="{{ old('email') }}">
                </div>

               <div class="form-group">
                    <label for="email2">{{ trans('aplicacion.correo') }}:</label>
                    <input type="email" class="form-control" name="email2" id="email2" placeholder="pedro@example.com" value="{{ old('email2') }}">
                </div>   

               <div class="form-group">
                    <label for="direccion">{{ trans('aplicacion.direccion') }}:</label>
                    <input type="text" class="form-control" name="direccion" id="direccion" placeholder="calle ..." value="{{ old('direccion') }}">
                </div>                                

                {{-- Perfiles o roles--}}
                 <div class="form-group" style="display:none;">
                        <label for="role_id">{{ trans('aplicacion.roles') }}:</label>
                            <select name="role_id" id="role_id"  tipo="entrada"  class="form-control">
                                    @foreach ($perfiles as $key => $valor)
                                        <option value="{{ $valor->id }}"
                                            @if ($valor->id == old('role_id') )
                                                selected="selected"
                                            @endif
                                        >{{ $valor->nombre_rol  }}</option>
                                    @endforeach
                            </select>
                </div> 



                <div class="form-group" style="display:none;">
                    <label for="password">{{ trans('autenticacion.Password') }}:</label>
                    <input type="password" class="form-control" name="password" id="password" placeholder="Mayor a 6 caracteres">

                </div>
            </div>    
        </div>     


      <h4>  {{  trans('aplicacion.vacante') }}</h4>
        <div class="row">
           <div class="col-12">   

                {{-- vacantes --}}
                 <div class="form-group">
                        <label for="vacante_id">{{ trans('aplicacion.vacante') }}:</label>
                            <select name="vacante_id" id="vacante_id"  tipo="entrada"  class="form-control">
                                    @foreach ($vacantes as $key => $valor)
                                        <option value="{{ $valor->id }}"
                                            
                                            @if ($valor->id == old('vacante_id') )
                                                selected="selected"
                                            @endif
                                        >{{ $valor->nombre  }}</option>
                                    @endforeach
                            </select>
                </div>  

           </div> 
        </div>      