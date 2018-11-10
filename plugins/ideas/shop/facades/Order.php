<?php

namespace Ideas\Shop\Facades;

use Ideas\Shop\Models\Config;
use Ideas\Shop\Models\CouponHistory;
use Ideas\Shop\Models\Currency;
use Ideas\Shop\Models\IdeasShop;
use Ideas\Shop\Models\OrderProduct;
use Ideas\Shop\Models\ProductDownloadable;
use Ideas\Shop\Models\ProductDownloadableLink;
use Ideas\Shop\Models\Products;
use Ideas\Shop\Models\UserExtend;
use Illuminate\Support\Facades\DB;
use \October\Rain\Database\Model;
use RainLab\User\Facades\Auth;
use Mail;

class Order extends Model
{
    const IS_LOGIN = 1;
    const NOT_LOGIN = 0;

    const SAVE_ORDER_SUCCESS = 1;
    const SAVE_ORDER_FAIL = 0;


    /**
     * Assign value if empty
     */
    public static function assignValueIfEmptyInAddress($array, $key, $value)
    {
        if (!empty($array)) {
            if (!empty($array[$key][0])) {//if empty or 0
                return $array[$key][0];//get first element in array
            } else {
                return $value;
            }
        }
        return $array;
    }

    /**
     * address not login
     * Get information of address from form
     */
    public static function addressNotLogin($order, $arrayName, $formPaymentInfo)
    {
        $arrayBillingName = ['billing_email', 'billing_phone', 'billing_address'];
        $arrayShippingName = ['shipping_email', 'shipping_phone', 'shipping_address'];
        if (empty($formPaymentInfo['use_same_address_not_login'])) {//shipping address != billing address
            $order['billing_name'] = $formPaymentInfo['billing_first_name'][0].' '. $formPaymentInfo['billing_last_name'][0];
            $order['shipping_name'] = $formPaymentInfo['shipping_first_name'][0].' '. $formPaymentInfo['shipping_last_name'][0];
            $i = 0;
            foreach ($arrayName as $row) {
                $order['billing_'.$row] = self::assignValueIfEmptyInAddress($formPaymentInfo, $arrayBillingName[$i], null);
                $order['shipping_'.$row] = self::assignValueIfEmptyInAddress($formPaymentInfo, $arrayShippingName[$i], null);
                $i++;
            }
        } else {//shipping address == billing address
            $order['billing_name'] = $formPaymentInfo['billing_first_name'][0].' '. $formPaymentInfo['billing_last_name'][0];
            $order['shipping_name'] = $formPaymentInfo['billing_first_name'][0].' '. $formPaymentInfo['billing_first_name'][0];
            $y = 0;
            foreach ($arrayName as $row) {
                $order['billing_'.$row] = self::assignValueIfEmptyInAddress($formPaymentInfo, $arrayBillingName[$y], null);
                $order['shipping_'.$row] = self::assignValueIfEmptyInAddress($formPaymentInfo, $arrayBillingName[$y], null);
                $y++;
            }
        }
        return $order;
    }

    /**
     * Address when login
     *  Get information of address from database
     */
    public static function addressLogin($order, $post, $arrayName)
    {
        $addressBilling = $post['address_billing'];
        $addressShipping = $post['address_shipping'];
        if ($addressBilling == $addressShipping) {
            $address = UserExtend::where('id', $addressBilling)->first();
            if (!empty($address)) {
                $addressArray = $address->toArray();
                $order['billing_name'] = $addressArray['first_name'].' '. $addressArray['last_name'];
                $order['shipping_name'] = $addressArray['first_name'].' '. $addressArray['last_name'];
                foreach ($arrayName as $row) {
                    $order['billing_'.$row] = $addressArray[$row];
                    $order['shipping_'.$row] = $addressArray[$row];
                }
            }
        } else {
            $address = UserExtend::whereIn('id', [$addressBilling, $addressShipping])->get()->toArray();
            $rs = [];
            foreach ($address as $row) {
                $rs[$row['id']] = $row;
            }
            $addressBillingArray = $rs[$addressBilling];
            $addressShippingArray = $rs[$addressShipping];
            $order['billing_name'] = $addressBillingArray['first_name'].' '. $addressBillingArray['last_name'];
            $order['shipping_name'] = $addressShippingArray['first_name'].' '. $addressShippingArray['last_name'];
            foreach ($arrayName as $row) {
                $order['billing_'.$row] = $addressBillingArray[$row];
                $order['shipping_'.$row] = $addressShippingArray[$row];
            }
        }
        return $order;
    }


    public static function billingAndShippingAddress($order, $formPaymentInfo, $post)
    {
        $arrayName = ['email', 'phone', 'address'];
        if ($formPaymentInfo['is_login'][0] == self::NOT_LOGIN) {
            $order = self::addressNotLogin($order, $arrayName, $formPaymentInfo);
        } else {//logged in
            $order = self::addressLogin($order, $post, $arrayName);
        }
        return $order;
    }

    public static function saveProduct($orderId, $product)
    {
        $orderProduct = [];
        foreach ($product as $row) {
            $orderProduct[] = [
                'order_id' => $orderId,
                'product_id' => $row['id'],
                'name' => $row['name'],
                'qty' => $row['qty'],
                'price_after_tax' => $row['price'],
                'total' => $row['qty'] * $row['price'],
                'weight' => $row['weight'],
                'weight_id' => $row['weight_id']
            ];
        }
        OrderProduct::insert($orderProduct);
    }

    /**
     * Save order quantity
     */
    public static function saveOrderQuantity($product)
    {
        foreach ($product as $key => $value) {
            $product = Products::where('id', $value['id'])->first();
            $qtyOrder =  $product->qty_order + $value['qty'];
            Products::where('id', $value['id'])->update(['qty_order'=>$qtyOrder]);
        }
    }


    /**
     * Save order data
     */
    public static function saveOrderData($post, $formPaymentInfo)
    {
        $order = [
            'user_id' => $post['user_id'],
            'shipping_cost' => $post['shipping_cost'],
            'total' => $post['total'],
            'order_status_id' => $post['order_status_id'],
            'payment_method_id' => $post['payment_method_id'],
            'shipping_rule_id' => $post['shipping_rule_id'],
            'comment' => $post['comment'],
            'created_at' => date('Y-m-d H:i:s'),
            'payment_status' => IdeasShop::PAYMENT_STATUS_NOT_PAID
        ];
        $order = self::billingAndShippingAddress($order, $formPaymentInfo, $post);
        $orderId = \Ideas\Shop\Models\Order::insertGetId($order);
        $product = $post['cart'];
        self::saveProduct($orderId, $product);
        self::saveOrderQuantity($product);
        return ['order'=>$order, 'orderId'=>$orderId];
    }

    /**
     * Send mail order
     */
    public static function sendOrderMail($order, $post)
    {
        $loggedIn = Auth::getUser();
        if (!empty($loggedIn)) {//for loggin user
            $arrayEmailUnique = [$loggedIn->email];
            $userId = $loggedIn->id;
            $userExtendData = UserExtend::find($userId);
            if (!empty($userExtendData)) {
                $name = $userExtendData->first_name.' '.$userExtendData->last_name;
            } else {
                $name = 'John Doe';
            }
        } else {//for guest
            $emailArray = [$order['order']['billing_email'], $order['order']['shipping_email']];
            $arrayEmailUnique = array_unique($emailArray);
            $name = $post['order']['billing_first_name'].' '.$post['billing_last_name'];
        }
        $post['orderId'] = $order['orderId'];
        foreach ($arrayEmailUnique as $email) {
            $params = [
                'email' => $email,
                'name' => $name,
                'subject' => 'ideas.shop::lang.subject.order_success',
                'data' => $post,
                'template' => 'ideas.shop::mail.orderSuccess'
            ];
            IdeasShop::sendMail($params);
        }
    }

    /**
     * Save coupon id history
     */
    public static function saveCouponIdHistory($orderId, $post)
    {
        $couponHistory = new CouponHistory();
        $couponHistory->order_id = $orderId;
        $couponHistory->coupon_id = $post['coupon_id'];
        $couponHistory->customer_id = $post['user_id'];
        $couponHistory->total = $post['coupon_total'];
        $couponHistory->save();
    }

    /**
     * Save order
     */
    public static function saveOrder($post, $formPaymentInfo)
    {
        DB::beginTransaction();
        try {
            $order = self::saveOrderData($post, $formPaymentInfo);
            if ($post['coupon_id'] != 0) {
                self::saveCouponIdHistory($order['orderId'], $post);
            }
            DB::commit();
            //send mail
            self::sendOrderMail($order, $post);
            return $order['orderId'];
        } catch (\Exception $e) {
            DB::rollBack();
            return self::SAVE_ORDER_FAIL;
        }
    }

    /**
     * Get downloadable product of order
     */
    public static function getDownloadableProductOfOrder($orderId)
    {
        $product = OrderProduct::select('product_id', 'order_id')
            ->with(['product:id,product_type', 'order:id,shipping_email'])
            ->where('order_id', $orderId)
            ->get()
            ->toArray();
        $productDownloadableIdArray = [];
        $email = '';
        foreach ($product as $row) {
            if ($row['product']['product_type'] == Products::PRODUCT_TYPE_DOWNLOADABLE) {
                $productDownloadableIdArray[] = $row['product']['id'];
                $email = $row['order']['shipping_email'];
            }
        }
        if (!empty($productDownloadableIdArray)) {
            $productDownloadableIdArrayUnique = array_unique($productDownloadableIdArray);
            $productDownloadable = ProductDownloadable::whereIn('product_id', $productDownloadableIdArrayUnique)->get();
            foreach ($productDownloadable as $row) {
                $params = [
                    'email' => $email,
                    'productId' => $row->product_id,
                    'link' => $row->link
                ];
                ProductDownloadableLink::sendDownloadLink($params);
            }
        }
    }

    /**
     * Change status payment to paid
     */
    public static function changeStatusPaymentToPaid($orderId)
    {
        \Ideas\Shop\Models\Order::where('id', $orderId)->update(['payment_status'=>IdeasShop::PAYMENT_STATUS_PAID]);
        $isDownloadRightAfterCheckout = Config::getConfigByKey('download_right_after_checkout');
        if ($isDownloadRightAfterCheckout == IdeasShop::ENABLE) {
            //send download link right after checkout if paid
            self::getDownloadableProductOfOrder($orderId);
        }
    }

}