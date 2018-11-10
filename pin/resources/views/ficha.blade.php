@extends('layouts.admin')

@section('content')
<div class="content-view">
            <div class="row">
              <div class="col-lg-6">
                <div class="card">
                  <div class="card-header no-bg b-a-0">
                    <h2>Datos personales</h2>
                  </div>
                  <div class="card-block">
                    <p>
                      Información propia de la persona
                    </p>
                    @if ($errors->any())
                      <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                      </div><br />
                    @endif
                   
                    @if (!Auth::user()->ficha)
                    <form method="post" action="{{ route('datos_personales') }}" Files="true" enctype="multipart/form-data">
                       
                        @csrf
                      <fieldset class="form-group">
                        <label for="exampleInputEmail1">
                          Nombre
                        </label>
                        <input type="text" class="form-control" id="Nombre" placeholder="Nombre" name="Nombre"/>
                        <small class="text-muted">
                         Nombre completo sin apellidos
                        </small>
                      </fieldset>
                      <fieldset class="form-group">
                        <label for="exampleInputPassword1">
                          Apellidos
                        </label>
                        <input type="text" class="form-control" id="Apellidos" placeholder="Apellidos" name="Apellidos"/>
                      </fieldset>
                      <fieldset class="form-group">
                        <label for="exampleInputEmail1">
                          Rut
                        </label>
                        <input type="text" class="form-control" id="Rut" placeholder="Rut" name="Rut"/>
                        <small class="text-muted">
                         El Rol Único Tributario
                        </small>
                      </fieldset>
                      <fieldset class="form-group">
                        <label for="exampleInputPassword1">
                          Dirección
                        </label>
                        <input type="text" class="form-control" id="Direccion" placeholder="Direccion" name="Direccion"/>
                      </fieldset>
                      <fieldset class="form-group">
                        <label for="exampleInputPassword1">
                          Teléfono
                        </label>
                        <input type="text" class="form-control" id="Telefono" placeholder="Telefono" name="Telefono"/>
                      </fieldset>
                      <fieldset class="form-group">
                        <label for="exampleInputPassword1">
                          Fecha de Nacimiento
                        </label>
                        <input class="form-control" type="date" value="" id="Fecha_nacimiento" name="Fecha_nacimiento" require />
                      </fieldset>
                      <fieldset class="form-group">
                        <label for="exampleInputPassword1">
                          Comuna
                        </label>
                        <input type="text" class="form-control" id="Telefono" placeholder="Telefono" name="Telefono"/>
                      </fieldset>
                      <fieldset class="form-group">
                        <label for="exampleInputPassword1">
                          Ciudad
                        </label>
                        <input type="text" class="form-control" id="Telefono" placeholder="Telefono" name="Telefono"/>
                      </fieldset>
                      <fieldset class="form-group">
                        <label for="exampleInputPassword1">
                          Pais
                        </label>
                        <input type="text" class="form-control" id="Telefono" placeholder="Telefono" name="Telefono"/>
                      </fieldset>
                      <fieldset class="form-group">
                        <label for="exampleSelect1">
                          Tipo de Sangre
                        </label>
                        <select class="form-control" id="Tipo_sangre" name="Tipo_sangre" require>
                          <option>
                            Seleccione...
                          </option>
                          <option value="O -">
                            O -
                          </option>
                          <option value="O +">
                             O +
                          </option>
                          <option value="A -">
                           A -
                          </option>
                          <option value="A +">
                           A +
                          </option>
                          <option value="B -">
                            B -
                          </option>
                          <option value="B +">
                            B +
                          </option>
                          <option value="AB -">
                            AB -
                          </option>
                          <option value="AB +">
                            AB +
                          </option>
                        </select>
                      </fieldset>
                      <fieldset class="form-group">
                        <label for="exampleSelect1">
                          Tiene alergias
                        </label>
                        <select class="form-control" id="Alergias_" name="Alergias_">
                          <option value="0" selected>
                            No
                          </option>
                          <option value="1">
                            Si
                          </option>
                          
                        </select>
                      </fieldset>
                      <fieldset class="form-group">
                        <label for="exampleTextarea">
                          Que alergia
                        </label>
                         <input type="text" class="form-control" id="Alergias_cual" placeholder="Especifica a que eres alérgico" name="Alergias_cual"/>
                        </textarea>
                      </fieldset>
                      <fieldset class="form-group">
                        <label for="exampleSelect1">
                          Es donador de organos?
                        </label>
                        <select class="form-control" id="Donador_organos_" name="Donador_organos_">
                          <option value="0" selected>
                            No
                          </option>
                          <option value="1">
                            Si
                          </option>
                          
                        </select>
                      </fieldset>
                      
                      
                      <fieldset class="form-group">
                        <label for="exampleInputFile">
                          Carga una foto de tu rostro
                        </label>
                        <input type="file" class="form-control-file" id="imagen" name="imagen"/>
                        <small class="text-muted">
                          La imagen debe ser clara y actual de ti mismo para que no hayan confusiones
                        </small>
                      </fieldset>
                      
                      <button type="submit" class="btn btn-primary">
                        Guardar
                      </button>
                    </form>
                    @else
                    <form method="post" action="{{ route('edit_datos_personales') }}" Files="true" enctype="multipart/form-data">
                        @method('post')
                        @csrf
                      <fieldset class="form-group">
                        <label for="exampleInputEmail1">
                          Nombre
                        </label>
                        <input type="text" class="form-control" id="Nombre" value="{{$ficha->Nombre}}" name="Nombre" />
                        <small class="text-muted">
                         Nombre completo sin apellidos
                        </small>
                      </fieldset>
                      <fieldset class="form-group">
                        <label for="exampleInputPassword1">
                          Apellidos
                        </label>
                        <input type="text" class="form-control" id="Apellidos" value="{{$ficha->Apellidos}}" name="Apellidos" />
                      </fieldset>
                      <fieldset class="form-group">
                        <label for="exampleInputEmail1">
                          Rut
                        </label>
                        <input type="text" class="form-control" id="Rut" value="{{$ficha->Rut}}" name="Rut" />
                        <small class="text-muted">
                         El Rol Único Tributario
                        </small>
                      </fieldset>
                      <fieldset class="form-group">
                        <label for="exampleInputPassword1">
                          Dirección
                        </label>
                        <input type="text" class="form-control" id="Direccion" value="{{$ficha->Direccion}}" name="Direccion" />
                      </fieldset>
                      <fieldset class="form-group">
                        <label for="exampleInputPassword1">
                          Teléfono
                        </label>
                        <input type="text" class="form-control" id="Telefono" value="{{$ficha->Telefono}}"  name="Telefono"/>
                      </fieldset>
                      <fieldset class="form-group">
                        <label for="exampleInputPassword1">
                          Fecha de Nacimiento
                        </label>
                        <input class="form-control" type="date" value="{{$ficha->Fecha_nacimiento}}" id="Fecha_nacimiento" name="Fecha_nacimiento"  />
                      </fieldset>
                      <fieldset class="form-group">
                        <label for="exampleInputPassword1">
                          Comuna
                        </label>
                        <input type="text" class="form-control" id="Comuna" value="{{$ficha->Comuna}}" name="Comuna"/>
                      </fieldset>
                      <fieldset class="form-group">
                        <label for="exampleInputPassword1">
                          Ciudad
                        </label>
                        <input type="text" class="form-control" id="Ciudad" value="{{$ficha->Ciudad}}" name="Ciudad"/>
                      </fieldset>
                      <fieldset class="form-group">
                        <label for="exampleInputPassword1">
                          Pais
                        </label>
                        <input type="text" class="form-control" id="Pais" value="{{$ficha->Pais}}" name="Pais"/>
                      </fieldset>
                      <fieldset class="form-group">
                        <label for="exampleSelect1">
                          Tipo de Sangre
                        </label>
                        <select class="form-control" id="Tipo_sangre" name="Tipo_sangre" require>
                          <option selected value="{{$ficha->Tipo_sangre}}">
                            {{$ficha->Tipo_sangre}}
                          </option>
                          <option value="O -">
                            O -
                          </option>
                          <option value="O +">
                             O +
                          </option>
                          <option value="A -">
                           A -
                          </option>
                          <option value="A +">
                           A +
                          </option>
                          <option value="B -">
                            B -
                          </option>
                          <option value="B +">
                            B +
                          </option>
                          <option value="AB -">
                            AB -
                          </option>
                          <option value="AB +">
                            AB +
                          </option>
                        </select>
                      </fieldset>
                      <fieldset class="form-group">
                        <label for="exampleSelect1">
                          Tiene alergias
                        </label>
                        <select class="form-control" id="Alergias_" name="Alergias_">
                          @if ($ficha->Alergias_ == 0 )
                          <option value="0" selected>
                            No
                          </option>
                          <option value="1">
                            Si
                          </option>
                          @else
                          <option value="1" selected>
                            Si
                          </option>
                          <option value="0">
                            NO
                          </option>
                          @endif
                          
                          
                        </select>
                      </fieldset>
                      <fieldset class="form-group">
                        <label for="exampleTextarea">
                          Que alergia
                        </label>
                         <input type="text" class="form-control" id="Alergias_cual" value="{{$ficha->Alergias_cual}}" name="Alergias_cual"/>
                        </textarea>
                      </fieldset>
                      <fieldset class="form-group">
                        <label for="exampleSelect1">
                          Es donador de organos?
                        </label>
                        <select class="form-control" id="Donador_organos_" name="Donador_organos_">
                          @if ($ficha->Donador_organos_ == 0 )
                          <option value="0" selected>
                            No
                          </option>
                          <option value="1">
                            Si
                          </option>
                          @else
                          <option value="1" selected>
                            Si
                          </option>
                          <option value="0">
                            NO
                          </option>
                          @endif
                        </select>
                      </fieldset>
                      
                      
                      <fieldset class="form-group">
                        <label for="exampleInputFile">
                          Carga una foto de tu rostro
                        </label>
                        <input type="file" class="form-control-file" id="imagen" name="imagen" value="{{$ficha->imagen}}"/>
                        <small class="text-muted">
                          La imagen debe ser clara y actual de ti mismo para que no hayan confusiones <div class="user-image">
                          <img src="../img/{{$ficha->imagen}}" class="avatar img-circle" alt="user" title="user"/>
                        </div>
                        </small>
                      </fieldset>
                      
                      <button type="submit" class="btn btn-primary">
                        Editar
                      </button>
                    </form>
                    @endif
                    
                  </div>
                </div>
                <div class="card">
                  <div class="card-header no-bg b-a-0">
                    <h2>Datos relevantes</h2>
                  </div>
                  <div class="card-block">
                    <p>
                      The class is the easiest way to add some structure to forms. Its only purpose is to provide margin-bottom around a label and control pairing. As a bonus, since it’s a class you can use it with
                      
                    </p>
                    @if (!Auth::user()->ficha)
                    @else
                    <form class="form-inline" method="post" action="{{ route('edit_farmacia') }}">
                       @method('post')
                        @csrf
                      <div class="form-group m-b-1">
                        <label for="exampleInputName2">
                          Farmacia
                        </label>
                        <input type="text" class="form-control" id="Farmacia" name="Farmacia" value="{{$ficha->Farmacia}}" placeholder="Farmacia"/>
                      </div>
                      <button type="submit" class="btn btn-primary m-b-1">
                        Registrar farmacia
                      </button>
                    </form>
                    
                    <form class="form-inline" method="post" action="{{ route('edit_prevision_salud') }}">
                       @method('post')
                        @csrf
                      <div class="form-group m-b-1">
                        <label for="exampleInputName2">
                          PRevision en salud actual
                        </label>
                        <input type="text" class="form-control" id="Prevision_salud" name="Prevision_salud" value="{{$ficha->Prevision_salud}}" placeholder="Prevision en salud"/>
                      </div>
                      
                      <button type="submit" class="btn btn-primary m-b-1">
                        Registrar
                      </button>
                    </form>
                    @endif
                  </div>
                </div>
               
                
              </div>
              <div class="col-lg-6">
                <div class="card">
                  <div class="card-header no-bg b-a-0">
                    <h2>Contactos</h2>
                  </div>
                  <div class="card-block">
                    <p style="color: #47dc4c">
                      Registra aca todos las personas a las que deberiamos contactar en caso de urgencia.
                    </p>
                    <form method="post" action="{{ route('store_contactos') }}" >
                       
                        @csrf
                      <fieldset class="form-group">
                        <label for="exampleInputEmail1">
                          Nombre completo
                        </label>
                        <input type="text" class="form-control" id="Nombre" placeholder="Nombre" name="Nombre"/>
                        <small class="text-muted">
                         Nombre completo incluyendo apellidos
                        </small>
                      </fieldset>
                      <fieldset class="form-group">
                        <label for="exampleInputPassword1">
                          Telefono
                        </label>
                        <input type="text" class="form-control" id="Telefono" placeholder="Telefono" name="Telefono"/>
                      </fieldset>
                      <fieldset class="form-group">
                        <label for="exampleInputPassword1">
                          Parentesco
                        </label>
                        <input type="text" class="form-control" id="Parentesco" placeholder="Parentesco" name="Parentesco"/>
                      </fieldset>
                     
                      <button type="submit" class="btn btn-primary">
                        Registrar contacto
                      </button>
                    </form>
                     <div class="table-responsive">
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
                      @if (count(Auth::user()->Contacto) > 0)
                        @foreach(Auth::user()->Contacto as $pro)
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
                <div class="card">
                  <div class="card-header no-bg b-a-0">
                    <h2>Enfermedades</h2>
                  </div>
                  <div class="card-block">
                    <p style="color: #47dc4c">
                      Registra aca todas las enfermedades que tienes de las cuales debemos estar atentos
                    </p>
                    <form method="post" action="{{ route('store_enfermedad') }}" >
                       
                        @csrf
                      <fieldset class="form-group">
                        <label for="exampleInputEmail1">
                          Nombre enfermedad
                        </label>
                        <input type="text" class="form-control" id="Enfermedad" placeholder="Enfermedad" name="Enfermedad"/>
                        <small class="text-muted">
                         Nombre completo para poder entender tu situación
                        </small>
                      </fieldset>
                      <fieldset class="form-group">
                        <label for="exampleInputPassword1">
                          Situación de tu salud
                        </label>
                        <input type="text" class="form-control" id="Situacion_Salud" placeholder="Situacion_Salud" name="Situacion_Salud"/>
                      </fieldset>
                     
                      <button type="submit" class="btn btn-primary">
                        Registrar enfermedad
                      </button>
                    </form>
                     <div class="table-responsive">
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
                <div class="card">
                  <div class="card-header no-bg b-a-0">
                    <h2>Remedios</h2>
                  </div>
                  <div class="card-block">
                    <p style="color: #47dc4c">
                      Registra aca todos los remedios que estas tomando actualmente.
                    </p>
                    <form method="post" action="{{ route('store_remedio') }}" >
                       
                        @csrf
                      <fieldset class="form-group">
                        <label for="exampleInputEmail1">
                          Nombre remedio
                        </label>
                        <input type="text" class="form-control" id="Remedio" placeholder="Remedio" name="Remedio"/>
                        <small class="text-muted">
                         Nombre completo para poder entender tu situación
                        </small>
                      </fieldset>
                      <fieldset class="form-group">
                        <label for="exampleInputPassword1">
                          Uso y tratamiento detallado
                        </label>
                        <input type="text" class="form-control" id="Uso_y_tratamiento" placeholder="Uso_y_tratamiento" name="Uso_y_tratamiento"/>
                      </fieldset>
                     
                      <button type="submit" class="btn btn-primary">
                        Registrar remedio
                      </button>
                    </form>
                     <div class="table-responsive">
                  <table class="table table-bordered table-striped m-b-0">
                    <thead>
                      <tr>
                        <th>
                          Remedio
                        </th>
                        <th>
                         Uso y tratamiento
                        </th>
                        
                      </tr>
                    </thead>
                    
                    <tbody>
                      @if (count(Auth::user()->Remedio) > 0)
                        @foreach(Auth::user()->Remedio as $pro)
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
                <div class="card">
                  <div class="card-header no-bg b-a-0">
                    <h2>Ubicacion geolocalizada</h2>
                  </div>
                  <div class="card-block">
                    <div id="map-canvas" style="min-height: 300px"></div>
                    <form class="form-inline" method="post" action="{{ route('registrar_coordenadas') }}">
                       
                        @csrf
                      <div class="form-group m-b-1">
                        
                        <input type="hidden" class="form-control" id="lat" name="lat" value="" />
                        <input type="hidden" class="form-control" id="lng" name="lng" value="" />
                      </div>
                      
                      <button type="submit" class="btn btn-primary m-b-1">
                        Guardar coordenadas
                      </button>
                    </form>
                  </div>
                </div>
                
               
              </div>
            </div>
          </div>
         <script src="https://maps.googleapis.com/maps/api/js"></script>
        <script>
          var map = new google.maps.Map(document.getElementById('map-canvas'),{
            center: {
                lat:-33.4406285,
                lng:-70.6447395
              },
              zoom:15
          });
          var marker =  new google.maps.Marker({
            position: {
              lat:-33.4406285,
              lng:-70.6447395
            },
            map: map,
            draggable: true
          });
          
          google.maps.event.addListener(marker,'position_changed',function(){
            var lat = marker.getPosition().lat();
            var lng = marker.getPosition().lng();
            
            
            $('#lat').val(lat);
            $('#lng').val(lng);
          });
          
          // var searchBox = new google.maps.places.SearchBox(document.getElementById('searchmap'));
        </script>
@endsection