<?php namespace Ideas\Shop\Models;

use October\Rain\Database\Model;
use October\Rain\Database\Traits\Validation;

class CouponToCategory extends Model
{
    protected $table = 'ideas_coupon_to_category';
    public $timestamps = false;//disable 'created_at' and 'updated_at'

    /**
     * Belong to category
     */
    public function category()
    {
        return $this->belongsTo('Ideas\Shop\Models\Category', 'category_id', 'id');
    }

}