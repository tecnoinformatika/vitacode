<!doctype html>
<html lang="en" ng-app="AngularGoogleMap">
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
    <!-- end page stylesheets -->

    <!-- build:css({.tmp,app}) styles/app.min.css -->
    
    
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/dist/css/bootstrap.css') }}"/>
    <link rel="stylesheet" href="{{ asset('vendor/PACE/themes/blue/pace-theme-minimal.css') }}"/>
    <link rel="stylesheet" href="{{ asset('vendor/font-awesome/css/font-awesome.css') }}"/>
    <link rel="stylesheet" href="{{ asset('vendor/animate.css/animate.css') }}"/>
    <link rel="stylesheet" href="{{ asset('styles/app.css') }}" id="load_styles_before"/>
    <link rel="stylesheet" href="{{ asset('styles/app.skins.css') }}"/>
        <script src="{{ asset('js/lib/angularjs.min.js?v=1.2.26') }}"></script>
 
        <!-- Google Maps Javascript API -->
        <script src="http://maps.google.com/maps/api/js?sensor=false"></script>
 
        <!-- angular-google-maps -->
        <script src="{{ asset('js/lib/lodash.underscore.min.js?v=2.4.1') }}"></script>
        <script src="{{ asset('js/lib/angular-google-maps.min.js?v=1.2.2') }}"></script>
 
        <!-- Custom angular module -->
        <script src="{{ asset('js/map.js?v=1.0') }}"></script>
    <!-- endbuild -->
      <style> 
        .body-back {
            background-image: url("{{ asset('images/back.jpg') }}");
            background-color: #cccccc;
        }
      </style>
      <style>
            .angular-google-map-container {
                position: absolute;
                top: 0;
                bottom: 0;
                right: 0;
                left: 0;    
            }
        </style>
  </head>
  <body ng-controller="MapCtrl" style=" background-image: url('{{ asset('images/back.jpg') }}');" >
  <google-map center="map.center" 
    			zoom="map.zoom" 
    			draggable="true" 
    			options="map.options" 
    			control="map.control">
		<marker coords="marker.coords" options="marker.options" idkey="marker.id" ></marker>        
    </google-map>
    <div class="app no-padding no-footer layout-static">
        
        @yield('content')
    
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
   
    <!-- endbuild -->

    <!-- page scripts -->
    <script src="{{ asset('vendor/jquery-validation/dist/jquery.validate.min.js') }}"></script>
    <!-- end page scripts -->

    <!-- initialize page scripts -->
    <script type="text/javascript">
      $('#validate').validate();
    </script>
    <!-- end initialize page scripts -->
     <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        @include('sweet::alert')
  </body>
</html>