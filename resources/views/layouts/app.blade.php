<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Supercito</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/sweetalert.min.js') }}" defer></script>
    <script src="{{ asset('js/jquery.dataTables.js') }}" defer></script>
    <script src="{{ asset('js/jQuery.print/jQuery.print.js') }}" defer></script> 
    <script src="{{ asset('plantilla/js/bootstrap.min.js') }}" defer></script>
    <script src="{{ asset('js/adminSistema.js') }}" defer></script>
    {{-- <script src="{{ asset('js/bootstrap-toggle.js') }}" defer></script> --}} 
    {{-- <!-- Fonts -->
    {{-- <link rel="dns-prefetch" href="//fonts.gstatic.com"> --}}
    {{-- <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet"> --}}

    <!-- Styles -->
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
    <link href="{{ asset('css/jquery.dataTables.css') }}" rel="stylesheet"> 
    <link href="{{ asset('plantilla/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('plantilla/css/estilos.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-toggle.css') }}" rel="stylesheet">
    <link href="{{ asset('css/w3school-toggle.css') }}" rel="stylesheet">
    <link href="{{ asset('css/font-awesome/css/font-awesome.css') }}" rel="stylesheet">

    {{-- <style media="screen">
      .botones{
        background: #b9007f;
        color: #fff;
      }
      .botones:hover{
        background: #974398;
        color: #fff;
      }
      .barra{
        background:#b9007f;
        color: #fff;
      }
    </style> --}}

</head>
<!--  -->
<body >
    @guest
        <!-- no esta logueado -->
        <input type="hidden" name="" id="nome_token">
    @else
        <input type="hidden" name="" id="nome_token_user" value="{{Auth::user()->nome_token}}">
    @endguest

    <div id="app">
        <nav class="navbar navbar-default ">
            
                
                @guest

               
                   @else 
                   <div class="container">
                   {{-- <div id="navbar-expand-md navbar-light bg-primary shadow-sm" class="collapse navbar-collapse"> --}}
                    <div class="navbar-header">
                      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                      </button>
                     
                    </div>
                   
                    <div id="navbar" class="collapse navbar-collapse">
                        <ul class="nav navbar-nav">
                          <li ><a href="{{ route('home') }}">Supercito</a></li>
                          {{-- <li><a href="entradas.html">Roles</a></li>
                          <li><a href="entradas.html">Usuarios</a></li>
                          <li><a href="usuarios.html">Productos</a></li> 
                          <li><a href="usuarios.html">Productos</a></li> 
                          --}}
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            <li class="nav-item nav navbar-nav navbar-right">
                                <a id="navbarDropdown" class="nav-link  text-white" href="#"  aria-expanded="false" v-pre>
                                    <i class="fa fa-user-o" aria-hidden="true">Bienvenid@, </i>
                                    {{ Auth::user()->name }} <span ></span>
                                </a>
                            
                             </li>
                           
                             <li>
                                    <a  href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ 'Salir' }}
                                    </a>
</li>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form> 
                             
                        </ul>
                      </div>
                             
                       
                  {{-- </div><!--/.nav-collapse --> --}}
              </div>
                 @endguest
          </div>
                
       </div>
    </nav>
  <section id="main">
    <main class="py-4">
       @yield('content')
    </main>
 
    @yield('scripts')
  </section>
                              <br><br><br>
<footer id="footer">
  <p>Copyright Supercito &copy; 2020</p>
</footer>

{{-- <script src="{{ asset('plantilla/js/bootstrap.min.js') }}" defer></script> --}}
</body>
</html>
