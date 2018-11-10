<?php

namespace Ideas\Shop\Models;

use October\Rain\Database\Model;

class Reason extends Model
{
    protected $table = 'ideas_order_return_reason';
    public $timestamps = false;//disable 'created_at' and 'updated_at'

    /**
     * Get all reason
     */
    public static function getAllReason()
    {
        return self::all();
    }
}