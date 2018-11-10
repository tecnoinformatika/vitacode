<?php

namespace Ideas\Shop\Models;

use October\Rain\Database\Model;

class ProductToAttribute extends Model
{
    protected $table = 'ideas_product_attribute';
    public $timestamps = false;//disable 'created_at' and 'updated_at'

    /**
     * Get attribute by product id
     */
    public static function getAttributeByProductId($productId)
    {
        $data = self::where('product_id', $productId)->first();
        return $data;
    }


}