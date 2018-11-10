@extends('layouts.auth')

@section('content')
        
<div class="app no-padding no-footer layout-static">
      <div class="session-panel">
        <div class="session">
          <div class="session-content">
            <div class="card card-block form-layout" style="    max-width: 1000px;">

                <div class="text-xs-center m-b-3">
                   <a class="">
                      <img class="expanding-hidden" src="{{ asset('images/logo-vitacode-400.png') }}" style="max-height: 80px;" alt=""/>
                    </a>
                 
                  <div class="user-image">
                    <img src="img/{{$ficha->imagen}}" class="avatar img-circle" alt="user" title="user"/>
                  </div>
                
                </div>
                <div class="divider">
                  <span>
                    
                  </span>
                </div>
                <style>
                  .color-nuevo{
                    color:#009FD7;
                    font-size: 28px;
                  }
                </style>
                <div class="col-lg-6">
                  <div class="card">
                    <div class="card-header b-a-0" style="    background-color: #bef3ce42 !important;">
                      <h2>Datos personales</h2>
                    </div>
                    <div class="card-block">
                      <div class="form-group row" style="line-height: 1">
                        <p style="font-size: 28px;"><span  class="color-nuevo">Nombre: </span> {{$ficha->Nombre}}</p>
                        <p style="font-size: 28px;"><span  class="color-nuevo">Rut: </span> {{$ficha->Rut}}</p>
                        <p style="font-size: 28px;"><span  class="color-nuevo">Dirección: </span> {{$ficha->Direccion}}</p>
                        <p style="font-size: 28px;"><span  class="color-nuevo">Teléfono: </span> {{$ficha->Telefono}}</p>
                        <p style="font-size: 28px;"><span  class="color-nuevo">Fecha de nacimiento: </span> {{$ficha->Fecha_nacimiento}}</p>
                        <p style="font-size: 28px;"><span  class="color-nuevo">Comuna: </span> {{$ficha->Comuna}}</p>
                        <p style="font-size: 28px;"><span  class="color-nuevo">Ciudad: </span> {{$ficha->Ciudad}}</p>
                        <p style="font-size: 28px;"><span  class="color-nuevo">Pais: </span> {{$ficha->Pais}}</p>
                      </div>
                    </div>
                    
                   
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="card">
                      <div class="card-block"> 
                        
                           <div class="form-group row" style="line-height: 1">
                            <p style="font-size: 28px;"><span  class="color-nuevo">Tipo de Sangre: </span> <span class="tag tag-danger">{{$ficha->Tipo_sangre}}</span></p>
                            <p style="font-size: 28px;"><span  class="color-nuevo">Alérgias: </span> @if ($ficha->Alergias_ == 1) <span class="tag tag-danger">SI</span> @else <span class="tag tag-success">NO</span> @endif <span  class="color-nuevo">Cuales: </span>{{$ficha->Alergias_cual}}</p>
                            <p style="font-size: 28px;"><span  class="color-nuevo">Dirección: </span> {{$ficha->Direccion}}</p>
                           </div>
                    
                          <div id="accordion" role="tablist" aria-multiselectable="true">
                           
                              
                              <div class="card panel panel-default m-b-xs">
                                <div class="card-header panel-heading" role="tab" id="headingOne">
                                  <h6 class="panel-title m-a-0">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                     <span  class="color-nuevo">Contactos </span>
                                    </a>
                                  </h6>
                                </div>
                                <div class="table-responsive" style="font-size: 15px;">
                                  <table class="table table-bordered table-striped m-b-0">
                                      <thead>
                                        <tr>
                                          <th>
                                            Nombre
                                          </th>
                                          <th>
                                           Telefono
                                          </th>
                                          <th>
                                           Parentesco
                                          </th>
                                          
                                        </tr>
                                      </thead>
                              
                                      <tbody>
                                        @if (count($contacto) > 0)
                                          @foreach($contacto as $pro)
                                        <tr>
                                          <td>
                                           {{$pro->Nombre}}
                                          </td>
                                          <td>
                                            {{$pro->Telefono}}
                                          </td>
                                          <td>
                                            {{$pro->Parentesco}}
                                          </td>
                                         
                                         
                                          
                                        </tr>
                                        @endforeach
                                        @else
                                        <tr>
                                        No hay nada que mostrar...
                                        </tr>
                                        @endif
                                        
                                      </tbody>
                                  </table>
                                </div>
                              </div>
                          
                           
                        </div>
                      
                      </div>
                    
                   
                  </div>
                </div>
                    
                    <div class="col-lg-6">
                      <div class="card">
                      <div class="card-header b-a-0" style="    background-color: #bef3ce42 !important;">
                        <h2>Enfermedades</h2>
                      </div>
                      <div class="card-block">
                        <p style="color: #47dc4c">
                          Enfermedades registradas con su actual estado de salud
                        </p>

                         <div class="table-responsive" style="font-size: 15px;">
                            <table class="table table-bordered table-striped m-b-0">
                        <thead>
                          <tr>
                            <th>
                              Enfermedad
                            </th>
                            <th>
                             Situación de tu salud
                            </th>
                            
                          </tr>
                        </thead>
                        
                        <tbody>
                          @if (count(Auth::user()->Enfermedad) > 0)
                            @foreach(Auth::user()->Enfermedad as $pro)
                          <tr>
                            <td>
                             {{$pro->Enfermedad}}
                            </td>
                            <td>
                              {{$pro->Situacion_Salud}}
                            </td>
                           
                           
                            
                          </tr>
                          @endforeach
                          @else
                          <tr>
                          No hay nada que mostrar...
                          </tr>
                          @endif
                          
                        </tbody>
                      </table>
                         </div>
                      </div>
                      
                     
                    </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="card">
                        <div class="card-header b-a-0" style="    background-color: #bef3ce42 !important;">
                          <h2>Diabetes</h2>
                        </div>
                        <div class="card-block">
                          <p style="color: #47dc4c">
                           Tabla informativa de niveles de Glucemia para control de diabetes
                          </p>
                          
                         <a class="" href="{{ asset('uploads/NIVELES GLUCEMIA.xlsx') }}">
                          <img class="expanding-hidden" src="{{ asset('images/tabla.png') }}" style="max-height: 80px; margin:10px auto;	display:block;" alt=""/>
                        </a>
                           
                        </div>
                        
                       
                      </div>
                    </div>
                     <div class="divider col-lg-12">
                        <span>
                        
                        </span>
                      </div>
                    <div class="col-lg-6">
                      <div class="card">
                      <div class="card-header b-a-0" style="    background-color: #bef3ce42 !important;">
                        <h2>Remedios</h2>
                      </div>
                      <div class="card-block">
                        <p style="color: #47dc4c">
                          Remedios, usos y tratamientos
                        </p>

                         <div class="table-responsive" style="font-size: 15px;">
                            <table class="table table-bordered table-striped m-b-0">
                        <thead>
                          <tr>
                            <th>
                              Remedio
                            </th>
                            <th>
                             Usos y tratamientos
                            </th>
                            
                          </tr>
                        </thead>
                        
                        <tbody>
                          @if (count($remedios) > 0)
                            @foreach($remedios as $pro)
                          <tr>
                            <td>
                             {{$pro->Remedio}}
                            </td>
                            <td>
                              {{$pro->Uso_y_tratamiento}}
                            </td>
                           
                           
                            
                          </tr>
                          @endforeach
                          @else
                          <tr>
                          No hay nada que mostrar...
                          </tr>
                          @endif
                          
                        </tbody>
                      </table>
                         </div>
                      </div>
                      
                     
                    </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="card">
                       
                          <img class="expanding-hidden" src="{{ asset('images/VITA.jpeg') }}" style="width:100%; height: auto" alt=""/>
                      
                      </div>
                    </div>
                    <div class="divider col-lg-12">
                      <span>
                        
                      </span>
                    </div>
                    <div class="col-lg-12">
                      <div class="card">
                        <div class="card-header b-a-0" style="    background-color: #bef3ce42 !important;">
                          <h2>Farmacias</h2>
                        </div>
                        <div class="card-block">
                          <p style="color: #47dc4c">
                           Farmacias registradas para compra de medicacion recomendados
                          </p>
                          
                          <fieldset class="form-group">
                            <label for="exampleTextarea">
                              <span class="color-nuevo" >{{$ficha->Farmacia}}</span>
                            </label>
                            
                          </fieldset>
                           
                        </div>
                        
                       
                      </div>
                    </div>
                    <div class="col-lg-12">
                      <div class="card">
                        <div class="card-header b-a-0" style="    background-color: #bef3ce42 !important;">
                          <h2>Prevision en salud</h2>
                        </div>
                        <div class="card-block">
                          <p style="color: #47dc4c">
                           Farmacias registradas para compra de medicacion recomendados
                          </p>
                          
                          <fieldset class="form-group">
                            <label for="exampleTextarea">
                              <span class="color-nuevo" >{{$ficha->Prevision_salud}}</span>
                            </label>
                            
                          </fieldset>
                           
                        </div>
                        
                       
                      </div>
                    </div>
                    <div class="col-lg-12">
                      <div class="card">
                        <div class="card-header no-bg b-a-0">
                          <h2>Ubicacion geolocalizada</h2>
                        </div>
                          <div class="card-block">
                            <!-- Se determina y escribe la localizacion -->
                          <div id='ubicacion'></div>
                          <script type="text/javascript">
                          	if (navigator.geolocation) {
                          		navigator.geolocation.getCurrentPosition(mostrarUbicacion);
                          	} else {alert("¡Error! Este navegador no soporta la Geolocalización.");}
                          function mostrarUbicacion(position) {
                              var times = position.timestamp;
                          	var latitud = position.coords.latitude;
                          	var longitud = position.coords.longitude;
                              var altitud = position.coords.altitude;	
                          	var exactitud = position.coords.accuracy;	
                          	var div = document.getElementById("ubicacion");
                          	div.innerHTML = "Timestamp: " + times + "<br>Latitud: " + latitud + "<br>Longitud: " + longitud + "<br>Altura en metros: " + altitud + "<br>Exactitud: " + exactitud;}	
                          function refrescarUbicacion() {	
                          	navigator.geolocation.watchPosition(mostrarUbicacion);}	
                          </script>
                          
                          <!-- Se escribe un mapa con la localizacion anterior-->
                          <div id="demo"></div>
                          <div id="mapholder"></div>
                          <script src="http://maps.google.com/maps/api/js?sensor=false"></script>
                          <button onclick="cargarmap()">Cargar mapa</button>
                          <script type="text/javascript">
                          var x=document.getElementById("demo");
                          function cargarmap(){
                          navigator.geolocation.getCurrentPosition(showPosition,showError);
                          function showPosition(position)
                            {
                            lat=position.coords.latitude;
                            lon=position.coords.longitude;
                            latlon=new google.maps.LatLng(lat, lon)
                            mapholder=document.getElementById('mapholder')
                            mapholder.style.height='250px';
                            mapholder.style.width='500px';
                            var myOptions={
                            center:latlon,zoom:10,
                            mapTypeId:google.maps.MapTypeId.ROADMAP,
                            mapTypeControl:false,
                            navigationControlOptions:{style:google.maps.NavigationControlStyle.SMALL}
                            };
                            var map=new google.maps.Map(document.getElementById("mapholder"),myOptions);
                            var marker=new google.maps.Marker({position:latlon,map:map,title:"You are here!"});
                            }
                          function showError(error)
                            {
                            switch(error.code) 
                              {
                              case error.PERMISSION_DENIED:
                                x.innerHTML="Denegada la peticion de Geolocalización en el navegador."
                                break;
                              case error.POSITION_UNAVAILABLE:
                                x.innerHTML="La información de la localización no esta disponible."
                                break;
                              case error.TIMEOUT:
                                x.innerHTML="El tiempo de petición ha expirado."
                                break;
                              case error.UNKNOWN_ERROR:
                                x.innerHTML="Ha ocurrido un error desconocido."
                                break;
                              }
                            }}
                          </script>

                          </div>
                      </div>
                    
                    
                
                  
                    

                    
                  
                
               
                
               
              
            </div>
                <script
                    src="https://code.jquery.com/jquery-3.3.1.min.js"
                    integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
                    crossorigin="anonymous"></script>
            <script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>
           
            <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyByBBgG4UNnGNgKFJRfs4ker2bcg2lOLd8&callback=initMap" async defer></script>
          </div>
          <footer class="text-xs-center p-y-1">
            <p>
              
            </p>
          </footer>
        </div>
      </div>
    </div>
@endsection
