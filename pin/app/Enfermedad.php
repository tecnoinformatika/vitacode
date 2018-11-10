<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Enfermedad extends Model
{
    protected $table = 'Enfermedad';
    protected $fillable = [
       'user_id','Enfermedad','Situacion_Salud'
       ];
       
       public function User()
    {
        return $this->belongsTo('App\User');
    }
}
