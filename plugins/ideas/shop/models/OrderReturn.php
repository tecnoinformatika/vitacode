<?php

namespace Ideas\Shop\Models;

use Illuminate\Support\Facades\DB;
use October\Rain\Database\Model;

class OrderReturn extends Model
{
    protected $table = 'ideas_order_return';

    const REVERSE_QTY_ORDER = 1;
    const NOT_REVERSE_QTY_ORDER = 0;

    /**
     * belong to reason
     */
    public function reason()
    {
        return $this->belongsTo('Ideas\Shop\Models\Reason', 'reason_id', 'id');
    }

    /**
     * Convert product
     */
    public static function convertProduct($data)
    {
        $rs = [];
        foreach ($data as $row) {
            $rs[$row['product_id']] = $row;
        }
        return $rs;
    }

    /**
     * Decrease order qty
     */
    public static function decreaseOrderQty($productData, $productQtyReverse)
    {
        $productId = $productData['product_id'];
        $qtyDecrease = $productData['qty'];
        $product = Products::select('qty_order')->where('id', $productId)
            ->first();
        $qtyOrder = $product->qty_order;
        if ($qtyOrder > 0 && !empty($product) && $qtyOrder >= $qtyDecrease) {
            if (in_array($productId, $productQtyReverse)) {
                //just decrease qty order if check qty reverse
                Products::where('id', $productId)->update(['qty_order'=>$qtyOrder - $qtyDecrease]);
            }
        }
    }

    /**
     * Save order return
     */
    public static function saveOrderReturn($productData, $order, $post, $productQtyReverse)
    {
        $orderReturn = new OrderReturn();
        $orderReturn->order_id = $productData['order_id'];
        $orderReturn->product_id = $productData['product_id'];
        $orderReturn->product_name = $productData['name'];
        $orderReturn->customer_id = $order['user_id'];
        $orderReturn->billing_name = $order['billing_name'];
        $orderReturn->shipping_name = $order['shipping_name'];
        $orderReturn->billing_phone = $order['billing_phone'];
        $orderReturn->billing_email = $order['billing_email'];
        $orderReturn->shipping_phone = $order['shipping_phone'];
        $orderReturn->shipping_email = $order['shipping_email'];
        $orderReturn->reason_id = $post['reason_id'];
        $orderReturn->qty_order = $productData['qty'];
        $isReverseQtyOrder = IdeasShop::DISABLE;
        if (in_array($productData['product_id'], $productQtyReverse)) {
            $isReverseQtyOrder = IdeasShop::ENABLE;
        }
        $orderReturn->is_reverse_order_qty = $isReverseQtyOrder;
        $orderReturn->save();
    }

    /**
     * create order return
     */
    public static function createOrderReturn($post)
    {
        $product = $post['product'];
        $productConvert = self::convertProduct($product);
        $order = $post['order'];
        $productChecked = $post['product_checked'];
        $productQtyReverse = $post['qty_reverse'];
        if (!empty($productChecked)) {
            DB::beginTransaction();
            try {
                foreach ($productChecked as $row) {
                    if (array_key_exists($row, $productConvert)) {
                        $productData = $productConvert[$row];
                        self::saveOrderReturn($productData, $order, $post, $productQtyReverse);
                        self::decreaseOrderQty($productData, $productQtyReverse);
                    }
                }
                DB::commit();
                return ['result'=>IdeasShop::SUCCESS];
            } catch (\Exception $e) {
                DB::rollBack();
                return ['result'=>IdeasShop::FAIL];
            }
        }
        return ['result'=>IdeasShop::FAIL];
    }

    /**
     * Check product in order is return
     */
    public static function checkProductInOrderIsReturn($post)
    {
        $productIdArray = [];
        $orderId = 0;
        foreach ($post as $row) {
            $productIdArray[] = $row['product_id'];
            $orderId = $row['order_id'];
        }
        $data = self::select('product_id')->where('order_id', $orderId)
            ->whereIn('product_id', $productIdArray)
            ->get();
        $productIdArrayReturned = [];
        if (!empty($data)) {
            foreach ($data as $row) {
                $productIdArrayReturned[] = $row->product_id;
            }
        }
        $rs = [
            'productIdArray' => $productIdArray,
            'productIdArrayReturned' => $productIdArrayReturned
        ];
        return $rs;
    }

    /**
     * Map text for reverse order
     */
    public static function mapTextReverseOrder()
    {
        return [
            self::REVERSE_QTY_ORDER => e(trans('ideas.shop::lang.general.yes')),
            self::NOT_REVERSE_QTY_ORDER => e(trans('ideas.shop::lang.general.no'))
        ];
    }

    /**
     * Get order return
     */
    public static function getOrderReturn($id)
    {
        $data = self::with(['reason:id,name'])->find($id);
        $mapText = self::mapTextReverseOrder();
        $data->is_reverse_order_qty = !empty($mapText[$data->is_reverse_order_qty]) ?
            $mapText[$data->is_reverse_order_qty] : '';
        return $data;
    }
}