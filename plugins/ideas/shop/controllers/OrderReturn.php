<?php

namespace Ideas\Shop\Controllers;

class OrderReturn extends IdeasShopController
{
    public $requiredPermissions = ['ideas.shop.access_order_return'];
    public $controllerName = 'orderreturn';

    public function update($recordId = null)
    {
        $this->pageTitle = 'ideas.shop::lang.action.update';
        $this->vars['controller'] = $this->controllerName;
        $this->vars['data'] = \Ideas\Shop\Models\OrderReturn::getOrderReturn($recordId);
    }
}
