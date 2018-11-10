<?php namespace Ideas\Shop\Models;

use October\Rain\Database\Model;
use October\Rain\Database\Traits\Validation;

class CouponToProduct extends Model
{
    protected $table = 'ideas_coupon_to_product';
    public $timestamps = false;//disable 'created_at' and 'updated_at'

    /**
     * belong to product
     */
    public function product()
    {
        return $this->belongsTo('Ideas\Shop\Models\Products', 'product_id', 'id');
    }
}