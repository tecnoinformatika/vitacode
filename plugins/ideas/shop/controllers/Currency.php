<?php

namespace Ideas\Shop\Controllers;

use Flash;
use Backend;

class Currency extends IdeasShopController
{
    public $requiredPermissions = ['ideas.shop.access_currency'];
    public $controllerName = 'currency';

    /**
     * Update value of currency
     */
    public function updatevalue()
    {
        \Ideas\Shop\Models\Currency::updateCurrencyValue();
        Flash::success("You've just updated currency");
        $url = Backend::url('ideas/shop/currency/index');
        return redirect($url);
    }

}
