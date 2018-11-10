<?php

namespace Ideas\Shop\Models;

use October\Rain\Database\Model;

class UserExtend extends Model
{

    protected $table = 'ideas_users_extends';
    public $timestamps = false;//disable 'created_at' and 'updated_at'

    /**
     * Save user extend data for shipping
     */
    public static function saveUserRegister($userId, $data)
    {
        $data['user_id'] = $userId;
        unset($data['password']);
        unset($data['password_confirmation']);
        self::insert($data);
    }

    /**
     * Get user extend data
     */
    public static function getUserExtendData($id)
    {
        return self::where('user_id', $id)->get();
    }
}