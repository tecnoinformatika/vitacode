<?php namespace Ideas\Shop\Components;

use Cms\Classes\ComponentBase;
use Ideas\Shop\Models\Order;
use RainLab\User\Facades\Auth;

class UserOrder extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name' => 'User extend order',
            'description' => 'extend user plugin'
        ];
    }

    public function onRun()
    {
        $user = Auth::getUser();
        if (!empty($user)) {
            $userId = $user->id;
            $this->page['orderData'] = Order::getOrderData($userId);
        }
    }
}