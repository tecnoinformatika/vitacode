<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
   
    
    protected $table = 'ideas_order_product';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
     
     
     
    protected $fillable = [
        'order_id', 'product_id', 'name', 'qty', 'price_after_tax', 'weight', 'weight_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    
    public function Product()
    {
        return $this->belongsToMany('App\Product');
    }
    
    
    public function Order()
    {
        return $this->belongsTo('App\Order');
    }
    
}
