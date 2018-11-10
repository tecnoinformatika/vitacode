<?php

namespace Ideas\Shop\Models;

use October\Rain\Database\Model;

class ProductToCategory extends Model
{
    protected $table = 'ideas_product_to_category';
    public $timestamps = false;//disable 'created_at' and 'updated_at'

    /**
     * Get category for product detail
     */
    public static function getCategoryForProduct($id)
    {
        return self::select('category_id')->where('product_id', $id)->first();
    }

}