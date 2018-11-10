<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coordenada extends Model
{
    protected $table = 'Coordenadas';
    protected $fillable = [
       'user_id','lat','lng'
       ];
       
       public function User()
    {
        return $this->belongsTo('App\User');
    }
}
