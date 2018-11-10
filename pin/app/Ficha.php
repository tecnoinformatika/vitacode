<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ficha extends Model
{
   protected $table = 'Ficha';
   
   protected $fillable = [
       'id','user_id','Nombre','Apellidos','Rut','Direccion','Telefono','Fecha_nacimiento',
       'Comuna','Ciudad','Pais','Tipo_sangre','Alergias_','Alergias_cual','Donador_organos_',
       'imagen','created_at','updated_at','diligenciado'
       ];
       
       public function User()
    {
        return $this->hasOne('App\User');
    }
}
