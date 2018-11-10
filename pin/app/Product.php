<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
     protected $table = 'ideas_product';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
     
     
     
    protected $fillable = [
        'slug','sku','price','price_promotion','qty','qty_order','featured_image','gallery',
        'status','product_order','product_type','tax_class_id','review_count','related_product',
        'created_at','updated_at','review_point','name','ID_id', 'PIN'


    ];
    
    public function OrderProduct()
    {
        return $this->belongsToMany('App\OrderProduct');
    }
    
      public function Id()
    {
        return $this->hasOne('App\Id');
    }
}
