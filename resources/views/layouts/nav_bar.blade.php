 <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">

                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ asset('/images/logo.png') }}" alt="" sizes="64x64" >
                    {{-- config('app.name', 'Autos') --}}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ trans('autenticacion.Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>


                @if (Auth::check()) 
                  @if (Auth::user()->esAdministrador()) 
                      <div class="collapse navbar-collapse" id="navbarSupportedContent">
                          {{-- lado izquierdo del Navbar --}}

                        <ul class="nav navbar-nav navbar-right mr-auto">
                          

                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('vacantes.index') }}">{{ trans('aplicacion.vacantes') }}</a>
                            </li>



                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('candidatos.index') }}">{{ trans('aplicacion.candidato') }}</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('clientes.index') }}">{{ trans('aplicacion.cliente') }}</a>
                            </li>

                            
                            <li class="nav-item active">
                              <a class="nav-link" href="{{ route('users.index') }}">{{ trans('aplicacion.users') }}</a>
                            </li>
                            <li class="nav-item dropdown">
                              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ trans('aplicacion.config') }}
                              </a>
                              <div class="dropdown-menu" aria-labelledby="navbarDropdown">

                                <a class="dropdown-item" href="{{ route('preguntas.index') }}">{{trans('aplicacion.preguntas') }}</a>
                                
                                <a class="dropdown-item" href="{{ route('adjuntos.index') }}">{{trans('aplicacion.adjuntos') }}</a>

                                <a class="dropdown-item" href="{{ route('tipo_vacantes.index') }}">{{trans('aplicacion.tvacante') }}</a>

                                <a class="dropdown-item" href="{{ route('templates.index') }}">{{trans('aplicacion.templates') }}</a>

                                


                                <div class="dropdown-divider"></div>

                                <a class="dropdown-item" href="{{ route('zonas.index') }}">{{ trans('aplicacion.zonas') }}</a>
                                <a class="dropdown-item" href="{{ route('especialidads.index') }}">{{ trans('aplicacion.especialidades') }}</a>
                                <a class="dropdown-item" href="{{ route('nivels.index') }}">{{ trans('aplicacion.neducacion') }}</a>
                                <a class="dropdown-item" href="{{ route('estados.index') }}">{{trans('aplicacion.ecivil') }}</a>

                                  <div class="dropdown-divider"></div>


                                  

                                <a class="dropdown-item" href="{{ route('areas.index') }}">{{trans('aplicacion.areas') }}</a>


                                
                                {{--
                                <a class="dropdown-item" href="{{ route('entrevistas.index') }}">{{trans('aplicacion.entrevistas') }}</a> --}}

                                  <div class="dropdown-divider"></div>
                               
                                 <a class="dropdown-item" href="{{ route('puestos.index') }}">{{trans('aplicacion.puestos') }}</a>
                                 
                                  <div class="dropdown-divider"></div>

                                 <a class="dropdown-item" href="{{ route('semaforos.index') }}">{{trans('aplicacion.semaforos') }}</a>
                                 <a class="dropdown-item" href="{{ route('fases.index') }}">{{trans('aplicacion.fases') }}</a>
                                 <a class="dropdown-item" href="{{ route('tipo_entrevistas.index') }}">{{trans('aplicacion.tentrevista') }}</a>

                                  <div class="dropdown-divider"></div>

                                 <a class="dropdown-item" href="{{ route('situacions.index') }}">{{trans('aplicacion.efinal') }}</a>
                                   <a class="dropdown-item" href="{{ route('estatus.index') }}">{{trans('aplicacion.eseleccion') }}</a>

                                   <a class="dropdown-item" href="{{ route('contactos.index') }}">{{trans('aplicacion.contacto') }}</a>

                                   <a class="dropdown-item" href="{{ route('tipo_referencias.index') }}">{{trans('aplicacion.tipo_referencia') }}</a>

                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('perfiles.index') }}">{{trans('aplicacion.perfiles') }}</a>

                              </div>
                            </li>


                            <li class="nav-item">

                              {{-- <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">{{ trans('aplicacion.disabled') }}</a> --}}
                            </li>
                          </ul>
                    @endif  
                  @endif  

                    {{-- lado derecho del Navbar --}}
                    <ul class="navbar-nav ml-auto">
                        {{-- Enlaces de autenticacion --}}
                        @guest
                            
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ trans('autenticacion.Login') }}</a>
                            </li>
                            {{--
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ trans('autenticacion.Register') }}</a>
                                </li>
                            @endif
                            --}}
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ trans('autenticacion.Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>



                     <ul class="nav navbar-nav navbar-right">
                          
                          
                        <li class="nav-item dropdown">
                              <a class="nav-link dropdown-toggle idioma" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                              idioma= "{{ session('lang') }}"
                              >
                                {{  ucfirst(session('lang')!='' ? session('lang') : "es")   }}
                                
                              </a>
                              <div class="dropdown-menu " aria-labelledby="navbarDropdown">
                                <a class="dropdown-item " href="{{ url('lang', ['es']) }}" >Español</a>
                                <a class="dropdown-item " href="{{ url('lang', ['en']) }}" >English</a>


                              </div>
                      </li>



                    </ul>



                </div>
                
            </div>
        </nav>

