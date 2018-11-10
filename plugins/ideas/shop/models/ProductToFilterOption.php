<?php

namespace Ideas\Shop\Models;

use October\Rain\Database\Model;

class ProductToFilterOption extends Model
{
    protected $table = 'ideas_product_to_filter_option';
    public $timestamps = false;//disable 'created_at' and 'updated_at'

    /**
     * belong to filter
     */
    public function filterOption()
    {
        return $this->belongsTo('Ideas\Shop\Models\FilterOption', 'filter_option_id', 'id');
    }
}