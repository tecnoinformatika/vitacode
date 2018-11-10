<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Id extends Model
{
    protected $table = 'ids';
    protected $fillable = [
       'ID_fabrica','PIN','User_id','Product_id','Vinculado'
       ];
       
       public function User()
    {
        return $this->belongsTo('App\User');
    }
      public function Product()
    {
        return $this->belongsTo('App\Product');
    }
}
