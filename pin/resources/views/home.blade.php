@extends('layouts.admin')

@section('content')
        <div class="content-view">
            <div class="card">
              <div class="card-header no-bg b-a-0">
               Listado de productos Vita + Code
              </div>
              <div class="card-block">
                <p>
                  Estos son todos los productos que has adquirido
                  
                  Puedes actualizar los datos referentes a cada producto
                </p>
                <div class="table-responsive">
                  <table class="table table-bordered table-striped m-b-0">
                    <thead>
                      <tr>
                        <th>
                          Nombre
                        </th>
                        <th>
                         Precio
                        </th>
                        <th>
                          Fecha compra
                        </th>
                        <th>
                          Imagen
                        </th>
                        <th>
                          ID / PIN
                        </th>
                        <th>
                          Acciones
                        </th>
                      </tr>
                    </thead>
                    <tfoot>
                      <tr>
                        <th>
                          Nombre
                        </th>
                        <th>
                         Precio
                        </th>
                        <th>
                          Fecha compra
                        </th>
                        <th>
                          Imagen
                        </th>
                        <th>
                          ID / PIN
                        </th>
                        <th>
                          Acciones
                        </th>
                        
                       
                      </tr>
                    </tfoot>
                    <tbody>
                        @foreach($products as $pro)
                  
                      <tr>
                        <td>
                         {{$pro->name}}
                        </td>
                        <td>
                          {{$pro->price}}
                        </td>
                        <td>
                          {{$pro->created_at}}
                        </td>
                        <td>
                          <img src="/storage/app/media/{{$pro->featured_image}}" width="80px" >
                        </td>
                        <td>
                          {{$pro->ID_id}} / {{$pro->PIN}}
                        </td>
                        <td>
                          @if (is_null($pro->ID_id)) 
                          <form class="form-inline" method="post" action="{{ route('Vincular_pin') }}">
                              @csrf
                            <div class="form-group m-b-1">
                              <input type="hidden" class="form-control" id="Product_id" name="Product_id" value="{{$pro->product_id}}" />
                              <input type="text" class="form-control" id="ID_id" name="ID_id" value="" placeholder="ID"/>
                              <input type="text" class="form-control" id="PIN" name="PIN" value="" placeholder="PIN"/>
                            </div>
                            
                            <button type="submit" class="btn btn-primary m-b-1">
                             Vincular PIN
                            </button>
                          </form>
                          @else
                          -
                          @endif
                        </td>
                        
                      </tr>
                      @endforeach
                      
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
        </div>
@endsection
