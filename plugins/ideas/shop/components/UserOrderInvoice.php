<?php namespace Ideas\Shop\Components;

use Cms\Classes\ComponentBase;
use Ideas\Shop\Models\Config;
use Ideas\Shop\Models\Order;
use Ideas\Shop\Models\OrderProduct;
use Ideas\Shop\Models\Ship;
use October\Rain\Support\Facades\Twig;
use RainLab\User\Facades\Auth;
use View;
use Illuminate\Support\Facades\Response;

class UserOrderInvoice extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name' => 'User extend order invoice',
            'description' => 'Display order invoice'
        ];
    }

    /**
     * Get invoice data
     */
    public static function getInvoice($orderData, $product)
    {
        $orderData['shipping_rule_name'] =  Ship::getShipRuleNameById($orderData['shipping_rule_id']);
        $orderData['payment_method_name'] = Order::paymentMethodName($orderData['payment_method_id']);
        $data['order'] = $orderData;
        $data['product'] = $product;
        $data['baseUrl'] = url('/');
        $data['css'] = Config::getConfigByKey('invoice_css');
        $data['template'] = Config::getConfigByKey('invoice_template');
        $data['template_css'] = $data['css'].''.$data['template'];
        $data['shipping_cost'] = $orderData['shipping_cost'];
        $data['total'] = $orderData['total'];
        $data['now'] = date('Y-m-d', strtotime($orderData['created_at']));
        return $data;
    }

    public function onRun()
    {
        $user = Auth::getUser();
        if (!empty($user)) {
            $userId = $user->id;
            $orderId = $this->param('id');
            $orderCheck = UserOrderDetail::checkOrderIdBelongUserId($userId, $orderId);
            if (!empty($orderCheck)) {
                $orderProduct = OrderProduct::getOrderProduct($orderId);
                $invoice = self::getInvoice($orderCheck, $orderProduct);
                return Twig::parse($invoice['template_css'], $invoice);//twig parse code from string
            } else {
                return Response::make(View::make('cms::404'), 404);
            }
        }
    }

}