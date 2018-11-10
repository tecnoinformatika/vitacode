<?php

namespace Ideas\Shop\Models;

use Illuminate\Support\Facades\DB;
use October\Rain\Database\Model;

class OrderStatusChange extends Model
{

    protected $table = 'ideas_order_status_change';

    public static function getOrderStatusChange($id)
    {
        $data = self::where('order_id', $id)
            ->get()
            ->toArray();
        return $data;
    }

    public static function createOrderStatusChange($post)
    {
        DB::beginTransaction();
        try {
            $model = new OrderStatusChange();
            $model->order_id = $post['id'];
            $model->order_status_id = $post['order_status_id'];
            $model->comment = $post['comment'];
            $model->save();
            Order::updateOrderStatus($post['id'], $post['order_status_id']);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
        }
    }

}