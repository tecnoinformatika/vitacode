<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contacto extends Model
{
    protected $table = 'Contacto';
    protected $fillable = [
       'user_id','Nombre','Telefono','Parentesco'
       ];
       
       public function User()
    {
        return $this->belongsTo('App\User');
    }
}
