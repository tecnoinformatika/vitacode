<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Ficha, App\Contacto, App\Enfermedad, App\Remedios, App\Coordenada, App\Id, App\Product, App\OrderProduct;
use DB;
use Auth;
use Image;
use Alert;
class FichaController extends Controller
{
   public function __construct()
    {
        $this->middleware('auth');
    }
    
    
    public function index(Request $request)
    {
        $ID = ID::where('ID_fabrica', '=', $request->get('ID_id'))->where('PIN', '=', $request->get('PIN'))->first();
        if ($ID){
                
             
            
             $ficha = Ficha::where('user_id', $ID->User_id)->first();
             $contacto = Contacto::where('user_id', $ID->User_id)->get();
             $enfermedad = Enfermedad::where('user_id', $ID->User_id)->get();
             $remedios = Remedios::where('user_id', $ID->User_id)->get();
             $coordenadas = Coordenada::where('user_id', $ID->User_id)->latest('created_at')->first();
             
             Alert::success('Has ingresado correctamente la información', 'Muy bien')->autoclose(3000);
             return view('ficha-web')->with('ficha',$ficha)->with('contacto',$contacto)->with('enfermedad',$enfermedad)->with('remedios',$remedios)->with('coordenadas',$coordenadas);
            
        
        }
   
       Alert::error('Debes registrar el id y el pin que venian con tu compra', 'Error')->autoclose(3000);
        return redirect::back();
        
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_datos_personales(Request $request)
    {
        $ficha = Ficha::where('user_id', Auth::user()->id)->first();
        try{
    
                $ruta = public_path().'/img/';
                
            
                $imagenOriginal = $request->file('imagen');
                 // crear instancia de imagen
                $imagen = Image::make($imagenOriginal);
             
                // generar un nombre aleatorio para la imagen
                $temp_name = $this->random_string() . '.' . $imagenOriginal->getClientOriginalExtension();
             
                $imagen->resize(300,300);
                 
                  // guardar imagen
                  // save( [ruta], [calidad])
                $imagen->save($ruta . $temp_name, 100);
         
             
              $share = new File([
                'user_id' => Auth::user()->id,
                'Nombre' => $request->get('Nombre'),
                'Apellidos' => $request->get('Apellidos'),
                'Rut' => $request->get('Rut'),
                'Direccion' => $request->get('Direccion'),
                'Telefono' => $request->get('Telefono'),
                'Fecha_nacimiento' => $request->get('Fecha_nacimiento'),
                'Comuna' => $request->get('Comuna'),
                'Ciudad' => $request->get('Ciudad'),
                'Pais' => $request->get('Pais'),
                'Tipo_sangre' => $request->get('Tipo_sangre'),
                'Alergias_' => $request->get('Alergias_'),
                'Alergias_cual' => $request->get('Alergias_cual'),
                'Donador_organos_' => $request->get('Donador_organos_'),
                'imagen' => $temp_name,
                'diligenciado' => 1
        
              ]);
              $share->save();
      
              Alert::Success('Tus datos han sido registrados correctamente', 'Muy bien')->autoclose(3000);
              return Redirect('editar/ficha')->with('ficha',$ficha);
        } catch (Exception $e ) {
            Alert::error('Algo fallo, revisa la informacion que ingresas', 'Upss')->autoclose(3000);
              return Redirect('editar/ficha')->with('ficha',$ficha);
        }
    }
    
    public function store_contactos(Request $request)
    {
        $ficha = Ficha::where('user_id', Auth::user()->id)->first();
        try{
     
              $share = new Contacto([
                'user_id' => Auth::user()->id,
                'Nombre' => $request->get('Nombre'),
                'Telefono' => $request->get('Telefono'),
                'Parentesco' => $request->get('Parentesco')
              ]);
              $share->save();
      
              Alert::Success('Tu contacto ha sido registrado correctamente', 'Muy bien')->autoclose(3000);
              return Redirect('editar/ficha')->with('ficha',$ficha);
        } catch (Exception $e ) {
            Alert::error('Algo fallo, revisa la informacion que ingresas', 'Upss')->autoclose(3000);
              return Redirect('editar/ficha')->with('ficha',$ficha);
        }
   
    }
    
    public function store_enfermedad(Request $request)
    {
    
        $ficha = Ficha::where('user_id', Auth::user()->id)->first();
        try{
          $share = new Enfermedad([
            'user_id' => Auth::user()->id,
            'Enfermedad' => $request->get('Enfermedad'),
            'Situacion_Salud' => $request->get('Situacion_Salud')
            
          ]);
          $share->save();
      
              Alert::Success('La enfermedad ha sido registrada correctamente', 'Muy bien')->autoclose(3000);
              return Redirect('editar/ficha')->with('ficha',$ficha);
        } catch (Exception $e) {
            Alert::error('Algo fallo, revisa la informacion que ingresas', 'Upss')->autoclose(3000);
              return Redirect('editar/ficha')->with('ficha',$ficha);
        }
   
    }
    
    public function store_remedio(Request $request)
    {
    
            $ficha = Ficha::where('user_id', Auth::user()->id)->first();
            try{
              $share = new Remedios([
                'user_id' => Auth::user()->id,
                'Remedio' => $request->get('Remedio'),
                'Uso_y_tratamiento' => $request->get('Uso_y_tratamiento')
                
              ]);
              $share->save();
              
             
                  Alert::Success('El remedio ha sido registrado correctamente', 'Muy bien')->autoclose(3000);
                  return Redirect('editar/ficha')->with('ficha',$ficha);
            } catch (Exception $e) {
                Alert::error('Algo fallo, revisa la informacion que ingresas', 'Upss')->autoclose(3000);
                  return Redirect('editar/ficha')->with('ficha',$ficha);
            }
   
    }
    
    public function registrar_coordenadas(Request $request)
    {
    
    
        try {
             $share = new Coordenada([
                'user_id' => Auth::user()->id,
                'lat' => $request->get('lat'),
                'lng' => $request->get('lng')
                
              ]);
              $share->save();
              
              $ficha = Ficha::where('user_id', Auth::user()->id)->first();
              Alert::Success('Tus coordenadas han sido registradas correctamente', 'Muy bien')->autoclose(3000);
              return Redirect('editar/ficha')->with('ficha',$ficha);
        } catch (Exception $e) {
            Alert::error('Algo fallo, revisa la informacion que ingresas', 'Upss')->autoclose(3000);
              return Redirect('editar/ficha')->with('ficha',$ficha);
        }
             
   
    }
    
    public function Vincular_pin(Request $request)
    {
    
    
    
        $ID = ID::where('ID_fabrica', '=', $request->get('ID_id'))->where('PIN', '=', $request->get('PIN'))->first();
  
        if ($ID){
            if ($ID->vinculado == 0){
       
            $ID->User_id = Auth::user()->id;
            $ID->Product_id = $request->Product_id;
            $ID->vinculado = 1;
            $ID->save();
            
            $producto= OrderProduct::find($request->Product_id);
          
            $producto->ID_id = $request->get('ID_id');
            $producto->PIN = $request->get('PIN');
            $producto->save();
            
            alert()->success('Pin vinculado correctamente.','Vinculacion')->autoclose(3000);
            return redirect('home');
            }else{
               Alert::error('Este ID ya esta en uso', 'Error')->autoclose(3000);
               return redirect('home');
            }
        
        }
       Alert::error('Debes registrar el id y el pin que venian con tu compra', 'Error')->autoclose(3000);
       return redirect('home');
        
      
      
   
    }
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $ficha = Ficha::where('user_id', Auth::user()->id)->first();
       
        return view('ficha')->with('ficha',$ficha);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    protected function random_string()
    {
        $key = '';
        $keys = array_merge( range('a','z'), range(0,9) );
     
        for($i=0; $i<10; $i++)
        {
            $key .= $keys[array_rand($keys)];
        }
     
        return $key;
    }
    public function edit_datos_personales(Request $request)
    {
        $ficha= Ficha::where('user_id', Auth::user()->id)->first();
        try{
        
                $ficha= Ficha::where('user_id', Auth::user()->id)->first();
                $id = $ficha->id;
                $ruta = public_path().'/img/';
                
            
                $imagenOriginal = $request->file('imagen');
                 // crear instancia de imagen
                $imagen = Image::make($imagenOriginal);
             
                // generar un nombre aleatorio para la imagen
                $temp_name = $this->random_string() . '.' . $imagenOriginal->getClientOriginalExtension();
             
                $imagen->resize(300,300);
                 
                  // guardar imagen
                  // save( [ruta], [calidad])
                $imagen->save($ruta . $temp_name, 100);
              
              
              
              
                
              
              
            
                $ficha->Nombre = $request->get('Nombre');
                $ficha->Apellidos  = $request->get('Apellidos');
                $ficha->Rut = $request->get('Rut');
                $ficha->Direccion = $request->get('Direccion');
                $ficha->Telefono = $request->get('Telefono');
                $ficha->Fecha_nacimiento = $request->get('Fecha_nacimiento');
                $ficha->Comuna = $request->get('Comuna');
                $ficha->Ciudad = $request->get('Ciudad');
                $ficha->Pais = $request->get('Pais');
                $ficha->Tipo_sangre = $request->get('Tipo_sangre');
                $ficha->Alergias_ = $request->get('Alergias_');
                $ficha->Alergias_cual = $request->get('Alergias_cual');
                $ficha->Donador_organos_ = $request->get('Donador_organos_');
                $ficha->imagen = $temp_name;
                $ficha->save();
      
              Alert::Success('Tus datos han sido actualizados correctamente', 'Muy bien')->autoclose(3000);
              return Redirect('editar/ficha')->with('ficha',$ficha);
        } catch (Exception $e) {
            Alert::error('Algo fallo, revisa la informacion que ingresas', 'Upss')->autoclose(3000);
              return Redirect('editar/ficha')->with('ficha',$ficha);
        }
      
     
    }
    
    public function edit_farmacia(Request $request)
    {
      $ficha= Ficha::where('user_id', Auth::user()->id)->first();
      try{  
        
        $ficha->Farmacia = $request->get('Farmacia');
        $ficha->save();
           Alert::Success('La farmacia ha sido registrada correctamente', 'Muy bien')->autoclose(3000);
           return Redirect('editar/ficha')->with('ficha',$ficha);
      }catch (Exception $e){
          Alert::error('Algo fallo, revisa la informacion que ingresas', 'Upss')->autoclose(3000);
          return Redirect('editar/ficha')->with('ficha',$ficha);
      }
     
    }
    
    public function edit_prevision_salud(Request $request)
    {
      $ficha= Ficha::where('user_id', Auth::user()->id)->first();
      try{  
            $ficha->Prevision_salud = $request->get('Prevision_salud');
            $ficha->save();
      
            Alert::Success('La farmacia ha sido registrada correctamente', 'Muy bien')->autoclose(3000);
            return Redirect('editar/ficha')->with('ficha',$ficha);
      }catch (Exception $e){
          Alert::error('Algo fallo, revisa la informacion que ingresas', 'Upss')->autoclose(3000);
          return Redirect('editar/ficha')->with('ficha',$ficha);
      }
      
     
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
