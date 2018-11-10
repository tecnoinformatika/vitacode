<?php namespace Ideas\Shop\Models;

use October\Rain\Database\Model;

class Order extends Model
{
    public $table = 'ideas_order';

    const PAYMENT_METHOD_COD = 1;
    const PAYMENT_METHOD_PAYPAL = 2;
    const PAYMENT_METHOD_STRIPE = 3;

    public $hasOne = [
        'order_status_relation' => [
            'Ideas\Shop\Models\OrderStatus',
            'key' => 'id',//primary key
            'otherKey' => 'order_status_id'//foreign key
        ]
    ];

    /**
     * Has many product
     */
    public function product()
    {
        return $this->hasMany('\Ideas\Shop\Models\OrderProduct', 'order_id', 'id');
    }

    /**
     * belongs to order status
     */
    public function orderStatus()
    {
        return $this->belongsTo('\Ideas\Shop\Models\OrderStatus', 'order_status_id', 'id');
    }

    /**
     * Get order data
     */
    public static function getOrderData($userId)
    {
        $data = self::with(['product:*', 'orderStatus:id,name'])
            ->where('user_id', $userId)
            ->paginate(10);
        return $data;
    }

    /**
     * Get order detail
     */
    public static function getOrderDetail($id)
    {
        $data = self::select('*')
            ->where('id', $id)
            ->first();
        $rs = [];
        if (!empty($data)) {
            $rs = $data->toArray();
        }
        return $rs;
    }

    //update order status
    public static function updateOrderStatus($id, $status)
    {
        $order = self::find($id);
        $order->order_status_id = $status;
        $order->save();
    }

    /**
     * Change payment status
     */
    public static function changePaymentStatus($post)
    {
        $order = self::find($post['id']);
        $order->payment_status = $post['payment_status'];
        $order->save();
        return $order;
    }

    /**
     * payment method name
     */
    public static function paymentMethodName($id)
    {
        $arrayPayment = [
            self::PAYMENT_METHOD_COD => trans('ideas.shop::lang.order.cash_on_delivery'),
            self::PAYMENT_METHOD_PAYPAL => trans('ideas.shop::lang.order.paypal'),
            self::PAYMENT_METHOD_STRIPE => trans('ideas.shop::lang.order.stripe'),
        ];
        $name = trans('ideas.shop::lang.order.cash_on_delivery');
        if (array_key_exists($id, $arrayPayment)) {
            $name = $arrayPayment[$id];
        }
        return $name;
    }

}