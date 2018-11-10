<?php

namespace Ideas\Shop\Models;

use Illuminate\Support\Facades\Cache;
use October\Rain\Database\Model;
use Mail;

class IdeasShop extends Model
{
    const TABLE_PREFIX = 'ideas';
    const ENABLE = 1;
    const DISABLE = 0;

    const COUPON_PREFIX = 'shop';
    const COUPON_RANDOM_LENGTH = 8;

    const MODEL_PRODUCT = 1;
    const MODEL_CATEGORY = 2;

    const CACHE_ENABLE = 1;
    const CACHE_DISABLE = 0;

    const CACHE_DEFAULT_TIME = 1;

    const IN_STOCK = 1;
    const OUT_OF_STOCK = 0;

    const PAYMENT_STATUS_NOT_PAID = 0;
    const PAYMENT_STATUS_PAID = 1;

    const SUCCESS = 1;
    const FAIL = 0;

    const MAIL_SEND = 0;
    const MAIL_QUEUE = 1;

    /**
     * model initial
     */
    public static function modelInitial($modelId)
    {
        $modelArray = [
            self::MODEL_PRODUCT => new Products(),
            self::MODEL_CATEGORY => new Category()
        ];
        $model = new \stdClass();
        if (array_key_exists($model, $modelArray)) {
            return $modelArray[$modelId];
        }
    }

    /**
     * Get option field
     */
    public static function getOptionOfField($object)
    {
        $data = $object::select('id', 'name')
            ->get()
            ->toArray();
        $rs = [];
        foreach ($data as $row) {
            $rs[$row['id']] = $row['name'];
        }
        return $rs;
    }

    /**
     * Get option for field form in twig
     */
    public static function getOptionOfFieldForTwigForm($object)
    {
        $data = $object::select('id', 'name')
            ->get()
            ->toArray();
        return $data;
    }

    /**
     * $data is object
     * Convert array to ['id'=>'name']
     */
    public static function convertArrayKeyValue($data, $key, $value)
    {
        $rs = [];
        if (!empty($data)) {
            foreach ($data as $row) {
                $rs[$row->$key] = $row->$value;
            }
        }
        return $rs;
    }

    /**
     * Generate random string
     */
    public static function generateRandomString($length = 10)
    {
        $characters = '123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    /**
     * Return Cache data
     */
    public static function returnCacheData($cacheKey, $function)
    {
        $isCacheEnable = Config::getConfigByKey('is_cache');
        !empty($isCacheEnable) ? $cache = $isCacheEnable : $cache = self::CACHE_DISABLE;
        $cacheTime = Config::getConfigByKey('cache_minutes');
        !empty($cacheTime) ? $minutes = $cacheTime : $minutes = self::CACHE_DEFAULT_TIME;
        if ($cache == self::CACHE_ENABLE) {
            $value = Cache::remember($cacheKey, $minutes, function () use ($function) {
                return $function();
            });
            return $value;
        } else {
            return $function();
        }
    }

    /**
     * Check single product object
     */
    public static function checkSingleProductCanBuy($data)
    {
        $isOutOfStock = self::OUT_OF_STOCK;
        if ($data->qty > $data->qty_order || $data->qty == 0) {
            $isOutOfStock = self::IN_STOCK;
        }
        $data->is_out_of_stock = $isOutOfStock;
        if ($data->product_type == Products::PRODUCT_TYPE_CONFIGURABLE || $isOutOfStock == self::OUT_OF_STOCK) {
            $data->action_class = 'view-now';
            $data->action_text = trans('ideas.shop::lang.plugin.view_now');
        } else {
            $data->action_class = 'buy-now';
            $data->action_text = trans('ideas.shop::lang.plugin.buy_now');
        }
        return $data;
    }

    /**
     * Check single product array can buy
     */
    public static function checkSingleProductCanBuyArray($data)
    {
        $isOutOfStock = self::OUT_OF_STOCK;
        if ($data['qty'] > $data['qty_order'] || $data['qty'] == 0) {
            $isOutOfStock = self::IN_STOCK;
        }
        $data['is_out_of_stock'] = $isOutOfStock;
        if ($data['product_type'] == Products::PRODUCT_TYPE_CONFIGURABLE || $isOutOfStock == self::OUT_OF_STOCK) {
            $data['action_class'] = 'view-now';
            $data['action_text'] = trans('ideas.shop::lang.plugin.view_now');
        } else {
            $data['action_class'] = 'buy-now';
            $data['action_text'] = trans('ideas.shop::lang.plugin.buy_now');
        }
        return $data;
    }

    /**
     * Check if product can buy now
     */
    public static function checkProductCanBuy($data)
    {
        foreach ($data as $row) {
            self::checkSingleProductCanBuy($row);
        }
        return $data;
    }

    /**
     * Convert object to Array
     */
    public static function objectToArray($object)
    {
        $json = json_encode($object);
        $array = json_decode($json, true);
        return $array;
    }

    /**
     * Display price and currency
     */
    public static function displayPriceAndCurrency($price)
    {
        $currency = Config::getCurrencySymbol();
        if ($currency['symbol_position'] == Currency::POSITION_BEFORE) {//before
            return $currency['symbol']. ' ' .$price;
        } else {//after
            return $price. ' '. $currency['symbol'];
        }
    }

    /**
     * Ideas shop send mail
     * There are four params:
     * email : email of receiver
     * name : name of receiver
     * template: name of mail template
     * subject : subject of mail
     * data: data pass to email
     */
    public static function sendMail($params)
    {
        $mailMethod = Config::getConfigByKey('mail_method');
        !empty($mailMethod) ? $method = $mailMethod : $method = self::MAIL_SEND;
        if ($method == self::MAIL_SEND) {//send
            Mail::send($params['template'], $params['data'], function ($message) use ($params) {
                $message->to($params['email'], $params['name']);
                $message->subject(e(trans($params['subject'])));
            });
        } else {//quueue
            Mail::queue($params['template'], $params['data'], function ($message) use ($params) {
                $message->to($params['email'], $params['name']);
                $message->subject(e(trans($params['subject'])));
            });
        }
    }

    /**
     * Assign value for key if this key not exist in array $array
     */
    public static function assignValueIfKeyNotExists($array, $key, $value)
    {
        if (!empty($array)) {
            if (array_key_exists($key, $array)) {
                return $array[$key];
            } else {
                return $value;
            }
        }
        return $array;
    }

}