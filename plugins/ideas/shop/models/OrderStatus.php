<?php

namespace Ideas\Shop\Models;

use October\Rain\Database\Model;

class OrderStatus extends Model
{

    protected $table = 'ideas_order_status';
    public $timestamps = false;//disable 'created_at' and 'updated_at'

    public static function getOrderStatusNameById($id)
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

    public static function getOrderStatus()
    {
        $data = self::get()->toArray();
        return $data;
    }

}