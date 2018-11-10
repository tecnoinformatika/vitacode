<?php

namespace Ideas\Shop\Models;

use October\Rain\Database\Model;
use October\Rain\Database\Traits\Validation;
use Event;

class Ship extends Model
{
    use Validation;

    protected $table = 'ideas_ship_rule';
    public $timestamps = false;//disable 'created_at' and 'updated_at'

    const TYPE_PRICE = 1;
    const TYPE_GEO = 2;
    const TYPE_WEIGHT_BASED = 3;
    const TYPE_PER_ITEM = 4;
    const TYPE_GEO_WEIGHT_BASED = 5;

    const WEIGHT_TYPE_FIXED = 1;
    const WEIGHT_TYPE_RATE = 2;

    public $rules = [
        'name' => 'required'
    ];

    public function getGeoZoneIdOptions()
    {
        $rs = Geo::select('id', 'name')
            ->get()
            ->toArray();
        $geoZoneArray = [];
        foreach ($rs as $row) {
            $geoZoneArray[$row['id']] = $row['name'];
        }
        return $geoZoneArray;
    }

    public function getWeightTypeOptions()
    {
        $rs = [
            self::WEIGHT_TYPE_FIXED => 'ideas.shop::lang.field.weight_type_fix',
            self::WEIGHT_TYPE_RATE => 'ideas.shop::lang.field.weight_type_rate'
        ];
        return $rs;
    }

    public function getTypeOptions()
    {
        $rs = [
            self::TYPE_PRICE => 'ideas.shop::lang.field.price',
            self::TYPE_GEO => 'ideas.shop::lang.field.geo_zone_id',
            self::TYPE_WEIGHT_BASED => 'ideas.shop::lang.ship.weight_based',
            self::TYPE_PER_ITEM => 'ideas.shop::lang.ship.per_item',
            self::TYPE_GEO_WEIGHT_BASED => 'ideas.shop::lang.ship.geo_weight_based'
        ];
        return $rs;
    }

    /**
     * Get all ship rule
     */
    public static function getShipRule()
    {
        $data = self::where('status', IdeasShop::ENABLE)
            ->get()
            ->toArray();
        return $data;
    }

    /**
     * Get ship rule by id
     */
    public static function getShipRuleNameById($id)
    {
        $data = self::select('name')
            ->where('id', $id)
            ->first();
        $rs = [];
        if (!empty($data)) {
            $rs = $data->toArray();
        }
        return $rs['name'];
    }

    /**
     * after save
     */
    public function afterSave()
    {
        $dataSaved = $this->attributes;
        $post = post();
        Event::fire('ideas.shop.save_ship', [$dataSaved, $post]);
    }
}