<?php
/**
 * This table use for relationship between product child of configurable product
 * Use when apply coupon for config child
 */

namespace Ideas\Shop\Models;

use October\Rain\Database\Model;

class ProductChildToCategory extends Model
{
    protected $table = 'ideas_product_child_to_category';
    public $timestamps = false;//disable 'created_at' and 'updated_at'
}