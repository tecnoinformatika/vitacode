<?php namespace Ideas\Shop\Models;

use October\Rain\Database\Model;
use October\Rain\Database\Traits\Validation;
use Event;

class Config extends Model
{
    public $table = 'ideas_config';
    public $timestamps = false;//disable 'created_at' and 'updated_at'
    use Validation;

    const IS_DEFAULT = 1;
    const IS_PLUS = 2;

    public $rules = [
        'name' => 'required',
        'slug' => 'required',
        'value' => 'required',
    ];

    /**
     * Get config by key
     */
    public static function getConfigByKey($key)
    {
        $rs = '';
        $data = self::select('value')->where('slug', $key)
            ->first();
        if (!empty($data)) {
            $rs = $data->value;
        }
        return $rs;
    }

    /**
     * Get array cache setting
     */
    public static function arrayCacheSetting()
    {
        $rs = [
            IdeasShop::CACHE_DISABLE => trans('ideas.shop::lang.general.disable'),
            IdeasShop::CACHE_ENABLE => trans('ideas.shop::lang.general.enable'),
        ];
        return $rs;
    }

    /**
     * Get config default
     */
    public static function getConfigDefault()
    {
        $data = self::where('is_default', \Ideas\Shop\Models\Config::IS_DEFAULT)->get();
        $rs = [];
        foreach ($data as $row) {
            $rs[$row->slug] = $row->value;
        }
        return $rs;
    }

    /**
     * Is config default
     */
    public static function isConfigDefault($id)
    {
        $data = self::select('is_default')->where('id', $id)->first();
        if ($data->is_default == self::IS_DEFAULT) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Get currency symbol
     */
    public static function getCurrencySymbol()
    {
        $currencyDefault = self::getConfigByKey('currency_default');
        $data = Currency::select('symbol', 'symbol_position', 'code')->where('id', $currencyDefault)->first();
        if (!empty($data)) {
            return $data->toArray();
        } else {
            return ['symbol'=>'$', 'symbol_position' => Currency::POSITION_AFTER, 'code'=>'USD'];//return usd
        }
    }

    /**
     * after save
     */
    public function afterSave()
    {
        $dataSaved = $this->attributes;
        $post = post();
        Event::fire('ideas.shop.save_config', [$dataSaved, $post]);
    }
}