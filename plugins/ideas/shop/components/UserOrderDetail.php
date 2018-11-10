<?php namespace Ideas\Shop\Components;

use Cms\Classes\ComponentBase;
use Ideas\Shop\Models\Order;
use Ideas\Shop\Models\OrderProduct;
use Ideas\Shop\Models\Ship;
use Illuminate\Support\Facades\URL;
use RainLab\User\Facades\Auth;
use View;
use Illuminate\Support\Facades\Response;

class UserOrderDetail extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name' => 'User extend order detail',
            'description' => 'Display order detail'
        ];
    }

    /**
     * Check order id belong user id
     */
    public static function checkOrderIdBelongUserId($userIdCheck, $orderId)
    {
        $data = Order::getOrderDetail($orderId);
        if (!empty($data)) {
            $userId = $data['user_id'];
            if ($userId == $userIdCheck) {
                return $data;
            }
        }
        return [];
    }


    public function onRun()
    {
        $user = Auth::getUser();
        if (!empty($user)) {
            $userId = $user->id;
            $orderId = $this->param('id');
            $orderCheck = self::checkOrderIdBelongUserId($userId, $orderId);
            if (!empty($orderCheck)) {
                $this->page['order'] = $orderCheck;
                $orderProduct = OrderProduct::getOrderProduct($orderId);
                
                $this->page['product'] = $orderProduct;
                $this->page['shipping_rule_name'] =  Ship::getShipRuleNameById($orderCheck['shipping_rule_id']);
                $this->page['urlPrintInvoice'] = URL::to('/order/invoice/'.$orderId);
            } else {
                return Response::make(View::make('cms::404'), 404);
            }
        }

    }


}