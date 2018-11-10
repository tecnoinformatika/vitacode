<?php

namespace Ideas\Shop\Models;

use October\Rain\Database\Model;
use October\Rain\Database\Traits\Validation;

class Weight extends Model
{
    use Validation;

    protected $table = 'ideas_weight';
    public $timestamps = false;//disable 'created_at' and 'updated_at'

    public $rules = [
        'name' => 'required'
    ];

    public static function getWeightForShipCache()
    {
        $data = self::select('id', 'value')->get();
        $rs = [];
        foreach ($data as $row) {
            $rs[$row->id] = $row->value;
        }
        return $rs;
    }
    /**
     * Get weight class
     */
    public static function getWeightForShip()
    {
        $cacheKey = 'weight_for_ship';
        $rs = IdeasShop::returnCacheData($cacheKey, function () {
            return self::getWeightForShipCache();
        });
        return $rs;
    }
}