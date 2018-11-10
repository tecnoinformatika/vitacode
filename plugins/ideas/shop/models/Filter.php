<?php

namespace Ideas\Shop\Models;

use October\Rain\Database\Model;
use October\Rain\Database\Traits\Validation;
use Event;

class Filter extends Model
{
    use Validation;

    protected $table = 'ideas_filter';
    public $timestamps = false;//disable 'created_at' and 'updated_at'

    public $rules = [
        'name' => 'required'
    ];

    /**
     * Has many filter option
     */
    public function filterOption()
    {
        return $this->hasMany('Ideas\Shop\Models\FilterOption', 'filter_id', 'id');
    }

    /**
     * Has many through
     */
    public function productToFilterOption()
    {
        return $this->hasManyThrough(
            'Ideas\Shop\Models\ProductToFilterOption',
            'Ideas\Shop\Models\FilterOption',
            'filter_id', // in table '#_filter_option'
            'filter_option_id', //in table '#_product_to_filter_option'
            'id', // id in table '#_filter'
            'id' // id in table '#_filter_option'
        );
    }

    /**
     * Get all filter
     */
    public static function getAllFilter()
    {
        $data = self::select('id', 'name')
            ->get();
        return IdeasShop::convertArrayKeyValue($data, 'id', 'name');
    }

    /**
     * after save
     */
    public function afterSave()
    {
        $dataSaved = $this->attributes;
        $post = post();
        Event::fire('ideas.shop.save_filter', [$dataSaved, $post]);
    }
}