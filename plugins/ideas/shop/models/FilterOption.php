<?php

namespace Ideas\Shop\Models;

use October\Rain\Database\Model;
use October\Rain\Database\Traits\Validation;
use Event;

class FilterOption extends Model
{
    use Validation;

    protected $table = 'ideas_filter_option';
    public $timestamps = false;//disable 'created_at' and 'updated_at'

    public $rules = [
        'name' => 'required'
    ];

    const FILTER_TYPE_COLOR = 1;
    const FILTER_TYPE_LABEL = 2;
    const FILTER_TYPE_IMAGE = 3;

    public $hasOne = [
        'filter_relation' => [
            'Ideas\Shop\Models\Filter',
            'key' => 'id',//primary key
            'otherKey' => 'filter_id'//foreign key
        ]
    ];

    public function filter()
    {
        return $this->belongsTo('Ideas\Shop\Models\Filter', 'filter_id');
    }

    /**
     * Has many product
     */
    public function productToFilterOption()
    {
        return $this->hasMany('Ideas\Shop\Models\ProductToFilterOption', 'filter_option_id', 'id');
    }


    /**
    * Filter Select data
    */
    public static function getFilterTypeOptions()
    {
        return [
            self::FILTER_TYPE_COLOR => 'ideas.shop::lang.filter.color',
            self::FILTER_TYPE_LABEL => 'ideas.shop::lang.filter.label',
            self::FILTER_TYPE_IMAGE => 'ideas.shop::lang.filter.image'
        ];
    }

    /**
     * Get filter
     */
    public static function getFilterIdOptions()
    {
        $data = Filter::all();
        $rs = [];
        foreach ($data as $row) {
            $rs[$row->id] = $row->name;
        }
        return $rs;
    }

    /**
     * after save
     */
    public function afterSave()
    {
        $dataSaved = $this->attributes;
        $post = post();
        Event::fire('ideas.shop.save_filter_option', [$dataSaved, $post]);
    }

}