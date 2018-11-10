<?php namespace Ideas\Shop\Models;

use October\Rain\Database\Model;
use October\Rain\Database\Traits\Validation;
use Event;

class TaxRate extends Model
{
    public $table = 'ideas_tax_rate';
    public $timestamps = false;//disable 'created_at' and 'updated_at'
    use Validation;

    const TYPE_PERCENTAGE = 1;
    const TYPE_FIXED = 2;

    public $rules = [
        'name' => 'required',
        'rate' => 'required'
    ];

    public $hasOne = [
        'geo_zone_relation' => [
            'Ideas\Shop\Models\Geo',
            'key' => 'id',//primary key
            'otherKey' => 'geo_zone_id'//foreign key
        ]
    ];

    public static function typeArray()
    {
        return [
            self::TYPE_PERCENTAGE => trans('ideas.shop::lang.field.percentage'),
            self::TYPE_FIXED => trans('ideas.shop::lang.field.fixed_amount')
        ];
    }
    public function getTypeOptions()
    {
        return self::typeArray();
    }

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

    public static function getTaxRate()
    {
        $rs = TaxRate::select('id', 'name')
            ->get()
            ->toArray();
        return $rs;
    }

    /**
     * Get list tax rate
     */
    public static function getTaxRateList()
    {
        $rs = [];
        $data = self::select('id', 'name')
            ->get();
        foreach ($data as $row) {
            $rs[$row->id] = $row->name;
        }
        return $rs;
    }

    /**
     * Map type text
     */
    public static function mapTypeTextOfTaxRate($type)
    {
        $typeArray = self::typeArray();
        $text = trans('ideas.shop::lang.field.percentage');
        if (array_key_exists($type, $typeArray)) {
            $text = $typeArray[$type];
        }
        return $text;
    }

    /**
     * after save
     */
    public function afterSave()
    {
        $dataSaved = $this->attributes;
        $post = post();
        Event::fire('ideas.shop.save_tax_rate', [$dataSaved, $post]);
    }
}