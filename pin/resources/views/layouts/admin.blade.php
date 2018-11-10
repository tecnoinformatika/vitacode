<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content=""/>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1"/>
    <meta name="msapplication-tap-highlight" content="no">
    
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="application-name" content="Milestone">

    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="Milestone">

    <meta name="theme-color" content="#4C7FF0">
    
    <title>{{ config('app.name', 'Laravel')}}</title>

    <!-- page stylesheets -->
    <link rel="stylesheet" href="{{ asset('vendor/datatables/media/css/dataTables.bootstrap4.css') }}"/>
    <!-- end page stylesheets -->

    <!-- build:css({.tmp,app}) styles/app.min.css -->
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/dist/css/bootstrap.css') }}"/>
    <link rel="stylesheet" href="{{ asset('vendor/PACE/themes/blue/pace-theme-minimal.css') }}"/>
    <link rel="stylesheet" href="{{ asset('vendor/font-awesome/css/font-awesome.css') }}"/>
    <link rel="stylesheet" href="{{ asset('vendor/animate.css/animate.css') }}"/>
    <link rel="stylesheet" href="{{ asset('styles/app.css') }}" id="load_styles_before"/>
    <link rel="stylesheet" href="{{ asset('styles/app.skins.css') }}"/>
    <!-- endbuild -->
  </head>
  <body>

    <div class="app">
      <!--sidebar panel-->
      <div class="off-canvas-overlay" data-toggle="sidebar"></div>
      <div class="sidebar-panel">
        <div class="brand">
          <!-- toggle offscreen menu -->
          <a href="javascript:;" data-toggle="sidebar" class="toggle-offscreen hidden-lg-up">
            <i class="material-icons">menu</i>
          </a>
          <!-- /toggle offscreen menu -->
          <!-- logo -->
          <a class="brand-logo">
            <img class="expanding-hidden" src="{{ asset('images/logo-vitacode-400.png') }}" style="max-height: 50px;" alt=""/>
          </a>
          <!-- /logo -->
        </div>
        <div class="nav-profile dropdown">
          @if(Auth::user()->ficha)
          <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
            <div class="user-image">
              <img src="{{'img/'}}{{Auth::user()->ficha->imagen}}" class="avatar img-circle" alt="user" title="user"/>
            </div>
            <div class="user-info expanding-hidden">
              {{Auth::user()->ficha->Nombre}}  {{Auth::user()->ficha->Apellidos}}
              <small class="bold"><span>RUT</span> {{Auth::user()->ficha->Rut}}</small>
            </div>
          </a>
          @else
           <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
            <div class="user-image">
              <img src="{{'images/'}}avatar.jpg" class="avatar img-circle" alt="user" title="user"/>
            </div>
            <div class="user-info expanding-hidden">
              Diligencia sus datos
              <small class="bold"><span>RUT:</span> Diligencie su rut</small>
            </div>
          </a>
          @endif
          <div class="dropdown-menu">
            
            <a class="dropdown-item" href="/logout">Logout</a>
            <a class="dropdown-item" href="{{ url('/logout') }}"onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Cerrar Sesion </a>

                                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
            
          </div>
        </div>
        <!-- main navigation -->
        <nav>
          
          @include('partials.nav')
        </nav>
        <!-- /main navigation -->
      </div>
      <!-- /sidebar panel -->
      <!-- content panel -->
      <div class="main-panel">
        <!-- top header -->
        <nav class="header navbar">
         @include('partials.nav-header')
        </nav>
        <!-- /top header -->

        <!-- main area -->
        <div class="main-content">
            
            @yield('content')
            
          
          
          
          
          <!-- bottom footer -->
          <div class="content-footer">
            <nav class="footer-right">
              <ul class="nav">
                <li>
                  <a href="javascript:;">Feedback</a>
                </li>
              </ul>
            </nav>
            <nav class="footer-left">
              <ul class="nav">
                <li>
                  <a href="javascript:;">
                    <span>Copyright</span>
                    &copy; 2016 Your App
                  </a>
                </li>
                <li class="hidden-md-down">
                  <a href="javascript:;">Privacy</a>
                </li>
                <li class="hidden-md-down">
                  <a href="javascript:;">Terms</a>
                </li>
                <li class="hidden-md-down">
                  <a href="javascript:;">help</a>
                </li>
              </ul>
            </nav>
          </div>
          <!-- /bottom footer -->
        </div>
        <!-- /main area -->
      </div>
      <!-- /content panel -->
    </div>
        
    <script type="text/javascript">
      window.paceOptions = {
        document: true,
        eventLag: true,
        restartOnPushState: true,
        restartOnRequestAfter: true,
        ajax: {
          trackMethods: [ 'POST','GET']
        }
      };
    </script>

    <!-- build:js({.tmp,app}) scripts/app.min.js -->
    <script src="{{ asset('vendor/jquery/dist/jquery.js') }}"></script>
    <script src="{{ asset('vendor/PACE/pace.js') }}"></script>
    <script src="{{ asset('vendor/tether/dist/js/tether.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/dist/js/bootstrap.js') }}"></script>
    <script src="{{ asset('vendor/fastclick/lib/fastclick.js') }}"></script>
    <script src="{{ asset('scripts/constants.js') }}"></script>
    <script src="{{ asset('scripts/main.js') }}"></script>
    <!-- endbuild -->

    <!-- page scripts -->
    <script src="{{ asset('vendor/datatables/media/js/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('vendor/datatables/media/js/dataTables.bootstrap4.js') }}"></script>
    <!-- end page scripts -->

    <!-- initialize page scripts -->
    <script type="text/javascript">
      $('.datatable').DataTable({
        'ajax': 'data/datatables-arrays.json'
      });
    </script>
    <!-- end initialize page scripts -->
     
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        @include('sweet::alert')
  </body>
</html>
