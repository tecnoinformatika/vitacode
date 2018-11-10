<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Remedios extends Model
{
    protected $table = 'Remedios';
    protected $fillable = [
       'user_id','Remedio','Uso_y_tratamiento'
       ];
       
       public function User()
    {
        return $this->belongsTo('App\User');
    }
}
