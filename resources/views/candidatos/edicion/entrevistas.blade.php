<style>
/* The container */
.container1 {
  display: inline;
  position: relative;
  padding-left: 35px;
  margin-bottom: 12px;
  cursor: pointer;
  font-size: 22px;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

/* Hide the browser's default checkbox */
.container1 input {
  position: absolute;
  opacity: 0;
  cursor: pointer;
  height: 0;
  width: 0;
}

/* Create a custom checkbox */
.checkmark {
  position: absolute;
  top: 0;
  left: 0;
  height: 25px;
  width: 25px;
  background-color: #eee;
}

/* On mouse-over, add a grey background color */
.container1:hover input ~ .checkmark {
  background-color: #ccc;
}

/* When the checkbox is checked, add a blue background */
.container1 input:checked ~ .checkmark {
  background-color: #2196F3;
}

/* Create the checkmark/indicator (hidden when not checked) */
.checkmark:after {
  content: "";
  position: absolute;
  display: none;
}

/* Show the checkmark when checked */
.container1 input:checked ~ .checkmark:after {
  display: inline;
}

/* Style the checkmark/indicator */
.container1 .checkmark:after {
  left: 9px;
  top: 5px;
  width: 5px;
  height: 10px;
  border: solid white;
  border-width: 0 3px 3px 0;
  -webkit-transform: rotate(45deg);
  -ms-transform: rotate(45deg);
  transform: rotate(45deg);
}
</style>


<h3> 3) {{  trans('aplicacion.entre_eva') }}</h3>

<p>
   @foreach ($tipo_entrevistas as $key => $valor)

        <label class="container1 ch{{$key}}" data-toggle="collapse" data-target="#{{$valor->campo }}" aria-expanded="false" aria-controls="{{$valor->campo }}"> {{$valor->nombre }}
          <input class="ch{{$key}}" type="checkbox"/> 
          <span class="checkmark"></span>
        </label>
  @endforeach
      


</p>
<div class="row">
  
  <div class="col-12">
    <div class="collapse multi-collapse" id="primero">

      <div class="card-group">
      
          <div class="card card-body">
            <b>1er filtro: Entrevista Oficial</b>
          </div>

          <div class="card card-body">
               <div class="form-group">

                    @php
                       $comentario= ( (isset($entrevistas[0]->comentario)) ? $entrevistas[0]->comentario : null);   
                    @endphp                 
                    <textarea class="form-control" rows="3"
                    name="comentario[]" id="comentario[]" placeholder="Comentario" 
                    >{{ old('comentario', $comentario) }}</textarea>

                </div>            
          </div>

          <div class="card card-body" style="display: none;">
                    @php
                       $fecha= ( (isset($entrevistas[0]->fecha)) ? $entrevistas[0]->fecha : null);   
                    @endphp 

                <input name="fecha[]" id="fecha[]" disabled type="text" class="form-control datepicker"
                 value="{{ old('fecha', $fecha) }}">
                <div class="input-group-addon">
                     <span class="glyphicon glyphicon-th"></span>
                </div>     
            
          </div>
          <div class="card card-body">

             {{--  selector_tipo --}}
               <div class="form-group">
                          <select name="selector_tipo_id[]" id="selector_tipo_id[]" class="form-control">
                                  @foreach ($selector_tipos->where('tipo_entrevista_id',1) as $key => $valor)
                                      <option value="{{ $valor->id }}"
                                      
                                        @php
                                            $selector_tipo_id= ( (isset($entrevistas[0]->selector_tipo_id)) ? $entrevistas[0]->selector_tipo_id : 0);   
                                        @endphp
                                        @if ($selector_tipo_id == old('selector_tipo_id', $valor->id))
                                            selected="selected"
                                        @endif

                                      >{{ $valor->nombre  }}</option>
                                  @endforeach
                          </select>
              </div>  

            
          </div> 
          <div class="card card-body" style="display: none;">
            <input type="file" name="adjunto[]">
          </div>   

      </div>    

    </div>
  </div>
  
  <div class="col-12">
    <div class="collapse multi-collapse" id="segundo">



      <div class="card-group">
      
          <div class="card card-body">
            <b>2do filtro: Segunda Entrevista</b>
          </div>

          <div class="card card-body">
               <div class="form-group">
                    @php
                       $comentario= ( (isset($entrevistas[1]->comentario)) ? $entrevistas[1]->comentario : null);   
                    @endphp                   
                    <textarea class="form-control" rows="3"
                    name="comentario[]" id="comentario[]" placeholder="Comentario" 
                    >{{ old('comentario', $comentario) }}</textarea>

                </div>            
          </div>

          <div class="card card-body" style="display: none;">

                @php
                       $fecha= ( (isset($entrevistas[1]->fecha)) ? $entrevistas[1]->fecha : null);   
                    @endphp 
                                
                <input name="fecha[]" id="fecha[]" disabled type="text" class="form-control datepicker"
                 value="{{ old('fecha', $fecha) }}">
            
                
                <div class="input-group-addon">
                     <span class="glyphicon glyphicon-th"></span>
                </div>     
            
          </div>
          <div class="card card-body">

             {{--  selector_tipo --}}
               <div class="form-group">
                          <select name="selector_tipo_id[]" id="selector_tipo_id[]" class="form-control">
                                  @foreach ($selector_tipos->where('tipo_entrevista_id',2) as $key => $valor)
                                      <option value="{{ $valor->id }}"

                                        @php
                                            $selector_tipo_id= ( (isset($entrevistas[1]->selector_tipo_id)) ? $entrevistas[1]->selector_tipo_id : 0);   
                                        @endphp
                                        @if ($selector_tipo_id == old('selector_tipo_id', $valor->id))
                                            selected="selected"
                                        @endif

                                      >{{ $valor->nombre  }}</option>
                                  @endforeach
                          </select>
              </div>  

            
          </div> 
          <div class="card card-body" style="display: none;">
            <input type="file" name="adjunto[]">
          </div>   

      </div>    



    </div>
  </div>

  <div class="col-12">
    <div class="collapse multi-collapse" id="exampsico">
          
      <div class="card-group">
      
          <div class="card card-body">
            <b>Examen Psicométrico</b>
          </div>

          <div class="card card-body" >
            
                    @php
                       $fecha= ( (isset($entrevistas[2]->fecha)) ? $entrevistas[2]->fecha : null);   
                    @endphp 
                                
                <input name="fecha[]" id="fecha[]"  type="text" class="form-control datepicker"
                 value="{{ old('fecha', $fecha) }}">

                <div class="input-group-addon">
                     <span class="glyphicon glyphicon-th"></span>
                </div>     
            
          </div>

         <div class="card card-body">

             {{--  selector_tipo --}}
               <div class="form-group">
                          <select name="selector_tipo_id[]" id="selector_tipo_id[]" class="form-control">
                                  @foreach ($selector_tipos->where('tipo_entrevista_id',3) as $key => $valor)
                                      <option value="{{ $valor->id }}"
                                      

                                        @php
                                            $selector_tipo_id= ( (isset($entrevistas[2]->selector_tipo_id)) ? $entrevistas[2]->selector_tipo_id : 0);   
                                        @endphp
                                        @if ($selector_tipo_id == old('selector_tipo_id', $valor->id))
                                            selected="selected"
                                        @endif

                                      >{{ $valor->nombre  }}</option>
                                  @endforeach
                          </select>
              </div>  

            
          </div>           

          <div class="card card-body">
               <div class="form-group">
                    @php
                       $comentario= ( (isset($entrevistas[2]->comentario)) ? $entrevistas[2]->comentario : null);   
                    @endphp                  
                    <textarea class="form-control" rows="3"
                    name="comentario[]" id="comentario[]" placeholder="Comentario" 
                    >{{ old('comentario', $comentario) }}</textarea>

                </div>            
          </div>


 
          <div class="card card-body">
            <input type="file" name="adjunto[]">
          </div>   

      </div>    



    </div>
  </div>


  <div class="col-12">
    <div class="collapse multi-collapse" id="exampractico">

     <div class="card-group">
      
          <div class="card card-body">
             <b>Examen Práctico</b>
          </div>

          <div class="card card-body" >
            
                    @php
                       $fecha= ( (isset($entrevistas[3]->fecha)) ? $entrevistas[3]->fecha : null);   
                    @endphp 
                                
                <input name="fecha[]" id="fecha[]" type="text" class="form-control datepicker"
                 value="{{ old('fecha', $fecha) }}">
                <div class="input-group-addon">
                     <span class="glyphicon glyphicon-th"></span>
                </div>     
            
          </div>

         <div class="card card-body">

             {{--  selector_tipo --}}
               <div class="form-group">
                          <select name="selector_tipo_id[]" id="selector_tipo_id[]" class="form-control">
                                  @foreach ($selector_tipos->where('tipo_entrevista_id',4) as $key => $valor)
                                      <option value="{{ $valor->id }}"
                                      

                                        @php
                                            $selector_tipo_id= ( (isset($entrevistas[3]->selector_tipo_id)) ? $entrevistas[3]->selector_tipo_id : 0);   
                                        @endphp
                                        @if ($selector_tipo_id == old('selector_tipo_id', $valor->id))
                                            selected="selected"
                                        @endif

                                      >{{ $valor->nombre  }}</option>
                                  @endforeach
                          </select>
              </div>  

            
          </div>           

          <div class="card card-body">
               <div class="form-group">
                    @php
                       $comentario= ( (isset($entrevistas[3]->comentario)) ? $entrevistas[3]->comentario : null);   
                    @endphp                  
                    <textarea class="form-control" rows="3"
                    name="comentario[]" id="comentario[]" placeholder="Comentario" 
                    >{{ old('comentario', $comentario) }}</textarea>

                </div>            
          </div>


 
          <div class="card card-body">
            <input type="file" name="adjunto[]">
          </div>   

      </div>    


    </div>
  </div>



  <div class="col-12">
    <div class="collapse multi-collapse" id="tercero">
          
      <div class="card-group">
      
          <div class="card card-body">
            <b>Tercer filtro</b>
          </div>

          <div class="card card-body">
               <div class="form-group">
                    @php
                       $comentario= ( (isset($entrevistas[4]->comentario)) ? $entrevistas[4]->comentario : null);   
                    @endphp  
                    <textarea class="form-control" rows="3"
                    name="comentario[]" id="comentario[]" placeholder="Comentario" 
                    >{{ old('comentario', $comentario) }}</textarea>

                </div>            
          </div>

          <div class="card card-body" style="display: none;">

                    @php
                       $fecha= ( (isset($entrevistas[4]->fecha)) ? $entrevistas[4]->fecha : null);   
                    @endphp 
                                
                <input name="fecha[]" id="fecha[]" disabled type="text" class="form-control datepicker"
                 value="{{ old('fecha', $fecha) }}">

                <div class="input-group-addon">
                     <span class="glyphicon glyphicon-th"></span>
                </div>     
            
          </div>
          <div class="card card-body">

             {{--  selector_tipo --}}
               <div class="form-group">
                          <select name="selector_tipo_id[]" id="selector_tipo_id[]" class="form-control">
                                  @foreach ($selector_tipos->where('tipo_entrevista_id',5) as $key => $valor)
                                      <option value="{{ $valor->id }}"
                                      

                                        @php
                                            $selector_tipo_id= ( (isset($entrevistas[4]->selector_tipo_id)) ? $entrevistas[4]->selector_tipo_id : 0);   
                                        @endphp
                                        @if ($selector_tipo_id == old('selector_tipo_id', $valor->id))
                                            selected="selected"
                                        @endif

                                      >{{ $valor->nombre  }}</option>
                                  @endforeach
                          </select>
              </div>  

            
          </div> 
          <div class="card card-body" style="display: none;">
            <input type="file" name="adjunto[]">
          </div>   

      </div>    


   
    </div>
  </div>





</div>