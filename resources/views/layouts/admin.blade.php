<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>@yield('title', config('app.name', 'Laravel'))</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>   

  <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('/assets/favicon.png') }}">
  <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" />

  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}" defer></script>
  <script src="{{ asset('js/jquery-ui.min.js') }}" defer></script>

  <!-- Fonts -->
  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,600,700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/css/bootstrap-select.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">


  <!-- Styles -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
  <link href="{{ asset('css/jquery-ui.min.css') }}" rel="stylesheet">
  <link href="{{ asset('css/jquery-ui.structure.min.css') }}" rel="stylesheet">
  <link href="{{ asset('css/jquery-ui.theme.min.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
</head>
<body>
  <div id="app">
    <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
      <div class="container">
        <button class="navbar-toggler" type="button" data-sidebar="#sidebar-principal">
          <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="{{ url('/') }}">
          <img src="{{asset('assets/decosur-logo.png')}}" width="250px" height="70px">
        </a>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <!-- Left Side Of Navbar -->
          <ul class="navbar-nav mr-auto">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown">
                Usuarios
              </a>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="{{route('admin.usuarios.index')}}">Listar</a>
                <a class="dropdown-item" href="{{route('admin.usuarios.create')}}">Nuevo</a>
              </div>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown">
                Productos
              </a>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="{{route('admin.productos.index')}}">Listar</a>
                <a class="dropdown-item" href="{{route('admin.productos.create')}}">Nuevo</a>
              </div>
            </li>
          </ul>
          <!-- Right Side Of Navbar -->
          <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
              <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                {{ Auth::user()->nombre }} <span class="caret"></span>
              </a>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
                </form>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <nav id="sidebar-principal" role="navigation" class="sidebar d-block d-sm-none">
      <button class="close"></button>
      <ul class="menu">
      <li>Menu</li>
      <li>
        <a href="{{route('admin.usuarios.index')}}">
          Usuarios
        </a>
      </li>
      <li>
        <a href="{{route('admin.productos.index')}}">
          Productos
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" style="padding: 0;" href="{{ route('logout') }}" 
               onclick="event.preventDefault(); $('#logout-form').submit();" >
                Salir
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
          </form>
        </a>
      </li>
      </ul>
    </nav>
    <main class="{{!isset($container) ? 'container' : ''}}">
      @yield('content')
    </main>
      <footer class="footer">
          <div class="container">
              <div class="row mt-3">
                <div class="col-md-4 col-12">
                  <h5>Categorías</h5>
                  @inject('links', 'App\Http\Controllers\HomeController')
                  @foreach($links->linksBusquedaPorCategoriaFooter() as $nombre => $link)
                    <p><a href="{{ $link }}" class="btn btn-link">{{ $nombre }}</a></p>
                  @endforeach
                </div>
                <div class="col-md-4 col-12 mt-md-0 mt-2">
                  <h5>Contacto</h5>
                  <p><i class="fas fa-map-marker-alt"></i>&nbsp; Pje. Emilio Huespe 187 Centro, Córdoba</p>
                  <p><i class="fas fa-envelope"></i>&nbsp; administracion@decosurmayorista.com</p>
                  <p><i class="fas fa-mobile-alt"></i>&nbsp; (0351) 421-4703</p>
                  <br/>
                  <a href="https://www.facebook.com/decosurdeco/" target="_blank"><i class="fab fa-facebook-square fa-2x"></i></a>
                  <a href="https://www.instagram.com/decosurmayorista/" target="_blank"><i class="fab fa-instagram fa-2x ml-2"></i></a>
                </div>
              </div>
          </div>
      </footer>
  </div>
  <script src='https://www.google.com/recaptcha/api.js'></script>
  <script type="text/javascript">
    $(function() {
      $('.navbar-toggler').on('click', function() {
        $($(this).data('sidebar')).toggleClass('open');
        $('body').addClass('sidebar-open');
        return false;
      });
      $('.sidebar .close').on('click', function() {
        $(this).parents('.sidebar').removeClass('open');
        $('body').removeClass('sidebar-open');
        return false;
      });
    })
</script>
  @yield('post-scripts')
</body>
</html>
