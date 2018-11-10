<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
   protected $table = 'ideas_order';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
     
     
     
    protected $fillable = [
        'user_id', 'billing_name', 'billing_address', 'billing_email', 'billing_phone', 
        'updated_at','shipping_name','shipping_address','shipping_email','shipping_phone',
        'shipping_rule_id','payment_method_id','comment','shipping_cost','total',
        'order_status_id','payment_status','created_at'

    ];
    
    
    public function User()
    {
        return $this->belongsTo('App\User');
    }
    
    public function Orderproduct()
    {
        return $this->hasMany('App\OrderProduct');
    }
    
   
}
