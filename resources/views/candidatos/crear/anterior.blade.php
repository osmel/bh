                <div class="form-group">
                    <label for="name">{{ trans('autenticacion.Name') }}:</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Pedro Perez" value="{{ old('name') }}">
                </div>

                <div class="form-group">
                    <label for="email">{{ trans('autenticacion.E-Mail Address') }}:</label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="pedro@example.com" value="{{ old('email') }}">

                    {{-- mostrar el primer error de email. --}}
                    @if ($errors->has('email'))
					    <p>{{ $errors->first('email') }}</p>
					@endif
                </div>


                  {{-- area --}}
                     <div class="form-group">
                            <label for="area_id">{{ trans('aplicacion.area') }}:</label>
                                <select name="area_id" id="area_id"  tipo="entrada"  class="form-control">
                                        @foreach ($areas as $key => $valor)
                                            <option value="{{ $valor->id }}"
                                            
                                                @if ($key == old('area_id', $valor->id))
                                                    selected="selected"
                                                @endif
                                            >{{ $valor->nombre  }}</option>
                                        @endforeach
                                </select>
                    </div> 



                    {{-- Perfiles o roles--}}
                     <div class="form-group">
                            <label for="role_id">{{ trans('aplicacion.roles') }}:</label>
                                <select name="role_id" id="role_id"  tipo="entrada"  class="form-control">
                                        @foreach ($perfiles as $key => $valor)
                                            <option value="{{ $valor->id }}"
                                            
                                                @if ($key == old('role_id', $valor->id))
                                                    selected="selected"
                                                @endif
                                            >{{ $valor->nombre_rol  }}</option>
                                        @endforeach
                                </select>
                    </div> 



                <div class="form-group">
                    <label for="password">{{ trans('autenticacion.Password') }}:</label>
                    <input type="password" class="form-control" name="password" id="password" placeholder="Mayor a 6 caracteres">
                </div>

                <button type="submit" class="btn btn-primary">{{ trans('aplicacion.c_candidato') }}</button>
                <a href="{{ route('candidatos.index') }}" class="btn btn-danger">{{ trans('aplicacion.rl_candidato') }}</a>
